<?php

namespace App\Models\Pelanggaran;

use CodeIgniter\Model;

class TambahPasalModel extends Model
{
    protected $table            = 'datapasal';
    protected $primaryKey       = 'Bab';
    protected $returnType       = 'object';
    protected $allowedFields    = ['Bab', 'Keterangan', 'JumlahPoin'];
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;


    public function tambahPasal($dataPasal){
        return $this->insert($dataPasal);
    }

    // public function tampilkan_data()
    // {
    //     return $this
    //     ->select('*')
    //     ->db
    //     ->table($this->table)
    //     ->orderBy('Bab')
    //     ->get()
    //     ->getResult();
    // }

    public function tampilkan_data()
    {
        return $this
        ->orderBy('Bab')
        ->findAll();
    }

    public function tampilkan_data_deleted()
    {
        return $this
        ->withDeleted()
        ->findAll();
    }

    public function hapus_data($ID)
    {
        return $this
            ->where('id', $ID)
            ->delete();
    }

    public function fetch_data($ID){
        return $this
        ->where('Bab', $ID)
        ->first();
    }

    public function edit_data($data)
    {
        return $this
            ->set([
                'Bab' => $data['Bab'],
                'Keterangan' => $data['Keterangan'],
                // 'No' => $data['No']
                'JumlahPoin' => $data['poin']
            ])
            ->where('Bab', $data['Bab'])
            ->update();
    }

    public function fetch_poin($ID){
        return $this
        ->where('id', $ID)
        ->first();
    }

    public function exist($bab){
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->where('Bab', $bab)
        // ->get()
        // ->getResult();
        ->findAll();
    }
}
