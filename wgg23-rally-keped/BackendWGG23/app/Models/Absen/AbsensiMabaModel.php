<?php

namespace App\Models\Absen;

use CodeIgniter\Model;

class AbsensiMabaModel extends Model
{
    protected $table            = 'absen_maba';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['id_kegiatan', 'id_maba', 'jam_regis_in', 'jam_regis_out', 'last_updated_by'];

    // Dates
    protected $useTimestamps = true;
}
