<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','username', 'email', 'NIM', 'password'];

    public function getUser($username){
        return $this->where('username', $username)->first();
    }
    
}