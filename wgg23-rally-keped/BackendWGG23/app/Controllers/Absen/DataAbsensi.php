<?php

namespace App\Controllers\Absen;

use App\Controllers\BaseController;
use App\Models\Absen\AbsensiMabaModel;
use App\Models\Absen\AbsensiPanitiaModel;
use App\Models\Absen\KegiatanMabaModel;
use App\Models\Absen\KegiatanPanitiaModel;
use CodeIgniter\HTTP\ResponseInterface;

class DataAbsensi extends BaseController
{
    private $models, $absensiPesertaModel, $kegiatanPesertaModel;

    public function __construct()
    {
        $this->models['panitia'] = [
            new AbsensiPanitiaModel(),
            new KegiatanPanitiaModel(),
        ];
        $this->models['maba'] = [
            new AbsensiMabaModel(),
            new KegiatanMabaModel(),
        ];
    }

    private function setModels($tipePeserta) {
        [$this->absensiPesertaModel, $this->kegiatanPesertaModel] = $this->models[$tipePeserta];
    }

    public function index($tipePeserta, $idKegiatan)
    {
        $this->setModels($tipePeserta);
        $data['title'] = 'Data Absensi ' . (($tipePeserta === 'panitia') ? ucwords($tipePeserta) : ' Mahasiswa Baru');
        $data['kegiatan'] = $this->kegiatanPesertaModel
            ->select('id, nama')
            ->where('id', $idKegiatan)
            ->first();
        $data['tipePeserta'] = $tipePeserta;
        return view('absen/dataAbsensi', $data);
    }

    public function fetchDataAbsensi($tipePeserta, $idKegiatan)
    {
        $this->setModels($tipePeserta);
        if ($tipePeserta === 'panitia') {
            $response['data'] = $this->absensiPesertaModel
                ->select("ROW_NUMBER() OVER (ORDER BY p.id) AS rn, absen_panitia.id, absen_panitia.id_kegiatan, 
                        p.nama, p.nrp, p.divisi, absen_panitia.jam_regis_in, absen_panitia.jam_regis_out")
                ->join('panitia p', "absen_panitia.id_panitia = p.id AND absen_panitia.id_kegiatan = $idKegiatan", 'right')
                ->findAll();
        } else {
            $response['data'] = $this->absensiPesertaModel
                ->select("ROW_NUMBER() OVER (ORDER BY p.id) AS rn, absen_maba.id, absen_maba.id_kegiatan,
                        p.nama, p.nrp, k.nama AS kelompok, absen_maba.jam_regis_in, absen_maba.jam_regis_out")
                ->join('mahasiswa p', "absen_maba.id_maba = p.id AND absen_maba.id_kegiatan = $idKegiatan", 'right')
                ->join('kelompok k', 'p.id_kelompok = k.id', 'left')
                ->findAll();
        }
        
        return $this->response
            ->setStatusCode(ResponseInterface::HTTP_OK)
            ->setJSON($response);
    }

    public function customExport($tipePeserta, $idKegiatan)
    {
        $this->setModels($tipePeserta);
        $delimiter = ',';
        $filename = 'data-absensi.csv';
        $f = fopen('php://memory', 'w');
        $field = ['id', 'id_kegiatan', 'id_'.$tipePeserta];
        fputcsv($f, $field, $delimiter);

        $data = $this->absensiPesertaModel
            ->select('id, id_kegiatan, id_'.$tipePeserta)
            ->where('id_kegiatan', $idKegiatan)
            ->findAll();

        foreach ($data as $datum) {
            $record = [];
            foreach ($datum as $k => $v) {
                $record[] = $v;
            }
            fputcsv($f, $record, $delimiter);
        }

        
        header('Content-Type: application/csv');
        header("Content-Description: File Transfer"); 
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        fseek($f, 0); 
        fpassthru($f);
        fclose($f);
        exit;
        // return $this->response->download($f, null)
        //     ->setFileName('data-absensi.csv');
    }
}
