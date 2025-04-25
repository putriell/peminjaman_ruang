<?php

namespace App\Controllers;

use App\Models\RuangModel;
use App\Models\PermintaanModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Ruang extends Controller
{
    public function index()
    {
        $model = new RuangModel();
        $data['cards'] = $model->getAllRuang(); // Ambil data dari model

        return view('informasi_ruang', $data); // Kirim data ke view
    }

    public function formPeminjaman() {
        $model = new RuangModel();
        $data['ruang'] = $model->findAll();
        return view('form_peminjaman_ruang', $data); // Ambil data dari
    }

    public function getKlasifikasi($nama_ruang)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('ruang');
        $ruang = $builder->where('nama_ruang', urldecode($nama_ruang))->get()->getRow();

        if ($ruang) {
            return $this->response->setJSON(['klasifikasi' => $ruang->klasifikasi]);
        } else {
            return $this->response->setJSON(['klasifikasi' => '']);
        }
    }


    public function simpan()
    {
        
        $ruangModel = new RuangModel();
        $permintaanModel = new PermintaanModel();
        $userModel = new UserModel();
        
        $userId = session()->get('id_user');
        $user = $userModel->find($userId);
        // dd($user);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
        $pesan = ""; 
            $data = [
                'id_user' => $user['id'],
                'username' => $user['username'],  
                'nim' => $user['NIM'],
                'email' => $user['email'],
                
                'organisasi' => $this->request->getPost('organisasi'),
                'penanggungjawab' => $this->request->getPost('penanggungjawab'),
                'email' => $this->request->getPost('email'),
                'nohp' => $this->request->getPost('nohp'),
                'ruang' => $this->request->getPost('ruang'),
                'tanggal' => $this->request->getPost('tanggal'),
                'waktu_mulai' => $this->request->getPost('waktu_mulai'),
                'waktu_selesai' => $this->request->getPost('waktu_selesai'),
                'fasilitas' => $this->request->getPost('fasilitas'),
                'keperluan' => $this->request->getPost('keperluan'),
                'klasifikasi' => $this->request->getPost('klasifikasi'),
            ];

    

            // Cek ketersediaan ruang
            $ruang = $data['ruang'];
            $tanggal = $data['tanggal'];
            $waktu_mulai = $data['waktu_mulai'];
            $waktu_selesai = $data['waktu_selesai'];
    
            $cek_disetujui = $permintaanModel->cekJadwal('disetujui', $ruang, $tanggal, $waktu_mulai, $waktu_selesai);
            $cek_event = $permintaanModel->cekJadwal('event', $ruang, $tanggal, $waktu_mulai, $waktu_selesai);
            $cek_jadwal_kuliah = $permintaanModel->cekJadwal('jadwal_kuliah', $ruang, $tanggal, $waktu_mulai, $waktu_selesai);
            $cek_jadwal_ujian = $permintaanModel->cekJadwal('jadwal_ujian', $ruang, $tanggal, $waktu_mulai, $waktu_selesai);
    
            if ($cek_disetujui || $cek_event || $cek_jadwal_kuliah || $cek_jadwal_ujian) {
                $pesan = "Maaf, ruangan sudah dipesan pada tanggal dan waktu yang sama. Silakan pilih ruangan dan waktu lain.";
            } else {
                // Proses upload file lampiran
                $lampiran = $this->request->getFile('lampiran');
                if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                    $newName = $lampiran->getRandomName();
                    $lampiran->move(WRITEPATH . 'uploads', $newName);
                    $data['lampiran'] = $newName;
                } else {
                    $data['lampiran'] = '';
                }
    
                // Simpan data ke database
                
            }
            $ruang = $ruangModel->findAll();
        
            
            if ($permintaanModel->insert($data)) {
                $pesan = "Pengajuan anda sudah dikirim!";
                return view('/form_peminjaman_ruang', ['pesan' => $pesan, 'ruang' => $ruang]);
    
                
            } else {
                $pesan = "Terjadi kesalahan saat menyimpan data:" . implode(', ', $permintaanModel->errors());
                return view('form_peminjaman_ruang', ['pesan' => $pesan, 'ruang' => $ruang]);
            }
            
       
       }
    
}