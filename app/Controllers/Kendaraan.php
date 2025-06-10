<?php

namespace App\Controllers;

use App\Models\KendaraanDisetujui;
use App\Models\KendaraanDitolak;
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

        public function Disetujui_kendaraan()
        {
            $model = new KendaraanDisetujui();
            $perPage = 5;
            $data = [
                'disetujui'   => $model->getPaginatedData($perPage),
                'pager'       => $model->pager,
                'page'        =>   $data['page'] = $this->request->getVar('page') ?? 1,
                'totalPages' => $model->pager->getPageCount(),

            ];

            return view('admin/kendaraan/disetujui', $data);
        } 

        public function Ditolak_kendaraan()
        {
            $model = new KendaraanDitolak();
            $perPage = 5;
            $data = [
                'ditolak'   => $model->getPaginatedData($perPage), // Pass keyword to the model
                'pager'       => $model->pager,
                'page'        =>   $data['page'] = $this->request->getVar('page') ?? 1,
                'totalPages' => $model->pager->getPageCount(),

            ];
            return view('admin/kendaraan/ditolak', $data);
        }

        public function approve_kendaraan(){
            $id = $this->request->getPost('id');
            $permintaanModel = new PermintaanKendaraan(); 
            $data = $permintaanModel->where('id', $id)->first();

            if ($data) {
                $kendaraanDisetujui = new KendaraanDisetujui();
                $kendaraanDisetujui->insert([
                    'id' => $data['id'],
                    'id_user' => $data['id_user'],
                    'nama' => $data['nama'],
                    'no_hp' => $data['no_hp'],
                    'kendaraan' => $data['kendaraan'],
                    'tanggal_pinjam' => $data['tanggal_pinjam'],
                    'tanggal_kembali' => $data['tanggal_kembali'],
                    'jam_pinjam' => $data['jam_pinjam'],
                    'jam_kembali' => $data['jam_kembali'],
                    'status' => $data['status'],
                    'unit_kerja' => $data['unit_kerja'],
                    'nama_pic' => $data['nama_pic'],
                    'keperluan' => $data['keperluan'],
                    'lampiran' => $data['lampiran'],
                    
                ]);

                // Hapus dari tabel utama
                $permintaanModel->delete($id);

                return redirect()->to('kendaraan_menunggu')->with('message', 'Data berhasil disetujui.');
            } else {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
        }
    public function reject_kendaraan()
    {
        $id = $this->request->getPost('id');
        $alasan = $this->request->getPost('alasan_penolakan');

        $permintaanModel = new PermintaanKendaraan(); 
        $data = $permintaanModel->where('id', $id)->first();
        if ($data) {
            $kendaraanDitolak = new KendaraanDitolak();
            $kendaraanDitolak->insert([
                'id' => $data['id'],
                'id_user' => $data['id_user'],
                'nama' => $data['nama'],
                'no_hp' => $data['no_hp'],
                'kendaraan' => $data['kendaraan'],
                'tanggal_pinjam' => $data['tanggal_pinjam'],
                'tanggal_kembali' => $data['tanggal_kembali'],
                'jam_pinjam' => $data['jam_pinjam'],
                'jam_kembali' => $data['jam_kembali'],
                'status' => $data['status'],
                'unit_kerja' => $data['unit_kerja'],
                'nama_pic' => $data['nama_pic'],
                'keperluan' => $data['keperluan'],
                'lampiran' => $data['lampiran'],
                'alasan_penolakan' => $alasan,
            ]);
            $permintaanModel->delete($id);

            return redirect()->to('kendaraan_menunggu')->with('message', 'Data berhasil ditolak.');
            } else {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
    }
}