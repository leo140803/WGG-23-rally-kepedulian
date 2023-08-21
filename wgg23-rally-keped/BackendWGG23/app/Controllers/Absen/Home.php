<?php

namespace App\Controllers\Absen;

use App\Controllers\BaseController;
use App\Models\Absen\KegiatanPanitiaModel;

class Home extends BaseController
{
    public function index()
    {
        $now = date('Y-m-d');
        $db = (new KegiatanPanitiaModel())->db;

        $data['title'] = 'Absen';

        $kegiatanPanitia = $db->table('absen_kegiatan_panitia')
            ->select("*, 'Panitia' AS peserta");
        $kegiatanMahasiswa = $db->table('absen_kegiatan_maba')
            ->select("*, 'Mahasiswa Baru' AS peserta");
        $union = $kegiatanPanitia->union($kegiatanMahasiswa);
        
        $data['listKegiatan'] = $db->newQuery()
            ->fromSubquery($union, 'union')
            ->where('tanggal >=', $now)
            ->where('deleted_at IS NULL', null, false)
            ->orderBy('tanggal', 'ASC')
            ->orderBy('start_regis_in', 'ASC')
            ->get();

        $data['listKegiatanSelesai'] = $db->newQuery()
            ->fromSubquery($union, 'union')
            ->where('tanggal <', $now)
            ->where('deleted_at IS NULL', null, false)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('start_regis_in', 'DESC')
            ->get();
        return view('absen/home', $data);
    }
}
