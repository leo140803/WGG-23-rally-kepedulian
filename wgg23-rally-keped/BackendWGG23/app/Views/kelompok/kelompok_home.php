<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<style>
    body{
        background-color: #F0EDD4;
       
    }

    .tb_kelompok{
        background-color: aliceblue;
        margin-left:auto;
        margin-right: auto;
        width: 80vw;
        padding: 30px 20px ;

    }
</style>

<?=$this->renderSection('css')?>
<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>
<!-- isi body di sini -->
<?= $this->include('kelompok/kelompok_navbar.php'); ?>

<?php if(session()->has('msg_success')):?>
<script>
    Swal.fire({
    icon: 'success',
    title: '<?=session()->getFlashdata('msg_success')?>',
    })
</script>

<?php elseif(session()->has('msg_error')): ?>
<script>
    Swal.fire({
    icon: 'error',
    title: '<?=session()->getFlashdata('msg_error')?>',
  
    })
</script>
<?php endif ?>
    

    <div class="tb_kelompok">
    <a class="btn btn-primary" href="<?=site_url("panitia/kelompok/tambah")?>">Tambah </a>
    <a class="btn btn-success" href="<?=site_url("panitia/kelompok/myteam")?>">Kelompok Saya</a>
    <a class="btn btn-warning" href="<?=site_url("panitia/kelompok/list")?>">List Mahasiswa</a>
    <br>
    <br>

    <table id="example">
    
                    <thead>
                        <tr>
                            <th>Kelompok</th>
                            <th>Ketua</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                
                            foreach($data_kelompok as $kelompok):
                            ?>

                            <tr>
                                <!-- $admin['username'] ini kalo type data array -->
                                <td><?=htmlspecialchars($kelompok->nama_kelompok)?> </td> 
                                <?php if($kelompok->ketua == null):?>
                                    <td>-</td>
                                <?php else:?>
                                     <td><?=htmlspecialchars($kelompok->ketua)?> </td>
                                 <?php endif?>

                                <td>
                                    

                                    
                                    <?= form_open("panitia/kelompok/hapus") ?>
                                        <input type="hidden" name="id_kelompok_delete" value="<?=htmlspecialchars($kelompok->id)?>">
                                        <input type="hidden" name="_method" value="DELETE">
                                    
                                        <a href="<?=site_url('panitia/kelompok/sunting/'.$kelompok->id)?>" class="btn btn-secondary btn-sm">Edit</a> 
                                        <a id="<?=$kelompok->id?>" class="btn btn-danger btn-sm hapus_btn">Hapus</a> 
                                        <button type="submit" id="deleted_<?=$kelompok->id?>" style="display: none;" name="sum" value="ya"></button> 
                                    <?= form_close() ?>
                                    
                                 </td>
                            </tr>

                                        
                            <?php endforeach ?>
                        
                    </tbody>
                    
                </table>
                </div>


<?=$this->renderSection('content')?>

<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>

<!-- Swal -->
<script>
    $(document).ready(function(){
        $('.hapus_btn').click(function(e) {
            // Form submission logic here
            e.preventDefault();
            var ambilAttribute = $(this).attr('id')
            Swal.fire({
                title: 'Yakin Menghapus Kelompok?',
                text: "Kelompok yang terhapus tidak dapat dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Kelompok'
                }).then((result) => {
                    if (result.isConfirmed) {
                     
                        $('#deleted_'+ambilAttribute).click();

                    }
                })
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>