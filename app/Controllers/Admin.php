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

        $data = [
            'itemCount' => $itemModel->countAllResults(),
            'brandCount' => $BrandModel->countAllResults(),
            'categoryCount' => $CategoryModel->countAllResults(),
            'title' => 'Papank Komputer - Dashboard',
            'header' => 'Welcome, ' . user()->username . '. Today is warmer than yesterday!',
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
}
