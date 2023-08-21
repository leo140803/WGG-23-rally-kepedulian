<?= $this->extend('absen/absen_layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    main>section.form-create-kegiatan {
        max-width: 600px;
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

<main class="container-fluid px-lg-5 px-md-4">
    <div class="mb-4">
        <h1 class="text-center">Kegiatan <?= ($tipePeserta === 'panitia')? ucwords($tipePeserta) : 'Mahasiswa Baru' ?></h1>
        <hr class="">
    </div>
    <section class="m-auto form-create-kegiatan">

        <?= form_open(site_url("panitia/absen/$tipePeserta/kegiatan"), ['class' => 'text-center', 'method' => 'POST']) ?>
        <div class="mb-3">
            <label for="nama-kegiatan" class="form-label">Nama Kegiatan <?= ($tipePeserta === 'panitia')? ucwords($tipePeserta) : 'Mahasiswa Baru' ?></label>
            <input type="text" name="nama-kegiatan" id="nama-kegiatan" class="form-control text-center" value="<?= old('nama-kegiatan') ?>" autocomplete="off">
            <div class="text-danger">
                <?php if (session()->has($errorKey) && array_key_exists('nama-kegiatan', $errors)) : ?>
                    <?= $errors['nama-kegiatan']; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Tanggal</label>
            <div class="input-group date" id="datepicker">
                <input type="text" class="form-control text-center ps-5" id="date" name="tanggal" value="<?= old('tanggal') ?>" autocomplete="off" />
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
                <input type="time" name="start-regis-in" id="start-regis-in" class="form-control text-center" value="<?= old('start-regis-in') ?>">
                <span class="input-group-text">-</span>
                <input type="time" name="end-regis-in" id="end-regis-in" class="form-control text-center" value="<?= old('end-regis-in') ?>">
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
                <input type="time" name="start-regis-out" id="start-regis-out" class="form-control text-center" value="<?= old('start-regis-out') ?>">
                <span class="input-group-text">-</span>
                <input type="time" name="end-regis-out" id="end-regis-out" class="form-control text-center" value="<?= old('end-regis-out') ?>">
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
        <button type="submit" class="btn btn-primary my-4">TAMBAH</button>
        <?= form_close() ?>

    </section>
    <hr>
    <section class="my-4">
        <div class="table-responsive" style="min-height: 240px;">
            <table class="table text-center dataTable no-footer" id="list-kegiatan">
                <thead class="text-center">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Kegiatan <?= ucwords($tipePeserta) ?></th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Regis-in</th>
                        <th class="text-center">Regis-out</th>
                        <th class="text-center">View</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listKegiatan as $i => $kegiatan) : ?>
                        <tr>
                            <td class="align-middle"><?= $i + 1 ?></td>
                            <td class="align-middle"><?= $kegiatan['nama'] ?></td>
                            <td class="align-middle"><?= $kegiatan['tanggal'] ?></td>
                            <td class="align-middle"><?= $kegiatan['start_regis_in'] ?></td>
                            <td class="align-middle"><?= $kegiatan['start_regis_out'] ?></td>
                            <td class="align-middle">
                                <div class="btn-group dropdown-center">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        VIEW
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= site_url("panitia/absen/$tipePeserta/regis-in/" . $kegiatan['id']) ?>">Regis-In</a></li>
                                        <li><a class="dropdown-item" href="<?= site_url("panitia/absen/$tipePeserta/regis-out/" . $kegiatan['id']) ?>">Regis-Out</a></li>
                                        <li><a class="dropdown-item" href="<?= site_url("panitia/absen/$tipePeserta/dataAbsensi/" . $kegiatan['id']) ?>">Data Absensi</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="id[]" value="">
                            </td>
                            <td class="align-middle">
                                <a href="<?= site_url("panitia/absen/$tipePeserta/kegiatan/" . $kegiatan['id']) ?>" class="text-dark text-decoration-none w-100 h-100">
                                    <button class="btn btn-warning">
                                        EDIT
                                    </button>
                                </a>
                            </td>
                            <td class="align-middle">
                                <button class="btn btn-danger delete" data-nama="<?= $kegiatan['nama'] ?>">DELETE</button>
                                <?= form_open(
                                    site_url("panitia/absen/$tipePeserta/kegiatan/" . $kegiatan['id']),
                                    ['method' => 'POST']
                                ) ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <?= form_close() ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            clearBtn: true,
            daysOfWeekDisabled: '0',
            autoclose: true,
            todayHighlight: true,
        });

        $('#list-kegiatan').DataTable({
            columnDefs: [{
                target: [5, 6, 7],
                orderable: false,
            }],
        });

        $('#list-kegiatan').on('click', '.delete', async function() {
            const namaKegiatan = $(this).data('nama');

            const deleteConfirmation = await Swal.fire({
                title: `Yakin untuk delete kegiatan ${namaKegiatan}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Delete'
            });

            if (!deleteConfirmation.isConfirmed) return;

            $(this).siblings('form').submit();
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