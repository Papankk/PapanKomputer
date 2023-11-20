<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ItemModel;
use App\Models\WilayahModel;

class Item extends BaseController
{
    protected $CartModel;
    protected $ItemModel;
    protected $WilayahModel;

    public function __construct()
    {
        $this->CartModel = new CartModel();
        $this->ItemModel = new ItemModel();
        $this->WilayahModel = new WilayahModel();
        helper('auth');
        helper('number');
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
            'title' => 'Checkout',
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

        return view('user/checkout', $data);
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
