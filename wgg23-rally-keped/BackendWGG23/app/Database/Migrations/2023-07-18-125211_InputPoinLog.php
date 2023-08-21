<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InputPoinLog extends Migration
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
            'id_kelompok' => [
                'type' => 'int',
                'unsigned' => true,
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
        $this->forge->addForeignKey('id_kelompok', 'kelompok_rally', 'id_kelompok');
        $this->forge->createTable('log_point');
    }

    public function down()
    {
        $this->forge->dropTable("log_point");
    }
}
