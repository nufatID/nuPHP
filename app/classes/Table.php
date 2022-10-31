<?php
class Table
{
    public $after_aray;

    public function getTablePage($h = null)
    {
        $header = $this->pagination()[0];
        $nu = $this->no();

        $output = "<table class='table table-striped'><thead><tr class='bg-warning'>";
        $output .= "<th scope='col' class='text-center'>No</th>";
        if (isset($h)) {
            foreach ($h as $key) :
                $output .= "<th scope='col'>$key</th>";
            endforeach;
        } else {
            foreach ($header as $key => $vav) :
                $output .= "<th scope='col'>$key</th>";
            endforeach;
        }
        if (isset($this->after_aray)) {
            foreach ($this->after_aray as $key => $vav) :
                $output .= "<th scope='col' class='text-center'>$key</th>";
            endforeach;
        }
        $output .= "</tr></thead><tbody>";

        foreach ($this->pagination() as $key => $value) :
            $output .= "<tr>";
            $output .= "<td class='text-center'>$nu</td>";
            foreach ($value as $v) :
                $output .= "<td>$v</td>";
            endforeach;

            if (isset($this->after_aray)) {
                foreach ($this->after_aray as $keya => $vava) :

                    foreach ($header as $key => $vav) :
                        $vava = str_replace('{{' . $key . '}}', $value[$key], $vava);
                    endforeach;
                    $output .= "<th scope='col' class='text-center'>$vava</th>";
                endforeach;
            }
            $output .= "</tr>";
            $nu++;
        endforeach;
        $output .= "</tbody></table>";
        return $output;
    }
    public function getTable($h = null)
    {
        $header = $this->getAll()[0];
        $nu = 1;

        $output = "<table class='table table-striped'><thead><tr>";
        $output .= "<th scope='col'>No</th>";
        if (isset($h)) {
            foreach ($h as $key) :
                $output .= "<th scope='col'>$key</th>";
            endforeach;
        } else {
            foreach ($header as $key => $vav) :
                $output .= "<th scope='col'>$key</th>";
            endforeach;
        }

        $output .= "</tr></thead><tbody>";

        foreach ($this->getAll() as $key => $value) :
            $output .= "<tr>";
            $output .= "<td>$nu</td>";
            foreach ($value as $v) :
                $output .= "<td>$v</td>";
            endforeach;
            $output .= "</tr>";
            $nu++;
        endforeach;
        $output .= "</tbody></table>";
        return $output;
    }

    public function Add_row($a)
    {
        $this->after_aray = $a;
    }
}
