<?php

namespace App\Models\rotasi;

use CodeIgniter\Model;

class RotasiModel extends Model
{
    protected $table            = 'rotasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelompok', 'ruang1', 'ruang2', 'ruang3', 'ruang4', 'ruang5', 'ruang6', 'ruang7'];

    /**
     * Dapatkan rotasi dari ID kelompok.
     * READ DATA
     */
    public function getRotasiByKelompokId(){
        return $this
            ->db
            ->table($this->table)
            ->select("rotasi.id, kelompok.nama, ruang1, ruang2, ruang3, ruang4, ruang5, ruang6, ruang7")
            ->join("kelompok", "rotasi.id_kelompok = kelompok.id")
            ->get()
            ->getResult();
    }


    //TAMBAH DATA
    public function tambah_data($data)
    {
        return $this->insert($data,false);
    }


     //UNTUK FETCH DATA
     public function fetch_data($id)
     {
         return $this
             ->where('id', $id)
             ->first();
     }



    //EDIT DATA
    public function edit_data($data)
    {
        return $this
            ->set([
                'ruang1' => $data['ruang1'],
                'ruang2' => $data['ruang2'],
                'ruang3' => $data['ruang3'],
                'ruang4' => $data['ruang4'],
                'ruang5' => $data['ruang5'],
                'ruang6' => $data['ruang6'],
                'ruang7' => $data['ruang7']
            ])
            ->where('id', $data['id'])
            ->update();

        //UPDATE 'kelas' SET Nama = '".$data['nama']."' ,  Nilai = '".$data['nilai']."' 
        //WHERE NRP = '".$data['nrp']."'

    }



    //HAPUS DATA
    public function hapus_data($id)
    {
        return $this
            ->where('id', $id)
            ->delete();

        //DELETE FROM 'kelas' WHERE NRP = '$nrp'
    }
    //CHECK DI DATABASE
    public function fill_nama($nama)
    {
        // $qry_inp =  "SELECT nama FROM mahasiswa WHERE NRP = $nrp LIMIT 1";
        // $query = $this->db->query($qry_inp);

        return $this->db
            ->table('kelompok')
            ->select('id')
            ->where('nama', $nama)
            ->limit(1)
            ->get()
            ->getRow();
    }

    //CHECK DOUBLE DI DATABASE
    public function check_double($nama)
    {
        // $qry_inp =  "SELECT nama FROM mahasiswa WHERE NRP = $nrp LIMIT 1";
        // $query = $this->db->query($qry_inp);

        return $this->db
            ->table('rotasi')
            ->select('id_kelompok')
            ->join('kelompok', 'rotasi.id_kelompok = kelompok.id')
            ->where('nama', $nama)
            ->countAllResults() > 0;
    }
}
