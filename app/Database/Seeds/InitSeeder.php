<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        $this->call('GasStationSeeder');
        $this->call('NewsSeeder');
        $this->call('RestaurantSeeder');
        $this->call('ReviewSeeder');
        $this->call('RolesSeeder');
        $this->call('UsersSeeder');
        $this->call('VideosSeeder');
        $this->call('WeatherSeeder');

    }
}
