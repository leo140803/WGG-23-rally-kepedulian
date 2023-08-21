<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nrp' => [
                'type' => 'varchar',
                'constraint' => 9,
                'null' => false
            ],
            'nama' => [
                'type' => 'text',
                'null' => false
            ],
            'prodi' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false
            ],
            'jenis_kelamin' => [
                'type' => 'varchar',
                'constraint' => 10,
                'null' => false
            ],
            'asal_kota' => [
                'type' => 'text',
                'null' => false
            ],
            'agama' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false
            ],
            'sma_asal' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ],
            'no_hp' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false
            ],
            'id_kelompok' => [
                'type' => 'int',
                'unsigned' => true,
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_kelompok', 'kelompok', 'id');
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable("mahasiswa");
    }
}
