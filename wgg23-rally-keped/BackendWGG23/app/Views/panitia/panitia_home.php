<?= $this->extend('panitia/home_layout'); ?>

<?= $this->section('css') ?>
<style>
        .banner-image{
            background: #41295a;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #2F0743, #41295a);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #2F0743, #41295a); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            /* filter: blur(0.5px); */
        }
        h1{
            font-weight: 900;
            font-size: 60px;
        }
        #welcome{
            overflow : hidden;
            border-right: none;
            animation: typing 3s steps(40, end), blink-caret .75s step-end 4;
        }
        #nama{
            overflow : hidden;
            width:0%;
            border-right: none;
            animation: typing 3s 3s forwards steps(40, end), blink-caret .75s 3s step-end 4;
            white-space: nowrap;
        }

        @media screen and (max-width:768px) {
            #welcome, #nama {
                font-size: 2em;
            }
        }
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        /* The typewriter cursor effect */
        @keyframes blink-caret {
            from, to { border-right: 0.15em solid transparent }
            50% { border-right: 0.15em solid orange; }
        }
</style>
<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<?= $this->include('panitia/panitia_navbar.php'); ?>

<div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="content text-center" style="z-index:10;" id="text">
        <h1 class="text-white" id="welcome">WELCOME,</h1>
        <h1 class="text-white" id="nama"><?= session('nama') ?></h1>
    </div>
</div>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>



<?= $this->endSection('script') ?>