<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('news')->where('id>',0)->delete();
        $this->db->query("ALTER TABLE news AUTO_INCREMENT=1 ");
        $created= new Time('-3 days');
        $updated= new Time();
        $pubDate = new Time('-1 day');

        // $new=[
        //     [
        //     'title'=> 'Murcia estrena nueva web de Turismo',
        //     'pubDate'=> $pubDate->format('Y-m-d H:i:s'),
        //     'url'=> 'http://appmurcia_codeigniter.test/',
        //     'guid'=> 'New644R',
        //     'description'=> 'The page you are looking at is being generated dynamically by CodeIgniter.',
        //     'created_at'=> $created->format('Y-m-d H:i:s'),
        //     'updated_at'=> $updated->format('Y-m-d H:i:s'),
        //     ]
        // ];
        // d($new);
        // $builder= $this->db->table('news');
        // $builder->insertBatch($new);

    }
}
