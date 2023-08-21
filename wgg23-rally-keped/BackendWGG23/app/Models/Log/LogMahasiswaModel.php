<?php

namespace App\Models\Log;

use CodeIgniter\Model;

class LogMahasiswaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'log_mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_file', 'nrp_pengupdate', 'bertambah', 'berkurang'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
