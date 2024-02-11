<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SZonas extends Seeder
{
    public function run()
    {
        $zonas = [
            [
                "nombre" => "Urbanas bogotá",
                "descripcion" => "Urbanas bogotá",
            ],
            [
                "nombre" => "Alendaños bogotá",
                "descripcion" => "Alendaños bogotá",        
            ],
            [
                "nombre" => "Poblacion cundinamarca",
                "descripcion" => "Poblacion cundinamarca",        
            ]
        ];

        foreach ($zonas as $zona){
            var_dump($zona);
            $this->db->table('t_zonas')->insert($zona);
        }  
    }
}
