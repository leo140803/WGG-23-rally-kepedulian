<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PertanyaanTalkshowAnonym extends Migration
{
    public function up()
    {
        //
        $fields = [
            'is_anonym' => [
                'type' => 'tinyint',
                'constraint' => 1,
                'null' => false,
                'default' => 0,
                'unsigned' => true
            ]
        ];

        $this->forge->addColumn('talkshow_pertanyaan', $fields);
    }

    public function down()
    {
        //
        $this->forge->dropColumn('talkshow_pertanyaan', ['is_anonym']);
    }
}
