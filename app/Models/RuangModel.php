<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangModel extends Model
{
    protected $table      = 'ruang'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key tabel

    protected $allowedFields = ['nama_ruang', 'klasifikasi', 'kapasitas', 'status']; // Kolom yang bisa diisi

    // Method untuk mendapatkan semua ruang
    public function getAllRuang()
    {
        return $this->findAll();
    }
    public function getRuang()
    {
       return $this->select('ruang')
       ->distinct()
       ->where('ruang IS NOT NULL')
       ->orderBy('ruang', 'ASC')
       ->findAll();
     }

}
