<?php

namespace App\Models;

use CodeIgniter\Model;

class LogPointModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'log_point';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nrp', 'id_kelompok', 'poin', 'created_at', 'updated_at', 'deleted_at'];
}
