<?php

use Midtrans\Snap;
use Midtrans\CoreApi;
use App\Model\member;
use App\Model\PaymentType;
use App\Core\Controller;
use App\Models\MidtransModel;
use App\Model\Midtran as Datmid;

class pembayaran extends Controller
{
    public $auth = true;

    public function __construct()
    {
        parent::__construct();
        $model = new MidtransModel;
    }

    public function index($myhanna = 'kas', $hannaku = null)
    {
        last_form();
        $hanna["clientKey"] = $_ENV['MIDTRANS_CLIENT_KEY'];
        $hanna["title"] = tanggal_sekarang();
        $hanna["member"] = member::all();
        $hanna["paymentType"] = PaymentType::all();
        $hanna["jenis"] = $myhanna;
        $hanna["type"] = 'kredit';
        $hanna["judultype"] = 'Pembayaran';
        $hanna["donid"] = $hannaku;
        View("pembayaran/midtrans", $hanna);
        //View('404');
    }
    public function post($don = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['Nama'];
            $noreg = $_POST['Noreg'];
            $jumlah = str_replace('Rp. ', '', $_POST['jumlah']);
            $jumlah = str_replace('.', '', $jumlah);
            $keterangan = $_POST['keterangan'];
            $payment_method = $_POST['payment_method'];
            $jenis = $_POST['jenis'];
            $judul = midNumber($jenis);
            $transaction_details = array(
                'order_id' => $judul,
                'gross_amount' => (int) $jumlah,
            );

            $item_details = array(
                array(
                    'id' => ridNumber(),
                    'price' => (int) $jumlah,
                    'quantity' => 1,
                    'name' => $keterangan,
                    'brand' => "UB ASSY",
                    'category' => "DONASI",
                    'merchant_name' => "UNDERBODY ASSY"
                )
            );

            $customer_details = array(
                'first_name' => $nama,
                'last_name' => $noreg,
                'email' => member_login()->email,
                'phone' => member_login()->telp,
            );
            // 



            try {

                if ($payment_method === 'deep') {

                    $transaction = array(
                        'payment_type' => 'gopay',
                        'transaction_details' => $transaction_details,
                        'item_details' => $item_details,
                        'customer_details' => $customer_details,
                        'gopay' => array(
                            'enable_callback' => true,
                            'callback_url' => getBaseUrl() . 'midtrans/check', // Replace with your actual callback URL
                        ),
                    );




                    $response = \Midtrans\CoreApi::charge($transaction);
                    $deeplinkUrl = '';

                    foreach ($response->actions as $action) {
                        if ($action->name === 'deeplink-redirect') {
                            $deeplinkUrl = $action->url;
                            break;
                        }
                    }
                    $create = [
                        'judul' => $judul,
                        'member_id' => member_login()->id,
                        'jumlah' => $jumlah,
                        'payment_type' => 3,
                        'type' => $_POST['type'],
                        'status' => 0,
                        'keterangan' => $_POST['keterangan'],
                        'date' => date('Y-m-d H:i:s'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'input_by' => $_SESSION['login_member'],
                        'snap_token' =>  $deeplinkUrl,
                        'don_id' => $don,
                    ];
                    $transaction = Datmid::create($create);
                    echo json_encode(['deeplinkUrl' => $deeplinkUrl]);
                } else {
                    $enable_payments = array('cimb_clicks', 'mandiri_clickpay', 'echannel', 'gopay', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'permata_va', 'bni_va', 'other_va', 'shopeepay');

                    $transaction = array(
                        'transaction_details' => $transaction_details,
                        'enabled_payments' => $enable_payments,
                        'item_details' => $item_details,
                        'customer_details' => $customer_details,
                    );


                    $snapToken = Snap::getSnapToken($transaction);
                    $create = [
                        'judul' => $judul,
                        'member_id' => member_login()->id,
                        'jumlah' => $jumlah,
                        'payment_type' => 3,
                        'type' => $_POST['type'],
                        'status' => 0,
                        'keterangan' => $_POST['keterangan'],
                        'date' => date('Y-m-d H:i:s'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'input_by' => $_SESSION['login_member'],
                        'snap_token' => $snapToken,
                        'don_id' => $don,
                    ];
                    $transaction = Datmid::create($create);
                    echo json_encode(['snapToken' => $snapToken]);
                }
            } catch (Exception $e) {
                echo json_encode(['error' => $e->getMessage()]);
            }

            //     

        }
    }
}

//https://underbody.nufat.id/midtrans/webhook?order_id=KAS0624IKJ487785&result=success