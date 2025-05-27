<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','driver','mobil', 'kapasitas', 'status'];
}