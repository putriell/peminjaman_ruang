<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'disetujui';
    protected $allowedFields = ['nama', 'ruang', 'waktu_mulai', 'waktu_selesai', 'tanggal'];

    public function getDaftarRuang()
    {
        $db = \Config\Database::connect();
        return $db->table('ruang')->select('nama_ruang')->get()->getResultArray();
    }

    public function getJadwal($filter_date)
    {
        $db = \Config\Database::connect();

        // Query Peminjaman
        $queryPeminjaman = $db->query("SELECT 'Peminjaman' AS tipe, nama, ruang, waktu_mulai, waktu_selesai FROM disetujui WHERE DATE(tanggal) = ?", [$filter_date]);

        // Query Event
        $queryEvent = $db->query("SELECT 'Event' AS tipe, organisasi AS nama, ruang, waktu_mulai, waktu_selesai FROM event WHERE DATE(tanggal) = ?", [$filter_date]);

        // Query Kuliah
        $queryKuliah = $db->query("SELECT 'Kuliah' AS tipe, matkul AS nama, ruang, waktu_mulai, waktu_selesai FROM jadwal_kuliah WHERE DATE(tanggal) = ?", [$filter_date]);

        // Gabungkan data
        $jadwal = array_merge($queryPeminjaman->getResultArray(), $queryEvent->getResultArray(), $queryKuliah->getResultArray());

        // Urutkan berdasarkan waktu mulai
        usort($jadwal, function ($a, $b) {
            return strtotime($a['waktu_mulai']) - strtotime($b['waktu_mulai']);
        });

        return $jadwal;
    }
}
