<?php

namespace App\Models\Ijin;

use CodeIgniter\Model;

class IjinModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ijin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nrp','id_tanggal','waktu_mulai','waktu_selesai','jenis_ijin','keterangan','bukti','terima','nrp_penerima','comment'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
