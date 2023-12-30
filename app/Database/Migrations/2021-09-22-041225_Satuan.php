<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Satuan extends Migration
{
	public function up()
    {
        $this->forge->addField([
            'satid1910005' => [
                'type' => 'int',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'satnama1910005' => [
                'type' => 'varchar',
                'constraint' => '50'
            ]
        ]);
        $this->forge->addKey('satid1910005');
        $this->forge->createTable('satuan1910005');
    }
 
    public function down()
    {
        $this->forge->dropTable('satuan1910005');
    }

}
