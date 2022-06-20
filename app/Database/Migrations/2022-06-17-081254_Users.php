<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
{
    public function up()
    {
         $this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'auto_increment' => true
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '120'
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => '120'
			],
			'phonenumber' => [
				'type'           => 'VARCHAR',
				'constraint'     => '120'
			],
			'role'      => [
				'type'           => 'ENUM',
				'constraint'     => ['maker','checker', 'approval'],
				'default'        => 'maker'
			],
			'password' =>[
				'type'           => 'VARCHAR',
				'constraint'     => '120'
			],
			'fcm_token' => [
				'type'   => 'VARCHAR',
				'constraint' => '200',
				'null' => true
			],
			'created_at' => [
			    'type'    => 'TIMESTAMP',
	    		'default' => new RawSql('CURRENT_TIMESTAMP')
			]
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel users
		$this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        //
    }
}
