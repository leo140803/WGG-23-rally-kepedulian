<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummyRotasi extends Seeder
{
    public function run()
    {
        $rotasi = [
            ['id_kelompok' => 1, 'ruang1' => 'P.205', 'ruang2' => 'P.206', 'ruang3' => 'P.205', 'ruang4' => 'P.205', 'ruang5' => 'P.201A', 'ruang6' => 'Q.203', 'ruang7' => 'P.208'],
            ['id_kelompok' => 2, 'ruang1' => 'P.205', 'ruang2' => 'Q.205', 'ruang3' => 'I.205', 'ruang4' => 'P.205', 'ruang5' => 'P.208', 'ruang6' => 'P.205', 'ruang7' => 'P.205'],
            ['id_kelompok' => 3, 'ruang1' => 'P.209', 'ruang2' => 'P.205', 'ruang3' => 'P.205', 'ruang4' => 'P.205', 'ruang5' => 'P.205', 'ruang6' => 'Q.401', 'ruang7' => 'Q.401'],
            ['id_kelompok' => 4, 'ruang1' => 'Q.205', 'ruang2' => 'P.205', 'ruang3' => 'P.205', 'ruang4' => 'P.205', 'ruang5' => 'P.205', 'ruang6' => 'Q.205', 'ruang7' => 'P.205'],
            ['id_kelompok' => 5, 'ruang1' => 'Q.301', 'ruang2' => 'Q.301', 'ruang3' => 'Q.301', 'ruang4' => 'Q.301', 'ruang5' => 'P.205', 'ruang6' => 'P.205', 'ruang7' => 'P.205'],
        ];
        $this->db->table('rotasi')->insertBatch($rotasi);
    }
}
