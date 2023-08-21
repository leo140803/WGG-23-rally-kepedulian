<?php

namespace App\Models\DataPoli;

use CodeIgniter\Database\Database;
use CodeIgniter\Model;

class PoliModel extends Model
{
    protected $table            = 'absen_poli';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nrp', 'nama', 'tanggal', 'jam_masuk', 'jam_keluar', 'deskripsi', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    protected $useSoftDeletes = true;


    //TAMPIL DATA
    public function tampilkan_data()
    {
        //SELECT * FROM 'data_kunjungan'
        return $this
            ->db
            ->table($this->table)
            ->where('deleted_at', null)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResult();
    }



    //TAMBAH DATA
    public function tambah_data($data)
    {
        return $this->insert($data);
    }




    //CARI NAMA DI DATABASE
    public function fill_nama($nrp)
    {
        // $qry_inp =  "SELECT nama FROM mahasiswa WHERE NRP = $nrp LIMIT 1";
        // $query = $this->db->query($qry_inp);

        return $this->db
            ->table('mahasiswa')
            ->select('nama')
            ->where('nrp', $nrp)
            ->limit(1)
            ->get()
            ->getRow();
    }




    //UNTUK UPDATE DATA
    public function fetch_data($id)
    {
        return $this
            ->where('id', $id)
            ->first();
    }


    public function edit_data($data)
    {
        return $this
            ->set([
                'deskripsi' => $data['deskripsi'],
                'status' => $data['status'],
                'tanggal' => $data['tanggal'],
                'jam_masuk' => $data['jam_masuk'],
                'jam_keluar' => $data['jam_keluar']
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




    //TOMBOL ABSEN KELUAR
    public function absen_keluar($id, $mytime)
    {
        return $this
            ->set([
                'jam_keluar' => $mytime
            ])
            ->where('id', $id)
            ->update();
    }



    public function out_poli($nrp, $mytime)
    {
        $builder = $this->db->table('absen_poli');
        $builder->select('id')
            ->where('nrp', $nrp)
            ->orderBy('created_at', 'DESC')
            ->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $id = $result->id;
            return $this
                ->set([
                    'jam_keluar' => $mytime
                ])
                ->where('id', $id)
                ->update();
        }
    }


    public function redir_to_update($nrp)
    {
        $builder = $this->db->table('absen_poli');
        $builder->select('id, nrp, created_at')
            ->where('nrp', $nrp)
            ->orderBy('created_at', 'DESC')
            ->limit(1);
        $query = $builder->get();
        $result = $query->getRow();

        if ($result) {
            $id = $result->id;

            return $id;
        }
    }


}
