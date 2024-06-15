<?php
class dodol extends Controller
{
     public function index()
     {
 
         $model = $this->model("dodolModel");
         $data["data"] = $model;
 
          View("dodol/index", $data);
 
     }
}
