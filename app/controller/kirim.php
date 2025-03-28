<?php

use App\Core\Controller;

class kirim extends Controller
{
     public function index()
     {
          $recieverEmail = "nufat17@gmail.com";
          $subject = "TEST EMAIL NUPHP config";
          $body = "yayayyaay";

          $mailer = new Email();
          $mailer->sendMail($recieverEmail, $subject, $body);
     }
}
