<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'uid'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'email'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
					'unique'		 => true,
			],
			'password'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '100',
			],
			'namadepan'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
			],
			'namabelakang'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
			],
			'notelpon'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '13',
			],
			'tgllahir'       => [
					'type'           => 'date',
			],
			'tglregister'       => [
					'type'           => 'date',
			],
			'status'       => [
					'type'           => 'CHAR',
					'constraint'     => '1',
			],
			'photo'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '100',
			],
			
		]);
		$this->forge->addKey('uid', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
