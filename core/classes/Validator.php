<?php

namespace App\Core;

class Validator
{
    protected array $data = [];
    protected array $rules = [];
    protected array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->validate();
    }

    public static function make(array $data, array $rules): self
    {
        return new self($data, $rules);
    }

    protected function validate(): void
    {
        foreach ($this->rules as $field => $ruleString) {
            $value = $this->data[$field] ?? null;
            $ruleList = is_array($ruleString) ? $ruleString : explode('|', $ruleString);

            foreach ($ruleList as $rule) {
                $params = [];
                if (str_contains($rule, ':')) {
                    [$ruleName, $paramStr] = explode(':', $rule, 2);
                    $params = explode(',', $paramStr);
                } else {
                    $ruleName = $rule;
                }

                switch ($ruleName) {
                    case 'required':
                        if ($value === null || $value === '') {
                            $this->addError($field, "Bidang {$field} wajib diisi.");
                        }
                        break;

                    case 'email':
                        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($field, "Format email pada {$field} tidak valid.");
                        }
                        break;

                    case 'numeric':
                        if (!empty($value) && !is_numeric($value)) {
                            $this->addError($field, "Bidang {$field} harus berupa angka.");
                        }
                        break;

                    case 'min':
                        $min = (int)($params[0] ?? 0);
                        if (!empty($value) && strlen((string)$value) < $min) {
                            $this->addError($field, "Bidang {$field} minimal {$min} karakter.");
                        }
                        break;

                    case 'max':
                        $max = (int)($params[0] ?? 255);
                        if (!empty($value) && strlen((string)$value) > $max) {
                            $this->addError($field, "Bidang {$field} maksimal {$max} karakter.");
                        }
                        break;
                }
            }
        }
    }

    protected function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function firstError(): string
    {
        foreach ($this->errors as $fieldErrors) {
            return $fieldErrors[0] ?? '';
        }
        return '';
    }
}
