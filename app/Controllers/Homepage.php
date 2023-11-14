<?php

namespace App\Controllers;

use App\Models\ItemModel;

class Homepage extends BaseController
{
    public function __construct()
    {
        helper('number');
        helper('auth');
    }

    public function index(): string
    {
        $brandModel = model('BrandModel');
        $categoryModel = model('CategoryModel');
        $itemModel = model('ItemModel');

        $data = [
            'title' => 'Papank Komputer',
            'category' => $categoryModel->findAll(),
            'is_recomend' => $itemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->where('is_recomend', '1')->orderBy('id_barang', 'DESC')->limit(3)->get()->getResult(),
            'brand' => $brandModel->findAll(),
            'terbaru' => $itemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->orderBy('id_barang', 'DESC')->limit(3)->get()->getResult(),
            'lainnya' => $itemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->orderBy('rand()')->get()->getResult(),
        ];

        return view('user/index', $data);
    }

    public function search(): string
    {
        $searchTerm = $this->request->getPost('keyword');

        if (isset($searchTerm)) {
            $model = new ItemModel();
            $data = [
                'keyword' => $searchTerm,
                'title' => 'Search',
                'results' => $model->search($searchTerm),
            ];

            return view('user/search', $data);
        } else {
            return view('user/search');
        }
    }

    public function kategori($slug): string
    {
        $categoryModel = model('CategoryModel');
        $itemModel = model('ItemModel');

        $data = [
            'title' => 'Papank Komputer - Kategori',
            'categoryall' => $categoryModel->findAll(),
            'category' => $categoryModel->where('slug_kategori', $slug)->first(),
            'categoryresult' => $itemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->where('slug_kategori', $slug)->orderBy('id_barang', 'DESC')->get()->getResult(),
        ];

        return view('user/kategori', $data);
    }

    public function brand($slug): string
    {
        $brandModel = model('BrandModel');
        $itemModel = model('ItemModel');

        $data = [
            'title' => 'Papank Komputer - Brand',
            'brand' => $brandModel->findAll(),
            'category' => $brandModel->where('slug_brand', $slug)->first(),
            'categoryresult' => $itemModel->select('*')->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_item.kategori')->join('tbl_brand', 'tbl_brand.id_brand = tbl_item.brand')->where('slug_brand', $slug)->orderBy('id_barang', 'DESC')->get()->getResult(),
        ];

        return view('user/brand', $data);
    }
}
