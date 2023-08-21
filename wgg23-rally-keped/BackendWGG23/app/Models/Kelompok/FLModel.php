<?php

namespace App\Models\Kelompok;

use CodeIgniter\Model;

class FLModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'frontline';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nrp', 'id_kelompok','deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    //Untuk Kelompok
    public function fetch_frontline($id){
        return $this
        ->db
        ->table($this->table. " f")
        ->select("f.id,f.nrp,f.id_kelompok,p.nama,p.no_telp as telp")
        ->join('panitia p','f.nrp = p.nrp','left')
        ->where('id_kelompok',$id)
        ->get()
        ->getResult();
    }
    
    //set id_kelompok
    public function update_id_kelompok($data){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'id_kelompok' => $data['id_kelompok']
        ])
        ->where('nrp',$data['nrp'])
        ->update();
        
    }

    //hapus id_kelompok frontline
    public function hapus_kelompok_frontline($id){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'id_kelompok' =>null
        ])
        ->where('id',$id)
        ->update();
    }

    //hapus id_kelompok frontline berdasarkan id_kelompok tertentu
    public function kelompok_terhapus($id){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'id_kelompok' => null
        ])
        ->where('id_kelompok',$id)
        ->update();

    }

    // suggest
    public function suggestFrontline($nrp){
        return $this
        ->db
        ->table($this->table)
        ->select('nrp')
        ->like('nrp',$nrp )
        ->limit(5)
        ->get()
        ->getResult();
    }

    //get id kelompok
    public function get_id_kelompok($nrp){
        return $this
        ->db
        ->table($this->table)
        ->select('id_kelompok')
        ->where('nrp',$nrp)
        ->get()
        ->getRow();
    }
    


}
