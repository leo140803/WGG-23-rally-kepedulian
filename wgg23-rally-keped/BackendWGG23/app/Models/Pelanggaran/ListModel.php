<?php

namespace App\Models\Pelanggaran;

use CodeIgniter\Model;

class ListModel extends Model
{
    protected $table            = 'dataayat';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'Keterangan', 'Pasal'];
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;

    // public function tampilkan_data()
    // {
    //     return $this
    //     ->select('*')
    //     ->db
    //     ->table($this->table)
    //     ->orderBy('Pasal')
    //     ->orderBy('id')
    //     ->get()
    //     ->getResult();
    // }

    public function tampilkan_data()
    {
        return $this
        ->orderBy('Pasal')
        ->orderBy('id')
        ->findAll();
    }
}
