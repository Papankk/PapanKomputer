<?php

namespace App\Models;

use CodeIgniter\Model;

helper('auth');

class PaymentModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'tbl_payment';
    protected $primaryKey       = 'id_payment';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user', 'nama', 'no_telp', 'provinsi', 'kabupaten', 'kecamatan', 'alamat', 'gambar', 'order_invoice', 'gross_amount', 'status'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getByStatus($status)
    {
        return $this->db->table('tbl_payment')
            ->select('*')
            ->where('status', $status)
            ->where('user', user_id())
            ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_payment.provinsi')
            ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = kabupaten')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_payment.kecamatan')
            ->get()->getResult();
    }

    public function getByStatusAll($status)
    {
        return $this->db->table('tbl_payment')
            ->select('*')
            ->where('status', $status)
            ->join('tbl_provinsi', 'tbl_provinsi.id_provinsi = tbl_payment.provinsi')
            ->join('tbl_kabupaten', 'tbl_kabupaten.id_kabupaten = kabupaten')
            ->join('tbl_kecamatan', 'tbl_kecamatan.id_kecamatan = tbl_payment.kecamatan')
            ->get()->getResult();
    }
}
