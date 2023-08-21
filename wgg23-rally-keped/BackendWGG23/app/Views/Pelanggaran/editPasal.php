<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit pasal</title>
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
     
    }

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
            <a class="nav-link active" href="<?= site_url("/panitia/pelanggaran/TambahPasal") ?>">Tambah Pasal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= site_url("/panitia/pelanggaran/TambahAyat") ?>">Tambah Ayat</a>
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
    <?= form_open(site_url("/panitia/pelanggaran/editPasal")); ?>

    <div class="input">
      <label> Bab Pasal: </label>
      
      <input type="text" name="babDisplay" value="<?= $fetch_data->Bab ?>" class="form-control mb-3" disabled>
      <input type="text" name="babPasal" value="<?= $fetch_data->Bab ?>" class="form-control mb-3" hidden>

      
      <label> Masukkan Keterangan Pasal: </label>
      
      <input type="text" name="keteranganPasal" value="<?= $fetch_data->Keterangan ?>" class="form-control mb-3" required>
      
      <label> Masukkan Jumlah Poin: </label>
      
      <input type="text" name="jumlahPoin" value="<?= $fetch_data->JumlahPoin ?>" class="form-control mb-3" required>
      
    </div>

    <div class="submitButton d-flex justify-content-center pt-3 pb-3">
      <button type="submit" class="btn btn-primary">Edit Data</button>
    </div>

    <?= form_close() ?>
  </div>
</body>

</html>