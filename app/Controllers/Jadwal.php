<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use CodeIgniter\Controller;

class Jadwal extends Controller
{
    public function ruang()
    {
        $model = new JadwalModel();

        $filter_date = $this->request->getPost('filter_date') ?? date('Y-m-d');
        $daftarruang = $model->getDaftarRuang();
        $jadwal = $model->getJadwal($filter_date);

        return view('jadwal_ruang', [
            'filter_date' => $filter_date,
            'daftarruang' => $daftarruang,
            'jadwal' => $jadwal
        ]);
    }
}
