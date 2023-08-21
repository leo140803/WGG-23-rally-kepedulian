<?= $this->extend('layouts/base_layouts') ?>
<!-- css -->
<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->
<style>
    body{
        background-color: #F0EDD4;
       
    }

</style>

<?=$this->renderSection('css')?>
<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>
<?= $this->include('kelompok/kelompok_navbar.php'); ?>  

<?=$this->renderSection('content')?>
<?= $this->endSection('base_content') ?>
<?=form_open()?>

<?= form_close()?>

<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>