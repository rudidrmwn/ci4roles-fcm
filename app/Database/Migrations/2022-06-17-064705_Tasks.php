<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Tasks extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id_task'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'task_title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'task_description' => [
				'type'           => 'TEXT',
				'null'           => true,
			],
			'status'      => [
				'type'           => 'ENUM',
				'constraint'     => ['approved','checked', 'draft'],
				'default'        => 'draft',
			],
			'created_at' => [
			    'type'    => 'TIMESTAMP',
	    		'default' => new RawSql('CURRENT_TIMESTAMP'),
			],
			'updated_at' => [
			    'type'    => 'TIMESTAMP',
	    		'default' => new RawSql('CURRENT_TIMESTAMP'),
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id_task', TRUE);

		// Membuat tabel tasks
		$this->forge->createTable('tasks', TRUE);
    }

    public function down()
    {
        //
    }
}
