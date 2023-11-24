<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function __construct()
    {
        helper('number');
    }

    public function index()
    {
        $currentRoute = $this->request->uri->getPath();

        $itemModel = model('ItemModel');
        $BrandModel = model('BrandModel');
        $CategoryModel = model('CategoryModel');
        $UserModel = model('UserModel');

        $data = [
            'itemCount' => $itemModel->countAllResults(),
            'brandCount' => $BrandModel->countAllResults(),
            'categoryCount' => $CategoryModel->countAllResults(),
            'userCount' => $UserModel->countAllResults(),
            'title' => 'Papank Komputer - Dashboard',
            'header' => 'Hai, ' . user()->username . " !",
            'currentRoute' => $currentRoute,
        ];

        return view('admin/index', $data);
    }

    public function produk()
    {
        $currentRoute = $this->request->uri->getPath();

        $CategoryModel = model('CategoryModel');
        $category = $CategoryModel->findAll();

        $BrandModel = model('BrandModel');
        $brand = $BrandModel->findAll();

        $itemModel = model('ItemModel');
        $item = $itemModel->select('*')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')
            ->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')
            ->orderBy('id_barang', 'DESC')
            ->get()->getResult();

        $data = [
            'title' => 'Papank Komputer - Manage Produk',
            'header' => 'Menu Produk',
            'item' => $item,
            'category' => $category,
            'brand' => $brand,
            'currentRoute' => $currentRoute,
        ];

        return view('admin/produk/index', $data);
    }

    public function kategori()
    {
        $currentRoute = $this->request->uri->getPath();

        $CategoryModel = model('CategoryModel');
        $category = $CategoryModel->select('*')->orderBy('id_kategori', 'DESC')->get()->getResult();

        $data = [
            'title' => 'Papank Komputer - Manage Kategori',
            'header' => 'Menu Kategori',
            'category' => $category,
            'currentRoute' => $currentRoute,
        ];

        return view('admin/kategori/index', $data);
    }

    public function brand()
    {
        $currentRoute = $this->request->uri->getPath();

        $BrandModel = model('BrandModel');
        $brand = $BrandModel->select('*')->orderBy('id_brand', 'DESC')->get()->getResult();

        $data = [
            'title' => 'Papank Komputer - Manage Brand',
            'header' => 'Menu Brand',
            'brand' => $brand,
            'currentRoute' => $currentRoute,
        ];

        return view('admin/brand/index', $data);
    }

    public function user()
    {
        $currentRoute = $this->request->uri->getPath();

        $userModel = model('UserModel');
        $users = $userModel
            ->select('*')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->orderBy('id', 'DESC')
            ->get()->getResult();

        $data = [
            'title' => 'Papank Komputer - Manage User',
            'header' => 'Menu User',
            'users' => $users,
            'currentRoute' => $currentRoute,
        ];

        return view('admin/user/index', $data);
    }

    public function transaksi()
    {
        $currentRoute = $this->request->uri->getPath();

        $PaymentModel = model('PaymentModel');

        $data = [
            'title' => 'Papank Komputer - Manage Transaksi',
            'header' => 'Menu Transaksi',
            'dibayar' => $PaymentModel->getByStatusAll('0'),
            'dikemas' => $PaymentModel->getByStatusAll('1'),
            'dikirim' => $PaymentModel->getByStatusAll('2'),
            'sampai' => $PaymentModel->getByStatusAll('3'),
            'diterima' => $PaymentModel->getByStatusAll('4'),
            'currentRoute' => $currentRoute,
        ];

        return view('admin/transaksi/index', $data);
    }
}
