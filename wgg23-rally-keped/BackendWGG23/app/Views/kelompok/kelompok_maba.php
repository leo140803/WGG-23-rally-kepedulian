<?= $this->extend('layouts/main_layouts') ?>

<?= $this->section('css') ?>
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
    }

    .kotak {
        background-color: white;
        border-radius: 10px;
        height: 100%;
        width: 100%;
        max-width: 500px;
        margin-top: 30px;
    }

    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .nama {
        font-size: 20px;
    }

    .table-responsive table {
        width: 100%;
    }

    .table-responsive table td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        font-size: 20px;
    }


    .d-flex.justify-content-center ul li {
        font-size: 22px;
        font-weight: 700;
        line-height: .5;
    }

    .d-flex.justify-content-center .nama {
        text-align: center;
        font-size: 42px;
    }

    .d-flex.justify-content-center ul li {
        font-size: 22px;
        font-weight: 700;
        line-height: 1.2;
    }

    @media screen and (max-width: 480px) {
        .kotak {
            width: 90%;
            margin-top: 30px;
            max-width: 300px;
        }

        .nama {
            font-size: 28px;
        }

        .d-flex.justify-content-center ul li {
            font-size: 18px;
            line-height: 1.2;
            margin-bottom: 5px;
        }

        .d-flex.justify-content-center .nama {
            font-size: 32px;
        }

        .table-responsive table td {
            font-size: 16px;
        }
    }

    .frontline-list {
        padding-left: 1.5em;
    }

    .frontline-list li {
        list-style-type: circle;
        font-weight: normal;
    }
</style>
<?= $this->endsection() ?>

<?= $this->section('content') ?>

<?php 
    //data dummy
    // $namaKlmpk[0] = new stdClass;
    // $namaKlmpk[0]->nama = "ISD - 1";

    // $fl[0] = new stdClass;
    // $fl[0]->nama = "ANTHONY REYNALDI";
    // $fl[1] = new stdClass;
    // $fl[1]->nama = "ANDREAS PANDU";

    // $allData[0] = new stdClass;
    // $allData[0]->nrp = "C14210099";
    // $allData[0]->nama = "NICHOLAS GUNAWAN";
    // $allData[0]->jabatan = "";
    // $allData[1] = new stdClass;
    // $allData[1]->nrp = "C14210025";
    // $allData[1]->nama = "DARRELL CORNELIUS RIVALDO";
    // $allData[1]->jabatan = "";
    // $allData[2] = new stdClass;
    // $allData[2]->nrp = "C14210073";
    // $allData[2]->nama = "CHRISTOPHER JULIUS LIMANTORO";
    // $allData[2]->jabatan = "";
// dd($fl);
?>

<div class="container-fluid px-0">
    <div class="d-flex justify-content-center">
        <div class="kotak">

            <?php if (count($namaKlmpk) == 0) : ?>
                
                <div class="text-center alert alert-warning px-2 mx-2 mt-2">Anda Saat Ini Belum Memiliki Kelompok</div>

            <?php else : ?>

                <div class="d-flex justify-content-center">
                    <h1 class="nama">
                        <?php foreach ($namaKlmpk as $nama): ?>
                            <?= $nama->nama ?>
                        <?php endforeach; ?>
                    </h1>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <ul>
                            <li class="">Frontline :
                                <ul class="frontline-list">
                                    <?php foreach ($fl as $frontline): ?>
                                        <li <?php echo 'style="font-weight: normal;"' ?> class="mt-2 mb-0">
                                            <?= $frontline->nama ?>
                                        </li>
                                        <div class="fw-normal fs-6" style="margin-bottom: 10px;"><span class="fw-bold">Line ID</span> : <?= $frontline->id_line ?></div>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="mt-3 pt-1">Ruangan :
                                <?php foreach ($ruangan as $rg): ?>
                                    <?php if ($ruanganHidden == 1): ?>
                                        <?= $rg->ruangan ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <br>

                <div class="table-responsive">
                
                    <table class="table" id="anggota" class="w-100">
                        <thead class="bg-blue text-white">
                            <th>NRP</th>
                            <th>NAMA</th>
                        </thead>
                        <?php foreach ($allData as $data): ?>
                            <tr>
                                <td <?php if ($data->jabatan === 'ketua')
                                    echo 'style="color: red; white-space: nowrap;"';
                                else
                                    echo 'style="white-space: nowrap;"' ?>>
                                <?= $data->nrp ?>
                                </td>
                                <td <?php if ($data->jabatan === 'ketua')
                                    echo 'style="color: red; white-space: nowrap;"';
                                else
                                    echo 'style="white-space: nowrap;"' ?>>
                                <?= $data->nama ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                            <div class="text-center mt-3 mb-4" style="color: #FF0000;">
                                merah: Ketua Kelompok
                            </div>
            <?php endif ?>

        </div>
    </div>
</div>
<?= $this->endsection() ?>