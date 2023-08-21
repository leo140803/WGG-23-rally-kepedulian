<?php

namespace App\Models\Rally;

use CodeIgniter\Model;

class KelompokRallyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelompok_rally';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kelompok', 'poin', 'created_at', 'updated_at', 'deleted_at'];

    public function add_point($id, $poin) {
        return $this->set('poin', 'poin+' . $poin, FALSE)->where('id_kelompok', $id)->update();
    }

    /**
      * Fungsi untuk mendapatkan poin kelompok
      *
      * @return App\Models\KelompokRallyModel
      */
    public function get_poin($id) {
        return $this->select('poin')->where('id_kelompok', $id)->get()->getResult()[0];
    }
}
