<?php

namespace App\Controllers;
use App\Models\MahasiswaModel;
use App\Models\QnA\PertanyaanPengaturanModel;
use App\Models\QnA\PertanyaanModel;

class PertanyaanPeserta extends BaseController
{
    private $nrp;
    private $mahasiswa;
    private $qna;
    private $pertanyaan_pengaturan;


    public function __construct()
    {
        $this->nrp = session()->get('nrp');
        // $this->nrp = array("H13230011","C14230052","C14230085","D11230387","B12230015")[rand(0, 4)];

        $this->qna = new PertanyaanModel;
        $this->pertanyaan_pengaturan = new PertanyaanPengaturanModel;
        $this->mahasiswa = new MahasiswaModel;
    }


    public function index()
    {
        $data['title'] = 'QnA';

        $data['data_maba'] = $this->mahasiswa
        ->select('nama, nrp')
        ->where('nrp', $this->nrp)
        ->first();

        $data['data_pertanyaan'] = $this->qna
        ->select('pertanyaan, created_at, is_anonym')
        ->where('nrp', $this->nrp)
        ->orderBy('created_at', 'DESC')
        ->findAll();

        $data['is_mobile'] = $this->request->getUserAgent()->isMobile();
        $data['pertanyaan_open'] = $this->pertanyaan_pengaturan
        ->select('is_open')
        ->where('id', 1)
        ->first();
        
        return view('QnA/pertanyaan_peserta', $data);
    }

    public function submit()
    {
        $cek_nrp = $this->mahasiswa->select('id')->where('nrp', $this->nrp)->first();
        $is_open = $this->pertanyaan_pengaturan
        ->select('is_open')
        ->where('id', 1)
        ->first();

        $success = false;
        if ($cek_nrp && $is_open)
        {
            $is_anonym = $this->request->getVar('anonym');
            $is_anonym = ($is_anonym == 'yes'); 
            $pertanyaan = $this->request->getVar('pertanyaan');

            $validate = [
                'pertanyaan' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'trim|required|min_length[10]|max_length[250]',
                    'errors' => [
                        'required' => '{field} wajib diisi.',
                        'min_length' => '{field} minimal 10 karakter.',
                        'max_length' => '{field} maksimal 250 karakter.'
                    ]
                ]
            ];

            if (!$this->validate($validate))
                return redirect()
                ->to(site_url('peserta/qna'))
                ->with('error_qna', $this->validator->getError('pertanyaan'))
                ->withInput();


            $insert_data = $this->qna->insert([
                'nrp' => $this->nrp,
                'pertanyaan' => $pertanyaan,
                'is_anonym' => $is_anonym
            ]);

            $insert_data = ($this->qna->db->affectedRows() > 0);

            if (!$insert_data)
                return redirect()
                ->to(site_url('peserta/qna'))
                ->with('error_qna', 'Terjadi kesalahan pada sistem, gagal menambahkan pertanyaan.')
                ->withInput();
            
            $success = true;
        }

        return redirect()->to(site_url('peserta/qna'))
        ->with('success_qna', $success);
    }
}