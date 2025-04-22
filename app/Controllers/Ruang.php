<?php

namespace App\Controllers;

use App\Models\RuangModel;
use App\Models\PermintaanModel;
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

    public function getKlasifikasi(){
        $namaRuang = $this->request->getPost('nama_ruang');
        $model = new RuangModel();
        $ruang = $model->where('nama_ruang', $namaRuang)->first();
        return $this->response->setJSON($ruang['klasifikasi']);
    }

    public function simpan()
    {
        
        $ruangModel = new RuangModel();
        $permintaanModel = new PermintaanModel();
    
        $pesan = ""; // Variabel untuk menyimpan pesan
    
        
            // Ambil data dari form
            $data = [
                'nama' => $this->request->getPost('nama'),
                'nim' => $this->request->getPost('nim'),
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
            
        
       
        // Ambil daftar ruang dari database
       
       }
    
}