<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BrandModel;

class Brand extends BaseController
{
    protected $BrandModel;

    public function __construct()
    {
        $this->BrandModel = new BrandModel();
        helper('number');
    }

    public function insert()
    {
        $slug = url_title($this->request->getVar('nama_brand'), '-', true);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nama_brand' => [
                'rules' => 'required|is_unique[tbl_brand.nama_brand]',
                'errors' => [
                    'required' => 'Nama Brand harus diisi!',
                    'is_unique' => 'Nama Brand sudah ada! silakan input data yang berbeda!'
                ]
            ],
            'gambar_brand' => [
                'rules' => 'uploaded[gambar_brand]|mime_in[gambar_brand,image/png]|max_size[gambar_brand,2048]|is_image[gambar_brand]',
                'errors' => [
                    'uploaded' => 'Gambar Brand harus diisi!',
                    'mime_in' => 'Gambar Brand harus format PNG dengan background transparan!',
                    'max_size' => 'Gambar Brand ukuran maksimal 2 MB!',
                    'is_image' => 'Gambar Brand harus format PNG dengan background transparan!',
                ]
            ]
        ]);

        if ($validation->withRequest($this->request)->run()) {

            $gambar_brand = $this->request->getFile('gambar_brand');
            $nama_gambar = $gambar_brand->getRandomName();
            $gambar_brand->move('img/brand/', $nama_gambar);

            $this->BrandModel->save([
                'nama_brand' => $this->request->getVar('nama_brand'),
                'gambar_brand' => $nama_gambar,
                'slug_brand' => $slug
            ]);

            session()->setFlashdata('message', 'Data berhasil ditambahkan!');

            return redirect()->to('/admin/brand');
        } else {
            return redirect()->to('/admin/brand')->withInput()->with('errors', $validation->getErrors());
        }
    }

    public function delete($id)
    {
        $brand = $this->BrandModel
            ->select('COUNT(tbl_item.id_barang) as hitung')
            ->join('tbl_item', 'tbl_item.brand = tbl_brand.id_brand')
            ->where('tbl_brand.id_brand', $id)
            ->get()->getRow();

        $hitung = intval($brand->hitung);

        if ($hitung > 0) {
            session()->setFlashdata('errors', 'Produk yang termasuk dalam brand yang akan dihapus harus kosong!');

            return redirect()->to('/admin/brand');
        } else {
            $gambar_brand = $this->BrandModel->find($id);
            unlink('img/brand/' . $gambar_brand['gambar_brand']);

            $this->BrandModel->delete($id);

            session()->setFlashdata('message', 'Data berhasil dihapus!');

            return redirect()->to('/admin/brand');
        }
    }

    public function update($id)
    {
        $slug = url_title($this->request->getVar('nama_brand'), '-', true);

        $validation = \Config\Services::validation();

        $namaLama = $this->BrandModel->where('slug_brand', $this->request->getVar('slug_brand'))->first();

        if ($namaLama['nama_brand'] == $this->request->getVar('nama_brand')) {
            $rule = 'required';
        } else {
            $rule = 'required|is_unique[tbl_brand.nama_brand]';
        }

        $validation->setRules([
            'nama_brand' => [
                'rules' => $rule,
                'errors' => [
                    'required' => 'Nama Brand harus diisi!',
                    'is_unique' => 'Nama Brand sudah ada! silakan input data yang berbeda!'
                ]
            ],
            'gambar_brand' => [
                'rules' => 'mime_in[gambar_brand,image/png]|max_size[gambar_brand,2048]|is_image[gambar_brand]',
                'errors' => [
                    'mime_in' => 'Gambar Brand harus format PNG dengan background transparan!',
                    'max_size' => 'Gambar Brand ukuran maksimal 2 MB!',
                    'is_image' => 'Gambar Brand harus format PNG dengan background transparan!',
                ]
            ]
        ]);

        if ($validation->withRequest($this->request)->run()) {
            $gambar_brand = $this->request->getFile('gambar_brand');

            if (!$gambar_brand->isValid()) {
                $nama_gambar = $this->request->getVar('gambar_lama');
            } else {
                $nama_gambar = $gambar_brand->getRandomName();
                $gambar_brand->move('img/brand/', $nama_gambar);
                unlink('img/brand/' . $this->request->getVar('gambar_lama'));
            }

            $this->BrandModel->save([
                'id_brand' => $id,
                'nama_brand' => $this->request->getVar('nama_brand'),
                'gambar_brand' => $nama_gambar,
                'slug_brand' => $slug
            ]);

            session()->setFlashdata('message', 'Data berhasil diedit!');

            return redirect()->to('/admin/brand');
        } else {
            return redirect()->to('/admin/brand')->withInput()->with('errors', $validation->getErrors());
        }
    }
}
