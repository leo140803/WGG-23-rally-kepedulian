<?php

namespace App\Models\Pelanggaran;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = [];
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;

    public function tampilkan_data()
    {
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->orderBy('id')
        // ->get()
        // ->getResult();
        ->findAll();
    }

    public function exist($nrp){
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->where('nrp', $nrp)
        // ->get()
        // ->getResult();
        ->findAll();
    }

    public function fetch_mahasiswa($nrp){
        return $this
        ->where('nrp', $nrp)
        ->first();
    }
}
