<?php

class Absensi extends Controller
{
    public $auth = false;
    public function index()
    {
        $model = $this->model('UserModel');
        $model->set_pagination(5);
        $model->jarak = 3;
        $adrow = [
            "Detail" => "<a href='" . getBaseUrl() . "absensi/detail/{{id}}' class='btn btn-primary' id='{{id}}'>Detail</a>",
            "Edit" => "<a href='" . getBaseUrl() . "absensi/edit/{{id}}' type='button' class='btn btn-warning'>Edit</a>",
            "Delete" => "<a href='" . getBaseUrl() . "absensi/hapus/{{id}}/" . Csrf::get() . "' onclick='return confirm('Anda Yakin??');' type='button' class='btn btn-danger'>Delete</a>"
        ];
        $model->Add_row($adrow);
        $data['data'] = $model;
        View('absensi/index', $data);
    }
    public function detail($p1)
    {
        $this->auth(true);
        $model = $this->model('UserModel');
        $user = $model->getbyId($p1);
        $data['data'] = $user;
        View('absensi/detail', $data);
    }
    public function insert($p1)
    {
        $this->auth(true);
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
            header("Location: " . getBaseUrl() . "absensi");
            exit();
        }
        $user = $model->getbyId($p1);
        $data['data'] = $user;
        View('absensi/edit', $data);
    }
    public function hapus($p1, $p2)
    {
        $this->auth(true);
        $csrf = Csrf::get();
        if ($csrf == $p2) {
            $this->auth(false);
            $model = $this->model('UserModel');
            $user = $model->DeleteData($p1);
            ALert::SetAlert('success', 'data berhasil dihapus');
            header("Location: " . getBaseUrl() . "absensi");
            exit();
        } else {
            ALert::SetAlert('danger', 'data GAGAL berhasil dihapus');
            header("Location: " . getBaseUrl() . "absensi");
            exit();
        }
    }
}
