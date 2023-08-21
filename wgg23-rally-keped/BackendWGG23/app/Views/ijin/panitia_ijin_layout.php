<?= $this->extend('layouts/base_layouts') ?>

<?= $this->section('css') ?>

<?= $this->include('layouts/datatable_css'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?= $this->renderSection('css') ?>

<?= $this->endSection('css') ?>

<?= $this->section('base_content') ?>

<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
      <a class="navbar-brand" href="<?= site_url('/panitia')?>">
        <img src="<?= site_url('assets/images/wgg.png')?>" width="auto" height="35" class="d-inline-block align-top" alt="">
        Panitia WGG 2023
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= site_url('panitia/ijin') ?>">Perizinan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= site_url('panitia/ijin/ubah') ?>">Tanggal Izin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?= $this->renderSection('base_content') ?>

<?= $this->endSection('base_content') ?>

<?= $this->section('script') ?>

<?= $this->include('layouts/datatable_script'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?= $this->renderSection('script') ?>

<?= $this->endSection('script') ?>