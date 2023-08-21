<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProdiPanitia extends Migration
{
    public function up()
    {
        //
        $fields = [
            'prodi' => [
                'type' => 'varchar',
                'constraint' => 50,
                'null' => true,
                'after' => 'tanggal_lahir'
            ],
        ];
        $this->forge->addColumn('panitia', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('panitia', 'prodi');
    }
}
