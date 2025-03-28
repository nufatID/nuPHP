<?php

use App\Core\Controller;

class tiket extends Controller
{
     public function index()
     {

          View("tiket/index", $data);
     }
}
