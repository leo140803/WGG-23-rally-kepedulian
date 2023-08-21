<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->
<?=$this->renderSection('css')?>

<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>

<!-- navbar -->
<?=$this->include('RBAC/rbac_navbar.php')?>

<?=$this->renderSection('content')?>

<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>