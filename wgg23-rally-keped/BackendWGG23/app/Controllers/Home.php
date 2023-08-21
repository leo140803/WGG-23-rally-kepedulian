<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['faq'] = [
            [
                'question'  => 'Kapan informasi seputar dresscode, titik kumpul, jam masuk dan pulang, serta tata aturan lainnya disampaikan?',
                'answer'    => 'Informasi akan disampaikan secepatnya. Mahasiswa baru dapat mem-follow instagram <a href="https://www.instagram.com/wgg.pcu/" target="_blank">@wgg.pcu</a> untuk mendapatkan update terkait pengumuman informasi terbaru.'
            ],
            [
                'question'  => 'Kapan WGG Program Studi diadakan?',
                'answer'    => 'WGG Program Studi akan diadakan pada Senin, 24 Juli 2023 dan merupakan bagian dari rangkaian acara WGG.'
            ],
            [
                'question'  => 'Kapan mahasiswa baru menerima jas almamater dan perlengkapan penting lainnya?',
                'answer'    => 'Jas almamater dan perlengkapan mahasiswa baru akan dibagikan di Sarasehan Orang Tua dan Mahasiswa Baru pada tanggal 14 atau 15 Juli 2023 (sesuai jadwal fakultas masing-masing).'
            ],
            [
                'question'  => 'Apa yang perlu dipersiapkan sebelum mengikuti Sarasehan Orang Tua dan Mahasiswa Baru?',
                'answer'    => 'Tidak ada yang perlu dipersiapkan.'
            ],
            [
                'question'  => 'Apakah akan ada kegiatan mahasiswa baru pada tanggal  28 Juli - 6 Agustus 2023?',
                'answer'    => 'Tidak.'
            ],
        ];
        return view("home/info", $data);
        return view("home/soon");
        return redirect()->to("/login");
    }

    public function home()
    {
        if(session('isPanitia')){
            return redirect()->to("panitia");
        }
        echo "test";

        d($_SESSION);

        echo session()->getFlashdata('argument');
    }
    
    public function peserta()
    {
        $nrp = session('nrp');
        $lumi = "";
        if ( strtoupper(substr($nrp, 0, 1)) == "B" ){
            $lumi = "ftsp";
        }else if ( strtoupper(substr($nrp, 0, 1)) == "C" ){
            $lumi = "fti";
        }else if ( strtoupper(substr($nrp, 0, 1)) == "D" ){
            $lumi = "fbe";
        }else if ( strtoupper(substr($nrp, 0, 1)) == "G" ){
            $lumi = "fkip";
        }else if ( strtoupper(substr($nrp, 0, 1)) == "H" ){
            $lumi = "fhik";
        }
        $data['lumi'] = $lumi;

        return view("home/app", $data);
    }
}
