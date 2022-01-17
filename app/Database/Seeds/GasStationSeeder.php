<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;


class GasStationSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('gasstation')->where('id>',0)->delete();
        $this->db->query("ALTER TABLE gasstation AUTO_INCREMENT=1 ");
        $created= new Time('-3 days');
        $updated= new Time();
        $station=[
            [
            'label'=> 'Repsol',
            'address'=> 'Av Juan Carlos I',
            'latitud'=> 37.896848,
            'longitud'=> 1.168461,
            'ideess'=> 'Ed5644R',
            'created_at'=> $created->format('Y-m-d H:i:s'),
            'updated_at'=> $updated->format('Y-m-d H:i:s'),
            ]
        ];
        d($station);
        $builder= $this->db->table('gasstation');
        $builder->insertBatch($station);
    }    
}
