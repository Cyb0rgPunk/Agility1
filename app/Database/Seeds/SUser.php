<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SUser extends Seeder
{
    public function run()
    {
        $users = [
            [
                'user' => 'Administrador',
                'email' => 'ADMINISTRADOR@AGILITY.COM',
                'password' =>  password_hash("admin1232023", PASSWORD_DEFAULT),
                'group' => '1'
            ],
            [
                'user' => 'Coordinador',
                'email' => 'Coordinador@agility.com',
                'password' =>  password_hash("admin1232023", PASSWORD_DEFAULT),
                'group' => '2'
            ],
            [
                'user' => 'Interventor',
                'email' => 'interventor@agility.com',
                'password' =>  password_hash("admin1232023", PASSWORD_DEFAULT),
                'group' => '3'
            ]
        ];

        foreach ($users as $user){
            var_dump($user);
            $this->db->table('t_users')->insert($user);
        }    
    }
}
