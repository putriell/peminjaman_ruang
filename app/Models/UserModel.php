<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['id','username', 'email', 'password', 'NIM', 'role', 'status'];
   

    public function getUser($username){
        return $this->where('username', $username)->first();
    }
    public function updatePassword($username, $newPassword) {
        return $this->db->table('users')
        ->where('username', $username)
        ->update(['password' => $newPassword]);    
    }
    public function getById($id){
        return $this->where('id', $id)->first();
    }
    public function search($keyword, $perPage = 10,) {
        $builder = $this->table($this->table);
        if ($keyword) {
            $builder->groupStart()
                    -> like('username', $keyword)
                    ->orLike('email', $keyword)
                    ->orLike('NIM', $keyword)
                    ->orLike('role', $keyword)
                    ->orLike('status', $keyword)
                    ->groupEnd();
        }
        
        return $builder->paginate($perPage);
    }

    public function getPaginatedData($perPage = 10, $keyword = null)
    {
        $builder = $this->whereIn('role', ['admin', 'user', 'akademik']);

        if ($keyword) {
            $builder ->groupStart()
                     ->like('username', $keyword)
                     ->orLike('email', $keyword)
                     ->orLike('NIM', $keyword)
                     ->orLike('role', $keyword)
                     ->orLike('status', $keyword)
                     ->groupEnd();
        }

        return $builder->paginate($perPage);
    }

    public function getMenungguUsers($perPage)
    {
        return $this->where('role', 'menunggu')->paginate($perPage);
    }


}
