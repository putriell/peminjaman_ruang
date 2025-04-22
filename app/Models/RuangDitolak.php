<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangDitolak extends Model
{
    protected $table = 'ditolak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'organisasi', 'nim', 'penanggungjawab', 'email', 'nohp', 'ruang', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'fasilitas', 'keperluan', 'lampiran', 'klasifikasi', 'alasan_penolakan'];

    public function getPaginatedData($perPage = 5)
    {
        $builder = $this;
        return $builder->orderBy('tanggal', 'DESC')->paginate($perPage);
    }
}