<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('roles')->where("id >", 0)->delete();
        $this->db->query("ALTER TABLE roles AUTO_INCREMENT=1");

        $created= new Time('-4 days');
        $updated= new Time();
        $roles=[
            [
                'name' => 'admin',
                'created_at' =>$created->format('Y-m-d H:i:s'),
                'updated_at' =>$updated->format('Y-m-d H:i:s'),
            ],
        ];
        $builder = $this->db->table('roles');
        $builder->insertBatch($roles);

    }
}
