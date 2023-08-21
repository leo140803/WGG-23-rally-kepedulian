<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>FAQ</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-image: url('<?= site_url('assets/images/rally/faq.png') ?>');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        #logoback {
            position: absolute;
            top: 30px;
            left: 30px;
            width: 50px;
            height: 50px;
            z-index: 2;
        }

        #bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            backdrop-filter: blur(6px);
        }

        /* Warna header accordion saat belum di-expand */
        .accordion-button {
            background-color: #F6E1C3;
            color: #333;
            text-align: justify;
            border: none;
            padding: 10px;
            margin-bottom: -1px;
            transition: background-color 0.3s;
        }

        /* Warna header accordion saat di-expand */
        .accordion-button:not(.collapsed) {
            background-color: #E8A34D;
            color: white;
            text-align: justify;
        }

        .accordion-button:focus {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            outline: none;
        }

        /* Warna body accordion */
        .accordion-body {
            background-color: #F5F5F5;
            color: #333;
            text-align: justify;
            padding: 10px;
        }
        .accordion-collapse{
            transition : all 0.095s ease-in-out;
        }
        .accordion-item {
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .box {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .title {
            margin-top: 30px;
            text-align: center;
            margin-bottom: 20px;
        }

        #title_faq {
            font-size: 48px;
            font-weight: bold;
            font-family: milonga;
            text-shadow:
                -1px -1px 0 white,
                1px -1px 0 white,
                -1px 1px 0 white,
                1px 1px 0 white;
            letter-spacing: 10px;
        }
    </style>
    <?php include 'checkViewport.php' ?>
</head>

<body>

    <div id='bg'>
        <!-- hrefnya ganti ke url home page -->
        <a href="<?= site_url("games/") ?>">
            <img id="logoback" src="<?= site_url("assets/images/rally/logoback.png") ?>">
        </a>
        <div class="title">
            <h1 id="title_faq">FAQ</h1>
        </div>

        <div class="box">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <?php foreach ($list_faq as $faq) { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $faq->id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $faq->id; ?>">
                                <span class="me-2" style="padding-right: 50px;"><?php echo htmlspecialchars($faq->question); ?></span>
                                <span class="ms-auto"></span>
                            </button>
                        </h2>
                        <div id="collapse-<?php echo $faq->id; ?>" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <?php echo htmlspecialchars($faq->answer); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        
        // JavaScript code
        window.addEventListener('DOMContentLoaded', (event) => {
            // Dapatkan semua elemen accordion
            const accordions = document.querySelectorAll('.accordion-collapse');

            // Tutup semua accordion
            accordions.forEach((accordion) => {
                accordion.classList.remove('show');
            });

            // Tambahkan kelas "collapsed" pada tombol accordion-header
            const accordionButtons = document.querySelectorAll('.accordion-button');
            accordionButtons.forEach((button) => {
                button.classList.add('collapsed');
            });
        });
    </script>
</body>

</html>