<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Divisi extends Seeder
{
    public function run()
    {
        //
        $divisi = [
            'BPH',
            'Acara',
            'Creative',
            'Peran',
            'Sekretariat',
            'IT',
            'Perlengkapan',
            'Regulasi',
            'Konsumsi',
            'Kesehatan'
        ];

        $color = [
            '#ffffff',
            '#fe810e',
            '#40c2f6',
            '#6e0095',
            '#ff0100',
            '#c82459',
            '#0701f2',
            '#005826',
            '#50ff40',
            '#fffe53'
        ];

        for ($i=0; $i < count($divisi); $i++) {
            $data = [
                'divisi' => $divisi[$i],
                'color' => $color[$i]
            ];
            $this->db->table('divisi')->insert($data);
        }
    }
}
