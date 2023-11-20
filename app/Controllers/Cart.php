<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\ItemModel;

class Cart extends BaseController
{
    public function __construct()
    {
        helper('number');
        helper('auth');
    }

    public function cek()
    {
        $cartModel = new CartModel();

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

    public function delete($id)
    {
        $itemModel = new ItemModel();
        $cartModel = new CartModel();

        $fetch_cart = $cartModel->find($id);
        $id_barang = $fetch_cart['barang'];
        $qty = $fetch_cart['qty'];

        $fetch_item = $itemModel->find($id_barang);
        $stok = $fetch_item['stok'];

        $itemModel->save([
            'id_barang' => $id_barang,
            'stok'      => $stok + $qty,
        ]);

        $cartModel->delete($id);

        session()->setFlashdata('message', 'Produk berhasil dihapus dari keranjang!');

        return redirect()->to('/keranjang');
    }
}
