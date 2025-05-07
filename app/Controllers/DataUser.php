<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\RuangDisetujui;
use App\Models\RuangDitolak;

class DataUser extends BaseController
{
    public function index()
    {
        $permintaanModel = new PermintaanModel();
        $disetujuiModel = new RuangDisetujui();
        $ditolakModel = new RuangDitolak();
        $userId = session()->get('id_user');
        $permintaan = $permintaanModel->where('id_user', $userId)->findAll();
        $ditolak    = $ditolakModel->where('id_user', $userId)->findAll();
        $disetujui  = $disetujuiModel->where('id_user', $userId)->findAll();
    
        $gabungan = array_merge($permintaan, $ditolak, $disetujui);

        $perPage = 5;
        $currentPage = $this->request->getVar('page') ?? 1;
        $totalItems = count($gabungan);
        $totalPages = ceil($totalItems / $perPage);

        $offset = ($currentPage - 1) * $perPage;
        $paginatedData = array_slice($gabungan, $offset, $perPage);

        $data = [
            'permintaan'   => $paginatedData,
            'page'         => $currentPage,
            'totalPages'   => $totalPages,
            'perPage'      => $perPage,
            'totalItems'   => $totalItems,
        ];
        return view('user/dashboard_user', $data);
    }
    public function jadwalHariIni()
    {
        return view('user/jadwal_hari_ini');
    }
}
