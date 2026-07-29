<?php

namespace App\Core;

class Resource
{
    protected mixed $data;

    public function __construct(mixed $data)
    {
        $this->data = $data;
    }

    public static function make(mixed $data, ?callable $callback = null): array
    {
        if ($callback !== null) {
            return $callback($data);
        }
        if (is_object($data) && method_exists($data, 'toArray')) {
            return $data->toArray();
        }
        return (array)$data;
    }

    public static function collection(iterable $items, ?callable $callback = null): array
    {
        $result = [];
        foreach ($items as $item) {
            $result[] = self::make($item, $callback);
        }
        return $result;
    }
}
