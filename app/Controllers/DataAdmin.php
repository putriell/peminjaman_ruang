<?php

namespace App\Controllers;
use App\Models\JadwalKuliah;
use App\Models\PermintaanModel;
use App\Models\RuangDisetujui;
use App\Models\RuangDitolak;
use App\Models\RuangModel;

class DataAdmin extends BaseController
{
    protected $permintaanModel;
    protected $ruangDisetujui;
    protected $ruangDitolak;
    protected $jadwalKuliah;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanModel();
        $this->ruangDisetujui = new RuangDisetujui();
        $this->ruangDitolak = new RuangDitolak();
        $this->jadwalKuliah = new JadwalKuliah();
    }

    public function index()
    {
        $model = new PermintaanModel();
        $data['jumlah_permintaan'] = $this->permintaanModel->countAllResults();
        // $data['permintaan'] = $this->permintaanModel->orderBy('ruang, tanggal, waktu_mulai')->findAll();
        $perPage = 5; // Jumlah data per halaman
            

            // Ambil data dengan pagination
            $data = [
                'permintaan'   => $model->getPaginatedData($perPage), // Pass keyword to the model
                'pager'       => $model->pager,
                'page'        => $this->request->getVar('page') ?? 1,
                'totalPages'  => $model->pager->getPageCount(),
            ];
        return view('admin/dashboard', $data);
    }
    public function Disetujui()
    {
        $model = new RuangDisetujui();
        $perPage = 5;
        $data = [
            'disetujui'   => $model->getPaginatedData($perPage), // Pass keyword to the model
            'pager'       => $model->pager,
            'page'        =>   $data['page'] = $this->request->getVar('page') ?? 1,
            'totalPages' => $model->pager->getPageCount(),

        ];

        return view('admin/ruang_disetujui', $data);
        
    } 
    public function Ditolak()
    {
        $model = new RuangDitolak();
        $perPage = 5;
        $data = [
            'ditolak'   => $model->getPaginatedData($perPage), // Pass keyword to the model
            'pager'       => $model->pager,
            'page'        =>   $data['page'] = $this->request->getVar('page') ?? 1,
            'totalPages' => $model->pager->getPageCount(),

        ];
        return view('admin/ruang_ditolak', $data);
    }

    public function jadwalHariIni()
    {
        

        $data = [
            'jumlah_permintaan' => $this->permintaanModel->countAllResults(),
            'hari_ini'          => date('Y-m-d'),
            'jadwal_peminjaman' => $this->ruangDisetujui->where('tanggal', date('Y-m-d'))->findAll(),
            'jadwal_kuliah'     => $this->jadwalKuliah->where('tanggal', date('Y-m-d'))->findAll(),
            'ruangan_dipesan'   => $this->ruangDisetujui->where('tanggal >=', date('Y-m-d'))->orderBy('tanggal', 'ASC')->findAll(),
            'username'          => session()->get('username')
        ];

        // dd($jadwalPeminjaman); 
        return view('admin/jadwal_ruang', $data);
    }
    public function approve(){
        $id = $this->request->getPost('id');
        $permintaanModel = new PermintaanModel(); 
        $data = $permintaanModel->where('id', $id)->first();

        if ($data) {
            $ruangDisetujui = new RuangDisetujui();
            $ruangDisetujui->insert([
                'id' => $data['id'],
                'nama' => $data['nama'],
                'nim' => $data['nim'],
                'organisasi' => $data['organisasi'],
                'penanggungjawab' => $data['penanggungjawab'],
                'email' => $data['email'],
                'nohp' => $data['nohp'],
                'ruang' => $data['ruang'],
                'tanggal' => $data['tanggal'],
                'waktu_mulai' => $data['waktu_mulai'],
                'waktu_selesai' => $data['waktu_selesai'],
                'fasilitas' => $data['fasilitas'],
                'keperluan' => $data['keperluan'],
                'lampiran' => $data['lampiran'],
                'klasifikasi' => $data['klasifikasi'],
                
            ]);

            // Hapus dari tabel utama
            $permintaanModel->delete($id);

            return redirect()->to('dashboard_admin')->with('message', 'Data berhasil disetujui.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
    public function reject()
    {
        $id = $this->request->getPost('id');
        // dd($id);
        $alasan = $this->request->getPost('alasan_penolakan');

        $permintaanModel = new PermintaanModel(); 
        $data = $permintaanModel->where('id', $id)->first();
        // dd($data);


        if ($data) {
            $ruangDitolak = new RuangDitolak();
            $ruangDitolak->insert([
                'id' => $data['id'],
                'nama' => $data['nama'],
                'nim' => $data['nim'],
                'organisasi' => $data['organisasi'],
                'penanggungjawab' => $data['penanggungjawab'],
                'email' => $data['email'],
                'nohp' => $data['nohp'],
                'ruang' => $data['ruang'],
                'tanggal' => $data['tanggal'],
                'waktu_mulai' => $data['waktu_mulai'],
                'waktu_selesai' => $data['waktu_selesai'],
                'fasilitas' => $data['fasilitas'],
                'keperluan' => $data['keperluan'],
                'lampiran' => $data['lampiran'],
                'klasifikasi' => $data['klasifikasi'],
                'alasan_penolakan' => $alasan,
            ]);

            // Hapus dari tabel utama
            $permintaanModel->delete($id);

            return redirect()->to('dashboard_admin')->with('message', 'Data berhasil ditolak.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function formPindahJadwal($id)
    {
        $ruangModel = new RuangModel();
        $ruangDisetujui = new RuangDisetujui();
        $data['ruang_list'] = $ruangModel->findAll(); // Ambil semua ruang
        $data['id'] = $id; 
        $data['disetujui'] = $ruangDisetujui->find($id); 
        return view('admin/form_pindah_jadwal', $data);
    }

    public function pindah_jadwal()
    {
        
        $id = $this->request->getPost('id');
        $ruang = $this->request->getPost('ruang');
        $tanggal = $this->request->getPost('tanggal');
        $waktu_mulai = $this->request->getPost('waktu_mulai');
        $waktu_selesai = $this->request->getPost('waktu_selesai');

        $data = [
            'ruang' => $ruang,
            'tanggal' => $tanggal,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
        ];


        $model = new RuangDisetujui();
        $model->update($id, $data);

        return redirect()->to('ruang_disetujui')->with('success', 'Jadwal berhasil dipindahkan.');
    }

    public function hapus() {
        $id = $this->request->getPost('id');

        $modelDisetujui = new RuangDisetujui();
        $modelDitolak = new RuangDitolak();
    
        $data = $modelDisetujui->find($id);
    
        if ($data) {
            $modelDitolak->insert($data);
            $modelDisetujui->delete($id);
        }
    
        return redirect()->back()->with('success', 'Data berhasil dipindahkan ke tabel Ditolak.');
    
    }


}
