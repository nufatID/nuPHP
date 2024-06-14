<?php

use App\Model\User;
use Jenssegers\Blade\Blade;

class pages extends Controller
{
    public function index()
    {
        $model = $this->model("Anggota");

        $data = ['name' => 'John Doe'];
        $data["mod"] = $model->all();

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


        View("index", $data);
    }
    public function aw()
    {

        $blade = new Blade('views', 'cache');

        echo $blade->make('homepage', ['name' => 'John Doe'])->render();
    }
}
