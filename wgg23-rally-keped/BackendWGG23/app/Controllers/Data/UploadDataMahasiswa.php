<?php

namespace App\Controllers\Data;

use App\Controllers\BaseController;
use App\Models\Log\LogMahasiswaModel;
use App\Models\MahasiswaModel;
use App\Models\PanitiaModel;

class UploadDataMahasiswa extends BaseController
{
    public function index()
    {
        $logMahasiswaModel = new LogMahasiswaModel();

        $data['rute'] = [];
        $data['logs'] = $logMahasiswaModel->findAll();
        return view('data/mahasiswa/upload', $data);
    }
    public function upload()
    {
        // dd($this->request->getFile('mahasiswa')->getMimeType());
        //validation image
        $validationRule = [
            'mahasiswa' => [
                'rules' => [
                    'uploaded[mahasiswa]',
                    'mime_in[mahasiswa,text/csv]',
                    'max_size[mahasiswa,2048]',  
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            return redirect()->back()->with("errors", $this->validator->getErrors());
        }
        
        //if validated then move image to folder
        $file = $this->request->getFile('mahasiswa');

        if (! $file->hasMoved()) {
            $foldername = "../data/mahasiswa";
            
            $filename = date("Y-m-d_Hms");
            $hash = $file->getRandomName();
            $hash = substr($hash, strpos($hash, "_"));
            
            $filename = $filename . $hash;
            
            $success = $file->move($foldername, $filename);
            
            //if success move save in database
            if($success){
                $result = $this->readFile($foldername . "/" . $filename);

                $result['nama_file'] = $filename;

                $log = $this->save_log($result);

                if(!$log){
                    return redirect()->back()->with("errors", ["mahasiswa" => "Failed to Save Log"]);
                }
                
                return redirect()->back()->with("success", true);
            }

            return redirect()->back()->with("errors", ["mahasiswa" => "Failed to Upload File"]);
            
        }
        
        return redirect()->back()->with("errors", ["mahasiswa" => "Something Went Wrong"]);
    }

    private function readFile($path){
        // 0 => string (2) "No"
        // 1 => string (3) "NIM"
        // 2 => string (4) "Nama"
        // 3 => string (7) "Jurusan"
        // 4 => string (7) "Kelamin"
        // 5 => string (9) "Asal Kota"
        // 6 => string (5) "Jaket"
        // 7 => string (4) "Muts"
        // 8 => string (5) "Agama"
        // 9 => string (8) "SMA Asal"
        // 10 => string (5) "Email"
        // 11 => string (2) "HP"
        // 12 => string (6) "PAC ID"
        // 13 => string (8) "PASS PAC"
        // 14 => string (10) "Dosen Wali"

        $bertambah = 0;
        $berkurang = 0;

        $mahasiswaModel = new MahasiswaModel();

        $deletedAwal = count($mahasiswaModel->onlyDeleted()->findAll());

        //delete all
        $mahasiswaModel->builder('mahasiswa')->update([
            'deleted_at' => date("Y-m-d H:m:s")
        ], "deleted_at IS NULL");

        $file = fopen($path, "r");
        $count = 0;

        while(! feof($file)){
            $row = fgetcsv($file);

            if($count < 3){         //ignore header
                $count += 1;
                continue;
            }
            if ($row){

                $count += 1;
                $data = [
                    'nrp' => $row[1],
                    'nama' => $row[2],
                    'prodi' => $row[3],
                    'jenis_kelamin' => $row[4],
                    'asal_kota' => $row[5],
                    'agama' => $row[8],
                    'sma_asal' => $row[9],
                    'no_hp' => $row[11],
                    'deleted_at' => null
                ];
                //check sudah ada blm
                $exist = $mahasiswaModel->withDeleted()->find($row[1]);

                if($exist){
                    $mahasiswaModel->update($row[1], $data);
                }else{
                    $mahasiswaModel->insert($data);
                    $bertambah += 1;
                }
            }
        }

        fclose($file);

        $deletedAkhir = count($mahasiswaModel->onlyDeleted()->findAll());
        $berkurang = $deletedAkhir - $deletedAwal;

        return ['bertambah' => $bertambah, 'berkurang' => $berkurang];
    }

    private function save_log($data)
    {
        $data['nrp_pengupdate'] = session('nrp');
        $logMahasiswaModel = new LogMahasiswaModel();
        return $logMahasiswaModel->save($data);
    }

    public function updateApp()
    {
        $mahasiswa = new MahasiswaModel();
        $res = $mahasiswa->select(['nrp','nama','IFNULL(id_kelompok,0) as idKelompok'])->findAll();

        // $mahasiswa = new PanitiaModel();
        // $res = $mahasiswa->select(['nrp','nama','1 as idKelompok'])->findAll();

        $app = json_encode($res);
        $email = ['email' => 'c14200078@john.petra.ac.id'];
        $email = json_encode($email);
        $curl = curl_init('https://wgg.petra.ac.id/app/backend2/api/v1/user/auth');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $email);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        $response = curl_exec($curl);
        curl_close($curl);
        $token = json_decode($response)->token;
        $curl = curl_init('https://wgg.petra.ac.id/app/backend2/api/v1/students/bulkInsert');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept: application/json','Content-type: application/json','Authorization: Bearer '.$token]);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $app);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $stat = curl_exec($curl);
        $http = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($http == 201){
            return redirect()->to('panitia/data/mahasiswa/upload')->with('success','Berhasil update data maba ke aplikasi!!');
        }else{
            return redirect()->to('panitia/data/mahasiswa/upload')->with('errors',['mahasiswa'=>'Gagal mengupdate data maba ke aplikasi!!']);
        }
    }
}
