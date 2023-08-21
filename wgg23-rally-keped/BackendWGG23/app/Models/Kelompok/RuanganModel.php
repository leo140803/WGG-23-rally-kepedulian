<?php

namespace App\Models\Kelompok;

use CodeIgniter\Model;

class RuanganModel extends Model
{
    protected $table            = 'ruangan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['ruangan']; 
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    public function tampil_data(){
        
    }

    public function edit_ruang($data) {
        return $this
            ->set([
                'Ruangan' => $data['ruangan'],
            ])
            ->where('Nama', $data['nama'])
            ->update();
    }

    public function getRuangan($nrp)
    {
        $builder = $this->db->table('mahasiswa m');
        $builder->select('r.ruangan');
        $builder->join('kelompok k', 'm.id_kelompok = k.id');
        $builder->join('ruangan r', 'k.ruangan = r.id');
        $builder->where('m.nrp', $nrp);

        return $builder->get()->getResult();
    }

}
