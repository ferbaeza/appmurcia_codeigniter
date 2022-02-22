<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'username'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '80',
            ],
            'password'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '80',
            ],
            'first_name'             => [
                'type'             => 'VARCHAR',
                'constraint'       => '80',
            ],
            'last_name'             => [
                'type'             => 'VARCHAR',
                'constraint'       => '80',
            ],
            'email'             => [
                'type'             => 'VARCHAR',
                'constraint'       => '80',
            ],
            'email_verified'             => [
                'type'             => 'BOOLEAN',
            ],
            'scope'             =>[
                'type'             =>'VARCHAR',
                'constraint'       =>'4000',
            ]
        ]);
        $this->forge->addKey('username', true);
        $this->forge->createTable('oauth_users');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_users');
    }
}

