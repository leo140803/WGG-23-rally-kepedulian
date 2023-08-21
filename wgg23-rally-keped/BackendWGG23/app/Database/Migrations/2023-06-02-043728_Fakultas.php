<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fakultas extends Migration
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
            'kode' => [
                'type' => 'varchar',
                'constraint' => 1,
            ],
            'nama' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'nama_inggris' => [
                'type' => 'varchar',
                'constraint' => 50,
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
        $this->forge->createTable('master_fakultas');
    }

    public function down()
    {
        //
        $this->forge->dropTable("master_fakultas");
    }
}
