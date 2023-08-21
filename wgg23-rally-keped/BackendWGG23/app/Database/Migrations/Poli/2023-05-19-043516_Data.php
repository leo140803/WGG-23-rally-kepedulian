<?php

namespace App\Database\Migrations\Poli;

use CodeIgniter\Database\Migration;

class Data extends Migration
{
    public function up()
    {
        //
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
            'tanggal' => [
                'type' => 'DATE'
            ],
            'jam_masuk' => [
                'type' => 'time'
            ],
            'jam_keluar' => [
                'type' => 'time',
                'null' => true
            ],
            'deskripsi' => [
                'type' => 'text',
                'null' => true
            ],
            'status' => [
                'type' => 'varchar',
                'constraint' => 20,
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
        $this->forge->createTable('absen_poli');
    }

    public function down()
    {
        //
        $this->forge->dropTable("absen_poli");
    }
}
