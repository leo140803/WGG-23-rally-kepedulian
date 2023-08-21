<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?= $title ?> </title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Menu</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= site_url('panitia/datapoli') ?>">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('panitia/datapoli/tambahData') ?>">Regist In</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('panitia/datapoli/outpoli') ?>">Regist Out</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <style>
    .bg-body-primary {
      background-color: blue;
    }

    .navbar a.active {
      color: yellow !important;
    }

    .navbar a {
      color: #fff;
    }
  </style>


  <div class="container-md">
    <br>
    <h1>Edit Data</h1>

    <?php
    $error = session()->has('error_val');
    $error_val = session()->getFlashdata('error_val');

    if (session()->has('msg_success'))
      echo '<div class="alert alert-success">' . session()->getFlashdata('msg_success') . '</div>';

    if (session()->has('error_outpoli'))
      echo '<div class="alert alert-danger">' . session()->getFlashdata('error_outpoli') . '</div>';
    ?>


    <div class="mt-4 mb-3 col-md-8">

      <?php if (!$fetch_data) : ?>

        <div class="alert alert-danger">
          Data NRP tidak tersedia di dalam database.
        </div>


      <?php else : ?>

        <?= form_open('', ['id' => 'nrp', 'method' => 'post']) ?>
        <div class="col-md-7">
          <label class="form-label">NRP</label>
          <input type="text" value="<?= htmlspecialchars($fetch_data->nrp) ?>" disabled name="nrp" placeholder="Masukkan NRP" class="form-control<?= $error && !empty($error_val['nrp']) ? ' is-invalid' : '' ?>">
        </div>
        </br>


        <div class="col-md-7">
          <label class="form-label" for="textareadeskripsi">Deskripsi</label>
          <textarea class="form-control" value="<?= htmlspecialchars($fetch_data->deskripsi) ?>" name="deskripsi" id="textareadeskripsi" rows="5"><?= htmlspecialchars($fetch_data->deskripsi) ?></textarea>
        </div>
        </br>

        <div class="col-md-7">
          <label for="inputStatus" class="form-label">Status</label>
          <select id="inputStatus" name="inputStatus" class="form-select" aria-label="Pilih Status">
            <option selected><?= htmlspecialchars($fetch_data->status) ?></option>
            <option value="Di poli">Di poli</option>
            <option value="Dipulangkan">Dipulangkan</option>
            <option value="Keluar poli">Keluar poli</option>
          </select>
        </div>
        </br>

        <div class="col-md-7">
          <label class="form-label">Tanggal</label>
          <input class="form-control" type="date" value="<?= htmlspecialchars($fetch_data->tanggal) ?>" name="tanggal" placeholder="yyyy-mm-dd">
        </div>
        </br>

        <div class="col-md-7">
          <label class="form-label">Jam masuk</label>
          <input step="1" class="form-control" type="time" value="<?= htmlspecialchars($fetch_data->jam_masuk) ?>" name="jammasuk" placeholder="hh:mm:ss">
        </div>
        </br>

        <div class="col-md-7">
          <label class="form-label">Jam keluar</label>
          <input step="1" class="form-control" type="time" value="<?= $fetch_data->jam_keluar ?>" name="jamkeluar" placeholder="hh:mm:ss">
        </div>
        </br>


        <input type="hidden" name="_method" value="PUT">
        <button class="btn btn-primary col-md-4" name="submit" value="ya">Update</button>
        <?= form_close() ?>
        </br>

        <?= form_open(site_url('panitia/datapoli/absenkeluar'), ['method' => 'post']) ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($fetch_data->id) ?>">
        <button name="absenkeluar" value="ya" class="btn btn-secondary col-md-4">Absenkan Out</button>
        <?= form_close() ?>

      <?php endif ?>
    </div>
  </div>



</body>

</html>