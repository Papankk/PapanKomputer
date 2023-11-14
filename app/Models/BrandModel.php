<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table      = 'tbl_brand';
    protected $primaryKey = 'id_brand';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_brand', 'gambar_brand', 'slug_brand'];
}
