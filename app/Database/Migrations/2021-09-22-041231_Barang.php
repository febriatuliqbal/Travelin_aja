<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Barang extends Migration
{
	public function up()
    {
        $this->forge->addField([
            'brgkode1910005' => [
                'type' => 'char',
                'constraint' => '10',
            ],
            'brgnama1910005' => [
                'type' => 'varchar',
                'constraint' => '100'
            ],
            'brgkatid1910005' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'brgsatid1910005' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'brgharga1910005' => [
                'type' => 'double',
            ],
            'brggambar1910005' => [
                'type' => 'varchar',
                'constraint' => 200
            ]
        ]);
 
        $this->forge->addPrimaryKey('brgkode1910005');
        $this->forge->addForeignKey('brgkatid1910005', 'kategori1910005', 'katid1910005');
        $this->forge->addForeignKey('brgsatid1910005', 'satuan1910005', 'satid1910005');
 
        $this->forge->createTable('barang1910005');
    }
 
    public function down()
    {
        $this->forge->dropTable('barang1910005');
    }
}
