<?php

namespace App\Models\Absen;

use CodeIgniter\Model;

class KegiatanPanitiaModel extends Model
{
    protected $table            = 'absen_kegiatan_panitia';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nama', 'tanggal', 'start_regis_in', 'end_regis_in', 'start_regis_out', 'end_regis_out'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
