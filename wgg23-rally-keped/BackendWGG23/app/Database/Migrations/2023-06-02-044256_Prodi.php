<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prodi extends Migration
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
                'type' => 'int',
                'unsigned' => true,
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
            'fakultas' => [
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
        $this->forge->addForeignKey('fakultas', 'master_fakultas', 'id');
        $this->forge->createTable('master_prodi');
    }

    public function down()
    {
        //
        $this->forge->dropTable("master_prodi");
    }
}
