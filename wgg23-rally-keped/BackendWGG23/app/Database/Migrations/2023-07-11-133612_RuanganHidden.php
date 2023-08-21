<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RuanganHidden extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'hidden' => [
                'type' => 'boolean',
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('kelompok_statusRuangan');
    }

    public function down()
    {
        $this->forge->dropTable("kelompok_statusRuangan");
    }
}
