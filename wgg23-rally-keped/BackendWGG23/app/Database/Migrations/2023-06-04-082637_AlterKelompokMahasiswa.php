<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterKelompokMahasiswa extends Migration
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
        $this->forge->modifyColumn('mahasiswa', $fields);
    }

    public function down()
    {
        //
        $fields = [
            'id_kelompok' => [
                'type' => 'int',
                'unsigned' => true,
                'null' => false,
            ],
        ];
        $this->forge->modifyColumn('mahasiswa', $fields);
    }
}
