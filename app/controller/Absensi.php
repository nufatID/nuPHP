<?php

class Absensi extends Controller
{

    public function index()
    {
        $model = $this->model('UserModel');
        $model->set_pagination(10);
        $adrow = [
            "Detail" => "<a href='" . getBaseUrl() . "/absensi/detail/{{id}}' class='btn btn-primary' id='{{id}}'>Detail</a>",
            "Edit" => "<button type='button' class='btn btn-warning'>Edit</button>",
            "Delete" => "<a href='" . getBaseUrl() . "/absensi/hapus/{{id}}' onclick='return confirm('Anda Yakin??');' type='button' class='btn btn-danger'>Delete</a>"
        ];
        $model->Add_row($adrow);
        $data['data'] = $model;
        View('absensi/index', $data);
    }
    public function detail($p1)
    {
        $model = $this->model('UserModel');
        $user = $model->getbyId($p1);
        $data['data'] = $user;
        View('absensi/detail', $data);
    }
    public function insert($p1)
    {
        $model = $this->model('UserModel');
        if (isset($_POST["pegawai_nama"])) {
            $data['row'] =  $model->AddDAta($_POST);
        }

        $user = $model->getbyId($p1);
        $data['data'] = $user;

        View('absensi/insert', $data);
    }
    public function hapus($p1)
    {
        $model = $this->model('UserModel');
        $user = $model->DeleteData($p1);
        echo $user;
        $this->index();
    }
}
