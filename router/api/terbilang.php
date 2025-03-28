<?php
use WebSocket\Client;
class terbilang
{
    public function index()
    {

$client = new Client("wss://socket.bungtemin.net");
$client->send(json_encode(array("message" => "Database has been updated")));

$client->close();
$data["ara"]="oke";
        res(200, $data);
    }
}
