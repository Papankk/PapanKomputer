<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ItemModel;
use App\Models\WilayahModel;
use App\Models\PaymentModel;
use App\Models\OrderModel;

class Item extends BaseController
{
    protected $CartModel;
    protected $ItemModel;
    protected $WilayahModel;
    protected $PaymentModel;
    protected $OrderModel;

    public function __construct()
    {
        $this->CartModel = new CartModel();
        $this->ItemModel = new ItemModel();
        $this->WilayahModel = new WilayahModel();
        $this->PaymentModel = new PaymentModel();
        $this->OrderModel = new OrderModel();
        helper('auth');
        helper('number');
        helper('url');
    }

    public function detail($slug)
    {
        $item = $this->ItemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->where('slug', $slug)->first();
        $lainnya = $this->ItemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->orderBy('rand()')->limit('4')->get()->getResult();

        if (empty($item)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Produk "' . $slug . '" tidak ditemukan!');
        }

        $data = [
            'title' => 'Papank Komputer - ' . $item['nama_barang'],
            'item' => $item,
            'lainnya' => $lainnya,
        ];

        return view('user/product_details', $data);
    }

    public function checkout()
    {
        $subtotal = $this->CartModel->select('sum(price) as prices')->where('user', user_id())->first();

        $data = [
            'title' => 'Papank Komputer - Checkout',
            'cart' => $this->CartModel->select('*')
                ->where('user', user_id())
                ->join('tbl_item', 'tbl_item.id_barang = tbl_keranjang.barang')
                ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')
                ->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')
                ->get()->getResult(),
            'subtotal' => $subtotal['prices'],
            'ongkir' => $subtotal['prices'] * 0.075,
            'provinsi' => $this->WilayahModel->AllProvinsi(),
        ];

        if ($subtotal['prices'] == 0) {
            return redirect()->to('/keranjang');
        } else {
            return view('user/checkout', $data);
        }
    }

    public function insert_order()
    {
        $gambar = $this->request->getFile('bukti_pembayaran');
        $nama_gambar = $gambar->getRandomName();
        $gambar->move('img/bukti_pembayaran/', $nama_gambar);
        $order = rand();

        $this->PaymentModel->save([
            'user' => user_id(),
            'order_invoice' => $order,
            'nama' => $this->request->getVar('nama'),
            'no_telp' => $this->request->getVar('no_telp'),
            'provinsi' => $this->request->getVar('id_provinsi'),
            'kabupaten' => $this->request->getVar('id_kabupaten'),
            'kecamatan' => $this->request->getVar('id_kecamatan'),
            'alamat' => $this->request->getVar('alamat'),
            'gambar' => $nama_gambar,
            'gross_amount' => intval($this->request->getVar('gross')),
        ]);

        return redirect()->to('/invoice/' . $order);
    }

    public function invoice($order)
    {
        $subtotal = $this->CartModel->select('sum(price) as prices')->where('user', user_id())->first();

        $data = [
            'invoice' => $this->PaymentModel->select('*')->where('order_invoice', $order)->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_payment.provinsi')->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = kabupaten')->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_payment.kecamatan')->first(),
            'cart' => $this->CartModel->select('*')
                ->where('user', user_id())
                ->join('tbl_item', 'tbl_item.id_barang = tbl_keranjang.barang')
                ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')
                ->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')
                ->get()->getResult(),
            'subtotal' => $subtotal['prices'],
            'ongkir' => $subtotal['prices'] * 0.075,
            'title' => 'Papank Komputer - Invoice #' . $order
        ];

        return view('user/invoice', $data);
    }

    public function pesanan()
    {
        $data = [
            'title' => 'Papank Komputer - Pesanan Saya',
            'dibayar' => $this->PaymentModel->getByStatus('0'),
            'dikemas' => $this->PaymentModel->getByStatus('1'),
            'dikirim' => $this->PaymentModel->getByStatus('2'),
            'sampai' => $this->PaymentModel->getByStatus('3'),
            'diterima' => $this->PaymentModel->getByStatus('4'),
        ];

        return view('user/pesanan', $data);
    }

    public function invoice_update($id)
    {
        $find = $this->PaymentModel->select('*')->where('id_payment', $id)->first();

        $this->PaymentModel->save([
            'id_payment' => $id,
            'status' => $find['status'] += 1
        ]);

        session()->setFlashdata('message', 'Data berhasil dikonfirmasi!');

        return redirect()->to('/pesanan-saya');
    }

    public function invoice_delete($id)
    {
        $this->PaymentModel->delete($id);

        session()->setFlashdata('message', 'Data berhasil dihapus!');

        return redirect()->to('/pesanan-saya');
    }

    public function kabupaten()
    {
        $id_provinsi = $this->request->getVar('id_provinsi');
        $kabupaten = $this->WilayahModel->AllKabupaten($id_provinsi);
        foreach ($kabupaten as $k) {
            echo "<option value=" . $k->id_kabupaten . ">" . $k->nama_kabupaten . "</option>";
        }
    }

    public function kecamatan()
    {
        $id_kabupaten = $this->request->getVar('id_kabupaten');
        $kecamatan = $this->WilayahModel->AllKecamatan($id_kabupaten);
        foreach ($kecamatan as $k) {
            echo "<option value=" . $k->id_kecamatan . ">" . $k->nama_kecamatan . "</option>";
        }
    }
}
