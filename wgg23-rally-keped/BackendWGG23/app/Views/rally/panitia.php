<?php $this->extend('rally/panitia_layout') ?>

<?php $this->section('css') ?>
<?php $this->endSection('css') ?>
<?php $this->section('content') ?>
    <div class="container">
        <h1 class="mt-5 text-center">Welcome di WEB ADMIN RALLY</h1>
        <div class="row mt-3">
            <div class="col-3 text-center"></div>
            <div class="col-6">
                <div class="row">
                    <?php foreach($rute as $r): 
                        if($r['route'] == 'panitia/games/rotasi'):
                    ?>
                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='<?= site_url('panitia/games/rotasi') ?>'" style="width:100%">Rotasi</button>
                    </div>
                    <?php endif;
                        if($r['route'] == 'panitia/games/admin'):
                    ?>
                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='<?= site_url('panitia/games/admin') ?>'" style="width:100%">Point</button>
                    </div>
                    <?php endif;
                        if($r['route'] == 'panitia/games/faq'):
                    ?>
                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='<?= site_url('panitia/games/faq') ?>'" style="width:100%">FaQ</button>
                    </div>
                    <?php endif;
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection('content') ?>
<?php $this->section('script') ?>
<?php $this->endSection('script') ?>