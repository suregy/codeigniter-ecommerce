<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableKategori extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'c1'       => [
					'type'           => 'char',
					'constraint'     => '3',
					'unique'		 => true,
					'default'		 => '0',
			],
			'c2'       => [
				'type'           => 'char',
				'constraint'     => '3',
				'unique'		 => true,
				'default'		 => '0',
			],
			'c3'       => [
				'type'           => 'char',
				'constraint'     => '3',
				'unique'		 => true,
				'default'		 => '0',
			],
			'namacategory'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
			],
			
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('categories');
	}
}
