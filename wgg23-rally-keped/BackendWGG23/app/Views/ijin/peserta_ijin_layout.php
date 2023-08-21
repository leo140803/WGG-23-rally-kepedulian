<?= $this->extend('layouts/main_layouts') ?>

<?= $this->section('css') ?>

<?= $this->include('layouts/datatable_css.php') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?= $this->renderSection('css') ?>

<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<?= $this->renderSection('content') ?>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>

<?= $this->include('layouts/datatable_script.php') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?= $this->renderSection('script') ?>

<?= $this->endSection('script') ?>