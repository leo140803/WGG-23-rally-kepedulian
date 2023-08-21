<?php

namespace App\Models\Kelompok;

use CodeIgniter\Model;

class KelompokModel extends Model
{
    protected $table = 'kelompok';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $protectFields = true;
    protected $allowedFields = ['ruangan'];
    protected $useSoftDeletes = true;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';



    public function getHiddenValue()
    {
        $result = $this->db->table('kelompok_statusRuangan')->get()->getRow();
        return $result->hidden;
    }

    public function updateHiddenValue($value)
    {
        $this->db->table('kelompok_statusRuangan')->update(['hidden' => $value], ['id' => 0]);
    }

    public function getData($nrp)
    {
        $subquery = $this->db->table('mahasiswa m')
            ->select('id_kelompok')
            ->where('nrp', $nrp);

        $builder = $this->db->table('mahasiswa m');
        $builder->select("m.nama, m.nrp, CASE WHEN k.nama IS NOT NULL THEN 'ketua' ELSE 'anggota' END AS jabatan");
        $builder->join('kelompok k', 'm.id = k.id_ketua', 'left');
        $builder->whereIn('id_kelompok', $subquery);
        $builder->orderBy('k.id', 'desc');

        $query = $builder->get();
        return $query->getResult();
    }

    public function getKelompok($nrp)
    {
        $builder = $this->db->table('mahasiswa m');
        $builder->select('k.nama');
        $builder->join('kelompok k', 'm.id_kelompok = k.id');
        $builder->where('m.nrp', $nrp);

        return $builder->get()->getResult();
    }
    public function getNamaKelompok($id)
    {
        $builder = $this->db->table('kelompok k');
        $builder->select('k.nama');
        $builder->where('k.id', $id);


        $result = $builder->get()->getResult();
        return $result[0]->nama;
    }
}