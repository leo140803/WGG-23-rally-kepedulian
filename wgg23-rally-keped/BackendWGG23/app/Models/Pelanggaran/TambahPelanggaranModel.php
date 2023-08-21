<?php

namespace App\Models\Pelanggaran;

use CodeIgniter\Model;

class TambahPelanggaranModel extends Model
{
    protected $table            = 'pelanggaran';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nrp', 'keterangan', 'pasalTerlanggar', 'ayatTerlanggar', 'poin', 'tanggalMelanggar', 'id_perekap', 'idPasal'];
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;

    public function tampilkan_data()
    {
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->orderBy('id')
        // ->get()
        // ->getResult();
        ->findAll();
    }

    public function tambahPelanggaran($dataPelanggaran){
        return $this->insert($dataPelanggaran);
    }

    public function exist($nrp, $ayatID, $tanggalMelanggar){
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->where('nrp', $nrp)
        ->where('ayatTerlanggar', $ayatID)
        ->where('tanggalMelanggar', $tanggalMelanggar)
        // ->get()
        // ->getResult();
        ->findAll();
    }

    public function fetch_pelanggaran($nrp){
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->where('nrp', $nrp)
        ->orderBy('created_at', 'desc')
        // ->get()
        // ->getResult();
        ->findAll();
    }

    public function hapus_data($ID)
    {
        return $this
            ->where('id', $ID)
            ->delete();
    }

    public function edit_data($data)
    {
        return $this
            ->set([
                'poin' => $data['poin'],
                'pasalTerlanggar' => $data['Bab']
            ])
            ->where('pasalTerlanggar', $data['Bab'])
            ->update();
    }

    public function edit_data_ayat($data)
    {
        return $this
            ->set([
                'poin' => $data['poin'],
                'pasalTerlanggar' => $data['Bab'],
                'idPasal' => $data['idPasal']
            ])
            ->where('ayatTerlanggar', $data['ID'])
            ->update();
    }

    public function getPelanggaran(){
        return $this
        ->select('
                  pelanggaran.nrp, 
                  SUM(pelanggaran.poin) as "akumulasi", 
                  m.nama')
        ->join('mahasiswa m', 'm.nrp = pelanggaran.nrp')
        ->join('dataayat da', 'da.id = pelanggaran.ayatTerlanggar')
        ->join('datapasal dp', 'dp.id = da.idPasal')
        ->groupBy('pelanggaran.nrp, m.nama')
        ->findAll();
    }

    public function getPelanggaranDetail($nrp){
        return $this
        ->select('pelanggaran.keterangan as "keteranganPelanggaran", pelanggaran.nrp, pelanggaran.poin, 
                  pelanggaran.idPasal as "pelanggaran.IdPasal", pelanggaran.pasalTerlanggar,
                  pelanggaran.keterangan as "keteranganPelanggaran", pelanggaran.id,
                  pelanggaran.ayatTerlanggar, pelanggaran.tanggalMelanggar, pelanggaran.id_perekap,  
                  da.id as "idAyat", da.keterangan as "keteranganAyat", da.pasal,
                  dp.id as "idPasal", dp.keterangan as "keteranganPasal",
                  m.nama, m.nrp as "nrpMahasiswa",
                  p.nama as "namaPanitia" ')
        ->join('mahasiswa m', 'm.nrp = pelanggaran.nrp')
        ->join('panitia p', 'p.id = pelanggaran.id_perekap')
        ->join('dataayat da', 'da.id = pelanggaran.ayatTerlanggar')
        ->join('datapasal dp', 'dp.id = da.idPasal' )
        ->where('pelanggaran.nrp', $nrp)
        ->orderBy('pelanggaran.tanggalMelanggar', 'desc')
        ->findAll();
    }
}