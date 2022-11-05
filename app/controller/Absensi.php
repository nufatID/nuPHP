<?php

class Absensi extends Controller
{

    public function index()
    {
        $model = $this->model('UserModel');
        $model->set_pagination(5);
        $model->jarak = 1;
        $adrow = [
            "Detail" => "<a href='" . getBaseUrl() . "/absensi/detail/{{id}}' class='btn btn-primary' id='{{id}}'>Detail</a>",
            "Edit" => "<a href='" . getBaseUrl() . "/absensi/edit/{{id}}' type='button' class='btn btn-warning'>Edit</a>",
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
            header("Location: " . getBaseUrl() . "/absensi");
            exit();
        }
        $user = $model->getbyId($p1);
        $data['data'] = $user;
        View('absensi/insert', $data);
    }
    public function edit($p1)
    {
        $model = $this->model('UserModel');
        if (isset($_POST["pegawai_nama"])) {
            $data['row'] =  $model->EditDAta($_POST, $p1);
            header("Location: " . getBaseUrl() . "/absensi");
            exit();
        }
        $user = $model->getbyId($p1);
        $data['data'] = $user;
        View('absensi/edit', $data);
    }
    public function hapus($p1)
    {
        $model = $this->model('UserModel');
        $user = $model->DeleteData($p1);
        header("Location: " . getBaseUrl() . "/absensi");
        exit();
    }
}
