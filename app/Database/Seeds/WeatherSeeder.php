<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class WeatherSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('weather')->where("id >", 0)->delete();
        $this->db->query("ALTER TABLE weather AUTO_INCREMENT=1");

        $created= new Time('-4 days');
        $updated= new Time();
        $weather=[
            [
                'main' => 'Soleado',
                'description' => 'Soleado sin nubes',
                'icon' => '01n',
                'created_at' =>$created->format('Y-m-d H:i:s'),
                'updated_at' =>$updated->format('Y-m-d H:i:s'),
            ],
           
        ];
        $builder = $this->db->table('weather');
        $builder->insertBatch($weather);
    }
}
