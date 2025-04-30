<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nama', 'nim', 'organisasi', 'penanggungjawab', 'email', 'nohp', 'ruang', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'fasilitas', 'keperluan', 'klasifikasi'];

    public function getPaginatedData($perPage = 5)
    {
        $builder = $this;
        return $builder->orderBy('tanggal', 'DESC')->paginate($perPage);
    }
}