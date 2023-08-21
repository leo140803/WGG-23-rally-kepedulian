<?php

namespace App\Models\Pelanggaran;

use CodeIgniter\Model;

class PesertaViewModel extends Model
{
    protected $table            = 'pelanggaran';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nrp', 'keterangan', 'pasalTerlanggar', 'ayatTerlanggar', 'poin', 'tanggalMelanggar', 'id_perekap', 'idPasal'];
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;

    public function getPelanggaran($nrp){
        return $this
        ->select('pelanggaran.keterangan as "keteranganPelanggaran", pelanggaran.nrp, pelanggaran.poin, pelanggaran.idPasal as "pelanggaranIdPasal", pelanggaran.ayatTerlanggar, pelanggaran.tanggalMelanggar,  
                  da.id as "idAyat", da.keterangan as "keteranganAyat", da.pasal,
                  dp.id as "idPasal", dp.keterangan as "keteranganPasal" ')
        ->join('mahasiswa m', 'm.nrp = pelanggaran.nrp')
        ->join('dataayat da', 'da.id = pelanggaran.ayatTerlanggar')
        ->join('datapasal dp', 'dp.id = da.idPasal' )
        ->where('pelanggaran.nrp', $nrp)
        ->orderBy('pelanggaran.tanggalMelanggar', 'desc')
        ->findAll();
    }
}
