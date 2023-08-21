<?= $this->extend('layouts/base_layouts') ?>

<?= $this->section('css') ?>
<style>
    .bg-blue{
        background-color: #1e3258!important;
    }
    .bg-yellow{
        background-color: #f8ad3d!important;
    }
    .text-blue{
        color: #1e3258!important;
    }
    .text-yellow{
        color: #f8ad3d!important;
    }
</style>
<?= $this->endSection('css') ?>

<?= $this->section('base_content') ?>
<div id="layout-wrapper">

    <?=$this->include('layouts/header.php')?>

    <div class="main-content">
        <div class="page-content">
            <?=$this->renderSection('content')?>
        </div>

    </div>
</div>
<?= $this->endSection('base_content') ?>