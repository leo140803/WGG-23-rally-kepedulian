<?= $this->extend('layouts/main_layouts') ?>

<?= $this->section('css') ?>
<style>
    .card {
        width: 350px;
        height: auto;
    }

    .container {
        height: auto;
        min-height: 100vh;
    }

    .backgroundImage {
        min-height: 100vh;
        position: relative;
    }

    .card-header {
        font-size: 16px;
    }

    .card-body {
        font-size: 14px;
    }

    #keteranganPoin {
        font-size: 13px;
    }
</style>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<div class="backgroundImage" id="backgroundImage">
    <div class="container d-flex justify-content-center px-0">
        <div class=" mb-3 mt-4 mx-0 h-100" id="cardBox" style="min-height: 515px;">
            <?php if (!is_null($joined)): ?>
                <span class="d-flex justify-content-center px-4 py-2 " id="keteranganPoin">
                    <?php
                    $akumulasiPoin = 0;
                    foreach ($joined as $pelanggaran):
                        $akumulasiPoin += $pelanggaran->poin;
                        ?>
                    <?php endforeach ?>
                </span>

                <span class="d-flex justify-content-center px-4 py-2 " id="keteranganPoin">
                    <?php if ($akumulasiPoin <= 30): ?>
                        <?php $colors = "border-success"; ?>
                        <span class="text-success d-flex justify-content-center px-2 fw-bold text-center">
                            <?= htmlspecialchars(strtoupper("Segala bentuk pelanggaran dapat berdampak pada kelulusan WGG")); ?>
                        </span>
                    <?php elseif ($akumulasiPoin <= 60): ?>
                        <?php $colors = "border-warning"; ?>
                        <span class="text-warning d-flex justify-content-center px-2 fw-bold text-center">
                            <?= htmlspecialchars(strtoupper("Pelanggaran yang berulang akan berdampak pada kelulusan WGG")); ?>
                        </span>
                    <?php elseif ($akumulasiPoin <= 90): ?>
                        <div>
                            <span class="d-flex justify-content-center px-2 fw-bold text-center" style="color: #fd7e14;">
                                <?= nl2br(htmlspecialchars("! PERINGATAN ! \n")) ?>
                            </span>
                            <span class="d-flex justify-content-center px-2 fw-bold text-center" style="color: #fd7e14;">
                                <?= htmlspecialchars(strtoupper("Pelanggaran yang berulang berpengaruh terhadap potensi kelulusan WGG")); ?>
                            </span>
                        </div>

                        <?php
                        $colors = "";
                        ?>
                    <?php elseif ($akumulasiPoin >= 91): ?>
                        <div>
                            <span class="text-danger d-flex justify-content-center px-2 text-center fw-bold">
                                <?= nl2br(htmlspecialchars(strtoupper("! PERINGATAN ! \n"))) ?>
                            </span>
                            <span class="text-danger d-flex justify-content-center px-2 text-center fw-bold">
                                <?= htmlspecialchars(strtoupper("Anda Berpotensi Untuk Tidak Lulus WGG")); ?>
                            </span>
                        </div>

                        <div>
                            <?php
                            $colors = "border-danger";
                            ?>
                        </div>
                    <?php endif ?>
                </span>

            <?php endif ?>

            <?php if (!is_null($joined)): ?>
                <?php if (count($joined) === 0): ?>
                    <div class="text-center alert alert-warning px-2 mx-2 mt-2">Anda Saat Ini belum Memiliki Pelanggaran</div>
                <?php endif ?>
                <div class="mt-3">
                    <?php foreach ($joined as $pelanggaran): ?>
                        <div class="d-flex justify-content-center align-items-center pb-3">
                            <div class="card" id="cardId" style="max-width: 18.5rem;">
                                <div class="card-header bg-transparent bg-blue text-white mx-0 px-3 fw-bold text-uppercase">
                                    <span>
                                        <div>
                                            <?= htmlspecialchars($pelanggaran->pasal), "." ?>
                                            <span class="">
                                                <?= htmlspecialchars($pelanggaran->keteranganPasal) ?>
                                            </span>
                                        </div>
                                    </span>
                                </div>
                                <div class="card-body mx-1 my-0 px-2 py-0">
                                    <div>
                                        <p class="card-text pb-0 mb-1 pt-2">
                                            <span class="fw-bold">
                                                <?= "Ayat: " ?>
                                            </span>
                                            <?= htmlspecialchars($pelanggaran->keteranganAyat) ?>
                                        </p>
                                    </div>
                                    <p class="card-text mb-2">
                                        <span class="fw-bold"><?= "Keterangan: " ?></span>
                                        <?= htmlspecialchars($pelanggaran->keteranganPelanggaran) ?>
                                    </p>
                                    <div class="card-footer pb-1 pt-1 px-2 bg-transparent text-end fs-6">
                                        <?= htmlspecialchars($pelanggaran->tanggalMelanggar) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endsection() ?>