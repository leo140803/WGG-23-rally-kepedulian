<?php

namespace App\Models\Absen;

use CodeIgniter\Model;

class AbsensiPanitiaModel extends Model
{
    protected $table            = 'absen_panitia';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['id_kegiatan', 'id_panitia', 'jam_regis_in', 'jam_regis_out', 'last_updated_by'];

    // Dates
    protected $useTimestamps = true;
}
