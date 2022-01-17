<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('reviews')->where('id>',0)->delete();
        $this->db->query("ALTER TABLE reviews AUTO_INCREMENT=1 ");
        $created= new Time('-3 days');
        $updated= new Time();

        $review=[
            [
            'description'=> 'Hemos comido muy bien y un trato exquisito de un camarero llamado Pedro. Me ha encantado el plato de embutido y el tomate partido con aceitunas y bonito',
            'puntuation'=> 8.2,
            'email'=> 'eldiariogourmet@mail.com',
            'restaurant_id'=> 2,
            'created_at'=> $created->format('Y-m-d H:i:s'),
            'updated_at'=> $updated->format('Y-m-d H:i:s'),
            ]
        ];
        d($review);
        $builder= $this->db->table('reviews');
        $builder->insertBatch($review);

    }
}
