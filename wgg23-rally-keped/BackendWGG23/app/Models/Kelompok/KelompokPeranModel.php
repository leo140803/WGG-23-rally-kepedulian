<?php

namespace App\Models\Kelompok;

use CodeIgniter\Model;


class KelompokPeranModel extends Model
{
    protected $table            = 'kelompok';
    protected $table2            = 'mahasiswa';
    protected $table3           = 'frontline';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','id_ketua','ruangan','deleted_at']; 
    protected $useSoftDeletes   = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    // READ
    public function tampil_data(){
       return $this
       ->db
       ->table($this->table." t")   
       ->select('t.id as id,t.nama as nama_kelompok, ruangan, mahasiswa.nama as ketua')
       ->join($this->table2,'t.id_ketua=mahasiswa.id','left')
       ->get()
       ->getResult();
    }

    //Create
    public function tambah_data($data){
       return $this->insert($data);
   
        
    }

    //UPDATE
    public function fetch_data($id){
       return $this
       ->db
       ->table($this->table." k")  
       ->select('k.id as id,k.nama as nama_kelompok,k.id_ketua ,ruangan, m.nama as ketua')
       ->join($this->table2. ' m','k.id_ketua=m.id','left')
       ->where('k.id',$id)
       ->get()
       ->getResult();
    //   SSELECT k.id,k.nama, k.id_ketua,k.ruangan, m.nama from kelompok k
// left JOIN mahasiswa m on k.id_ketua =m.id
// WHERE k.id = 42
       
    }


    public function edit_data($data){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'nama' => $data['nama'],    
        ])
        ->where("id", $data['id'])
        ->update();
    }

    //hapus
    public function hapus_data($id){
        return $this
        ->db
        ->table($this->table)
        ->where('id',$id)
        ->delete();
    }

    //hapus id_ketua
public function hapus_ketua($id){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'id_ketua' => null
        ])
        ->where('id',$id)
        ->update();
    }

    //set id_ketua
    public function set_ketua($data){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'id_ketua' => $data['id_mahasiswa']
        ])
        ->where('id',$data['id'])
        ->update();
    }

    public function check_ifKetua($nrp){
        
    }

    //hapus ketua berdasarkan id_ketua

    public function hapus_ketua_berdasarIdKetua($id_ketua,$kelompokSekarang){
        return $this
        ->db
        ->table($this->table)
        ->set([
            'id_ketua' => null
        ])
        ->where('id_ketua',$id_ketua)
        ->where('id !=',$kelompokSekarang)

        ->update();
    }

}
