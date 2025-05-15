<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\PermintaanModel;
use App\Models\RuangModel;
use App\Models\UserModel;

class Event extends BaseController
{
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
    
}
