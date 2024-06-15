<?php

use App\Model\User;
use Illuminate\Support\Str;

class pages extends Controller
{
    public function index()
    {
        $model = $this->model("Anggota");

        $data = ['name' => 'John Doe'];
        $data["mod"] = $model->all();
        $data["slug"] = Str::of('NUFAT NUPHP')->slug('-');
        Views("index", $data);
    }
    public function yu($bhj, $gjkhk, $hgjg)
    {
        $model = $this->model("Anggota");
        $data = ['name' => 'John Doe'];
        $data["mod"] = generateUID(10);
        View("home", $data);
    }
    public function yuser($bhj, $gjkhk, $hgjg)
    {
        $model = $this->model("Anggota");
        $data["mod"] = User::all();
        $data["slug"] = Str::of('NUFAT NUPHP')->slug('-');
        Views("index", $data);
    }
}
