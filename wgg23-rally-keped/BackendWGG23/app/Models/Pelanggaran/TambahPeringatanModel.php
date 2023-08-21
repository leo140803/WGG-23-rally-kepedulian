<?php

namespace App\Models\Pelanggaran;

use CodeIgniter\Model;

class TambahPeringatanModel extends Model
{
    protected $table            = 'peringatan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id', 'nrp', 'keterangan', 'pasalTerlanggar', 'ayatTerlanggar', 'poin', 'tanggalMelanggar', 'id_perekap', 'idPasal'];
    protected $useSoftDeletes   = true;
    // Dates
    protected $useTimestamps = true;

    public function tambahPeringatan($dataPelanggaran){
        return $this->insert($dataPelanggaran);
    }

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

    public function fetch_peringatan($nrp){
        return $this
        // ->select('*')
        // ->db
        // ->table($this->table)
        ->where('nrp', $nrp)
        ->orderBy('created_at')
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

    public function getPeringatan(){
        return $this
        ->select('peringatan.keterangan as "keteranganPeringatan", peringatan.nrp, peringatan.poin, 
                  peringatan.idPasal as "peringatan.IdPasal", 
                  peringatan.ayatTerlanggar, peringatan.tanggalMelanggar, peringatan.id_perekap,  
                  da.id as "idAyat", da.keterangan as "keteranganAyat", da.pasal,
                  dp.id as "idPasal", dp.keterangan as "keteranganPasal",
                  m.nama ')
        ->join('mahasiswa m', 'm.nrp = peringatan.nrp')
        ->join('dataayat da', 'da.id = peringatan.ayatTerlanggar')
        ->join('datapasal dp', 'dp.id = da.idPasal' )
        ->orderBy('peringatan.tanggalMelanggar', 'desc')
        ->findAll();
    }

    public function getPeringatanDetail($nrp){
        return $this
        ->select('peringatan.keterangan as "keteranganPeringatan", peringatan.nrp, peringatan.poin, 
                  peringatan.idPasal as "peringatan.IdPasal", peringatan.pasalTerlanggar,
                  peringatan.keterangan as "keteranganperingatan", peringatan.id,
                  peringatan.ayatTerlanggar, peringatan.tanggalMelanggar, peringatan.id_perekap,  
                  da.id as "idAyat", da.keterangan as "keteranganAyat", da.pasal,
                  dp.id as "idPasal", dp.keterangan as "keteranganPasal",
                  m.nama, m.nrp as "nrpMahasiswa",
                  p.nama as "namaPanitia" ')
        ->join('mahasiswa m', 'm.nrp = peringatan.nrp')
        ->join('panitia p', 'p.id = peringatan.id_perekap')
        ->join('dataayat da', 'da.id = peringatan.ayatTerlanggar')
        ->join('datapasal dp', 'dp.id = da.idPasal' )
        ->where('peringatan.nrp', $nrp)
        ->orderBy('peringatan.tanggalMelanggar', 'desc')
        ->findAll();
    }
}
