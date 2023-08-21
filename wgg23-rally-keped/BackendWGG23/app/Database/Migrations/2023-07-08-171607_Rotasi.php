<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rotasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_kelompok' => [
                'type' => 'int',
                'unsigned' => true,
            ],
            'ruang1' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'ruang2' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'ruang3' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'ruang4' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'ruang5' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'ruang6' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
            'ruang7' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_kelompok', 'kelompok', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rotasi');
    }

    public function down()
    {
        $this->forge->dropTable('rotasi');
    }
}
