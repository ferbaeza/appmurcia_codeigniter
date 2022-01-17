<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->where("id >", 0)->delete();
        $this->db->query("ALTER TABLE users AUTO_INCREMENT=1");
        
        $created= new Time("-3 days");
        $updated= new Time();
        $admin_hash= password_hash("11", PASSWORD_DEFAULT );

        $users=[
            [
                'username' =>"Root",
                'email' => "admin@mail.com",
                'password' =>$admin_hash,   
                //'password' =>"11",                
                'name' =>"Concejalia Turismo",
                'surname' =>"Murcia",
                'rol_id' =>'1',
                'created_at' =>$created->format('Y-m-d H:i:s'),
                'updated_at' =>$updated->format('Y-m-d H:i:s'),
            ]  
        ];
        //d($users);    //asi se imprime en consola para comprobar que los seeder funcionan bien
        $builder = $this->db->table('users');
        $builder->insertBatch($users);


    }
}
