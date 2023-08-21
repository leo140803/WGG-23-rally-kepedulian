<?= $this->extend('layouts/base_layouts') ?>


<?php // css 
?>
<?= $this->section('css') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?= $this->renderSection('css') ?>

<?= $this->endSection('css') ?>


<?php // content 
?>
<?= $this->section('base_content') ?>

<nav class="navbar navbar-expand-lg bg-light mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= site_url('/panitia') ?>">
            <img src="<?= site_url('assets/images/wgg.png') ?>" width="auto" height="35" class="d-inline-block align-top" alt="">
            Panitia WGG 2023
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= (current_url() === site_url('panitia/absen')) ? 'active' : '' ?>" aria-current="page" href="<?= site_url('/panitia/absen') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (current_url() === site_url('panitia/absen/panitia/kegiatan')) ? 'active' : '' ?>" href="<?= site_url('/panitia/absen/panitia/kegiatan') ?>">Kegiatan Panitia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (current_url() === site_url('panitia/absen/maba/kegiatan')) ? 'active' : '' ?>" href="<?= site_url('/panitia/absen/maba/kegiatan') ?>">Kegiatan Mahasiswa Baru</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?= $this->renderSection('content') ?>

<?= $this->endSection('base_content') ?>


<?php // script 
?>
<?= $this->section('script') ?>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->renderSection('script') ?>

<?= $this->endSection('script') ?>