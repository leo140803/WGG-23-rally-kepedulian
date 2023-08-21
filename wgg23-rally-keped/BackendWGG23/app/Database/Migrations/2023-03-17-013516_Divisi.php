<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Divisi extends Migration
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
            'divisi' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => false
            ],
            'color' => [
                'type' => 'varchar',
                'constraint' => 7,
                'null' => false
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('divisi');
    }

    public function down()
    {
        //
        $this->forge->dropTable('divisi');
    }
}
