<?= $this->extend('absen/absen_layout') ?>

<?= $this->section('css') ?>
<style>
    main {
        height: calc(100vh - 250px);
    }

    main .card {
        --bs-card-border-radius: 20px;
    }
</style>
<?= $this->endSection('css') ?>


<?= $this->section('content') ?>
<?php 
$url = current_url(True);
$tipeAbsen = $url->getSegment(4);
$tipeAbsen = explode('-', $tipeAbsen);
$tipeAbsen = join(' ', $tipeAbsen);
$tipeAbsen = ucwords($tipeAbsen);
?>
<main class="container d-flex justify-content-center align-items-center <?= ($tipePeserta === 'panitia') ? '' : 'pt-5' ?>">
    <section class="d-flex flex-column <?= ($tipePeserta === 'panitia') ? '' : 'pt-3' ?>">
        <h2 class="text-center mb-3"><?= $tipeAbsen ?> <?= ($tipePeserta === 'panitia') ? ucwords($tipePeserta) : 'Mahasiswa Baru' ?> WGG 2023</h2>
        <div class="card align-self-center" style="width: 30rem;">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-3"><?= $kegiatan['nama'] ?></h3>

                <?= form_open('', ['id' => 'absen', 'class' => 'mx-2']) ?>
                <div class="mb-3">
                    <label for="nrp" class="form-label">NRP</label>
                    <input type="text" class="form-control" name="nrp" id="nrp" autofocus="true" placeholder="Scan disini..." autocomplete="off">
                </div>
                <div class="mb-3">
                    <label class="form-label">NRP</label>
                    <input type="text" class="form-control" id="nrp-readonly" disabled readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name-readonly" disabled readonly>
                </div>
                <?php if ($tipePeserta === 'panitia'): ?>
                    <div class="mb-3">
                        <label class="form-label">Divisi</label>
                        <input type="text" class="form-control" id="divisi-readonly" disabled readonly>
                    </div>
                <?php else: ?>
                    <div class="mb-3">
                        <label class="form-label">Kelompok</label>
                        <input type="text" class="form-control" id="kelompok-readonly" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <input type="text" class="form-control" id="prodi-readonly" disabled readonly>
                    </div>
                <?php endif; ?>
                <button type="submit" style="display: none;"></button>
                <?= form_close() ?>

            </div>
        </div>
    </section>
    <section>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
        </div>
    </section>
</main>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
    $(document).ready(() => {
        $('#absen').submit(event => {
            event.preventDefault();
            const nrp = $('#nrp').val(); 
            const csrfToken = $(`input[name=<?= csrf_token() ?>]`).val();
            $.ajax({
                method: 'POST',
                data: {
                    nrp: nrp,
                    <?= csrf_token() ?>: csrfToken,
                }
            }).done(response => {
                createToast(
                    (response.isSuccess) ? 'success' : 'danger',
                    response.message
                );
                $(`input[name=<?= csrf_token() ?>]`).val(response.csrf);
                $('#nrp').val('');
                $('#nrp-readonly').val(response.nrp);
                $('#name-readonly').val(response.nama);
                if (response.tipePeserta === 'panitia') {
                    $('#divisi-readonly').val(response.divisi);
                } else {
                    $('#kelompok-readonly').val(response.kelompok);
                    $('#prodi-readonly').val(response.prodi);
                }
            }).fail((jqXHR, textStatus, errorThrown) => {
                createToast(
                    'danger',
                    jqXHR.responseJSON.message
                );
                $('#nrp').val('');
                $(`input[name=<?= csrf_token() ?>]`).val(jqXHR.responseJSON.csrf);
            });
                        
        });
        $('#liveToastBtn').click(() => {
            createToast('success', 'berhasil!');
        });
        
        $('.toast-container').on('hidden.bs.toast', '.toast', function() {
            $(this).remove();
        });
        
        function createToast(color, message) {
            $('.toast-container').append(`
            <div class="toast align-items-center text-bg-${color} border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2500">
                <div class="d-flex">
                    <div class="toast-body">
                      ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            `);
            $('.toast-container .toast:last-child').toast('show');
            if ($('.toast-container .toast').length > 4) {
                $('.toast-container .toast:first-child').toast('hide');
            }            
        }
    });
</script>
<?= $this->endSection('script') ?>