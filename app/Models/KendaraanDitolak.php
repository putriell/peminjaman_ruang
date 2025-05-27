<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanDitolak extends Model
{
    protected $table = 'ditolak_kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_user','nama', 'no_hp', 'tanggal_pinjam', 'tanggal_kembali', 'kendaraan', 'jam_pinjam', 'jam_kembali', 'status_peminjaman'];

    public function getPaginatedData($perPage = 5)
    {
        $builder = $this;
        return $builder->orderBy('tanggal_pinjam', 'DESC')->paginate($perPage);
    }
}