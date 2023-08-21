<?php

namespace App\Database\Migrations\Pelanggaran;

use CodeIgniter\Database\Migration;

class GantiNamaKolomPelanggaranPeringatan extends Migration
{
    private const PELANGGARAN = 'pelanggaran';
    private const PERINGATAN = 'peringatan';
    public function up()
    {
        $fields = [
            'nrpPerekap' => [
                'name' => 'id_perekap',
                'type' => 'int',
                'unsigned' => true,
            ],
        ];
        $this->forge->modifyColumn(self::PELANGGARAN, $fields);
        $this->forge->modifyColumn(self::PERINGATAN, $fields);
        $this->db->query('ALTER TABLE '.self::PERINGATAN.' ADD CONSTRAINT `fk_id_perekap_'.self::PERINGATAN.'` FOREIGN KEY (`id_perekap`) REFERENCES `panitia`(`id`) ON UPDATE CASCADE;');
        $this->db->query('ALTER TABLE '.self::PELANGGARAN.' ADD CONSTRAINT `fk_id_perekap_'.self::PELANGGARAN.'` FOREIGN KEY (`id_perekap`) REFERENCES `panitia`(`id`) ON UPDATE CASCADE;');
    }
    
    public function down()
    {
        $fields = [
            'id_perekap' => [
                'name' => 'nrpPerekap',
                'type' => 'varchar',
                'constraint' => 9,
            ],
        ];
        $this->forge->modifyColumn(self::PELANGGARAN, $fields);
        $this->forge->modifyColumn(self::PERINGATAN, $fields);
        $this->db->query('ALTER TABLE '.self::PERINGATAN.' DROP CONSTRAINT `fk_id_perekap_'.self::PERINGATAN.'`;');
        $this->db->query('ALTER TABLE '.self::PELANGGARAN.' DROP CONSTRAINT `fk_id_perekap_'.self::PELANGGARAN.'`;');
    }
}
