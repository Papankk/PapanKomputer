<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\CategoryModel;
use App\Models\BrandModel;

class Produk extends BaseController
{
    protected $ItemModel;
    protected $CategoryModel;
    protected $BrandModel;

    public function __construct()
    {
        $this->ItemModel = new ItemModel();
        $this->CategoryModel = new CategoryModel();
        $this->BrandModel = new BrandModel();
        helper('number');
    }

    public function insert()
    {
        $is_recomend = $this->request->getVar('is_recomend');

        if ($is_recomend == '1') {
            $is_recomend = '1';
        } else {
            $is_recomend = '0';
        }

        $slug = url_title($this->request->getVar('nama_barang'), '-', true);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_barang' => [
                'rules' => 'required|is_unique[tbl_item.nama_barang]',
                'errors' => [
                    'required' => 'Nama Barang harus diisi!',
                    'is_unique' => 'Nama Barang sudah ada! silakan input data yang berbeda!'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi!',
                    'numeric' => 'Harga harus angka!'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi!',
                    'numeric' => 'Stok harus angka!'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih!'
                ]
            ],
            'brand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Brand harus dipilih!'
                ]
            ],
            'gambar' => [
                'rules' => 'uploaded[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]|max_size[gambar,2048]|is_image[gambar]',
                'errors' => [
                    'uploaded' => 'Gambar Produk harus diisi!',
                    'mime_in' => 'Gambar Produk harus format PNG dengan background transparan!',
                    'max_size' => 'Gambar Produk ukuran maksimal 2 MB!',
                    'is_image' => 'Gambar Produk harus format PNG dengan background transparan!',
                ]
            ]
        ]);

        if ($validation->withRequest($this->request)->run()) {

            $gambar = $this->request->getFile('gambar');
            $nama_gambar = $gambar->getRandomName();
            $gambar->move('img/', $nama_gambar);

            $this->ItemModel->save([
                'nama_barang' => $this->request->getVar('nama_barang'),
                'slug' => $slug,
                'deskripsi' => $this->request->getVar('deskripsi'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'kategori' => $this->request->getVar('kategori'),
                'gambar' => $nama_gambar,
                'brand' => $this->request->getVar('brand'),
                'is_recomend' => $is_recomend
            ]);

            session()->setFlashdata('message', 'Data berhasil ditambahkan!');

            return redirect()->to('/admin/produk');
        } else {
            return redirect()->to('/admin/produk')->withInput()->with('errors', $validation->getErrors());
        }
    }

    public function delete($id)
    {
        $gambar = $this->ItemModel->find($id);
        unlink('img/' . $gambar['gambar']);

        $this->ItemModel->delete($id);

        session()->setFlashdata('message', 'Data berhasil dihapus!');

        return redirect()->to('/admin/produk');
    }

    public function update($id)
    {
        $is_recomend = $this->request->getVar('is_recomend');

        if ($is_recomend == '1') {
            $is_recomend = '1';
        } else {
            $is_recomend = '0';
        }

        $slug = url_title($this->request->getVar('nama_barang'), '-', true);

        $validation = \Config\Services::validation();

        $namaLama = $this->ItemModel->where('slug', $this->request->getVar('slug'))->first();

        if ($namaLama['nama_barang'] == $this->request->getVar('nama_barang')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[tbl_item.nama_barang]';
        }

        $validation->setRules([
            'nama_barang' => [
                'rules' => $rule,
                'errors' => [
                    'required' => 'Nama Barang harus diisi!',
                    'is_unique' => 'Nama Barang sudah ada! silakan input data yang berbeda!'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Harga harus diisi!',
                    'numeric' => 'Harga harus angka!'
                ]
            ],
            'stok' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Stok harus diisi!',
                    'numeric' => 'Stok harus angka!'
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi harus diisi!'
                ]
            ],
            'kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori harus dipilih!'
                ]
            ],
            'brand' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Brand harus dipilih!'
                ]
            ],
            'gambar' => [
                'rules' => 'mime_in[gambar,image/png,image/jpg,image/jpeg]|max_size[gambar,2048]|is_image[gambar]',
                'errors' => [
                    'mime_in' => 'Gambar Produk harus format PNG dengan background transparan!',
                    'max_size' => 'Gambar Produk ukuran maksimal 2 MB!',
                    'is_image' => 'Gambar Produk harus format PNG dengan background transparan!',
                ]
            ]
        ]);

        if ($validation->withRequest($this->request)->run()) {

            $gambar = $this->request->getFile('gambar');

            if (!$gambar->isValid()) {
                $nama_gambar = $this->request->getVar('gambar_lama');
            } else {
                $nama_gambar = $gambar->getRandomName();
                $gambar->move('img/', $nama_gambar);
                unlink('img/' . $this->request->getVar('gambar_lama'));
            }

            $this->ItemModel->save([
                'id_barang' => $id,
                'nama_barang' => $this->request->getVar('nama_barang'),
                'slug' => $slug,
                'deskripsi' => $this->request->getVar('deskripsi'),
                'harga' => $this->request->getVar('harga'),
                'stok' => $this->request->getVar('stok'),
                'kategori' => $this->request->getVar('kategori'),
                'gambar' => $nama_gambar,
                'brand' => $this->request->getVar('brand'),
                'is_recomend' => $is_recomend
            ]);

            session()->setFlashdata('message', 'Data berhasil diedit!');

            return redirect()->to('/admin/produk');
        } else {
            return redirect()->to('/admin/produk')->withInput()->with('errors', $validation->getErrors());
        }
    }
}
