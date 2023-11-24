<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaymentModel;

class Pesanan extends BaseController
{
    protected $PaymentModel;

    public function __construct()
    {
        $this->PaymentModel = new PaymentModel();
    }

    public function update($id)
    {
        $find = $this->PaymentModel->select('*')->where('id_payment', $id)->first();

        $this->PaymentModel->save([
            'id_payment' => $id,
            'status' => $find['status'] += 1
        ]);

        session()->setFlashdata('message', 'Data berhasil dikonfirmasi!');

        return redirect()->to('/admin/transaksi');
    }
}
