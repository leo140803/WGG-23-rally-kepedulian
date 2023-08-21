<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Ruangan Kelompok </title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    .bootstrap-select>.dropdown-toggle {
            height: 100% !important;
        }
    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .container {
      max-width: 700px;
      width: 100%;
      background-color: #fff;
      padding: 25px 30px;
      border-radius: 5px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    }

    .container .title {
      font-size: 25px;
      font-weight: 500;
      position: relative;
    }

    .container .title::before {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      height: 3px;
      width: 30px;
      border-radius: 5px;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .content form .user-details {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin: 20px 0 12px 0;
    }

    form .user-details .input-box {
      margin-bottom: 15px;
      width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
      display: block;
      font-weight: 500;
      margin-bottom: 5px;
    }

    .user-details .input-box input {
      height: 45px;
      width: 100%;
      outline: none;
      font-size: 16px;
      border-radius: 5px;
      padding-left: 15px;
      border: 1px solid #ccc;
      border-bottom-width: 2px;
      transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid {
      border-color: #9b59b6;
    }

    form .gender-details .gender-title {
      font-size: 20px;
      font-weight: 500;
    }

    form .category {
      display: flex;
      width: 80%;
      margin: 14px 0;
      justify-content: space-between;
    }

    form .category label {
      display: flex;
      align-items: center;
      cursor: pointer;
    }

    form .category label .dot {
      height: 18px;
      width: 18px;
      border-radius: 50%;
      background: #d9d9d9;
      border: 5px solid transparent;
      transition: all 0.3s ease;
    }

    #dot-1:checked~.category label .one,
    #dot-2:checked~.category label .two,
    #dot-3:checked~.category label .three {
      background: #9b59b6;
      border-color: #d9d9d9;
    }

    form input[type="radio"] {
      display: none;
    }

    form .button {
      height: 45px;
      margin: 35px 0
    }

    form .button input {
      height: 100%;
      width: 100%;
      border-radius: 5px;
      border: none;
      color: #fff;
      font-size: 18px;
      font-weight: 500;
      letter-spacing: 1px;
      cursor: pointer;
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    form .button input:hover {
      /* transform: scale(0.99); */
      background: linear-gradient(-135deg, #71b7e6, #9b59b6);
    }

    @media(max-width: 584px) {
      .container {
        max-width: 100%;
      }

      form .user-details .input-box {
        margin-bottom: 15px;
        width: 100%;
      }

      form .category {
        width: 100%;
      }

      .content form .user-details {
        max-height: 300px;
        overflow-y: scroll;
      }

      .user-details::-webkit-scrollbar {
        width: 5px;
      }
    }

    @media(max-width: 459px) {
      .container .content .category {
        flex-direction: column;
      }
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

</head>

<body>
<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= site_url('panitia/games/rotasi') ?>">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= site_url('panitia/games/rotasi/add') ?>">Add Rotasi</a>
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

  <div class="container">
    <div class="title">Add Ruangan Kelompok</div>
    <br>

    <?php
    if (session()->has('msg_success'))
      echo '<div class="alert alert-success">' . session()->getFlashdata('msg_success') . '</div>';

    if (session()->has('error_val'))
      echo '<div class="alert alert-danger">' . session()->getFlashdata('error_val')['idKelompok'] . '</div>';
    ?>


    <div class="content">
      <!-- <form action="" method="post"> -->
      <div class="user-details">
        <div class="input-box">
          <?= form_open(site_url('panitia/games/rotasi/add'), ['id' => 'formtambahdata', 'method' => 'post']) ?>
          <span class="details">Nama Kelompok</span>
          <select class="form-control" id="idKelompok" name="idKelompok" data-live-search="true" data-size="5" required>
            <?php foreach ($kelompok as $k) : ?>
                <option value="<?= $k->id ?>" data-tokens="<?= $k->nama ?>"><?= $k->nama ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="input-box">
          <span class="details">Ruangan 1</span>
          <input type="text" name="ruang1" placeholder="Ex: P.202" required>
        </div>
        <div class="input-box">
          <span class="details">Ruangan 2</span>
          <input type="text" name="ruang2" placeholder="Ex: P.202" required>
        </div>
        <div class="input-box">
          <span class="details">Ruangan 3</span>
          <input type="text" name="ruang3" placeholder="Ex: P.202" required>
        </div>
        <div class="input-box">
          <span class="details">Ruangan 4</span>
          <input type="text" name="ruang4" placeholder="Ex: P.202" required>
        </div>
        <div class="input-box">
          <span class="details">Ruangan 5</span>
          <input type="text" name="ruang5" placeholder="Ex: P.202" required>
        </div>
        <div class="input-box">
          <span class="details">Ruangan 6</span>
          <input type="text" name="ruang6" placeholder="Ex: P.202" required>
        </div>
        <div class="input-box">
          <span class="details">Ruangan 7</span>
          <input type="text" name="ruang7" placeholder="Ex: P.202" required>
        </div>
      </div>

      </br>


      <div class="button">
        <button class="btn btn-primary" type="submit" name="submit">submit</button>
        <?= form_close() ?>
      </div>
      <!-- </form> -->
    </div>
  </div>

</body>
<script>
  $(document).ready(function() {
    $('#idKelompok').selectpicker();
  });
</script>
</html>