<?php

use App\Core\Controller;

class setting extends Controller
{
     public function index()
     {
          $data = [];
          View("setting/index", $data);
     }
}
