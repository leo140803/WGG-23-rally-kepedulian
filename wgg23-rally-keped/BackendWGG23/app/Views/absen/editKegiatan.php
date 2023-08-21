<?= $this->extend('absen/absen_layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    section > form {
        max-width: 700px;
    }
</style>
<?= $this->endSection('css') ?>


<?= $this->section('content') ?>
<?php 
$errorKey = '_ci_validation_errors';

if (session()->has($errorKey)) {
    $errors = unserialize(session()->get($errorKey));
}
?>
<main class="container">
    <h1 class="text-center mb-5">Edit Kegiatan <?= ucwords($tipePeserta) ?></h1>
    <section class="">
    <?= form_open('', ['class' => 'mx-auto text-center', 'method' => 'POST']) ?>
        <div class="mb-3">
            <label for="nama-kegiatan" class="form-label">Nama Kegiatan <?= ucwords($tipePeserta) ?></label>
            <input type="text" name="nama-kegiatan" id="nama-kegiatan" class="form-control text-center" value="<?= old('nama-kegiatan') ?? $kegiatan['nama'] ?>" autocomplete="off">
            <div class="text-danger">
                <?php if (session()->has($errorKey) && array_key_exists('nama-kegiatan', $errors)) : ?>
                    <?= $errors['nama-kegiatan']; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <div class="input-group date" id="datepicker">
                <input type="text" class="form-control text-center ps-5" id="date" name="tanggal" value="<?= old('tanggal') ?? $kegiatan['tanggal'] ?>" autocomplete="off" />
                <span class="input-group-append">
                    <span class="input-group-text bg-light d-block">
                        <i class="fa fa-calendar"></i>
                    </span>
                </span>
            </div>
            <div class="text-danger">
                <?php if (session()->has($errorKey) && array_key_exists('tanggal', $errors)) : ?>
                    <?= $errors['tanggal'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Waktu Regis In</label>
            <div class="input-group">
                <input type="time" name="start-regis-in" id="start-regis-in" class="form-control text-center" value="<?= old('start-regis-in') ?? $kegiatan['start_regis_in'] ?>">
                <span class="input-group-text">-</span>
                <input type="time" name="end-regis-in" id="end-regis-in" class="form-control text-center" value="<?= old('end-regis-in') ?? $kegiatan['end_regis_in'] ?>">
            </div>
            <div class="text-danger">
                <?php if (session()->has($errorKey)) : ?>
                    <?php if (array_key_exists('start-regis-in', $errors)) : ?>
                        <?= $errors['start-regis-in']; ?>
                        <?php if (array_key_exists('end-regis-in', $errors)) : ?>
                            <br>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (array_key_exists('end-regis-in', $errors)) : ?>
                        <?= $errors['end-regis-in'] ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="">
            <label for="" class="form-label">Waktu Regis Out</label>
            <div class="input-group">
                <input type="time" name="start-regis-out" id="start-regis-out" class="form-control text-center" value="<?= old('start-regis-out') ?? $kegiatan['start_regis_out'] ?>">
                <span class="input-group-text">-</span>
                <input type="time" name="end-regis-out" id="end-regis-out" class="form-control text-center" value="<?= old('end-regis-out') ?? $kegiatan['end_regis_out'] ?>">
            </div>
            <div class="text-danger">
                <?php if (session()->has($errorKey)) : ?>
                    <?php if (array_key_exists('start-regis-out', $errors)) : ?>
                        <?= $errors['start-regis-out']; ?>
                        <?php if (array_key_exists('end-regis-out', $errors)) : ?>
                            <br>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (array_key_exists('end-regis-out', $errors)) : ?>
                        <?= $errors['end-regis-out'] ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <div class="my-4 px-sm-4">
            <div class="d-flex justify-content-around px-sm-5 mx-sm-5">
                <button type="submit" class="btn btn-success">EDIT</button>
                <button class="btn btn-outline-danger"><a href="<?= site_url("panitia/absen/$tipePeserta/kegiatan") ?>" class="text-decoration-none text-danger">CANCEL</a></button>
            </div>
        </div>
        <?= form_close() ?>
    </section>
</main>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(() => {
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            clearBtn: true,
            daysOfWeekDisabled: '0',
            autoclose: true,
            todayHighlight: true,
        });

        <?php if (session()->has('response')) : ?>
            <?php $response = session()->get('response'); ?>
            Swal.fire({
                icon: '<?= ($response['isSuccess']) ? 'success' : 'error' ?>',
                title: '<?= ($response['isSuccess']) ? 'Yay...' : 'Oops...' ?>',
                text: '<?= $response['message'] ?>'
            });
        <?php endif; ?>

    });
</script>
<?= $this->endSection('script') ?>