<?php

namespace App\Controllers;

use App\Models\KendaraanDisetujui;
use App\Models\KendaraanDitolak;
use App\Models\PermintaanKendaraan;
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
        foreach ($permintaan as &$p) {
            $p['status'] = 'Menunggu';
        }
        
        $ditolak    = $ditolakModel->where('id_user', $userId)->findAll();
        foreach ($ditolak as &$t) {
            $t['status'] = 'Ditolak';
        }
        
        $disetujui  = $disetujuiModel->where('id_user', $userId)->findAll();
        foreach ($disetujui as &$d) {
            $d['status'] = 'Disetujui';
        }
        
        $gabungan = array_merge($permintaan, $ditolak, $disetujui);
        
        usort($gabungan, function ($a, $b) {
            return strtotime($b['tanggal']) - strtotime($a['tanggal']);
        });
        
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
    public function dataKendaraan()
    {
        
        $permintaanKendaraan = new PermintaanKendaraan();
        $disetujuiKendaraan = new KendaraanDisetujui();
        $kendaraanDitolak = new KendaraanDitolak();
        $userId = session()->get('id_user');
        
        $permintaanKendaraan = $permintaanKendaraan->where('id_user', $userId)->findAll();
        foreach ($permintaanKendaraan as &$pk) {
            $pk['status'] = 'Menunggu';
        }
       
        $kendaraanDitolak = $kendaraanDitolak->where('id_user', $userId)->findAll();
        foreach ($kendaraanDitolak as &$tk) {
            $tk['status'] = 'Ditolak';
        }
        
        $kendaraanDisetujui = $disetujuiKendaraan->where('id_user', $userId)->findAll();
        foreach ($kendaraanDisetujui as &$dk) {
            $dk['status'] = 'Disetujui';
        }
        
        $gabunganKendaraan = array_merge($permintaanKendaraan, $kendaraanDitolak, $kendaraanDisetujui);
        
       
        usort($gabunganKendaraan, function ($a, $b) {
            return strtotime($b['tanggal_pinjam']) - strtotime($a['tanggal_pinjam']);
        });
        $perPage = 5;
        $currentPage = $this->request->getVar('page') ?? 1;
        
        $totalItem = count($gabunganKendaraan);
        $totalPage = ceil($totalItem / $perPage);

        $offset = ($currentPage - 1) * $perPage;
        $paginated = array_slice($gabunganKendaraan, $offset, $perPage);

        $data = [
            'page'         => $currentPage,
            'perPage'      => $perPage,
            'permintaanKendaraan' => $paginated,
            'totalPage' => $totalPage,
            'totalItem' => $totalItem
        ];
        return view('user/riwayat_kendaraan', $data);
    }
    public function jadwalHariIni()
    {
        $model = new RuangDisetujui();
        $userId = session()->get('id_user');
        $jadwalHariIni = $model
            ->where('id_user', $userId)
            ->where('tanggal', date('Y-m-d'))
            ->findAll();

        $data = [
            'jadwal_peminjaman' => $jadwalHariIni,
        ];

        return view('user/jadwal_hari_ini', $data);
    }
}
