<?= $this->extend('layouts/main_layouts') ?>

<?= $this->section('css')?>
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <!-- Demo styles -->
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
      background-color: #1e3258;
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
      height: 25vh;
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
      background-color: #1e3258;
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
      font-size: 4vw;
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
      width: 60vw;
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
      border: 3px solid #1e3258;
      color: #f8ad3d;
      background-color: #1e3258;
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
      background-color: #1e3258;
    }
    .progress-bar .indicator.half {
      width: 50%;
    }
    .progress-bar .indicator.full {
      width: 100%;
    }
    .icon {
      filter: invert(77%) sepia(96%) saturate(2010%) hue-rotate(323deg) brightness(95%) contrast(106%);
    }
  </style>
<?= $this->endsection()?>

<?= $this->section('content') ?>
  <!-- Swiper -->
  <div class="swiper mySwiper">
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
        <h1 class="mt-3">Part 1</h1>
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
        <h1 class="mt-3">Part 2</h1>
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
        <h1 class="mt-3">Part 3</h1>
      </div>
    </div>
    <div class="swiper-button-next button rounded-circle" id="next"><i class="bi bi-chevron-right icon"></i></div>
    <div class="swiper-button-prev button rounded-circle" id="prev"><i class="bi bi-chevron-left icon"></i></div>
  </div>

  <?= $this->endsection() ?>
  <?= $this->section('script') ?>

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
  <?= $this->endsection() ?>