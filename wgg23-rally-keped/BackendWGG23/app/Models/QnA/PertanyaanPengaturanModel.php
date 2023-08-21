<?php

namespace App\Models\QnA;

use CodeIgniter\Model;

class PertanyaanPengaturanModel extends Model
{
    protected $table            = 'talkshow_pengaturan';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['id', 'last_changed_nrp', 'is_open'];
}
