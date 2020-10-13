<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TableCategory extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'c1'          => [
					'type'           => 'char',
					'constraint'     => 1,
			],
			'c2'          => [
					'type'           => 'char',
					'constraint'     => 1,
			],
			'c3'          => [
					'type'           => 'char',
					'constraint'     => 1,
			],
			'namacategory'          => [
					'type'           => 'varchar',
					'constraint'     => 15,
			],
			
		]);
		$this->forge->addKey('c1', true);
		$this->forge->addKey('c2', true);
		$this->forge->addKey('c3', true);
		$this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('categories');
	}
}
