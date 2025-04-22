<?php

namespace App\Controllers;

use App\Models\KendaraanModel;

class Kendaraan extends BaseController
{
    public function index()
    {
        $model = new KendaraanModel();
        $data['cards'] = $model->findAll(); // Ambil data kendaraan dari database

        return view('informasi_kendaraan', $data); // Tampilkan view dengan data kendaraan
    }
}