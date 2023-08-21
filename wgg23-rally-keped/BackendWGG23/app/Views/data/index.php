<?= $this->extend('data/data_layout'); ?>

<?= $this->section('css') ?>

<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-6">

            <?php foreach($rute as $r): ?>
            <div class="card m-3">
                <div class="card-body">
                    
                    <span class="fw-bold h5 m-auto">
                        <?= $r['nama_route'] ?>
                    </span>

                    <a class="btn btn-primary float-end" href="<?= site_url(str_replace("\\", "", $r['route'],)) ?>">Access</a>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>

<?= $this->endSection('script') ?>