<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Milonga' rel='stylesheet'>
    <style>
        body {
            overflow: hidden;
        }

        * {
            margin: 0;
            padding: 0;
            font-family: 'Milonga';
        }

        #zoom {
            background-size: cover;
            /* position: absolute; */
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            transition: 2s ease;
        }

        /* #zoom.zoomed { */
        /* background-size: 2000%;
            background-position: 11.5% 50%; */
        /* transform: scale(25) translate(37%, -10%); */
        /* transform-origin: 7vh 25vh;
            animation: zoom 3s ease-in forwards; */
        /* } */

        @keyframes zoom {
            0% {
                transform: scale(1);
                z-index: 100;
            }

            100% {
                transform: scale(25);
                z-index: 100;
            }
        }


        .top {
            top: 15vh;
            display: flex;
            text-align: center;
            position: absolute;
            justify-content: center;
            margin: auto;
            margin-right: 2vh;
        }

        .top .rotasi {
            color: #473c33;
            background: none;
            font-weight: bold;
            border: none;
            text-shadow: 0 0 1vh #DFD7BF, 0 0 2vh #DFD7BF, 0 0 3vh #DFD7BF, 0 0 4vh #DFD7BF, 0 0 5vh #DFD7BF;
            cursor: pointer;
            font-size: 4vh;
            opacity: 50%;
            transition: 1s ease;
            z-index: 2;
        }

        .top .starrotasi {
            position: absolute;
            width: 200vh;
            top: -14vh;
            opacity: 0.3;
            z-index: 1;
            transition: opacity 1s ease;
        }

        .top .rotasi:hover {
            opacity: 100%;
            text-shadow: 0 0 1vh #DFD7BF, 0 0 2vh #DFD7BF, 0 0 3vh #DFD7BF, 0 0 4vh #DFD7BF, 0 0 5vh #DFD7BF;
        }

        .rotasi:hover+.starrotasi {
            animation: opacityAnimation 2.5s infinite;
        }

        .center {
            text-align: center;
        }

        .center .title {
            color: #473c33;
            font-size: 10vh;
            text-shadow: -0.3vh -0.3vh 0 #F6F1E9, 0.3vh -0.3vh 0 #F6F1E9, -0.3vh 0.3vh 0 #F6F1E9, 0.3vh 0.3vh 0 #F6F1E9;
        }

        .title-2 {
            color: #473c33;
            text-shadow: -0.3vh -0.3vh 0 #F6F1E9, 0.3vh -0.3vh 0 #F6F1E9, -0.3vh 0.3vh 0 #F6F1E9, 0.3vh 0.3vh 0 #F6F1E9;
        }

        .center .team {
            margin-top: 5vh;
            color: #473c33;
            font-size: 6vh;
            text-shadow: -0.2vh -0.2vh 0 #F6F1E9, 0.2vh -0.2vh 0 #F6F1E9, -0.2vh 0.2vh 0 #F6F1E9, 0.2vh 0.2vh 0 #F6F1E9;
        }

        .left {
            left: 12vh;
            top: 30vh;
            position: absolute;
            margin: auto;
            text-align: center;
        }

        .left .progresses {
            position: absolute;
            left: 7vh;
            top: 25vh;
            cursor: pointer;
            font-weight: bold;
            color: #473c33;
            text-shadow: 0 0 1vh #DFD7BF, 0 0 2vh #DFD7BF, 0 0 3vh #DFD7BF, 0 0 4vh #DFD7BF, 0 0 5vh #DFD7BF;
            transition: 1s ease;
            font-size: 4vh;
            opacity: 0.5;
            z-index: 20;
        }

        .left .starprogress {
            position: absolute;
            opacity: 0.5;
            left: 2vh;
            width: 80vh;
            transition: 1s ease;
            z-index: 2;
        }

        #zoom.zoomed .left {
            opacity: 0;
        }

        .progresses:hover+.starprogress {
            opacity: 1;
        }

        /* .left .starprogress {
            position: absolute;
            width: 30vh;
            left: 0vh;
            top: 0vh;
            opacity: 0.3;
            z-index: 1;
            transition: opacity 1s ease;
        } */
        .progress:hover {
            opacity: 1;
            text-shadow: 0 0 1vh #DFD7BF, 0 0 2vh #DFD7BF, 0 0 3vh #DFD7BF, 0 0 4vh #DFD7BF, 0 0 5vh #DFD7BF;
        }

        /* .progress:hover ~ .starprogress {
            animation: opacityAnimation 2.5s infinite;
        } */
        @keyframes opacityAnimation {
            0% {
                opacity: 0.3s;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.3s;
            }
        }

        .bottom {
            right: 1vh;
            bottom: -5vh;
            position: absolute;
            text-align: center;
        }

        .bottom .faq {
            cursor: pointer;
            bottom: 17vh;
            right: 14vh;
            position: absolute;
            color: #473c33;
            text-shadow: 0 0 1vh #DFD7BF, 0 0 2vh #DFD7BF, 0 0 3vh #DFD7BF, 0 0 4vh #DFD7BF, 0 0 5vh #DFD7BF;
            opacity: 70%;
            transition: 1s ease;
            font-size: 3vh;
            font-weight: bold;
            z-index: 3;
        }

        .bottom .vid {
            width: 35vh;
            z-index: 2;
        }

        .bottom .faq:hover {
            opacity: 100%;
            text-shadow: -0.1vh -0.1vh 0 #F6F1E9, 0.1vh -0.1vh 0 #F6F1E9, -0.1vh 0.1vh 0 #F6F1E9, 0.1vh 0.1vh 0 #F6F1E9;
        }

        #notification {
            position: fixed;
            top: 10vh;
            right: 100%;
            color: white;
            border-right: none;
            white-space: nowrap;
            /* Mencegah pemisahan baris */
            animation: slide-in 15s linear forwards;
            font-size: 2vh;
        }

        @keyframes slide-in {
            from {
                right: -20%;
            }

            to {
                right: 100%;
            }
        }

        .hidden {
            display: none;
        }

        #bg {
            z-index: -1;
            width: 100vw;
            height: 100vh;
            position: absolute;
            object-fit: cover;

        }

        #bg.zoomed {
            transform-origin: 12vw 60vh;
            animation: zoom 3s ease-in forwards;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5% !important;
        }

        .carousel-control-prev-icon {
            background-image: url("<?= site_url('assets/rally/carousel-prev.png') ?>") !important;
        }

        .carousel-control-next-icon {
            background-image: url("<?= site_url('assets/rally/carousel-next.png') ?>") !important;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 4rem !important;
            height: 4rem !important;
        }

        .locked {
            background-image: url("<?= site_url('assets/rally/carousel-next-locked.png') ?>") !important;
        }

        .frame {
            position: absolute;
            width: 80vw;
            height: 120vh;
            /* top: -7vh; */
            z-index: 0;
            right: 10vw;
            top: -15vh;
        }

        .text-1 {
            z-index: 2;
            width: 60vw;
            position: absolute;
            left: 20vw;
            text-align: center;
            bottom: .5vh;
            font-size: 25px;
        }

        .text-3 {
            z-index: 2;
            width: 60vw;
            position: absolute;
            left: 20vw;
            text-align: center;
            font-size: 25px;
            bottom: .5vh;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>

<body>
    <img src="<?= site_url('assets/images/rally/background.png') ?>" alt="" id="bg">

    <div id="carouselExampleControls" class="carousel slide">
        <div class="carousel-inner">
            <!-- Halaman utama -->
            <div class="carousel-item active">
                <section id="zoom">
                    <div class="top">
                        <button class="rotasi clickable" id="showNotification">Rotasi Day 6</button>
                        <img src="<?= site_url('assets/images/rally/rotasi-star.png') ?>" class="starrotasi">
                    </div>
                    <div class="center">
                        <h1 class="title">The Dilemmatic Pathways</h1>
                        <h1 class="team"><?= $nama; ?><?php if($ketua) { echo " (KETUA)"; }?></h1>
                    </div>
                    <div class="left zoom">
                        <h1 class="progresses" id="trigger">Progress</h1>
                        <video class="starprogress" muted>
                            <source src="<?= site_url('assets/webm/rally/progress-star.webm') ?>">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="bottom">
                        <h1 class="faq">FAQ</h1>
                        <video class="vid" muted>
                            <source src="<?= site_url('assets/webm/rally/lumi-wave.webm') ?>">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div id="notification" class="hidden">
                        COMING SOON : WGG DAY 6
                    </div>
                </section>
            </div>

            <!-- Storyline hal 1 -->
            <div class="carousel-item position-relative w-100 vh-100 p-5" style="backdrop-filter: blur(5px);">
                <img src="<?= site_url("assets/images/rally/frame2.png") ?>" alt="" class="frame">
                <p class="vh-100 p-5 mb-0 d-flex justify-content-center align-items-center text-dark text-1"><?= $storyline[0]; ?></p>
                <h5 class="position-absolute text-light" style="right: 5%; bottom:2%">1/3</h5>
            </div>

            <!-- Storyline hal 2 -->
            <div class="carousel-item position-relative w-100 vh-100" style="backdrop-filter: blur(5px);">
                <h2 class="w-100 vh-100 p-5 mb-0 d-flex justify-content-center align-items-center title-2 text-center"><?= $storyline[1]; ?></h2>
                <h5 class="position-absolute text-light" style="right: 5%; bottom:2%">2/3</h5>
            </div>
            s
            <!-- Storyline hal 3 -->
            <!-- <div class="carousel-item position-relative w-100 vh-100" style="backdrop-filter: blur(5px);">
                <img src="<?= site_url("assets/images/rally/frame2.png") ?>" alt="" class="frame">
                <p class="vh-100 p-5 mb-0 d-flex justify-content-center align-items-center text-dark text-3"><?= $storyline[2]; ?></p>
                <h5 class="position-absolute text-light" style="right: 5%; bottom:2%">3/3</h5>
            </div> -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
        const showNotificationButton = document.getElementById("showNotification");
        const notification = document.getElementById("notification");

        showNotificationButton.addEventListener("click", function() {
            notification.classList.add("hidden");
            setTimeout(function() {
                notification.classList.remove("hidden");
            }, 10);
        });
    </script>
    <script>
        const faqElement = document.querySelector('.faq');
        const videoElement = document.querySelector('.vid');

        faqElement.addEventListener('mouseenter', playVideo);
        faqElement.addEventListener('click', ()=>{
            window.location.href = '<?= site_url('games/faq') ?>';
        });

        function playVideo() {
            videoElement.play();
        }
        const progressElement = document.querySelector('.progresses');
        const starElement = document.querySelector('.starprogress');

        progressElement.addEventListener('mouseenter', playStar);
        progressElement.addEventListener('mouseleave', pauseStar);

        function playStar() {
            starElement.play();
        }

        function pauseStar() {
            starElement.pause();
        }
    </script>
    <script>
        const zoomSection = document.getElementById('bg');
        const zoomTrigger = document.getElementById('trigger');
        // const elements = document.querySelectorAll('.left');

        zoomTrigger.addEventListener('click', function() {
            // zoomSection.classList.toggle('zoomed');
            // elements.classList.toggle('zoomed');
            // setTimeout(function() {
                // window.location.href = '<?= site_url('games/scene') ?>';
            // }, 3100); // Delay selama 1 detik (1000 milidetik)
        });
    </script>
    <script>
        $(document).ready(function() {
            var $carousel = new bootstrap.Carousel("#carouselExampleControls");
            var $prevArrow = $("#carouselExampleControls").find('.carousel-control-prev');
            var $nextArrow = $("#carouselExampleControls").find('.carousel-control-next');

            $('#carouselExampleControls').carousel({
                interval: false
            });

            function hideControl() {
                if ($("#carouselExampleControls").find('.carousel-item.active').is(':first-child')) {
                    $prevArrow.hide();
                } else {
                    $prevArrow.show();
                }

                if ($("#carouselExampleControls").find('.carousel-item.active').is(':last-child')) {
                    $nextArrow.children('.carousel-control-next-icon').addClass('locked');
                    // $nextArrow.hide();
                } else {
                    $nextArrow.children('.carousel-control-next-icon').removeClass('locked');
                    // $nextArrow.show()
                }
            }

            hideControl();

            $("#carouselExampleControls").on("slid.bs.carousel", function() {
                hideControl();

                // komen kalo slide 3 udah diaktifin
                if ($("#carouselExampleControls").find('.carousel-item.active').is(':last-child')) {
                    $('.carousel-control-next').attr('data-bs-target', '');
                    $('.carousel-control-next').attr('data-bs-slide', '');
                } else {
                    // $('.carousel-control-next').prop('disabled', false);
                    $('.carousel-control-next').attr('data-bs-target', '#carouselExampleControls');
                    $('.carousel-control-next').attr('data-bs-slide', 'next');
                }
            })
        });
    </script>
</body>

</html>