<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>

<style>
        /* body { 
            background-image: url("") no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        } */
        .exit{
            width: 4vw;
            margin-left: 6vw;
            z-index: 2;
            position: absolute;
            top: 2vh;
        }
        .exit:hover{
           filter: drop-shadow( 0 0 5px rgba(255, 255, 255, 0.753));
        }
        .panah{
            position: absolute;
            z-index: 1;
            height: 10vh;
            filter: invert(82%) sepia(25%) saturate(361%) hue-rotate(355deg) brightness(106%) contrast(95%) 
            drop-shadow( 0 0 5px rgba(255, 255, 255, 0.753));
            height: 3%;
        }
        .panah-1{
            rotate: 345deg;
            margin-left: 36vw;
            margin-top: 67vh;
        }
        .panah-2{
            rotate: 60deg;
            margin-left: 22vw;
            margin-top: 55vh;
        }
        .panah-3{
            rotate: 147deg;
            margin-left: 25vw;
            margin-top: 26vh;
        }
        .panah-4{
            rotate: 179deg;
            margin-left: 40vw;
            margin-top: 18vh;
        }
        .panah-5{
            rotate: 140deg;
            margin-left: 53vw;
            margin-top: 10vh;
        }
        .panah-6{
            rotate: 205deg;
            margin-left: 69vw;
            margin-top: 10vh;
        }
        .huruf{
            position: absolute;
            color: white;
            font-weight: bold;
        }
        .huruf-1{
            margin-top: 66vh;
            margin-left: 43vw;
        }
        .huruf-2{
            margin-top: 72vh;
            margin-left: 29vw;
        }
        .huruf-3{
            margin-top: 43vh;
            margin-left: 19vw;
        }
        .huruf-4{
            margin-top: 28vh;
            margin-left: 31vw;
        }
        .huruf-5{
            margin-top: 29vh;
            margin-left: 50vw;
        }
        .huruf-6{
            margin-top: 12vh;
            margin-left: 60vw;
        }
        .huruf-7{
            margin-top: 36vh;
            margin-left: 80vw;
        }

        .line {
        width: 100%;
        height: 2px;
        position: absolute;
        overflow: hidden;
        }

        .line::before {
        content: "";
        display: block;
        width: 100%;
        height: 100%;
        background-color: #F8E2B3;
        position: absolute;
        animation: moveLine 1s linear infinite;
        }

        @keyframes moveLine {
            0% {
                left: 100%;
            }
            100% {
                left: -100%;
            }
        }
        .line-1{
            transform: rotate(344.5deg);
            margin-left: 29vw;
            margin-top: 65vh;
            width: 14%;
        }
        .line-2{
            transform: rotate(344.5deg);
            margin-left: 29vw;
            margin-top: 65vh;
            width: 14%;
        }
        .line-3{
            transform: rotate(344.5deg);
            margin-left: 29vw;
            margin-top: 65vh;
            width: 14%;
        }
        .line-4{
            transform: rotate(344.5deg);
            margin-left: 29vw;
            margin-top: 65vh;
            width: 14%;
        }
        .line-5{
            transform: rotate(344.5deg);
            margin-left: 29vw;
            margin-top: 65vh;
            width: 14%;
        }
        .line-6{
            transform: rotate(344.5deg);
            margin-left: 29vw;
            margin-top: 65vh;
            width: 14%;
        }

        #garis{
            position: absolute;
            top: 30px;
            left: 250px;            
        }
        #bg{
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            object-fit: cover;
        }
    </style>

<?=$this->renderSection('css')?>

<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>
    <video autoplay muted loop id="bg"> 
        <source src="<?= site_url("/assets/images/rotasi/animasi_rotasi.mp4"); ?>" type="video/mp4">
    </video>
    <div>
        <a href="<?= site_url("games") ?>">
            <img src="<?= site_url("/assets/images/rotasi/exit.png"); ?>" alt="exit" class="exit">
        </a>
            
        <label class="huruf-1 huruf"><?= esc($ruang1); ?></label>
        <label class="huruf-2 huruf"><?= esc($ruang2); ?></label>
        <label class="huruf-3 huruf"><?= esc($ruang3); ?></label>
        <label class="huruf-4 huruf"><?= esc($ruang4); ?></label>
        <label class="huruf-5 huruf"><?= esc($ruang5); ?></label>
        <label class="huruf-6 huruf"><?= esc($ruang6); ?></label>
        <label class="huruf-7 huruf"><?= esc($ruang7); ?></label>

        <img src="<?= site_url('/assets/images/rotasi/panah1.png'); ?>" alt="panah" class="panah-1 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah1.png'); ?>" alt="panah" class="panah-2 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah1.png'); ?>" alt="panah" class="panah-3 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah1.png'); ?>" alt="panah" class="panah-4 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah1.png'); ?>" alt="panah" class="panah-5 panah">
        <img src="<?= site_url('/assets/images/rotasi/panah1.png'); ?>" alt="panah" class="panah-6 panah">

        <!-- <div class="line-1 line"></div>
        <div class="line-2 line"></div>
        <div class="line-3 line"></div>
        <div class="line-4 line"></div>
        <div class="line-5 line"></div>
        <div class="line-6 line"></div> -->

        <svg width="836" height="407" viewBox="0 0 836 407" fill="none" xmlns="http://www.w3.org/2000/svg%22%3E
<path d="M315.36 352.692L219.817 378.346L124.273 404L3 209.322L156.301 112.529H409.644L543.512 3L835 139.82" stroke="#F8E2B3" stroke-width="4"/>
</svg>
    </div>

<?=$this->renderSection('content')?>
<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>// Query DOM Elements
const svg = document.querySelector('svg');
const fuse = svg.querySelector('.fuse');

// Create an object that gsap can animate
const val = { distance: 0 };
// Create a tween
gsap.to(val, {
  // Animate from distance 0 to the total distance
  distance: fuse.getTotalLength(),
  // Loop the animation
  repeat: -1,
  // Wait 1sec before repeating
  repeatDelay: 1,
  // Make the animation lasts 5 seconds
  duration: 5,
  // Function call on each frame of the animation
  onUpdate: () => {
    // Query a point at the new distance value
    const point = fuse.getPointAtLength(val.distance);
    createParticle(point);
  }
});

function createParticle (point) {
  // Create a new circle element
  const circle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
  // Prepend the element to the SVG
  svg.prepend(circle);
  // Set the coordinates of that circle
  circle.setAttribute('cx', point.x);
  circle.setAttribute('cy', point.y);
  // Define a random radius for each circle
  circle.setAttribute('r', (Math.random() * 2) + 0.2);
  // Define a random color
  circle.setAttribute('fill', gsap.utils.random(['#ff0000', '#ff5a00', '#ff9a00', '#ffce00', '#ffe808']));
  
  // Animate the circle
  gsap.to(circle, {
    // Random cx based on its current position
    cx: '+=random(-20,20)',
    // Random cy based on its current position
    cy: '+=random(-20,20)',
    // Fade out
    opacity: 0,
    // Random duration for each circle
    duration: 'random(1, 2)',
    // Prevent gsap from rounding the cx & cy values
    autoRound: false,
    // Once the animation is complete
    onComplete: () => {
      // Remove the SVG element from its parent
      svg.removeChild(circle);
    }
  });
}

/* Animate the fuse to reduce it */
fuse.setAttribute('stroke-dasharray', fuse.getTotalLength());
fuse.setAttribute('stroke-dashoffset', fuse.getTotalLength() * 2);
gsap.to(fuse, {
  strokeDashoffset: fuse.getTotalLength(),
  duration: 5,
  repeat: -1,
  // Wait 1sec before repeating
  repeatDelay: 1
});

let width=(1161/1920)*window.innerWidth;
let height=(556/1080)*window.innerHeight;
svg.style.width=width;
svg.style.height=height;

// let left=(317/1517)*window.innerWidth;
// let top=(37/694)*window.innerHeight;
// svg.style.left=left;
// svg.style.top=top;
</script>
<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>