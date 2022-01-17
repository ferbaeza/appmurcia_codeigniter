<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           =>false,
            ],
            'username'             => [
                'type'             => 'VARCHAR',
                'constraint'       => '100',
                'null'             =>false,
                'unique'            =>true,
            ],
            'email'             => [
                'type'             => 'VARCHAR',
                'constraint'       => '200',
                'null'             =>false,
                'unique'            =>true,
            ],
            'password'             =>[
                'type'             =>'VARCHAR',
                'constraint'       =>'255',
                'null'             =>false,
                'unique'            =>true,
            ],
            'name'             =>[
                'type'             =>'VARCHAR',
                'constraint'       =>'255',
                'null'             =>false,
            ],
            'surname'             =>[
                'type'             =>'VARCHAR',
                'constraint'       =>'255',
                'null'             =>false,
            ],
            'rol_id'             =>[
                'type'             =>'INT',
                'constraint'       =>5,
                'unsigned'       => true,
                'null'             =>true,
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
        $this->forge->addForeignKey('rol_id', 'Roles', 'id', 'CASCADE','SET NULL');
        $this->forge->createTable('Users');
        $this->db->enableForeignKeyChecks();
        $this->db->disableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('Users');
    }
}
