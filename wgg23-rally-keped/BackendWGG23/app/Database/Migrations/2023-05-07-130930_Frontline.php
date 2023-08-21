<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Frontline extends Migration
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
            ],
            'id_kelompok' => [
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
        $this->forge->addForeignKey('id_kelompok', 'kelompok', 'id');
        $this->forge->createTable('frontline');
    }

    public function down()
    {
        $this->forge->dropTable("frontline");
    }
}
