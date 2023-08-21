<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka One">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,700,1,200" />

<style>
    html, body{
        height: 100%;
    }
    .icon{
        font-size: 32px!important;
    }
    .min{
        min-width: 25%;
    }
    .bg-blue{
        background-color: #1e3258;
    }
    .maskot{
        width: 40%;
        height: auto;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translate(-50%);
    }
</style>
<style>
    .material-symbols-rounded {
        font-variation-settings:
        'FILL' 1,
        'wght' 700,
        'GRAD' 200,
        'opsz' 48
    }
</style>
<?= $this->endSection('css') ?>

<!-- body -->
<?= $this->section('base_content') ?>

<?php
// session()->set('nrp', 'C14200078')
?>

<nav class="navbar navbar-expand-lg bg-blue" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="">
            <h4 class=" text-white fw-bold">Lainnya</h4 class="nav-item" >
        </a>
    </div>
</nav>


<div class="container mt-3">
    <div class="row justify-content-start">
        <div class="col-3 text-center">
            <a href="<?= site_url('/peserta/qna') ?>" class="text-reset text-decoration-none icon-container">
                <div class="icon">
                    <span class="material-symbols-rounded icon">how_to_vote</span>
                </div>
                <p>QnA</p>
            </a>
        </div>
        
        <div class="col-3 text-center">
            <a href="<?= site_url('/peserta/briefing') ?>" class="text-reset text-decoration-none icon-container">
                <div class="icon">
                    <!-- <span class="material-symbols-rounded icon">how_to_vote</span> -->
                    <span class="material-symbols-rounded icon">interactive_space</span>
                </div>
                <p>Briefing</p>
            </a>
        </div>
        
        <div class="col-3 text-center">
            <a href="<?= site_url('/peserta/kelompok') ?>" class="text-reset text-decoration-none icon-container">
                <div class="icon">
                    <span class="material-symbols-rounded icon">groups</span>
                </div>
                <p>Kelompok</p>
            </a>
        </div>
        
        <div class="col-3 text-center">
            <a href="<?= site_url('/peserta/ijin') ?>" class="text-reset text-decoration-none icon-container">
                <div class="icon">
                    <span class="material-symbols-rounded icon">assignment_add</span>
                </div>
                <p>Izin</p>
            </a>
        </div>
        
        <div class="col-3 text-center">
            <a href="<?= site_url('/peserta/pelanggaran') ?>" class="text-reset text-decoration-none icon-container">
                <div class="icon">
                    <span class="material-symbols-rounded icon">assignment_late</span>
                </div>
                <p>Rekap</p>
            </a>
        </div>
        
        <div class="col-3 text-center">
            <a href="<?= site_url('/peserta/games') ?>" class="text-reset text-decoration-none icon-container">
                <div class="icon">
                    <span class="material-symbols-rounded">play_shapes</span>
                </div>
                <p>Games</p>
            </a>
        </div>
    </div>
</div>

<div class="text-center">
    <img src="<?= site_url('assets/images/lumi/' . $lumi . ".png") ?>" class="maskot">
</div>

<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>

<?= $this->endSection('script') ?>