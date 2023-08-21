<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ijin extends Migration
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
            'id_tanggal' => [
                'type' => 'int',
                'unsigned' => true,
                'null' => false
            ],
            'waktu_mulai' => [
                'type' => 'time'
            ],
            'waktu_selesai' => [
                'type' => 'time'
            ],
            'jenis_ijin' => [
                'type' => 'int',
                'null' => false
            ],
            'keterangan' => [
                'type' => 'text',
                'null' => false
            ],
            'bukti' => [
                'type' => 'text',
                'null' => false
            ],
            'terima' => [
                'type' => 'int',
            ],
            'nrp_penerima' => [
                'type' => 'varchar',
                'constraint' => 9,
                'null' => true
            ],
            'comment' => [
                'type' => 'text',
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
        $this->forge->addForeignKey('id_tanggal','ijin_tanggal','id');
        $this->forge->addForeignKey('nrp_penerima','panitia','nrp');
        $this->forge->addForeignKey('nrp','mahasiswa','nrp');
        $this->forge->createTable('ijin');
    }

    public function down()
    {
        $this->forge->dropTable('ijin');
    }
}
