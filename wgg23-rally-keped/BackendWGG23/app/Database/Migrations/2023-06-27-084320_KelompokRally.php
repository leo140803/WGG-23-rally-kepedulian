<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KelompokRally extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_kelompok' => [
                'type' => 'int',
                'unsigned' => true,
            ],
            'scene' => [
                'type' => 'int',
                'constraint' => 1,
            ],
            'poin' => [
                'type' => 'int',
                'constraint' => 12,
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
        $this->forge->createTable('kelompok_rally');
    }

    public function down()
    {
        $this->forge->dropTable("kelompok_rally");
    }
}
