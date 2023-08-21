<?php

namespace App\Models\rotasi;

use CodeIgniter\Model;

class KelompokModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelompok';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'ruangan', 'id_ketua', 'created_at', 'updated_at', 'deleted_at'];
    

    public function get_id($name) {
        return $this
        ->select('id','nama')
        ->where('nama', $name)
        ->first();
    }


}
