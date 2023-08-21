<?= $this->extend('layouts/main_layouts') ?>

<?= $this->section('css')?>

<?= $this->endsection()?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-1"></div>
            <div class="col-10">
                <h3 class="text-danger text-center mb-5">Tidak bisa mengakses Web Games selain menggunakan <b>Desktop</b></h3>
                <h4 class="text-center">Rekomendasi screen beratio <b>16:9</b> dengan minimum lebar <b>1024px</b>.</h4>
            </div>
        </div>
    </div>
<?= $this->endsection() ?>