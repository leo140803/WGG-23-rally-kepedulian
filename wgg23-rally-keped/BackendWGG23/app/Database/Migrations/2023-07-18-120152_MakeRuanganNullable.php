<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakeRuanganNullable extends Migration
{
    public function up()
    {
          //
          $fields = [
            'ruang1' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],

            'ruang2' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],

            'ruang3' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],

            'ruang4' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
            'ruang5' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
            'ruang6' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
            'ruang7' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
        ];
        $this->forge->modifyColumn('rotasi', $fields);
    }

    public function down()
    {
        //
        $fields = [
            'ruang1' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],

            'ruang2' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
            'ruang3' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],

            'ruang4' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
            'ruang5' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
            'ruang6' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
            'ruang7' => [
                'type'       => 'VARCHAR',
                'constraint' => '5',
                'null' => true
            ],
        ];
        $this->forge->modifyColumn('rotasi', $fields);
    }
}
