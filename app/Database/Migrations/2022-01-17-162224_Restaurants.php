<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Restaurants extends Migration
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
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'           =>false,
            ],
            'description'=>[
                'type'=> 'varchar',
                'constraint'=>'255',
                'null' => false
            ],
            'address' =>[
                'type' => 'text',
                'null' => false
            ],
            'latitud'=>[
                'type' => 'DECIMAL',
                'constraint' => "50,10",
                'null' => false
            ],
            'longitud'=>[
                'type' => 'DECIMAL',
                'constraint' => "50,10",
                'null' => false
            ],
            'reviewAverage'=>[
                'type' => 'float',
                'constraint' => 3,
                'null' => false
            ],
            'numReviews'=>[
                'type'=> 'int',
                'constraint' => 5,
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
        $this->forge->createTable('Restaurants');

    }

    public function down()
    {
        $this->forge->dropTable('Restaurants');
    }
}
