<?= $this->extend('layouts/base_layouts') ?>
<!-- css -->
<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->
<style>
    body{
        background-color: #F0EDD4;
       
    }
    .container{
        background-color: aliceblue;
        
    }

</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<?=$this->renderSection('css')?>
<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>
<?= $this->include('kelompok/kelompok_navbar.php'); ?>  

<?=$this->renderSection('content')?>
<?php

?>

<?php if (!$error): ?>
<div class="container my-3">
<h3 class="text-center"><?=htmlspecialchars($data_kelompok[0]->nama_kelompok)?></h3>
</div>

<div class="container pt-2 pb-4 my-3">
    <h5>Anggota Kelompok</h5>
    <div class="table-responsive">
        <table id="mahasiswa">
        
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>No HP</th>
                                <th>Posisi</th>
        
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                foreach($data_mahasiswa as $mahasiswa):
                                ?>
        
                                <tr>
                                    <td><?=htmlspecialchars($mahasiswa->nrp)?> </td>
                                    <td><?=htmlspecialchars($mahasiswa->nama)?> </td>
        
                                    <td><?=htmlspecialchars($mahasiswa->prodi)?> </td>
                                    <td><?=htmlspecialchars($mahasiswa->no_hp)?> </td>
                                    <td>
                                        <?php if($mahasiswa->id == $data_kelompok[0]->id_ketua):?>
                                            Ketua
                                         <?php else:?>
                                            Anggota
                                          <?php endif?>
                                     </td>
                                </tr>
                                <?php endforeach?>
        
        
                        </tbody>
        
                    </table>
    </div>
    
</div>


<div class="container pt-2 pb-4 my-3">
    <h5>Frontline</h5>
    <div class="table-responsive">
        <table id="frontline">
        
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Nama</th>
                                <th>No HP</th>
        
        
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                foreach($data_frontline as $frontline):
                                ?>
        
                                <tr>
                                    <td><?=htmlspecialchars($frontline->nrp)?> </td>
                                    <td><?=htmlspecialchars($frontline->nama)?> </td>
        
                                    <td><?=htmlspecialchars($frontline->telp)?> </td>
                                </tr>
                                <?php endforeach?>
        
        
                        </tbody>
        
                    </table>
    </div>
</div>
<div class="container pb-5" style="background-color:transparent !important ; padding:0;">
    <a class="btn btn-secondary px-4" href="<?=site_url("panitia/kelompok/main")?>"> Back </a>

</div>
<?php else: ?>
    <div class="text-center container"style="background-color:transparent !important ;">
    <h3>TIDAK DAPAT MENEMUKAN KELOMPOK</h3>
    <p>pastikan anda telah memiliki kelompok</p>
    <img src="https://i.kym-cdn.com/entries/icons/mobile/000/026/489/crying.jpg"  class="img-fluid"  alt="gagal">
    <div class="mb-4" >
    <a class="btn btn-secondary btn-lg my-3" href="<?=site_url("panitia/kelompok/main")?>"> Back </a>

    </div>

    
    </div>
    


<?php endif; ?>


<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    
$(document).ready(function () {
    $('#mahasiswa').DataTable({
        "searching": false,
        "paging" :false,
        "info":false,
    });
});


$(document).ready(function () {
    $('#frontline').DataTable({
        "searching": false,
        "paging" :false,
        "info":false,
    });
});
</script>
<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>