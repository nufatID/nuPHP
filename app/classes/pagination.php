<?php
class Pagination
{
    public function showlist()
    {

        $last = $_GET['page'] - 1;
        $next = $_GET['page'] + 1;

        $max = $_GET['page'] + 4;
        $min = $_GET['page'] - 4;
        if ($min <= 1) {
            $min = 1;
        }
        if ($max >= $this->total_pages) {
            $max =  $this->total_pages;
        }
        if ($_GET['page'] == '1') {
            $dis = 'disabled';
        } else {
            $dis = '';
        }
        if ($_GET['page'] == $this->total_pages) {
            $dise = 'disabled';
        } else {
            $dise = '';
        }

        $output =  "<nav aria-label='Page navigation example'><ul class='pagination justify-content-center'>";
        $output .= "<li class='page-item $dis'><a class='page-link' href='?page=1' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
        $output .= "<li class='page-item $dis'><a class='page-link' href='?page=$last'>Previous</a></li>";
        for ($page = $min; $page <= $max; $page++) :
            if ($_GET['page'] == $page) {
                $ac = 'active';
            } else {
                $ac = '';
            }
            $output .= "<li class='page-item $ac'><a class='page-link' href='?page=$page'>$page</a></li>";
        endfor;
        $output .= "<li class='page-item $dise'><a class='page-link' href='?page=$next'>Next</a></li>";
        $output .= "<li class='page-item $dise'><a class='page-link' href='?page=$this->total_pages' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
        $output .= "</ul></nav>";

        return $output;
    }
}
