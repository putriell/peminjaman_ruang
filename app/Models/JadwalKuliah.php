<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalKuliah extends Model
{
    protected $table = 'jadwal_kuliah';
    protected $allowedFields = ['matkul', 'nama', 'ruang', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'jurusan', 'code'];
}