<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeKelompokFrontlineNullable extends Migration
{
    public function up()
    {
        //
        $fields = [
            'id_kelompok' => [
                'type' => 'int',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('frontline', $fields);
    }

    public function down()
    {
        $fields = [
            'id_kelompok' => [
                'type' => 'int',
                'unsigned' => true,
                'null' => true,
            ],
        ];
        $this->forge->modifyColumn('frontline', $fields);
    }
}
