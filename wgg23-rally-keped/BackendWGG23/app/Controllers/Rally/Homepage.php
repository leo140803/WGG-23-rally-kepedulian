<?php

namespace App\Controllers\Rally;

use App\Controllers\BaseController;
use App\Models\Kelompok\KelompokModel;
use App\Models\MahasiswaModel;

class Homepage extends BaseController
{
    protected $kelompok;
    protected $mhs;
    public function __construct()
    {
        $this->kelompok = new KelompokModel();
        $this->mhs = new MahasiswaModel();
    }

    public function index()
    {
        $kelompokId = $this->mhs->select('id_kelompok')->where('nrp', session()->get('nrp'))->first();
        $kelompokId = $kelompokId['id_kelompok'] ?? '';
        // $kelompokId = 1;

        $data['nama'] = $kelompokId != '' ? $this->kelompok->getNamaKelompok($kelompokId) : '-';
        // $data['nama'] = 'Kelompok Games';
        $data['title'] = 'Homepage';
        $ketua = $this->kelompok->join('mahasiswa','kelompok.id_ketua = mahasiswa.id')->where('mahasiswa.nrp',session()->get('nrp'))->first();
        $data['ketua'] = $ketua != null ? true : false;
        // $scene = session()->get('kelompok')['scene'] 
        $scene = 1;

        if ($scene == 1) {
            $data['storyline'][] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa odit dolorum et fugit sint soluta incidunt doloribus id ullam suscipit! Dolorum inventore optio consequuntur praesentium cupiditate iure facilis accusamus quam quibusdam fugit porro ab eaque consectetur aliquam ut ullam, quidem quas at harum, dicta quia beatae et. Molestias porro dolores excepturi minus veritatis numquam cupiditate autem, tempora quo? Dignissimos eius voluptatibus quaerat. Eaque labore, in facilis est dicta repellat quasi magnam doloremque adipisci harum corrupti laudantium tempore molestias, recusandae ipsum modi veritatis ullam necessitatibus. Dolor autem dolores neque facere ratione maxime ducimus tenetur, necessitatibus deleniti eaque quod libero? Cum, veritatis.";
            $data['storyline'][] = "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam, cupiditate";
            $data['storyline'][] = "orem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem provident veniam temporibus vel perferendis commodi iure recusandae, consequatur corrupti eos quos quia odio laudantium nemo optio, voluptatum neque sit harum exercitationem porro rem hic! Fugiat eos unde placeat suscipit in. Inventore, quos porro blanditiis impedit itaque ducimus reprehenderit illum iure tempore fugit quod repellendus voluptatem dicta natus. Quia maiores aspernatur veritatis deserunt minus dolore aliquid ipsam dignissimos aliquam nisi sequi odit nulla, placeat consectetur optio reprehenderit explicabo ab dolores quisquam earum nemo qui quos? Quae quas saepe unde consequuntur ducimus. Ut sint ipsa porro ipsam, nulla iste dolore laborum error?";
        } else if (session()->get('kelompok')['scene'] == 2) {
            $data['storyline'][] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque pariatur explicabo, recusandae laudantium consequuntur eligendi, sequi officiis aut voluptate quas expedita, et iusto minima atque ratione obcaecati qui. Porro voluptatem odit molestiae pariatur nobis odio excepturi, quia magni beatae eum iure laudantium? Quaerat voluptates perferendis voluptate officia deleniti repudiandae ad.";
            $data['storyline'][] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, odio.";
            $data['storyline'][] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore nemo, ab et ullam consequuntur magni iure cumque obcaecati tenetur eius porro quos consequatur numquam eaque, placeat voluptatum. Esse mollitia omnis necessitatibus accusamus sequi fugit inventore, incidunt nemo optio eum cumque? Assumenda, corporis provident quam saepe maiores dolor error? Nobis.";
        } else if (session()->get('kelompok')['scene'] == 3) {
            $data['storyline'][] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem est tenetur doloremque quas aliquam explicabo, atque magnam earum cumque tempore soluta reprehenderit a similique impedit.";
            $data['storyline'][] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, odio.";
            $data['storyline'][] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem est tenetur doloremque quas aliquam explicabo, atque magnam earum cumque tempore soluta reprehenderit a similique impedit.";
        }

        return view('rally/homepage', $data);
    }
}
