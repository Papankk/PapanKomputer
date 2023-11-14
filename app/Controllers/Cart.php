<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;

class Cart extends BaseController
{
    public function __construct()
    {
        helper('number');
    }

    public function cek()
    {
        $cartModel = new CartModel();
        helper('auth');

        $result = $cartModel->select('sum(price) as prices')->where('user', user_id())->first();

        $data = [
            'title' => 'Papank Komputer - Keranjang Saya',
            'cart' => $cartModel->select('*')
                ->where('user', user_id())
                ->join('tbl_item', 'tbl_item.id_barang = tbl_keranjang.barang')
                ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')
                ->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')
                ->get()->getResult(),
            'total_cart' => $cartModel->where('user', user_id())->countAllResults(),
            'total_harga' => $result['prices']
        ];

        return view('user/keranjang', $data);
    }

    public function insert()
    {
        helper('auth');
        $cart = model('CartModel');
        $stok = intval($this->request->getVar('stok'));
        $jumlah = intval($this->request->getVar('jml_barang'));
        $id_barang = intval($this->request->getVar('id_barang'));

        if ($jumlah > $stok || $jumlah <= 0) {
            session()->setFlashdata('gagal', 'Jumlah produk tidak sesuai dengan stoknya!');

            return redirect()->to('produk/' . session()->getFlashdata('url'));
        } else {
            $itemModel = model('ItemModel');
            $barang = $cart->select('*')->where('user', user_id())->where('barang', $id_barang)->first();
            $jumlah_barang = intval($barang['qty'] ?? 0);

            // dd($jumlah_barang);

            if ($jumlah_barang == 0) {
                $cart->save([
                    'user'    => user_id(),
                    'price'   => intval($this->request->getVar('harga')),
                    'barang'  => $id_barang,
                    'qty'     => $jumlah,
                ]);
            } else {
                $id = $barang['id'];

                $cart->save([
                    'id'      => $id,
                    'user'    => user_id(),
                    'price'   => intval($this->request->getVar('harga')),
                    'barang'  => $id_barang,
                    'qty'     => $jumlah + $jumlah_barang,
                ]);
            }

            $itemModel->save([
                'id_barang' => $id_barang,
                'stok' => $stok - $jumlah,
            ]);

            session()->setFlashdata('message', 'Produk berhasil dimasukkan keranjang!');

            return redirect()->to('produk/' . session()->getFlashdata('url'));
        }
    }

    public function destroy()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
    }
}
