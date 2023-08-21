<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Faqrally extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'auto_increment' => true
            ],
            'question' => [
                'type' => 'varchar',
                'constraint' => 255
            ],
            'answer' => [
                'type' => 'varchar',
                'constraint' => 255
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable("faqrally", true);
    }

    public function down()
    {
        $this->forge->dropTable("faqrally");
    }
}
