<?php

use App\Model\member;
use App\Core\Controller;
use App\Helper\Unsplash;

class profil extends Controller
{
     public function index()
     {
          $this->auth(true);
          $member = mylogin();
          $data['member'] = member::find($member);
          View("profil/index", $data);
     }
     public function member($member)
     {

          $data['member'] = member::find($member);
          View("profil/index", $data);
     }
     public function edit($member)
     {
          $random_link = Unsplash::getRandomLink();
          echo "Random Link: " . $random_link;
     }
}
