<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = "tbl_provinsi";

    public function AllProvinsi()
    {
        return $this->db->table('tbl_provinsi')
            ->get()->getResult();
    }

    public function AllKabupaten($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')
            ->where('id_provinsi', $id_provinsi)
            ->get()->getResult();
    }

    public function Kabupaten($id_kabupaten)
    {
        return $this->db->table('tbl_kabupaten')
            ->select('*')
            ->where('id_kabupaten', $id_kabupaten)
            ->get()->getRowArray();
    }

    public function Kecamatan($id_kecamatan)
    {
        return $this->db->table('tbl_kecamatan')
            ->select('*')
            ->where('id_kecamatan', $id_kecamatan)
            ->get()->getRowArray();
    }

    public function AllKecamatan($id_kabupaten)
    {
        return $this->db->table('tbl_kecamatan')
            ->where('id_kabupaten', $id_kabupaten)
            ->get()->getResult();
    }
}
