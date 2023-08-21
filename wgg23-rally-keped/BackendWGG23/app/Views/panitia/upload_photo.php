<?= $this->extend('panitia/home_layout'); ?>

<?= $this->section('css') ?>

<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<?= $this->include('panitia/panitia_navbar.php'); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <iframe src="https://drive.google.com/file/d/1arfVfVBcmj891I8z1uv3nrW4wxR5cK4O/preview" class="w-100" height="480" allow="autoplay"></iframe>

            <div class="my-5">
                <img id="preview" class="img-thumbnail" src="<?= $foto ?>"/>
                <div class="text-danger text-style-bold" id="note" style="display: none;">*Foto belum tersimpan</div>
            </div>

            <?php $success = session('success'); ?>
            <?php if(isset($success) && $success): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>Success Mengupload Foto</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php $errors = session('errors') ?>
            <?php if(isset($errors)): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div>Error: <?= $errors['photo'] ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(date("Y-m-d") <= "2023-05-31"): ?>
                <?= form_open_multipart("/panitia/photo", ["class" => "my-5"]) ?>
                    <label for="nama" class="form-label">Nama Lengkap (silahkan ditambahkan jika belum lengkap)</label>
                    <input type="text" class="form-control mb-3" name="nama" id="nama" value="<?= $nama ?>" placeholder="Nama Lengkap" required>
                
                    <div class="input-group mb-4">
                        <input type="file" accept="image/*" class="form-control" id="photo" name="photo" onchange="readURL(this)" required>
                        <button class="btn btn-outline-primary" type="submit" id="btn-sumbit">Submit</button>
                    </div>
                    <h5>Foto dapat diupload ulang selama periode pengumpulan</h5>
                <?= form_close() ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
                $('#preview').addClass("border border-3 border-danger");
                $("#note").show();
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection('script') ?>