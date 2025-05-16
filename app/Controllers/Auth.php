<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        
        if ($this->session->get('logged_in')) {
            return redirect()->to('dashboard');
        }
        return view('login');
        
    }

    public function register(){
        return view('register');
    }

    Public function store() {
        $model = new UserModel();
        $model->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'NIM'      => $this->request->getPost('NIM'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => "menunggu" 
        ]);

        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }
    

    public function login(){

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
             return redirect()->back()->withInput()->with('validation', $this->validator);
        }


        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->getUser($username);

        if ($user && password_verify($password, $user['password'])) {
            
            if ($user['role'] === 'menunggu') {
                session()->setFlashdata('error', 'Akun Anda belum aktif. Silakan tunggu 24 jam atau hubungi admin.');
                return redirect()->to('login');
            }
            session()->set([
                'id_user' => $user['id'],
                
                'username' => $user['username'], 
                'email' => $user['email'],
                'NIM' => $user['NIM'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            if ($user['role'] === 'admin' || $user['role'] === 'superAdmin') {
                return redirect()->to('/dashboard_admin'); 
            } else {
                return redirect()->to('/'); 
            }
        } 
        else {
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('login');
        }
        
        

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
    
        
        
}
