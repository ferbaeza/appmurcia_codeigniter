<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GasStation extends Migration
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
            'label'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => false
            ],
            'address' =>[
                'type' => 'varchar',
                'constraint'=>'255',
                'null' => false
            ],
            'latitud'=>[
                'type' => 'decimal',
                'constraint' => 8,6,
                'null' => false
            ],
            'longitud'=>[
                'type' => 'decimal',
                'constraint' => 9,6,
                'null' => false
            ],
            'ideess'=>[
                'type' => 'varchar',
                'constraint' => '255',
                'unique' =>true,
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
        $this->forge->createTable('GasStation');

    }

    public function down()
    {
        $this->forge->dropTable('GasStation');
    }
}
