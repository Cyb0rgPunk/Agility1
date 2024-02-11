<?php

namespace App\Models;

use CodeIgniter\Model;

class MUser extends Model
{
    protected $table            = 't_users';
    protected $primaryKey       = 'id_user';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = ['email','user','group','password','identification','phone','address',
    'barrio',
    'zone',
    'id_operation',];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getUser($data){
        $user = $this->db->table('t_users');
        $user->where($data);
        return $user->get()->getResultArray();
    }

}