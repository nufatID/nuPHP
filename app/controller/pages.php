<?php
class pages extends Controller
{
    public function index()
    {
        $model = $this->model("Anggota");

        $data = ['name' => 'John Doe'];
        $data["mod"] = $model->all();

        Views("index", $data);
    }
}
