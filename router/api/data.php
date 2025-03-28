<?php

use App\Core\Controller;
use App\Model\Cerit;

class data extends Controller
{
    public function index($id)
    {
        $data = Cerit::with(['member'])
            ->where('don_id', $id)
            ->where('type', 'kredit')
            ->get();
        res(200, $data);
    }
}
