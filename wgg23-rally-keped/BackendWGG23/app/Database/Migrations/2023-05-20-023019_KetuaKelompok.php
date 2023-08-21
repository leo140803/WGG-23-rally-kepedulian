<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KetuaKelompok extends Migration
{
    private $table = 'kelompok';
    public function up()
    {
        $fields = [
            'id_ketua' => [
                'type' => 'int',
                'unsigned' => true,
                'null' => true,
                'after' => 'nama',
            ]
        ];
        $this->forge->addColumn($this->table, $fields);
        $this->db->query("ALTER TABLE `kelompok` ADD CONSTRAINT `fk_ketua` FOREIGN KEY (`id_ketua`) REFERENCES `mahasiswa`(`id`) ON UPDATE CASCADE;");
    }
    
    public function down()
    {
        $this->db->query("ALTER TABLE `kelompok` DROP CONSTRAINT `fk_ketua`;");
        $this->forge->dropColumn($this->table, 'id_ketua');
    }
}
