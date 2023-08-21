<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class PertanyaanTalkshow extends Migration
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
                'null' => true
            ],
            'pertanyaan' => [
                'type' => 'varchar',
                'constraint' => 250,
                'null' => false
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ]
        ];

        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('nrp', 'mahasiswa', 'nrp');
        $this->forge->createTable('talkshow_pertanyaan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('talkshow_pertanyaan');
    }
}
