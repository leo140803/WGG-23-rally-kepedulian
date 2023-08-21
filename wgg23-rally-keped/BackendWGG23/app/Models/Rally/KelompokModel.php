<?php

namespace App\Models\Rally;

use CodeIgniter\Model;

class KelompokModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelompok';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'ruangan', 'id_ketua', 'created_at', 'updated_at', 'deleted_at'];
    
    /**
      * Fungsi untuk mendapatkan id kelompok
      *
      * @param string $name
      * @return App\Models\KelompokModel
      */
    public function get_id($name) {
        return $this->select('id')->where('nama', $name)->findAll();
    }

    public function get_ketua() {
        return $this->select('nrp')->join('mahasiswa', 'mahasiswa.id = kelompok.id_ketua')->where('kelompok.id', session()->get('kelompok')['id_kelompok'])->first();
    }

    public function get_info_kelompok()
    {
        return $this->join('kelompok_rally', 'kelompok_rally.id_kelompok = kelompok.id')->findAll();
    }
}
