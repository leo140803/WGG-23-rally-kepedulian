<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah ayat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    /* .inputBox {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .text {
      padding: 10px 0px 0px 10px;
      /* atas kanan bawah kiri */
    /* }

    .submitButton {
      transform: translate(+20%, +0%);
    } */ 


  </style>

</head>

<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= site_url('/panitia')?>">
            <img src="<?= site_url('assets/images/wgg.png')?>" width="auto" height="35" class="d-inline-block align-top" alt="">
            Panitia WGG 2023
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran/TambahPasal") ?>">Tambah Pasal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= site_url("/panitia/pelanggaran/TambahAyat") ?>">Tambah Ayat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran/TambahPelanggaran") ?>">Tambah Pelanggaran</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran/list") ?>">Data Ayat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran/pasalList") ?>">Data Pasal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran/akumulasiPoin") ?>">Akumulasi Poin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php if (session()->has('msg_success')) { ?>
    <script>Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Sukses menambah data',
      })
    </script>
  <?php } elseif (session()->has('msg_unsuccess')) { ?>
    <script>
      swal.fire({
        icon: 'warning',
        title: 'Failed!',
        text: 'Gagal menambah data',
      })
    </script>
  <?php } ?>

  <div class="inputBox d-flex justify-content-center align-items-center mt-5 pt-5">
    <?= form_open(site_url("/panitia/pelanggaran/TambahAyat")); ?>
    <!-- <div class="text">
      <label> Masukkan Keterangan Ayat: </label>
      <label> Pilih Pasal: </label>
      <label> Memiliki sistem Tegur?: </label>
    </div> -->

    <div class="input">
      <label> Masukkan Keterangan Ayat: </label>
      <input type="text" name="keteranganAyat" class="form-control mb-3" required>
      <label> Pilih Pasal: </label>
      <select name="pasalAyat" class="form-select mb-3" required>
        <option disabled selected value="">Pasal</option>
        <?php foreach ($dataPasal as $pasal): ?>
          <option value="<?php echo htmlspecialchars($pasal->Bab),
           "|",
           htmlspecialchars($pasal->id); ?>">
            <?php
            echo htmlspecialchars($pasal->Bab), ". ";
            echo htmlspecialchars($pasal->Keterangan);
            ?>
          </option>
        <?php endforeach ?>
        </select>
      <label> Memiliki sistem Tegur? </label>
      <select name="sistemTegur" class="form-select mb-3" required>
        <option disabled selected value="">Memiliki Teguran?</option>
        <option value="0">Tidak</option>
        <option value="1">Ya</option>
      </select>
    </div>

    <div class="submitButton d-flex justify-content-center pt-3 pb-3">
      <button type="submit" class="btn btn-primary">Tambah data</button>
    </div>

    <?= form_close() ?>
  </div>
</body>

</html>