<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['id', 'id_user', 'nama', 'nim', 'organisasi', 'penanggungjawab', 'email', 'nohp', 'ruang', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'fasilitas', 'keperluan', 'lampiran', 'status', 'klasifikasi'];
    

    public function cekJadwal($table, $ruang, $tanggal, $waktu_mulai, $waktu_selesai)
    {
        return $this->db->table($table)
            ->where('ruang', $ruang)
            ->where('tanggal', $tanggal)
            ->where('waktu_mulai <=', $waktu_selesai)
            ->where('waktu_selesai >=', $waktu_mulai)
            ->countAllResults() > 0;
    }

    public function getPaginatedData($perPage = 5)
    {
        $builder = $this;
        // return $builder->paginate($perPage);
        return $this->orderBy('ruang, tanggal, waktu_mulai')->paginate($perPage);

    }

    public function getPaginateUser($perPage, $userId)
    {
        return $this->where('id_user', $userId)->paginate($perPage);
    }


    


   



}