<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka One">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    body{
        background-image: url('<?= site_url('assets/images/info/plain-bg.webp') ?>');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
    #bg{
        backdrop-filter: blur(8px) !important;
        /* width: 100vw;
        height: 100vh; */
    }

    #info{
        max-height: 90vh;
        width: auto;
    }

    .bg-purple{
        background-color: #f7f1e1;
    }

    .opacity-90{
        opacity: 0.9;
    }

</style>

<style>
    html,
    body {
      position: relative;
      height: 100%;
    }
    @media (max-width:600px){ 
    body {
      background-size: cover;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
      }
      .button {
      width: 20px;
      background-color: #f1c40f;
      border: none;
      margin-top: 15vh;
      margin-left: 30vw;
      margin-right: 30vw;
      padding: 5px 17px 5px 17px;
      border-radius: 50%;
      box-shadow: 0 0 10vw #000;
      border: 3px solid #f8ad3d;
      margin-bottom: 90vh;
      }
      .swiper-slide iframe {
      width: 80vw;
      height: calc(9 * 80vw / 16);
      }
      .swiper-slide h1{
        font-size: 4vw;
      color: #1e3258;
      margin-bottom: 30vh;
      }
      .container {
      width: 50vw;
    }
    /* .swiper-wrapper {
        height: 100vh;
        justify-content: center;
        align-items: start;
    } */

    .swiper-button-next, .swiper-button-prev{
      margin-top: 30%!important;
    }
    }
    @media (min-width:600px){
      body {
      background-size: cover;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      margin: 0;
      padding: 0;
      }
      .button {
      width: 30px;
      background-color: #f1c40f;
      border: none;
      margin-left: 5vw;
      margin-right: 5vw;
      padding: 10px 20px 10px 20px;
      border-radius: 50%;
      box-shadow: 0px 0px 5vh #000;
      border: 3px solid #f8ad3d;
      }
      .swiper-slide .iframe {
      width: 50vw;
      height: 60vh;
      box-shadow: 20vw;
      }
      .swiper-slide h1{
      font-size: 3vw;
      color: #1e3258;
      }
      .container {
      width: 30vw;
    }
    }
    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
    div[class^="swiper-button"]::after {
      display: none;
    }
    .top {
      height: 10vh;
      /* width: 60vw; */
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 5vh;
    }

    .container .steps {
      display: flex;
      width: 100%;
      align-items: center;
      justify-content: space-between;
      position: relative;
    }
    .steps .circle {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 45px;
      width: 45px;
      color: white;
      background-color: #F4EEE0;;
      color: black;
      border: 3px solid #6c757d;
      border-radius: 50%;
      font-weight: bold;
    }
    .steps .circle.active{
      border: 3px solid #f8ad3d;
      color: #000;
      background-color: #f1c40f;
    }
    .steps .progress-bar{
      position: absolute;
      height: 1vh;
      width: 100%;
      background-color: #6c757d;
      z-index: -1;
      font-weight: bold;
      display: flex;
    }
    .progress-bar .indicator {
      position: absolute;
      height: 100%;
      width: 10%;
      background-color: #f8ad3d;
    }
    .progress-bar .indicator.half {
      width: 50%;
    }
    .progress-bar .indicator.full {
      width: 100%;
    }
    .icon {
      color: #000;
      /* filter: invert(77%) sepia(96%) saturate(2010%) hue-rotate(323deg) brightness(95%) contrast(106%); */
    }

    
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>


<div id="bg">
    <nav class="navbar navbar-expand-lg sticky-top bg-purple opacity-90" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url() ?>">
                <h5 class="nav-item" >WGG 2023</h5 class="nav-item" >
                <!-- <img src="<?= site_url('assets/images/wgg.png')?>" width="auto" height="35" class="d-inline-block align-top" alt=""> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="<?= site_url() ?>">HOME</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Swiper -->
  <div class="swiper mySwiper">
    <h1 class="text-center text-white mt-3">Briefing WGG 2023</h1>
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="top">
          <div class="container">
            <div class="steps">
              <span class="circle active">1</span>
              <span class="circle">2</span>
              <span class="circle">3</span>
              <div class="progress-bar">
                <span class="indicator"></span>
              </div>
            </div>
          </div>
        </div>
        <!-- <iframe src="https://www.youtube.com/embed/nGGixu8DKMw?rel=0" title="YouTube video player" id="vid1" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
        <div id="player1" class="iframe"></div>
        <h1 class="text-white">Part 1</h1>
      </div>
      <div class="swiper-slide">
        <div class="top">
          <div class="container">
            <div class="steps">
              <span class="circle active">1</span>
              <span class="circle active">2</span>
              <span class="circle">3</span>
              <div class="progress-bar">
                <span class="indicator half"></span>
              </div>
            </div>
          </div>
        </div>
        <!-- <iframe src="https://www.youtube.com/embed/nGGixu8DKMw?rel=0" title="YouTube video player" frameborder="0" id="vid2" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
        <div id="player2" class="iframe"></div>
        <h1 class="text-white">Part 2</h1>
      </div>
      <div class="swiper-slide">
        <div class="top">
          <div class="container">
            <div class="steps">
              <span class="circle active">1</span>
              <span class="circle active">2</span>
              <span class="circle active">3</span>
              <div class="progress-bar">
                <span class="indicator full"></span>
              </div>
            </div>  
          </div>
        </div>
        <!-- <iframe src="https://www.youtube.com/embed/nGGixu8DKMw?rel=0" title="YouTube video player" frameborder="0" id="vid3" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> -->
        <div id="player3" class="iframe"></div>
        <h1 class="text-white">Part 3</h1>
      </div>
    </div>
    <div class="swiper-button-next button rounded-circle" id="next"><i class="bi bi-chevron-right icon"></i></div>
    <div class="swiper-button-prev button rounded-circle" id="prev"><i class="bi bi-chevron-left icon"></i></div>
  </div>
  <div class="mb-5"></div>
</div>

<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
      } else {
        document.getElementById("navbar").style.top = "-50px";
      }
      prevScrollpos = currentScrollPos;
    }
</script>


<script src="https://www.youtube.com/iframe_api"></script>
  <script>  
    // Fungsi yang dipanggil saat YouTube Player API siap
    function onYouTubeIframeAPIReady() {
      // Video 1
      var player1 = new YT.Player('player1', {
        height: '360',
        width: '640',
        videoId: 'oP9q-0C2hnU?rel=0',
        events: {
          'onStateChange': onPlayerStateChange
        }
      });

      // Video 2
      var player2 = new YT.Player('player2', {
        height: '360',
        width: '640',
        videoId: 'Aw7raN44jis?rel=0',
        events: {
          'onStateChange': onPlayerStateChange
        }
      });

      // Video 3
      var player3 = new YT.Player('player3', {
        height: '360',
        width: '640',
        videoId: 'ftHimSlKaGA?rel=0',
        events: {
          'onStateChange': onPlayerStateChange
        }
      });
    }

    function onPlayerStateChange(event) {
      if (event.data === YT.PlayerState.PLAYING) {
        console.log('Video telah diputar.');
      }
    }
  </script>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      on: {
        slideChangeTransitionEnd: function() {
          var currentSlide = this.slides[this.activeIndex];
          var iframe = currentSlide.querySelector("iframe");
          var isVideoPlayed = iframe.dataset.videoPlayed;

          if (!isVideoPlayed) {
            iframe.src += "?autoplay=1";
            iframe.dataset.videoPlayed = true;
          }
        }
      }
    });
  </script>
<?= $this->endSection('script') ?>
