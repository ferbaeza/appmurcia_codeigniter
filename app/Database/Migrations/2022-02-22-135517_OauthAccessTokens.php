<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthAccessTokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'access_token'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '40',
                'null'           =>false,
            ],
            'client_id'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '80',
                'null'           =>false,
            ],

            'user_id'             => [
                'type'             => 'VARCHAR',
                'constraint'       => '80',
            ],
            'expires'             =>[
                'type'             =>'TIMESTAMP',
                'null'             =>false,
            ],
            'scope'             =>[
                'type'             =>'VARCHAR',
                'constraint'       =>'4000',
            ]
        ]);
        $this->forge->addKey('access_token', true);
        $this->forge->createTable('oauth_access_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_access_tokens');
    }
}

