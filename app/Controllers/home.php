<?php

use App\Core\Controller;
use App\Model\Don;
use App\Helper\Unsplash;


class home extends Controller
{
    private $faker;
    private $create = [];
    public function __construct()
    {
        parent::__construct(); // Memanggil konstruktor dari kelas induk
        $this->faker = \Faker\Factory::create('id_ID');
        $rtor = Don::whereYear('created_at', date('Y'))->count();
        $angka = str_pad($rtor + 1, 4, '0', STR_PAD_LEFT);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->cekpost();
            vPost(['ket', 'event']);
            $this->create = [
                'eventid' => $this->faker->regexify('[A-Z]{3}[0-9]{3}') . $angka,
                'slug' => textToSlug($_POST['event']),
                'nama_acara' => $_POST['event'],
                'deskripsi' => $_POST['ket'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'member_id' => $_SESSION['login_member'],
            ];
        }
    }
    public function index()
    {
        last_form();
        $events = Don::where('status',1)->orderBy('created_at', 'desc')->take(14)->get();
        $text = $this->faker->realText($maxNbChars = 200, $indexSize = 2);
        $data = [
            'events' => $events,
            'text' => $text,
            'gambar' => Unsplash::getimg()
        ];

        View("index", $data);
    }

    public function addnew()
    {
        $this->auth(true);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            Don::create($this->create);
            unset($_SESSION['token_csrf']);
            // Redirect to a success page
            to_url("home");
            exit;
        }
    }
   
    
}
