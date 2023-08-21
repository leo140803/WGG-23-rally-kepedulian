<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogMahasiswa extends Migration
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
            'nama_file' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'nrp_pengupdate' => [
                'type' => 'varchar',
                'constraint' => 9,
            ],
            'bertambah' => [
                'type' => 'int',
                'unsigned' => true,
            ],
            'berkurang' => [
                'type' => 'int',
                'unsigned' => true,
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
        $this->forge->addForeignKey('nrp_pengupdate', 'panitia', 'nrp');
        $this->forge->createTable('log_mahasiswa');
    }

    public function down()
    {
        //
        $this->forge->dropTable("log_mahasiswa");
    }
}
