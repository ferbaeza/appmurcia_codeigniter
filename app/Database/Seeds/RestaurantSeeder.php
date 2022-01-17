<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('restaurants')->where('id>',0)->delete();
        $this->db->query("ALTER TABLE restaurants AUTO_INCREMENT=1 ");
        $created= new Time('-3 days');
        $updated= new Time();
        $restData=[];
        $resta=[
        [
            'name'=> 'HachoPijo',
            'description'=> 'Comida tipica de la huerta de Murcia',
            'address'=> 'Av Espinardo',
            'latitud'=> 4.1896848,
            'longitud'=> 12.968461,
            'reviewAverage'=> 8.5,
            'numReviews'=> 1255,
            'created_at'=> $created->format('Y-m-d H:i:s'),
            'updated_at'=> $updated->format('Y-m-d H:i:s'),
        ],
        [
            'name'=> 'Torremolinos',
            'description'=> 'Restaurante de carneMediterráneaEuropea',
            'address'=> 'Carretera Churra 113',
            'latitud'=> 4.3896848,
            'longitud'=> 14.968461,
            'reviewAverage'=> 8.5,
            'numReviews'=> 991,
            'created_at'=> $created->format('Y-m-d H:i:s'),
            'updated_at'=> $updated->format('Y-m-d H:i:s'),
        ],
        ];
        d($resta);
        $builder= $this->db->table('restaurants');
        $builder->insertBatch($resta);

    }
}
