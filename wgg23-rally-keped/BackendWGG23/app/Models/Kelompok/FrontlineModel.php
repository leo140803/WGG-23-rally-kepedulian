<?php

namespace App\Models\Kelompok;

use CodeIgniter\Model;

class FrontlineModel extends Model
{
    protected $table = 'frontline';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $protectFields    = true;

    public function getFL($nrp)
    {
        $builder = $this->db->table('mahasiswa m');
        $builder->select('p.nama, p.id_line');
        $builder->join('frontline f', 'm.id_kelompok = f.id_kelompok');
        $builder->join('panitia p', 'f.nrp = p.nrp');
        $builder->where('m.nrp', $nrp);

        return $builder->get()->getResult();
    }
}
