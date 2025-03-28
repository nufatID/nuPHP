<?php

use App\Core\Controller;
use App\Model\Pesan;

class invoice extends Controller
{
    public function index()
    {
        $data = Pesan::orderBy('created_at', 'asc')->get();
        res(200, $data);
    }
    public function data()
    {
        $data = Pesan::orderBy('created_at', 'asc')->first();
        res(200, $data);
    }
    public function delete($id)
    {
        $this->APIKeys();
        $data = Pesan::where('id', $id)->delete();
        res(200, $data);
    }
    public function create()
    {
        $faker = \Faker\Factory::create('id_ID');

        // Generate fake data
        $pesan = new Pesan();
        $pesan->nomor = '085882620035';
        $pesan->jenis = $faker->randomElement(['text', 'pdf']);
        $pesan->lampiran = base64_encode($faker->text);
        $pesan->text = $faker->paragraph; // Pastikan kolom 'text' terisi
        $pesan->created_at = now();
        $pesan->updated_at = now();
        $pesan->save();


        // Return response
        return $this->res(200, [
            'message' => 'Pesan created successfully',
            'pesan' => $pesan,
        ]);
    }
}
