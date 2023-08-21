<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterNRP extends Migration
{
    public function up()
    {
        $fields = [
            'nrp' => [
                'name' => 'nrp',
                'type' => 'varchar',
                'constraint' => 9,
                'unique' => true
            ]
        ];
        $this->forge->modifyColumn('panitia',$fields);
        $this->forge->modifyColumn('mahasiswa',$fields);
    }

    public function down()
    {
        $fields = [
            'nrp' => [
                'name' => 'nrp',
                'type' => 'varchar',
                'constraint' => 9,
                'unique' => false
            ]
        ];
        $this->forge->modifyColumn('panitia',$fields);
        $this->forge->modifyColumn('mahasiswa',$fields);
    }
}
