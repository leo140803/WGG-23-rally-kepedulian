<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummyPelanggaran extends Seeder
{
    public function run()
    {
        $data['datapasal'] = [
            ['id' => 1, 'Bab' => 'A', 'Keterangan' => 'Barang Bawaan', 'JumlahPoin' => 5, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 2, 'Bab' => 'B', 'Keterangan' => 'Penampilan', 'JumlahPoin' => 10, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 3, 'Bab' => 'C', 'Keterangan' => 'Kelancaran Acara', 'JumlahPoin' => 20, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 4, 'Bab' => 'D', 'Keterangan' => 'Sikap dan Tata Tertib', 'JumlahPoin' => 25, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
        ];
        $data['dataayat'] = [
            ['ID' => 1, 'idPasal' => 1, 'Pasal' => 'A', 'Keterangan' => 'KTM', 'sistemTegur' => 0, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['ID' => 2, 'idPasal' => 1, 'Pasal' => 'A', 'Keterangan' => 'Alat tulis', 'sistemTegur' => 1, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['ID' => 3, 'idPasal' => 2, 'Pasal' => 'B', 'Keterangan' => 'Peserta wajib menggunakan dresscode WGG 2023 sesuai ketentuan', 'sistemTegur' => 1, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['ID' => 4, 'idPasal' => 2, 'Pasal' => 'B', 'Keterangan' => 'Peserta dilarang menggunakan pakaian ketat dan tembus pandang', 'sistemTegur' => 1, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['ID' => 5, 'idPasal' => 3, 'Pasal' => 'C', 'Keterangan' => 'Peserta hanya diperbolehkan mengonsumsi air mineral', 'sistemTegur' => 1, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['ID' => 6, 'idPasal' => 3, 'Pasal' => 'C', 'Keterangan' => 'Peserta wajib mematuhi seluruh protokol kesehatan yang berlaku', 'sistemTegur' => 1, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['ID' => 7, 'idPasal' => 4, 'Pasal' => 'D', 'Keterangan' => 'Peserta wajib melaksanakan dan menaati jalur yang sudah ditentukan', 'sistemTegur' => 1, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
        ];
        $data['pelanggaran'] = [
            ['id' => 1, 'nrp' => 'C14230078', 'idPasal' => 1, 'pasalTerlanggar' => 'A', 'ayatTerlanggar' => 1, 'Keterangan' => 'KTM hilang', 'poin' => 5, 'tanggalMelanggar' => '2023-07-10', 'id_perekap' => 28, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 2, 'nrp' => 'C14230078', 'idPasal' => 2, 'pasalTerlanggar' => 'B', 'ayatTerlanggar' => 3, 'Keterangan' => 'Dasi tidak hitam', 'poin' => 10, 'tanggalMelanggar' => '2023-07-12', 'id_perekap' => 28, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 3, 'nrp' => 'C14230078', 'idPasal' => 3, 'pasalTerlanggar' => 'C', 'ayatTerlanggar' => 5, 'Keterangan' => 'Mengonsumsi air mineral', 'poin' => 20, 'tanggalMelanggar' => '2023-07-12', 'id_perekap' => 28, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
        ];
        $data['peringatan'] = [
            ['id' => 1, 'nrp' => 'C14230078', 'idPasal' => 3, 'pasalTerlanggar' => 'C', 'ayatTerlanggar' => 5, 'Keterangan' => 'Mengonsumsi air mineral', 'poin' => 0, 'tanggalMelanggar' => '2023-07-08', 'id_perekap' => 28, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 2, 'nrp' => 'C14230078', 'idPasal' => 4, 'pasalTerlanggar' => 'D', 'ayatTerlanggar' => 7, 'Keterangan' => 'Peserta tidak menaati jalur', 'poin' => 0, 'tanggalMelanggar' => '2023-07-09', 'id_perekap' => 28, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 3, 'nrp' => 'C14230078', 'idPasal' => 1, 'pasalTerlanggar' => 'A', 'ayatTerlanggar' => 2, 'Keterangan' => 'Tidak lengkap', 'poin' => 0, 'tanggalMelanggar' => '2023-07-10', 'id_perekap' => 28, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
            ['id' => 4, 'nrp' => 'C14230078', 'idPasal' => 2, 'pasalTerlanggar' => 'B', 'ayatTerlanggar' => 3, 'Keterangan' => 'Dasi tidak hitam', 'poin' => 0, 'tanggalMelanggar' => '2023-07-10', 'id_perekap' => 28, 'created_at' => '2023-03-17 14:24:22', 'updated_at' => '2023-03-17 14:24:22', 'deleted_at' => NULL],
        ];

        foreach ($data as $table => $rows) {
            $this->db->table($table)->insertBatch($rows);
        }
    }
}
