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



<div class="container pt-4 pb-4 my-3">
<a class="btn btn-secondary px-4" href="<?=site_url("panitia/kelompok/main")?>"> Back </a>
<br>
<br>
    <div class="table-responsive">
        <table id="mahasiswa">
        
                        <thead>
                            <tr>
                                <th>NRP</th>
                                <th>Prodi</th>
                                <th>Kelompok</th>
        
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                foreach($data_mahasiswa as $mahasiswa):
                                ?>
        
                                <tr>
                                    <td><?=htmlspecialchars($mahasiswa->nrp)?> </td>
        
                                    <td><?=htmlspecialchars($mahasiswa->prodi)?> </td>
                                        <?php if($mahasiswa->id_kelompok != null):?>
                                            <td><?=htmlspecialchars($mahasiswa->nama_kelompok)?> </td>
                                         <?php else:?>
                                            <td>-</td>
                                          <?php endif?>
        
                                </tr>
                                <?php endforeach?>
        
        
                        </tbody>
        
                    </table>
    </div>
    
</div>




<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    
$(document).ready(function () {
    $('#mahasiswa').DataTable({
       
    });
});


</script>
<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>