<?php

namespace App\Models\QnA;

use CodeIgniter\Model;

class PertanyaanModel extends Model
{
    protected $table            = 'talkshow_pertanyaan';
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nrp', 'pertanyaan', 'is_anonym'];
}
