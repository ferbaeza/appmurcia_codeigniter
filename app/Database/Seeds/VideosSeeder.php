<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class VideosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('videos')->where("id >", 0)->delete();
        $this->db->query("ALTER TABLE videos AUTO_INCREMENT=1");

        $created= new Time('-4 days');
        $updated= new Time();
        $videos=[
            [
                'title' => 'Qué ver en Murcia 🇪🇸 | 10 Lugares Imprescindibles',
                'pubDate' => '2019-05-16',
                'url' => 'https://www.youtube.com/watch?v=JcajSACJvzE',
                'guid' => 'dKSzA2ZxK0ygD20oZAzftw',
                'description' => 'Repaso de 10 lugares que puedes ver cuando vas a Murcia a hacer turismo.',
                'created_at' =>$created->format('Y-m-d H:i:s'),
                'updated_at' =>$updated->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Descubre la ciudad de Murcia',
                'pubDate' => '2017-02-22',
                'url' => 'https://www.youtube.com/watch?v=-F4A-GTQFEI',
                'guid' => '_iyhI6ctW0uCH8UOd-0u-A',
                'description' => 'Tour por Murcia, repasando sitios emblematicos y vistas muy bonitas de la ciudad.',
                'created_at' =>$created->format('Y-m-d H:i:s'),
                'updated_at' =>$updated->format('Y-m-d H:i:s'),
            ]
        ];
        $builder = $this->db->table('videos');
        $builder->insertBatch($videos);
    }
}
