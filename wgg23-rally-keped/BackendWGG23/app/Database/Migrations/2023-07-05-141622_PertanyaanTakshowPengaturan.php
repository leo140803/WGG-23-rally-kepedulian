<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class PertanyaanTakshowPengaturan extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id' => [
                'type' => 'tinyint',
                'constraint' => 1,
                'unsigned' => true,
                'null' => false
            ],
            'last_changed_nrp' => [
                'type' => 'varchar',
                'null' => true,
                'constraint' => 9,
            ],
            'is_open' => [
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => false,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'datetime',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'null' => false
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ]
        ];


        $this->forge->addField($fields);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('talkshow_pengaturan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('talkshow_pengaturan');
    }
}