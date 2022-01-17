<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reviews extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           =>false,
            ],
            'description'=> [
                'type'       => 'text',
                'null' => false
            ],
            'puntuation'=>[
                'type' => 'float',
                'constraint'=>3,
                'null' => false,
            ],
            'email'=>[
                'type' => 'varchar',
                'constraint'=> '255',
                'null' => false
            ],
            'restaurant_id'=>[
                'type' => 'int',
                'constraint' => '5',
                'unsigned'=> true,
                'null' => true
            ],
            'created_at'   =>[
                'type'   =>'DATETIME',
                'null'   =>true,
            ],
            'updated_at'   =>[
                'type' =>'DATETIME',
                'null' =>true,
            ],
            'deleted_at'   =>[
                'type' =>'DATETIME',
                'null' =>true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('restaurant_id', 'Restaurants', 'id', 'CASCADE','SET NULL');
        $this->forge->createTable('Reviews');
        $this->db->enableForeignKeyChecks();
        $this->db->disableForeignKeyChecks();


    }

    public function down()
    {
        $this->forge->dropTable('Reviews');
    }
}
