<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>

    <style>
        .rotasiContainer { 
            background: url("<?= site_url("/assets/images/rotasi/background.png") ?>") no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;

            min-width: 100vw;
            min-height: 100vh;
        }

        .exit{
            width: 9vh;
            margin-left: 10vh;
            z-index: -1;
            position: absolute;
        }
        .exit:hover{
           filter: drop-shadow( 0 0 5px rgba(255, 255, 255, 0.753));
        }


        .panah {
            position: absolute;
            /* z-index: -2; */
            height: 10vh;
        }
        .panah-1{
            rotate: 345deg;
            margin-left: 71%;
            margin-top: 50%;
        }
        .panah-2{
            rotate: 60deg;
            margin-left: 45vh;
            margin-top: 52vh;
        }
        .panah-3{
            rotate: 147deg;
            margin-left: 49vh;
            margin-top: 21vh;
        }
        .panah-4{
            rotate: 179deg;
            margin-left: 83vh;
            margin-top: 14vh;
        }
        .panah-5{
            rotate: 140deg;
            margin-left: 107vh;
            margin-top: 7vh;
        }
        .panah-6{
            rotate: 205deg;
            margin-left: 143vh;
            margin-top: 8vh;
        }
        .huruf{
            position: absolute;
            color: white;
            display: block;
        }
        .huruf-1{
            margin-top: 66vh;
            margin-left: 88vh;
        }
        .huruf-2{
            margin-top: 72vh;
            margin-left: 58vh;
        }
        .huruf-3{
            margin-top: 43vh;
            margin-left: 38vh;
        }
        .huruf-4{
            margin-top: 27vh;
            margin-left: 67vh;
        }
        .huruf-5{
            margin-top: 27vh;
            margin-left: 107vh;
        }
        .huruf-6{
            margin-top: 12vh;
            margin-left: 123vh;
        }
        .huruf-7{
            margin-top: 36vh;
            margin-left: 166vh;
        }
    </style>

<?=$this->renderSection('css')?>

<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>

    <div class="rotasiContainer">
        <!-- <a href="<?= site_url("/home") ?>">
            <img src="<?= site_url("/assets/images/rotasi/exit.png"); ?>" alt="exit" class="exit">
        </a> -->
            
        <div class="huruf-1 huruf"><?= esc($ruang1); ?></div>
        <div class="huruf-2 huruf"><?= esc($ruang2); ?></div>
        <div class="huruf-3 huruf"><?= esc($ruang3); ?></div>
        <div class="huruf-4 huruf"><?= esc($ruang4); ?></div>
        <div class="huruf-5 huruf"><?= esc($ruang5); ?></div>
        <div class="huruf-6 huruf"><?= esc($ruang6); ?></div>
        <div class="huruf-7 huruf"><?= esc($ruang7); ?></div>

        <img src="<?= site_url('/assets/images/rotasi/panah.png'); ?>" alt="panah" class="panah-1 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah.png'); ?>" alt="panah" class="panah-2 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah.png'); ?>" alt="panah" class="panah-3 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah.png'); ?>" alt="panah" class="panah-4 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah.png'); ?>" alt="panah" class="panah-5 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah.png'); ?>" alt="panah" class="panah-6 panah">
    </div>

<?=$this->renderSection('content')?>
<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>