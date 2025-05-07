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
        // dd($this->request->getPost());
        $ruangModel = new RuangModel();
        $permintaanModel = new PermintaanModel();
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
        
            
            if ($permintaanModel->insert($data)) {
                $pesan = "Pengajuan anda sudah dikirim!";
                return view('admin/event', ['pesan' => $pesan, 'ruang' => $ruang]);
    
                
            } else {
                $pesan = "Terjadi kesalahan saat menyimpan data:" . implode(', ', $permintaanModel->errors());
                return view('admin/event', ['pesan' => $pesan, 'ruang' => $ruang]);
            }
            
       
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
