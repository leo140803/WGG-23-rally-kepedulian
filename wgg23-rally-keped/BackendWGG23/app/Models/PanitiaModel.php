<?php

namespace App\Models;

use CodeIgniter\Model;

class PanitiaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'panitia';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'foto', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function pelanggaran_tampilkan_data()
    {
        return $this
        ->select('*')
        ->db
        ->table($this->table)
        ->orderBy('id')
        ->get()
        ->getResult();
    }
}
