<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TanggalIjin extends Migration
{
    public function up()
    {
        $fields=[
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'tanggal' => [
                'type' => 'date',
                'null' => false
            ],
            'open' => [
                'type' => 'int',
                'unsigned' => true,
                'constraint' => 1,
                'null' => false
            ]
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('ijin_tanggal');
    }

    public function down()
    {
        $this->forge->dropTable('ijin_tanggal');
    }
}
