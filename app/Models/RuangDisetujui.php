<?php

namespace App\Models;

use CodeIgniter\Model;

class RuangDisetujui extends Model
{
    protected $table = 'disetujui';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_user','nama', 'organisasi', 'nim', 'penanggungjawab', 'email', 'nohp', 'ruang', 'tanggal', 'waktu_mulai', 'waktu_selesai', 'fasilitas', 'keperluan', 'lampiran', 'klasifikasi'];

    public function getPaginatedData($perPage = 5)
    {
        $builder = $this;
        return $builder->orderBy('tanggal', 'DESC')->paginate($perPage);
    }
    public function getSearchResults($keyword = null)
    {
        $builder = $this;

        if (!empty($keyword)) {
            $builder = $builder->groupStart()
                ->like('nama', $keyword)
                ->orLike('email', $keyword)
                ->orLike('ruang', $keyword)
                ->orLike('tanggal', $keyword)
                ->groupEnd();
        }

        return $builder->orderBy('tanggal', 'DESC')->paginate(5);
    }
    
    
}