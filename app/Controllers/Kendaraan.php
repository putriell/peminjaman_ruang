<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\PermintaanKendaraan;
use App\Models\PermintaanModel;
use App\Models\UserModel;

class Kendaraan extends BaseController
{
    public function index()
    {
        $model = new KendaraanModel();
        $data['cards'] = $model->findAll();

        return view('informasi_kendaraan', $data); 
    }

    public function formPeminjaman() {
        $model = new KendaraanModel();
        $kendaraan = $model->findAll();
        return view('form_kendaraan', ['kendaraan' => $kendaraan]); 
    }

    public function simpan(){
        $kendaraanmodel = new KendaraanModel();
        $usermodel = new UserModel();
        $permintaanModel = new PermintaanKendaraan();

        $userId = session()->get('id_user');
        $user = $usermodel->find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'id_user' => $user['id'],
            'nama' => $user['username'],
            'no_hp' => $this->request->getPost('no_hp'),
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'kendaraan' => $this->request->getPost('kendaraan'),
            'jam_pinjam' => $this->request->getPost('jam_pinjam'),
            'jam_kembali' => $this->request->getPost('jam_kembali'),
            'status' => $this->request->getPost('status'),
            'unit_kerja' => $this->request->getPost('unit_kerja'),
            'nama_pic' => $this->request->getPost('nama_pic'),
            'keperluan' => $this->request->getPost('keperluan'),
        ];

        $kendaraan = $kendaraanmodel->findAll();
        $lampiran = $this->request->getFile('lampiran');
            if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                $newName = $lampiran->getRandomName();
                $lampiran->move(WRITEPATH . 'uploads', $newName);
                $data['lampiran'] = $newName;
            } else {
                $data['lampiran'] = '';
            }

        if ($permintaanModel->insert($data)) {
                $pesan = "Pengajuan anda sudah dikirim!";
                return view('form_kendaraan', ['pesan' => $pesan, 'kendaraan' => $kendaraan]);
    
                
            } else {
                $pesan = "Terjadi kesalahan saat menyimpan data:" . implode(', ', $permintaanModel->errors());
                return view('form_kendaraan', ['pesan' => $pesan, 'kendaraan' => $kendaraan]);
            }
    }
}