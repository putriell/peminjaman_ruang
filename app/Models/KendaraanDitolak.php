<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanDitolak extends Model
{
    protected $table = 'ditolak_kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','id_user','nama', 'email', 'no_hp', 'tanggal_pinjam', 'tanggal_kembali', 'kendaraan', 'jam_pinjam', 'jam_kembali', 'status_peminjaman'];

    public function getPaginatedData($perPage = 5)
    {
        $builder = $this;
        return $builder->orderBy('tanggal_pinjam', 'DESC')->paginate($perPage);
    }
    public function getSearchResults($keyword = null)
    {
        $builder = $this;

        if (!empty($keyword)) {
            $builder = $builder->groupStart()
                ->like('nama', $keyword)
                ->orLike('kendaraan', $keyword)
                ->orLike('no_hp', $keyword)
                ->orLike('email', $keyword)
                ->orLike('tanggal_pinjam', $keyword)
                ->groupEnd();
        }

        return $builder->orderBy('tanggal_pinjam', 'DESC')->paginate(5);
    }
}