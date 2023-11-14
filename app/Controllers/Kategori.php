<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Kategori extends BaseController
{
    protected $CategoryModel;

    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
        helper('number');
    }

    public function insert()
    {
        $slug = url_title($this->request->getVar('nama_kategori'), '-', true);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_kategori' => [
                'rules' => 'required|is_unique[tbl_kategori.nama_kategori]',
                'errors' => [
                    'required' => 'Nama Kategori harus diisi!',
                    'is_unique' => 'Nama Kategori sudah ada! silakan input data yang berbeda!'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon kategori harus diisi!',
                ]
            ]
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $this->CategoryModel->save([
                'nama_kategori' => $this->request->getVar('nama_kategori'),
                'icon' => $this->request->getVar('icon'),
                'slug_kategori' => $slug
            ]);

            session()->setFlashdata('message', 'Data berhasil ditambahkan!');

            return redirect()->to('/admin/kategori');
        } else {
            return redirect()->to('/admin/kategori')->withInput()->with('errors', $validation->getErrors());
        }
    }

    public function delete($id)
    {
        $this->CategoryModel->delete($id);

        session()->setFlashdata('message', 'Data berhasil dihapus!');

        return redirect()->to('/admin/kategori');
    }

    public function update($id)
    {
        $slug = url_title($this->request->getVar('nama_kategori'), '-', true);

        $validation = \Config\Services::validation();

        $namaLama = $this->CategoryModel->where('slug_kategori', $this->request->getVar('slug_kategori'))->first();

        if ($namaLama['nama_kategori'] == $this->request->getVar('nama_kategori')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[tbl_kategori.nama_kategori]';
        }

        $validation->setRules([
            'nama_kategori' => [
                'rules' => $rule,
                'errors' => [
                    'required' => 'Nama Kategori harus diisi!',
                    'is_unique' => 'Nama Kategori sudah ada! silakan input data yang berbeda!'
                ]
            ],
            'icon' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Icon kategori harus diisi!',
                ]
            ]
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $this->CategoryModel->save([
                'id_kategori' => $id,
                'nama_kategori' => $this->request->getVar('nama_kategori'),
                'icon' => $this->request->getVar('icon'),
                'slug_kategori' => $slug
            ]);

            session()->setFlashdata('message', 'Data berhasil diedit!');

            return redirect()->to('/admin/kategori');
        } else {
            return redirect()->to('/admin/kategori')->withInput()->with('errors', $validation->getErrors());
        }
    }
}
