<?php 
namespace App\Models\Kelompok;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_kelompok', 'nrp', 'nama'];

    public function getJumlahMahasiswaPerKelompok()
    {
        return $this->select('kelompok.nama AS nama_kelompok, COUNT(*) AS jumlah_mahasiswa')
            ->join('kelompok', 'mahasiswa.id_kelompok = kelompok.id')
            ->groupBy('kelompok.nama')
            ->findAll();
    }
}