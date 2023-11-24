<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PaymentGateway extends BaseController
{
    public function index()
    {
        helper('auth');
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => user()->username,
                'last_name' => '',
                'email' => user()->email,
                'phone' => $this->request->getVar('no_telp'),
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $data = [
            'token' => $snapToken
        ];

        return view('user/pembayaran', $data);
    }
}
