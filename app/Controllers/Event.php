<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\PermintaanModel;
use App\Models\RuangModel;
use App\Models\UserModel;

class Event extends BaseController
{
    protected $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    public function index()
    {
        $model = new EventModel();
        $ruangModel = new RuangModel();
        
        $perPage = 5;
        $data = [
            'event'   => $model->getPaginatedData($perPage),
            'pager'       => $model->pager,
            'page'        =>   $data['page'] = $this->request->getVar('page') ?? 1,
            'totalPages' => $model->pager->getPageCount(),
            'ruang'      => $ruangModel->findAll(), 
        ];
        
        return view('admin/event', $data);
    }

    public function simpan()
    {
        $ruangModel = new RuangModel();
        $model = new EventModel();
            $data = [           
                'nama' => $this->request->getPost('nama'),            
                'nim' => $this->request->getPost('nim'),                  
                'email' => $this->request->getPost('email'),
                'organisasi' => $this->request->getPost('organisasi'),
                'penanggungjawab' => $this->request->getPost('penanggungjawab'),
                'nohp' => $this->request->getPost('nohp'),
                'ruang' => $this->request->getPost('ruang'),
                'tanggal' => $this->request->getPost('tanggal'),
                'waktu_mulai' => $this->request->getPost('waktu_mulai'),
                'waktu_selesai' => $this->request->getPost('waktu_selesai'),
                'fasilitas' => $this->request->getPost('fasilitas'),
                'keperluan' => $this->request->getPost('keperluan'),
                'klasifikasi' => $this->request->getPost('klasifikasi'),
            ];

            $ruang = $ruangModel->findAll();
            $page = $this->request->getGet('page') ?? 1;
            $perPage = 10;

            $totalRows = $model->countAllResults();
            $totalPages = ceil($totalRows / $perPage);

            $event = $model->orderBy('tanggal', 'desc')
                                    ->paginate($perPage, 'default', $page);
                
                    
            if ($model->insert($data)) {
                $pesan = "Pengajuan anda sudah dikirim!";
            } else {
                $pesan = "Terjadi kesalahan saat menyimpan data:" . implode(', ', $model->errors());
            }

            return view('admin/event', [
                'pesan' => $pesan,
                'ruang' => $ruang,
                'event' => $event,
                'page' => $page,
                'totalPages' => $totalPages,
                'success' => session()->getFlashdata('success'),
                 'error' => session()->getFlashdata('error'),
            ]);
       
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
        public function edit($id = null)
    {
        
        if ($id === null) {
            return redirect()->to(base_url('event'))->with('error', 'ID event tidak ditemukan.');
        }

        $event = $this->eventModel->find($id);
        if (!$event) {
            return redirect()->to(base_url('event'))->with('error', 'Data event tidak ditemukan.');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama' => 'required|min_length[3]',
                'ruang' => 'required',
                'email' => 'required|valid_email',
                'tanggal' => 'required|valid_date',
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required|after_or_equal[waktu_mulai]',
            ];

            if ($this->validate($rules)) {
                $data = [
                    'nama'          => $this->request->getPost('nama'),
                    'ruang'         => $this->request->getPost('ruang'),
                    'email'         => $this->request->getPost('email'),
                    'tanggal'       => $this->request->getPost('tanggal'),
                    'waktu_mulai'   => $this->request->getPost('waktu_mulai'),
                    'waktu_selesai' => $this->request->getPost('waktu_selesai'),
                ];

                if ($this->eventModel->update($id, $data)) {
                    return redirect()->to(base_url('event'))->with('success', 'Data event berhasil diperbarui.');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data event.');
                }
            } else {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }
        }

        $data['event'] = $event;
        return view('admin/form_edit_event', $data); 
    }

    // --- FUNGSI HAPUS ---

    public function hapus($id = null)
    {
        // Pastikan ID tidak kosong
        if ($id === null) {
            return redirect()->to(base_url('event'))->with('error', 'ID event tidak ditemukan.');
        }

        // Lakukan penghapusan data
        if ($this->eventModel->delete($id)) {
            return redirect()->to(base_url('event'))->with('success', 'Data event berhasil dihapus.');
        } else {
            return redirect()->to(base_url('event'))->with('error', 'Gagal menghapus data event.');
        }
    }

    
}
