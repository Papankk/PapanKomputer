<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table      = 'tbl_item';
    protected $primaryKey = 'id_barang';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_barang', 'slug', 'deskripsi', 'harga', 'stok', 'kategori', 'gambar', 'brand', 'is_recomend'];

    protected $table1 = 'tbl_kategori';
    protected $table2 = 'tbl_brand';

    public function search($searchTerm)
    {
        return $this->db->table($this->table)
            ->join($this->table1, 'tbl_kategori.id_kategori = tbl_item.kategori')
            ->join($this->table2, 'tbl_brand.id_brand = tbl_item.brand')
            ->like('tbl_item.nama_barang', $searchTerm)
            ->orLike('tbl_item.deskripsi', $searchTerm)
            ->orLike('tbl_kategori.nama_kategori', $searchTerm)
            ->orLike('tbl_brand.nama_brand', $searchTerm)
            ->get()
            ->getResultArray();
    }
}
