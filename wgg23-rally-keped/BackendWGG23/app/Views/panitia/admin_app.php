<?= $this->extend('panitia/home_layout'); ?>

<?= $this->section('css') ?>

<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            
            <?= form_open_multipart("https://wgg.petra.ac.id/app/admin/authenticate", ["class" => "my-5"]) ?>
                <label for="nama" class="form-label">Sistem akan secara otomatis me-redirect ke halaman admin aplikasi </label>
                <label for="nama" class="form-label">Jika tidak terjadi apa-apa silahkan klik tombol dibawah ini</label>
                <input type="hidden" class="form-control mb-3" name="nrp" id="nrp" value="<?= session('nrp') ?>">
                
                <input type="hidden" class="form-control mb-3" name="token" id="token" value="<?= $token ?>">
                <br>
            
                <button class="btn btn-outline-primary" type="submit" id="btn-sumbit">Akses</button>
            <?= form_close() ?>
            

        </div>
    </div>
</div>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(function(){
        $("form").submit();
    });
</script>

<?= $this->endSection('script') ?>