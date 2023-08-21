<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterRuanganKelompok extends Migration
{
    private $table = 'kelompok';

    public function up()
    {
        $fields = [
            'ruangan' => [
                'type' => 'int',
                'unsigned' => true,
                'null' => true,
            ]
        ];
        $this->forge->modifyColumn($this->table, $fields);
        $this->db->query("ALTER TABLE `kelompok` ADD CONSTRAINT `fk_ruangan` FOREIGN KEY (`ruangan`) REFERENCES `ruangan`(`id`) ON UPDATE CASCADE;");
    }

    public function down()
    {
        $fields = [
            'ruangan' => [
                'type' => 'varchar',
                'constraint' => 30,
            ],
        ];
        $this->forge->modifyColumn($this->table, $fields);
        $this->db->query("ALTER TABLE `kelompok` DROP CONSTRAINT `fk_ruangan`;");
    }
}
