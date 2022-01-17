<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class News extends Migration
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
            'title'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'pubDate'=>[
                'type' => 'DATETIME',
                'null' => false,
            ],
            'url'=>[
                'type' => 'varchar',
                'constraint' => '255',
                'null' => false
            ],
            'guid'=>[
                'type' => 'varchar',
                'constraint' => '255',
                'unique' =>true,
                'null'=> false
            ],
            'description' =>[
                'type' => 'text',
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
        $this->forge->createTable('News');

    }

    public function down()
    {
        $this->forge->dropTable('News');
    }
}
