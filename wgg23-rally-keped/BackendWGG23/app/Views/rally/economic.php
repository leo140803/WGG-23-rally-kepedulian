<?php $this->extend('layouts/base_layouts') ?>

<?php $this->section('css') ?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Concert+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Ysabeau+SC:wght@300&display=swap');

    body {
        overflow: hidden;
    }

    .main img {
        object-fit: cover;
        object-position: bottom;
    }

    .shop img {
        object-fit: cover;
    }

    .background {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        z-index: 0;
        position: absolute;
    }

    .sky {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        z-index: 1;
        position: absolute;
    }

    .road {
        width: 100vw;
        height: 100vh;
        overflow: hidden;
        z-index: 10;
        position: absolute;
    }

    .gedung-biru {
        z-index: 3;
        width: 100vw;
        height: 100vh;
        position: absolute;
    }


    .gedung-ungu {
        width: 100vw;
        height: 100vh;
        z-index: 2;
        position: absolute;
    }

    .gedung-hijau {
        width: 100vw;
        height: 100vh;
        z-index: 6;
        position: absolute;
    }

    .gedung-kuning {
        width: 100vw;
        height: 100vh;
        z-index: 5;
        position: absolute;
    }

    .bianglala {
        width: 100vw;
        height: 100vh;
        z-index: 4;
        position: absolute;
    }

    .gedung-orange,
    .gedung-merah {
        width: 100vw;
        height: 100vh;
        z-index: 7;
        position: absolute;
    }

    .mobil-mewah {
        width: 100vw;
        height: 100vh;
        z-index: 11;
        position: absolute;
    }

    /* BUTTON BACK */
    .Btn {
        z-index: 15;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        left: 3vw;
        top: 2vh;
        width: 45px;
        height: 45px;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        position: absolute;
        overflow: hidden;
        transition-duration: .3s;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
        background-color: rgb(255, 65, 65);
    }

    /* plus sign */
    .sign {
        width: 100%;
        transition-duration: .3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sign svg {
        width: 17px;
    }

    .sign svg path {
        fill: white;
    }

    /* text */
    .text {
        position: absolute;
        right: 0%;
        width: 0%;
        opacity: 0;
        color: white;
        font-size: 1.2em;
        font-weight: 600;
        transition-duration: .3s;
    }

    /* hover effect on button width */
    .Btn:hover {
        width: 125px;
        border-radius: 40px;
        transition-duration: .3s;
    }

    .Btn:hover .sign {
        width: 30%;
        transition-duration: .3s;
        padding-left: 20px;
    }

    /* hover effect button's text */
    .Btn:hover .text {
        opacity: 1;
        width: 70%;
        transition-duration: .3s;
        padding-right: 10px;
    }

    /* button click effect*/
    .Btn:active {
        transform: translate(2px, 2px);
    }


    .btn-coin {
        position: absolute;
        left: 85vw;
        top: 2vh;
        border: solid;
        border-radius: 50px;
        width: 8vw;
        height: 8vh;
        z-index: 15;
        transition: all .5s ease-in-out;
    }

    .btn-coin:hover {
        background-color: #F1C376;
    }

    .img-coin {
        position: absolute;
        width: 3.5vw;
        height: 8vh;
        left: -0.1vw;
        top: -.5vh;
        z-index: 5;
        transition: all .5s ease-in-out;
    }

    .btn-coin:hover .img-coin {
        transform: translateX(4.5vw);
    }

    .jumlah-coin {
        position: absolute;
        left: 3.8vw;
        top: 1.5vh;
        transition: all .1s ease-in-out;
        z-index: 0;
        font-family: 'Concert One', cursive;
    }

    .btn-coin:hover .jumlah-coin {
        transform: translateX(3vw);
        opacity: 0%;
    }

    .text-shop {
        position: absolute;
        left: 4vw;
        top: 1.3vh;
        opacity: 0%;
        transition: all .1s ease-in-out;
        font-family: 'Concert One', cursive;
    }

    .btn-coin:hover .text-shop {
        transform: translateX(0vw);
        left: 1vw;
        opacity: 100%;
    }

    .main {
        z-index: 0;
    }

    .shop {
        display: none;
        position: fixed;
        z-index: 16;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(15px);
        background-color: #dddddd50;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .img-item {
        width: 10vw;
        height: 30vh;
    }

    .coin-shop {
        width: 2vw;
        height: 5vh;
        margin-left: 2.5vw;

    }

    .card-item:hover .btn-buy {
        opacity: 100%;
        transform: translateY(-25vh);
    }

    .item-name {
        color: black;
        margin-left: 2vw;
        font-size: 12px;
        font-family: 'Concert One', cursive;
    }

    .price-shop {
        color: black;
        font-family: 'Concert One', cursive;
        margin-left: -1.2vw;
        margin-top: .5vh;
    }

    .btn-buy {
        border: none;
        width: 5vw;
        height: 5vh;
        border-radius: 2em;
        margin-left: 2.5vw;
        transition: all .5s ease-in-out;
        opacity: 0%;
    }

    .btn-buy:hover {
        background-color: #E7CEA6;
    }

    .img-cart {
        position: absolute;
        margin-left: -2vw;
        margin-top: -1.5vh;
        width: 1.5vw;
        height: 3vh;
        transition: all .5s ease-in-out;
    }

    .btn-buy:hover .img-cart {
        transform: translateX(1.2vw);
        /* animation: keranjang 2s infinite; */
    }

    .text-buy {
        font-size: 12px;
        position: absolute;
        margin-top: -1.3vh;
        margin-left: 1.9vw;
        opacity: 100%;
        transition: all .1s ease-in-out;
    }

    .btn-buy:hover .text-buy {
        opacity: 0%;
        transform: translateX(2.5vw);
    }

    .img-back {
        z-index: 15;
        margin-left: 2vw;
        width: 5vw;
    }

    .img-back:hover {
        transform: translateX(-2px);
        cursor: pointer;
    }

    .footer {
        font-family: 'Ysabeau SC', sans-serif;
        z-index: 10;
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: white;
        padding: 5px 0;
        color: black;
        text-align: center;
        font-weight: bold;
    }

    /* ANIMATION FIELD */
    @keyframes newPurchase {
        0% {
            filter: drop-shadow(0 0 0.2rem #FFD93D);
        }

        10% {
            filter: drop-shadow(0 0 0.7rem #FFD93D);
        }

        20% {
            filter: drop-shadow(0 0 .2rem #FFD93D);
        }

        30% {
            filter: drop-shadow(0 0 .7rem #FFD93D);
        }

        40% {
            filter: drop-shadow(0 0 .2rem #FFD93D);
        }

        50% {
            filter: drop-shadow(0 0 .7rem #FFD93D);
        }

        60% {
            filter: drop-shadow(0 0 .2rem #FFD93D);
        }

        70% {
            filter: drop-shadow(0 0 .7rem #FFD93D);
        }

        80% {
            filter: drop-shadow(0 0 .2rem #FFD93D);
        }

        90% {
            filter: drop-shadow(0 0 .7rem #FFD93D);
        }

        100% {
            filter: drop-shadow(0 0 .2rem #FFD93D);
        }
    }

    @keyframes zoom-in {
        0% {
            transform: scale(0.1);
        }

        10% {
            transform: scale(0.2);
        }

        20% {
            transform: scale(0.3);
        }

        30% {
            transform: scale(0.4);
        }

        40% {
            transform: scale(0.5);
        }

        50% {
            transform: scale(0.6);
        }

        60% {
            transform: scale(0.7);
        }

        70% {
            transform: scale(0.8);
        }

        80% {
            transform: scale(0.9);
        }

        90% {
            transform: scale(1);
        }

        100% {
            transform: scale(1);

        }
    }

    /* LOADER CSS */
    .loader {
        background-color: white;
        /* display: none; */
        position: fixed;
        z-index: 25;
        width: 100%;
        height: 100%;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    .dots-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        width: 100%;
    }

    .dot {
        height: 20px;
        width: 20px;
        margin-right: 10px;
        border-radius: 10px;
        background-color: #b3d4fc;
        animation: pulse 1.5s infinite ease-in-out;
    }

    .dot:last-child {
        margin-right: 0;
    }

    .dot:nth-child(1) {
        animation-delay: -0.3s;
    }

    .dot:nth-child(2) {
        animation-delay: -0.1s;
    }

    .dot:nth-child(3) {
        animation-delay: 0.1s;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.8);
            background-color: #b3d4fc;
            box-shadow: 0 0 0 0 rgba(178, 212, 252, 0.7);
        }

        50% {
            transform: scale(1.2);
            background-color: #6793fb;
            box-shadow: 0 0 0 10px rgba(178, 212, 252, 0);
        }

        100% {
            transform: scale(0.8);
            background-color: #b3d4fc;
            box-shadow: 0 0 0 0 rgba(178, 212, 252, 0.7);
        }
    }

    .buy {
        display: none;
    }

    .outer {
        position: absolute;
        animation: zoomout 5s ease-in-out forwards;
        transform-origin: 53vw 65vh;
    }

    @keyframes zoomout {
        0% {
            transform: scale(50);
        }

        100% {
            transform: scale(1);
        }
    }
</style>



<?php $this->endSection('css') ?>

<?php $this->section('base_content') ?>
<!-- LOADER -->
<div class="loader">
    <section class="dots-container">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </section>
</div>

<?php if (count($shop)) : ?>
    <div class="shop">
        <div class="row mt-5">
            <div class="col-3">
                <img src="<?= site_url("/assets/rally/back.png"); ?>" alt="" class="img-back">
            </div>
            <div class="col-6">
                <div class="row">
                    <input id="csrf" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash() ?>">
                    <?php foreach ($shop as $s) : ?>
                        <div class="col-4 card-item">
                            <img src="<?= site_url($s['shop_image']); ?>" alt="" class="img-item">
                            <div class="name">
                                <h5 class="item-name"><?= strtoupper($s['nama']); ?></h5>
                            </div>
                            <div class="item-harga">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="<?= site_url("/assets/rally/coin.png"); ?>" alt="" class="coin-shop">
                                    </div>
                                    <div class="col-2">
                                        <h5 class="price-shop"><?= $s['harga']; ?></h5>
                                    </div>
                                </div>
                                <!-- IKI VALUE E SESUAI ID E SG RUSAK NGAB -->
                                <button class="btn-buy" value="<?= $s['id']; ?>">
                                    <img src="<?= site_url("/assets/rally/cart.png"); ?>" alt="" class="img-cart">
                                    <h5 class="text-buy">BUY!</h5>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="outer">
    <div class="main">
        <button class="btn-coin">
            <img src="<?= site_url("/assets/rally/coin.png"); ?>" alt="Coin Image" class="img-coin">
            <h5 class="jumlah-coin"><?= $coin->poin; ?></h5>
            <?php if (count($shop)) : ?>
                <span class="text-shop">SHOP!</span>
            <?php endif; ?>
        </button>

        <!-- BUTTON BACK -->
        <a href="<?= site_url('games')?>">
            <button class="Btn">
                <div class="sign"><svg viewBox="0 0 512 512">
                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                    </svg></div>
                <div class="text">EXIT</div>
            </button>
        </a>

        <?php foreach ($display as $d) : ?>
            <img src="<?= site_url($d['image']); ?>" alt="<?= $d['nama']; ?>" class="<?= str_replace(' ', '-', strtolower($d['nama'])); ?> objects" id="<?= $d['id']; ?>">
        <?php endforeach; ?>
    </div>
</div>

<div class="footer">
    <i>Help Built the Economy!</i>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php $this->endSection('base_content') ?>

<?php $this->section('script') ?>
<?php include 'checkViewport.php' ?>
<script>
    $(document).ready(function() {
        $(".loader").show().delay(1000).fadeOut();
        $(".btn-coin").click(function() {
            $(".shop").css("display", "block");
        });

        $(".img-back").click(function() {
            $(".shop").css("display", "none");
        })

        $(".btn-buy").click(function() {
            let name = $(this).parent().parent().children(".name").children(".item-name").text();
            let harga = $(this).parent().children(".row").children(".col-2").children(".price-shop").text();
            let sure = "Apakah yakin ingin membeli " + name + " dengan harga " + harga + " koin?";
            let group = $(this).val();
            let buy_btn = $(this);
            Swal.fire({
                text: sure,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#A6BB8D',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, buy!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url("/games/buy") ?>",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $("#csrf").val()
                        },
                        data: {
                            'item_id': group,
                        },
                        success: function(data) {
                            data = JSON.parse(data);

                            Swal.fire({
                                title: data.response.title,
                                text: data.response.text,
                                icon: data.response.icon,
                                confirmButtonColor: '#A6BB8D',
                            })

                            if (data.response.icon == 'success') {
                                buy_btn.parent().parent().remove();
                                $(".shop").css("display", "none");
                                $(".loader").show().delay(1000).fadeOut();

                                $.each(data.item, function(key, value) {
                                    $(".main").append(`
                                                    <img src="${"<?= site_url(); ?>" + data.item[key].image}" alt="${data.item[key].nama}" class="${data.item[key].nama.replace(' ', '-').toLowerCase()}">`);
                                    $("." + data.item[key].nama.replace(' ', '-').toLowerCase()).css("animation", "newPurchase 6s ease-in-out");
                                })

                                // update jumlah koin
                                $(".jumlah-coin").html(data.coin.poin);
                            }

                            // update csrf
                            $("#csrf").attr('name', data.csrf_name);
                            $("#csrf").val(data.csrf_hash);
                        }
                    })
                }
            })
        })
    });
</script>
<?php $this->endSection('script') ?>