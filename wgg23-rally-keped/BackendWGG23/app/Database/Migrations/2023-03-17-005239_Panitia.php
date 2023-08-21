<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Panitia extends Migration
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
            ],
            'nama' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false
            ],
            'gender' => [
                'type' => 'varchar',
                'constraint' => 6,
                'null' => false
            ],
            'tanggal_lahir' => [
                'type' => 'varchar',
                'constraint' => 10,
                'null' => false
            ],
            'divisi' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false
            ],
            'jabatan' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false
            ],
            'id_line' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false
            ],
            'no_telp' => [
                'type' => 'varchar',
                'constraint' => 20,
                'null' => false
            ],
            'instagram' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false
            ],
            'tiktok' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ],
            'alamat' => [
                'type' => 'text',
                'null' => false
            ],
            'kelurahan' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ],
            'kecamatan' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ],
            'kota' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ],
            'provinsi' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => false
            ],
            'kode_pos' => [
                'type' => 'int',
                'unsigned' => true
            ],
            'foto' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => false
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
        $this->forge->createTable('panitia');
    }

    public function down()
    {
        //
        $this->forge->dropTable("panitia");
    }
}
