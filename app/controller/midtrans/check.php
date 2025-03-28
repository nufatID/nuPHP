<?php

use App\Model\Cerit;
use App\Model\Tabung;
use App\Model\transaction;

class check
{
    public function index()
    {
        $data = $_GET['order_id'];
        $status = $_GET['result'];
        $prefix = substr($data, 0, 3);
        if ($status == 'success') {
            switch ($prefix) {
                case 'KAS':
                    $datana = transaction::with(['member', 'inputBy'])->where('judul', $data)->first();
                    if (!$datana) {
                        to_url('wait?order_id=' . $data);
                        exit();
                    }
                    to_url('pembayaran/resume/kas/' . $data);
                case 'TAB':
                    $datana = Tabung::with(['member', 'inputBy'])->where('judul', $data)->first();
                    if (!$datana) {
                        to_url('wait?order_id=' . $data);
                        exit();
                    }
                    to_url('pembayaran/resume/tabungan/' . $data);
                case 'DON':
                    $datana = Cerit::with(['member', 'inputBy', 'donasi'])->where('judul', $data)->first();
                    if (!$datana) {
                        to_url('wait?order_id=' . $data);
                        exit();
                    }
                    to_url('pembayaran/resume/donasi/' . $data);
                default:
                    to_url('wait?order_id=' . $data);
            }
        } else {
            to_url('home/' . $data);
        }
    }

    public function wait()
    {
        $data = $_GET['order_id'];
        $prefix = substr($data, 0, 3);

        switch ($prefix) {
            case 'KAS':
                $datana = transaction::with(['member', 'inputBy'])->where('judul', $data)->first();
                if (!$datana) {
                    $response = [
                        'status' => 'nodata',
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }
                $response = [
                    'status' => 'success',
                    'link' => get_url('pembayaran/resume/kas/' . $data),
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                return;
                break;

            case 'TAB':
                $datana = Tabung::with(['member', 'inputBy'])->where('judul', $data)->first();
                if (!$datana) {
                    $response = [
                        'status' => 'nodata',
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }
                $response = [
                    'status' => 'success',
                    'link' =>  get_url('pembayaran/resume/tabungan/' . $data),
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                return;
                break;

            case 'DON':
                $datana = Cerit::with(['member', 'inputBy', 'donasi'])->where('judul', $data)->first();
                if (!$datana) {
                    $response = [
                        'status' => 'nodata',
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    return;
                }
                $response = [
                    'status' => 'success',
                    'link' => get_url('pembayaran/resume/donasi/' . $data),
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                return;
                break;

            default:
                $response = [
                    'status' => 'nodata',
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                return;
                break;
        }
    }
}
