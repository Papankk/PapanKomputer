<?php

namespace App\Controllers;

class Item extends BaseController
{
    public function __construct()
    {
        helper('number');
    }

    public function detail($slug)
    {
        $itemModel = model('ItemModel');
        $item = $itemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->where('slug', $slug)->first();
        $lainnya = $itemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->orderBy('rand()')->limit('4')->get()->getResult();

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
}
