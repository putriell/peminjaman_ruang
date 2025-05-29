<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanDisetujui extends Model
{
    protected $table = 'disetujui_kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_user','nama', 'no_hp', 'tanggal_pinjam', 'tanggal_kembali', 'kendaraan', 'jam_pinjam', 'jam_kembali','unit_kerja', 'nama_pic', 'keperluan', 'lampiran', 'status_peminjaman'];

    public function getPaginatedData($perPage = 5)
    {
        $builder = $this;
        return $builder->orderBy('tanggal_pinjam', 'DESC')->paginate($perPage);
    }
}