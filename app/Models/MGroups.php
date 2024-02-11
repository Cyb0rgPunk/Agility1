<?php

namespace App\Models;

use CodeIgniter\Model;

class MGroups extends Model
{
    protected $table            = 't_groups';
    protected $primaryKey       = 'id_group';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = ['name','description'];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getGroups(){
        $user = $this->db->table('t_groups');
        return $user->get()->getResultArray();
    }

}
