<?php

namespace App\Models\Pelanggaran;

use CodeIgniter\Model;

class TambahAyatModel extends Model
{
    protected $table            = 'dataayat';
    protected $primaryKey       = 'ID';
    protected $returnType       = 'object';
    protected $allowedFields    = ['Keterangan', 'Pasal', 'ID', 'sistemTegur', 'idPasal'];
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;

    public function tambahAyat($dataAyat){
        return $this->insert($dataAyat);
    }

    public function tampilkan_data()
    {
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->orderBy('Pasal', 'ID')
        // ->get()
        // ->getResult();
        ->findAll();
    }

    public function tampilkan_data_deleted()
    {
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->orderBy('Pasal', 'ID')
        // ->get()
        // ->getResult();
        ->withDeleted()
        ->findAll();
    }

    public function hapus_data($ID)
    {
        return $this
            ->where('ID', $ID)
            ->delete();
    }

    public function fetch_data($ID){
        return $this
        ->where('ID', $ID)
        ->first();
    }

    public function edit_data($data)
    {
        return $this
            ->set([
                'Keterangan' => $data['Keterangan'],
                'Pasal' => $data['Pasal'],
                'idPasal' => $data['idPasal'],
                'sistemTegur' => $data['sistemTegur']
            ])
            ->where('ID', $data['ID'])
            ->update();
    }

    public function tampilkan_data_Bersyarat($pasal)
    {
        return $this
        ->where('idPasal', $pasal)
        ->get()
        ->getResult();
    }
}
