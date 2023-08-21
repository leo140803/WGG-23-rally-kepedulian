<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka One">
<style>

body {
  background-image: url("<?= site_url("assets/images/bg.webp") ?>");
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  background-position: top;
  overflow-y: hidden;
  overflow: hidden;
  min-height: 100vh;
  padding-top: 5rem;
}

@media (max-width: 768px) {
  body {
    background-image: url(<?= site_url("assets/images/bg-portrait.webp") ?>);
    background-repeat: no-repeat;
    background-position: top;
    background-size: cover;
    background-attachment: fixed;
  }
}

.center {
  text-align: center;
}

.text-line text {
    fill: rgba(0, 0, 0, 0);
    font-family: Fredoka One; 
    stroke-dasharray: 500;
    stroke-dashoffset: 500;
    animation: dash 20s linear infinite, filling 20s ease-in infinite;
    animation-delay: 5s, 5s;
    font-size: 8vw;
    letter-spacing: 0.6vw;
}

.text-line {
  font-family: Fredoka One; 
  color: #fffcc0;
}

@keyframes dash {
  0% {
    stroke-dashoffset: 500;
  }
  20%, 60% {
    stroke-dashoffset: 0;
  }
  80%, 100% {
    stroke-dashoffset: 500;
  }
}

@keyframes filling {
    0% {
        fill: #fffcc0;
        fill-opacity: 0;
    }
    20%, 60% {
      fill: #fffcc0;
      fill-opacity: 1;
    }
    80%, 100% {
      fill: #fffcc0;
      fill-opacity: 0;
    }
}

</style>

<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>

<div class="center">
    <svg height="200" width="100%" stroke="#fffcc0" stroke-width="2" class="text-line">
        <text style="font-weight: bold; font-style: normal;" x="50%" dominant-baseline="middle" text-anchor="middle" y="50%">COMING SOON</text>
    </svg>
</div>

<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>


<?= $this->endSection('script') ?>