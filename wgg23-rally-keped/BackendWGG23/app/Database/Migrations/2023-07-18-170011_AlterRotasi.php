<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterRotasi extends Migration
{
    private $table = 'rotasi';
    public function up()
    {
        $fields = [
            'ruang1' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'ruang2' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'ruang3' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'ruang4' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'ruang5' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'ruang6' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
            'ruang7' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ]
        ];
        $this->forge->modifyColumn($this->table,$fields);
    }

    public function down()
    {
        $fields = [
            'ruang1' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'ruang2' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'ruang3' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'ruang4' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'ruang5' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'ruang6' => [
                'type' => 'varchar',
                'constraint' => 5,
            ],
            'ruang7' => [
                'type' => 'varchar',
                'constraint' => 5,
            ]
        ];
        $this->forge->modifyColumn($this->table,$fields);
    }
}
