<?= $this->extend('layouts/main_layouts') ?>

<?= $this->section('css')?>

<style>
    .form-control {
        padding: 12px 15px;
        font-size: 18px
    }

    .btn-primary {
        font-size: 18px
    }
</style>

<?= $this->endsection()?>

<?= $this->section('content') ?>

<!-- <div class="px-4 mt-2">
    <?php if (isset($data_maba['nama']) && isset($data_maba['nrp'])): ?>
        Halo! <?=$data_maba['nama']?> (<?=$data_maba['nrp']?>)
    <?php endif ?>
</div>

<hr style="margin-bottom: 4em" /> -->

<div class="container px-3">
    <div class="text-center my-5 mx-auto" style="max-width: 800px">
        <!-- <h1>QnA</h1> -->

        <?php if (!$pertanyaan_open || (isset($pertanyaan_open->is_open) && $pertanyaan_open->is_open == 0)): ?>

            <div class="alert alert-warning mt-5">
                Form pertanyaan untuk peserta masih belum dibuka.
            </div>

        <?php else: 
            
            if (!isset($data_maba['nama'])): ?>
            
                <div class="alert alert-warning mt-5">
                    Kamu tidak dapat membuat pertanyaan, NRP kamu tidak dapat ditemukan di data mahasiswa.<br/>
                    Silakan hubungi panitia untuk lebih lanjutnya.
                </div>

            <?php else: ?>
            
                <?=form_open('peserta/qna/submit')?>
                    <?php

                    $error_pertanyaan = session()->getFlashdata('error_qna');

                    ?>

                    <div class="my-5">
                        <label class="form-label">Pertanyaan dari Kamu</label>
                        <input type="text" name="pertanyaan" value="<?=old('pertanyaan')?>" id="pertanyaan" class="form-control form-control-lg <?=$error_pertanyaan ? 'is-invalid' : '' ?>" placeholder="Ketik pertanyaan kamu disini ..." autocomplete="off">

                        <?php if ($error_pertanyaan): ?>

                            <div class="text-start invalid-feedback mb-4">
                                <?=$error_pertanyaan?>
                            </div>

                        <?php endif ?>

                        <div class="mt-3 mb-4 form-check text-start">
                            <input type="checkbox" class="form-check-input" id="anonym" name="anonym" value="yes"<?=old('anonym') == 'yes' ? ' checked' : ''?>>
                            <label class="form-check-label" for="anonym">Kirim sebagai <i>anonym</i>.</label>
                        </div>

                        <button class="btn btn-primary bg-blue btn-lg">Tanyakan</button>
                    </div>
                <?=form_close()?>

                
                <div class="text-start" style="margin-top: 4em">
                    <h3>Pertanyaan dari Kamu</h3>
                    
                    <?php if (session()->getFlashdata('success_qna')): ?>
                        <div class="alert alert-success mt-3">Pertanyaan kamu berhasil ditambahkan.</div>
                    <?php endif ?>

                    <?php if (count($data_pertanyaan) == 0): ?>

                        <p>Nampaknya kamu masih belum menanyakan sesuatu. Silakan ketik pertanyaan kamu di form atas.</p>

                    <?php else: ?>

                        <div class="table-responsive my-4">

                            <table class="table table-bordered">
                                <?php if (!$is_mobile): ?>
                                    <thead class="bg-blue text-white">
                                        <tr class="text-center">
                                            <th style="width: 450px">Pertanyaan</th>
                                            <th>Dibuat Pada</th>
                                            <th>Sebagai Anonym</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data_pertanyaan as $pertanyaan): ?>
                                            <tr>
                                                <td><?=htmlspecialchars($pertanyaan->pertanyaan)?></td>
                                                <td class="text-center"><?=htmlspecialchars(date('Y-m-d H:i', strtotime($pertanyaan->created_at)))?></td>
                                                <td class="text-center"><?=$pertanyaan->is_anonym == 1 ? 'Ya' : 'Tidak'?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                <?php else: ?>
                                    <tbody>
                                        <?php foreach($data_pertanyaan as $pertanyaan): ?>
                                            <tr class="bg-primary text-white">
                                                <td>Dibuat Pada</td>
                                                <td>:</td>
                                                <td><?=htmlspecialchars(date('Y-m-d H:i', strtotime($pertanyaan->created_at)))?></td>
                                            </tr>
                                            <tr>
                                                <td>Sebagai Anonym</td>
                                                <td>:</td>
                                                <td><?=$pertanyaan->is_anonym == 1 ? 'Ya' : 'Tidak'?></td>
                                            </tr>
                                            <tr>
                                                <td>Pertanyaan</td>
                                                <td>:</td>
                                                <td><?=htmlspecialchars($pertanyaan->pertanyaan)?></td>
                                            </tr>
                                        <?php endforeach?>
                                    </tbody>
                                <?php endif ?>
                            </table>
                        </div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
</div>

<?= $this->endsection() ?>