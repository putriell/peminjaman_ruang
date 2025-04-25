<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Auth extends BaseController
{
    public function index()
    {
        
        if ($this->session->get('logged_in')) {
            return redirect()->to('dashboard');
        }
        return view('login');
        
    }

    public function auth(){
        $validation = \Config\Services::validation();

        // Aturan validasi
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

        $model = new LoginModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username) -> first();

        $user = $model->getUser($username);

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'], 
                'email' => $user['email'],
                'NIM' => $user['NIM'],
                'role' => $user['role'],
                'logged_in' => true
            ]);
            if ($user['role'] === 'admin' || $user['role'] === 'superAdmin') {
                return redirect()->to('dashboard_admin'); 
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
        return redirect()->to('login')->with('success', 'Berhasil logout.');
    }
    
        
        
}
