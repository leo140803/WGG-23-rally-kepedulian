<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?= $title ?> </title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
    <h1>Regist Out</h1>

    <!-- Error NRP tidak ada -->
    <?php if (session()->has('error_nrp'))
      echo '<div class="alert alert-danger">' . session()->getFlashdata('error_nrp') . '</div>';
    ?>


    <?php
    $error = session()->has('error_val');
    $error_val = session()->getFlashdata('error_val');

    if (session()->has('msg_success'))
      echo '<div class="alert alert-success">' . session()->getFlashdata('msg_success') . '</div>';
    ?>


    <div class="mt-4 mb-3 col-md-8">

      <?= form_open('', ['id' => 'formtambahdata', 'method' => 'post']) ?>
      <div class="col-md-7">
        <label class="form-label">NRP</label>
        <input type="text" autofocus="true" onkeydown="prevententer()" name="nrp" id="nrp" placeholder="Masukkan NRP" class="form-control<?= $error && !empty($error_val['nrp']) ? ' is-invalid' : '' ?>">
        <?php if ($error && !empty($error_val['nrp'])) : ?>
          <div class="invalid-feedback">
            <?= $error_val['nrp'] ?>
          </div>
        <?php endif ?>
        </br>

        <?php
        $myresponse = session()->get('response')
        ?>
      </div>

      <div class="col-md-7">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control" readonly>
        </br>
      </div>


      <div class="row g-2 mt-2">
        <div class="mt-2 col-md-5">
          <button class="btn btn-secondary col-md-5" name="absenout" value="ya">Absenkan Out</button>
        </div>
        <?= form_close() ?>

        <?= form_open('panitia/datapoli/redirtoupdate', ['method' => 'post']) ?>
        <div class="mt-2 col-md-5">
          <input type="hidden" name="nrp" id='nrp_edit' value="">
          <button class="btn btn-primary col-md-5" name="sunting" value="ya">Edit Data</button>
        </div>
        <?= form_close() ?>
      </div>


    </div>
  </div>

  


  <script>
    $('#nrp').on('keyup', (event) => {
      //cara dapet inputan (php = getVar())
      nrp = $('#nrp').val();
      csrf_token = $(`input[name=<?= csrf_token() ?>]`).val();

      $('#nrp_edit').val(nrp);

      $.ajax({
        url: '<?= site_url('panitia/datapoli/fillnama') ?>',
        method: 'POST',
        data: {
          'varianenerpe': nrp,
          <?= csrf_token() ?>: csrf_token
        },
        success: function(response) {
          $(`input[name=<?= csrf_token() ?>]`).val(response.csrf);
          $('#nama').val(response.setnama);
        }
        //isi response = JSON
      })
    });
  </script>


  <script>
    function prevententer() {
      $(document).ready(function() {
        $(window).keydown(function(event) {
          if (event.keyCode == 13) {
            event.preventDefault();
            return false;
          }
        });
      });
    }
  </script>

</body>

</html>