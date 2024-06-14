<?php
class Pagination extends Table
{
    public $jarak = 3;
    public function pagelist()
    {

        $hal = $this->halaman();
        $getValue = $this->CekNumeric();
        $getValue = ($getValue > $hal) ? 1 : $getValue;
        $last = $getValue - 1;
        $next = $getValue + 1;
        $max = $getValue + $this->jarak;
        $min = $getValue - $this->jarak;
        $min = ($min <= 1) ?  1 : $min;
        $max = ($max >= $hal) ? $hal : $max;
        $dis = ($getValue == '1') ? 'disabled' : '';
        $dise = ($getValue == $hal) ? 'disabled' : '';
        $output =  "<nav aria-label='Page navigation example'><ul class='pagination justify-content-center'>";
        $output .= "<li class='page-item $dis'><a class='page-link' href='?page=1' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
        $output .= "<li class='page-item $dis'><a class='page-link' href='?page=$last'>Previous</a></li>";
        for ($page = $min; $page <= $max; $page++) :
            $ac = ($getValue == $page) ? 'active' : '';
            $output .= "<li class='page-item $ac'><a class='page-link' href='?page=$page'>$page</a></li>";
        endfor;
        $output .= "<li class='page-item $dise'><a class='page-link' href='?page=$next'>Next</a></li>";
        $output .= "<li class='page-item $dise'><a class='page-link' href='?page=$hal' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
        $output .= "</ul></nav>";
        return $output;
    }
}
