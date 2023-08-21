<?php

namespace App\Models\Kelompok;

use CodeIgniter\Model;
use PDO;

class MhModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'nrp';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nrp', 'nama', 'prodi', 'jenis_kelamin', 'asal_kota', 'agama', 'sma_asal', 'no_hp', 'id_kelompok', 'deleted_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';



    //Untuk Kelompok
    public function fetch_mahasiswa($id){
        return $this
        ->db
        ->table($this->table)
        ->where('id_kelompok',$id)
        ->get()
        ->getResult();
    }

    public function fetch_all_mahasiswa(){
        return $this
        ->db
        ->table($this->table. " m")
        ->select('m.nrp , m.prodi , m.id_kelompok, k.nama as nama_kelompok')
        ->join('kelompok k','m.id_kelompok=k.id','left')
        ->where('m.deleted_at IS NULL', null, false)
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

    //get id_ketua
    public function get_id($nrp){
        return $this
        ->db
        ->table($this->table)
        ->select('id')
        ->where('nrp',$nrp)
        ->get()
        ->getRow();
        
    }
    //hapus id_kelompok mahasiswa berdasarkan id mahasiswa
    public function hapus_kelompok_mahasiswa($id){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'id_kelompok' => null
        ])
        ->where('id',$id)
        ->update();
    }

    //hapus id_kelompok mahasiswa berdasarkan id_kelompok tertentu
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


    //try suggest
    public function suggestMahasiswa($nrp){
        return $this
        ->db
        ->table($this->table)
        ->select('nrp')
        ->like('nrp',$nrp )
        ->limit(5)
        ->get()
        ->getResult();
    }


    

}
