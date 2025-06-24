<?php

namespace App\Controllers;
use App\Models\JadwalKuliah;
use App\Models\KendaraanDisetujui;
use App\Models\KendaraanDitolak;
use App\Models\KendaraanModel;
use App\Models\PermintaanKendaraan;
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
    protected $permintaanKendaraan;
    protected $ruangModel;

    public function __construct()
    {
        $this->permintaanModel = new PermintaanModel();
        $this->ruangDisetujui = new RuangDisetujui();
        $this->ruangDitolak = new RuangDitolak();
        $this->jadwalKuliah = new JadwalKuliah();
        $this->permintaanKendaraan = new PermintaanKendaraan();
        $this->ruangModel = new RuangModel();
    }
    //ruang
    public function index()
    {
        $model = new PermintaanModel();
        $data['jumlah_permintaan'] = $this->permintaanModel->countAllResults();
        $perPage = 5; 

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
            'disetujui'   => $model->getPaginatedData($perPage),
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
                'id_user' => $data['id_user'],
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
                'id_user' => $data['id_user'],
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
            $permintaanModel->delete($id);

            return redirect()->to('/dashboard_admin')->with('message', 'Data berhasil ditolak.');
            } else {
                return redirect()->back()->with('error', 'Data tidak ditemukan.');
            }
    }

        public function hapus() {
        $id = $this->request->getPost('id');
        $alasan = $this->request->getPost('alasan_penolakan');
        $modelDisetujui = new RuangDisetujui();
        $modelDitolak = new RuangDitolak();
    
        $data = $modelDisetujui->find($id);
    
        if ($data) {
            $modelDitolak->insert([
                'id' => $data['id'],
                'id_user' => $data['id_user'],
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
            $modelDisetujui->delete($id);
        }
    
        return redirect()->back()->with('success', 'Data berhasil dipindahkan ke tabel Ditolak.');
    
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

    public function menunggu_kendaraan()
    {
        $model = new PermintaanKendaraan();
        $perPage = 5; 

            $data = [
                'permintaan'   => $model->getPaginatedData($perPage), 
                'pager'       => $model->pager,
                'page'        => $this->request->getVar('page') ?? 1,
                'totalPages'  => $model->pager->getPageCount(),
            ];
        return view('admin/kendaraan/persetujuan', $data);
    }

    public function search_disetujui()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new RuangDisetujui();

        $data = [
            'keyword' => $keyword,
            'disetujui' => $model->getSearchResults($keyword),
            'pager' => $model->pager,
            'page' => (int) ($this->request->getVar('page') ?? 1),
            'totalPages' => $model->pager->getPageCount(), 
        ];

        return view('admin/ruang_disetujui', $data);
    }

    public function search_ditolak()
    {
        $keyword = $this->request->getGet('keyword');
        $model = new RuangDitolak();

        $data = [
            'keyword' => $keyword,
            'ditolak' => $model->getSearchResults($keyword),
            'pager' => $model->pager,
            'page' => (int) ($this->request->getVar('page') ?? 1),
            'totalPages' => $model->pager->getPageCount(), 
        ];

        return view('admin/ruang_ditolak', $data);
    }
    public function tambah_jadwal(){
        $data = [
            'ruang_list' => $this->ruangModel->getRuangKelas()
        ];
        return view('admin/akademik', $data);
    }
   public function simpan_jadwal()
{
    $postData = $this->request->getPost();
    $ruangId = $postData['ruang'];
    $ruangData = $this->ruangModel->find($ruangId);
    $namaRuang = $ruangData ? $ruangData['nama_ruang'] : 'Ruang Tidak Ditemukan';
    $tanggalMulai = new \DateTime($postData['tanggal_mulai']);
    $tanggalSelesai = new \DateTime($postData['tanggal_selesai']);
    
    $interval = new \DateInterval('P1W'); 
    $currentDate = $tanggalMulai;

    while ($currentDate <= $tanggalSelesai) {
        $dataToInsert = [
            'matkul'        => $postData['matkul'],
            'nama'          => $postData['nama'], 
            
            'ruang'         => $namaRuang, 
            'tanggal'       => $currentDate->format('Y-m-d'),
            'waktu_mulai'   => $postData['waktu_mulai'],
            'waktu_selesai' => $postData['waktu_selesai'],
            'jurusan'       => $postData['jurusan'],
            'code'          => $postData['code']
        ];

        
        $this->jadwalKuliah->insert($dataToInsert);

        $currentDate->add($interval);
    }

    session()->setFlashdata('pesan', 'Jadwal kuliah berhasil ditambahkan untuk periode yang dipilih.');
    return redirect()->to(base_url('jadwal_kuliah/tambah'));
}
}
