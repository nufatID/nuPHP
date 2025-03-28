<?php

use App\Model\Imgclamp;

class upload
{
  public function index()
  {

    $imgClamp = Imgclamp::all();

    var_dump($imgClamp);
  }
  public function base($id)
  {
    $id = (int) $id;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $file = $_POST['file'];
      $mime = $_POST['mime'];


      $imgClamp = new ImgClamp;
      $imgClamp->member_id = $_SESSION['login_member']; // Atur sesuai kebutuhan
      $imgClamp->type = 'donasi'; // Atur sesuai kebutuhan
      $imgClamp->mime = $mime;
      $imgClamp->don_id = $id;
      $imgClamp->base64 = $file;
      $imgClamp->save();

      echo 'Success';
    }
  }
}
