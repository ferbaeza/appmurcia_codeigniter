<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Weather extends Migration
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
            'main'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'description' =>[
                'type' => 'varchar',
                'constraint'=> '255',
                'null' => false
            ],
            'icon'=>[
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false
            ],
            'created_at'   =>[
                'type'          =>'DATETIME',
                'null'          =>true,
            ],
            'updated_at'   =>[
                'type'          =>'DATETIME',
                'null'          =>true,
            ],
            'deleted_at'   =>[
                'type'          =>'DATETIME',
                'null'          =>true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Weather');

    }

    public function down()
    {
        $this->forge->dropTable('Weather');
    }
}
