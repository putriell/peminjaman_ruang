<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanKendaraan extends Model
{
    protected $table = 'permintaan_kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nama', 'email', 'no_hp', 'tanggal_pinjam', 'tanggal_kembali', 'kendaraan', 'jam_pinjam', 'jam_kembali', 'status', 'unit_kerja', 'nama_pic', 'keperluan', 'lampiran'];

    public function getPaginatedData($perPage = 5)
    {

        return $this->orderBy('kendaraan, tanggal_pinjam, jam_pinjam')->paginate($perPage);

    }
}