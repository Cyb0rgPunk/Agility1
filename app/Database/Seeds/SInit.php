<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SInit extends Seeder
{
    public function run()
    {
        $this->call('SGroups');
        $this->call('SUser');
        $this->call('SZonas');
    }
}
