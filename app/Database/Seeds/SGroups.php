<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SGroups extends Seeder
{
    public function run()
    {
        $groups = [
            [
                'name' => 'admin',
                'description' => 'Administrador',
            ],
            [
                'name' => 'coordinador',
                'description' => 'Coordinador',
            ],
            [
                'name' => 'interventor',
                'description' => 'Interventor',
            ],
            [
                'name' => 'pasajero',
                'description' => 'pasajero',
            ],
            [
                'name' => 'conductor',
                'description' => 'conductor',
            ]               
        ];

        foreach ($groups as $group){
            var_dump($group);
            $this->db->table('t_groups')->insert($group);
        }    
    }
}
