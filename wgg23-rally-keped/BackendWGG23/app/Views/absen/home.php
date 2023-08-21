<?= $this->extend('absen/absen_layout') ?>


<?= $this->section('css') ?>
<style>
    main {
        display: grid;
        grid-template-columns: 12fr 1px 5fr;
        min-height: calc(100vh - 109px);
    }

    .bi.bi-dot::before {
        scale: 2.5;
    }

    .time span {
        display: inline-block;
        width: 72px;
    }

    @media screen and (max-width: 1200px) {
        main {
            grid-template-columns: 3fr 1px 2fr;
        }
    }

    @media screen and (max-width: 768px) {
        main {
            grid-template-columns: initial;
        }
    }
</style>
<?= $this->endSection('css') ?>


<?= $this->section('content') ?>

<main class="container-fluid">
    <section class="h-100 px-xl-5 px-sm-4 px-2">
        <h2 class="mb-3">Upcoming & Ongoing</h2>
        <div class="d-flex flex-column justify-content-between pb-0 pb-md-1">
            <div class="row g-4">
                <?php foreach ($listKegiatan->getResult() as $kegiatan) : ?>
                    <div class="col-xl-6">
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="lh-sm"><?= $kegiatan->peserta ?></div>
                                <h4 class="card-title mx-1"><?= $kegiatan->nama ?></h4>
                                <div>
                                    <?php
                                    $date = DateTime::createFromFormat('Y-m-d', $kegiatan->tanggal);
                                    date_default_timezone_set('Asia/Jakarta');
                                    $now = new DateTime();
                                    $startKegiatan = Datetime::createFromFormat(
                                        'Y-m-d H:i:s',
                                        $kegiatan->tanggal . ' ' . $kegiatan->start_regis_in
                                    );
                                    $endKegiatan = Datetime::createFromFormat(
                                        'Y-m-d H:i:s',
                                        $kegiatan->tanggal . ' ' . $kegiatan->end_regis_out
                                    );
                                    if ($now < $startKegiatan) {
                                        $color = 'warning';
                                    } else if ($now < $endKegiatan) {
                                        $color = 'success';
                                    } else {
                                        $color = 'danger';
                                    }
                                    ?>
                                    <i class="bi bi-dot text-<?= $color ?>"></i> <span><?= $date->format('l, j F Y') ?></span>
                                </div>
                                <div class="card-text mx-4 px-2 mb-1">
                                    <?php $regisIn = DateTime::createFromFormat('H:i:s', $kegiatan->start_regis_in); ?>
                                    <div class="time"><span>Regis-In</span> : <?= $regisIn->format('H.i') ?></div>
                                    <?php $regisOut = DateTime::createFromFormat('H:i:s', $kegiatan->start_regis_out); ?>
                                    <div class="time"><span>Regis-Out</span> : <?= $regisOut->format('H.i') ?> </div>
                                </div>
                                <div class="btn-group float-end">
                                    <?php $peserta = ($kegiatan->peserta === 'Panitia') ? 'panitia' : 'maba'; ?>
                                    <a href="<?= site_url("panitia/absen/$peserta/regis-in/" . $kegiatan->id) ?>" class="btn btn-outline-primary">Regis-In</a>
                                    <a href="<?= site_url("panitia/absen/$peserta/regis-out/" . $kegiatan->id) ?>" class="btn btn-outline-primary">Regis-Out</a>
                                    <a href="<?= site_url("panitia/absen/$peserta/dataAbsensi/" . $kegiatan->id) ?>" class="btn btn-outline-primary">Daftar Hadir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex gap-5 overflow-hidden mt-4 mb-3 mb-md-5">
                <div class=""><i class="bi bi-dot text-warning"></i> <span>Upcoming</span></div>
                <div class=""><i class="bi bi-dot text-success"></i> <span>Ongoing</span></div>
            </div>
        </div>
    </section>
    <div class="pane-separator h-100 bg-dark bg-opacity-25"></div>
    <hr class="d-block d-md-none my-4">
    <section class="h-100 px-xl-4 px-sm-3 px-2">
        <h4 class="mb-3">Past</h4>
        <div>
            <?php foreach ($listKegiatanSelesai->getResult() as $kegiatan): ?>
                <div class="card w-100 mb-4">
                    <div class="card-body p-1">
                        <?php $date = DateTime::createFromFormat('Y-m-d', $kegiatan->tanggal) ?>
                        <div class="overflow-hidden text-end"><?= $date->format('j F Y') ?><i class="bi bi-dot text-danger"></i></div>
                        <div class="p-2">
                            <div class="fs-6 lh-1"><?= $kegiatan->peserta ?></div>
                            <h5 class="card-title mt-1 mx-1"><?= $kegiatan->nama ?></h5>
                            <div class="btn-group float-end mb-2">
                                <?php $peserta = ($kegiatan->peserta === 'Panitia') ? 'panitia' : 'maba'; ?>
                                <a href="<?= site_url("panitia/absen/$peserta/regis-in/" . $kegiatan->id) ?>" class="btn btn-outline-primary btn-sm">Regis-In</a>
                                <a href="<?= site_url("panitia/absen/$peserta/regis-out/" . $kegiatan->id) ?>" class="btn btn-outline-primary btn-sm">Regis-Out</a>
                                <a href="<?= site_url("panitia/absen/$peserta/dataAbsensi/" . $kegiatan->id) ?>" class="btn btn-outline-primary btn-sm">Daftar Hadir</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?= $this->endSection('content') ?>