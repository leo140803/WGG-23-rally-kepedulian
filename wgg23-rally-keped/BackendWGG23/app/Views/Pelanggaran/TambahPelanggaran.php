<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input pelanggaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

  <style>

    /* .inputBox {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-15%, -55%);
      height: 200px;
      width: 50%;
    }

    .text {
      padding: 10px 0px 0px 10px;
      /* atas kanan bawah kiri */
    /* } */

    /* .submitButton {
      transform: translate(5%, +0%);
    } */

    /* .tabelAdmin{
      transform: translate(-17%, +0%);
      width: 50%;
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
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran//TambahPasal") ?>">Tambah Pasal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= site_url("/panitia/pelanggaran//TambahAyat") ?>">Tambah
              Ayat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= site_url("/panitia/pelanggaran//TambahPelanggaran") ?>">Tambah
              Pelanggaran</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran//list") ?>">Data Ayat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran//pasalList") ?>">Data Pasal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url("/panitia/pelanggaran//akumulasiPoin") ?>">Akumulasi Poin</a>
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
  <?php } elseif (session()->has('msg_panitiaNotFound')) { ?>
    <script>
      swal.fire({
        icon: 'warning',
        title: 'Failed!',
        text: 'NRP Panitia Tidak Ditemukan!',
      })
    </script>
  <?php } ?>

  <div class="inputBox d-flex justify-content-center align-items-center mt-5 ">
    <?= form_open(site_url("/panitia/pelanggaran/TambahPelanggaran")); ?>
    <div class="input">
      <div class="row">
        <div class="col-md-6">
          <label style="width: 300px"> Masukkan NRP Mahasiswa: </label>
          <input type="text" name="nRPMahasiswa" id="nRPMahasiswa" class="form-control mb-3" required>
        </div>
        <div class="col-md-6">
          <label> Pasal yang dilanggar: </label>
          <select name="pasalTerlanggar" id="pasalTerlanggar" class="form-select mb-3" required>
            <option value="">Pasal</option>
            <?php foreach ($dataPasal as $pasal): ?>
              <option value="<?php echo htmlspecialchars($pasal->id) ?>">
                <?php
                echo htmlspecialchars($pasal->Bab), ". ";
                echo htmlspecialchars($pasal->Keterangan);
                ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label> Tanggal Melanggar: </label>
          <input type="date" name="tanggalMelanggar" class="form-control mb-3" required>
        </div>

        <div class="col-md-6">
          <label> Ayat yang dilanggar: </label>
          <select name="AyatTerlanggar" id="pilihAyat" class="form-select mb-3" required>
            <option value="">Ayat</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <label> Skip Teguran? </label>
          <input type="checkbox" name="skipPeringatan">
        </div>
        <div class="col-md-6">
          <label> Keterangan: </label>
          <input type="text" name="keterangan" class="form-control mb-3" required>
        </div>
      </div>
    </div>

    <div class="submitButton d-flex justify-content-center pt-3 pb-3">
      <button type="submit" class="btn btn-primary">Tambah data</button>
    </div>
    <?= form_close() ?>
  </div>

  </div>

  <div class="mb-4 mx-1 mx-sm-auto" style="max-width: 900px">
    <div class="table-responsive" style="">
      <table class="display w-100" id="tbl">
        <thead>
          <tr>
            <th scope="col">NRP</th>
            <th scope="col">Nama</th>
            <th scope="col">Jurusan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <span id="nrpValue">
                <?= "" ?>
              </span>
            </td>
            <td>
              <span id="namaValue">
                <?= "" ?>
              </span>
            </td>
            <td>
              <span id="jurusanValue">
                <?= "" ?>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      var dataTable = $('#tbl').DataTable({
        "pageLength": 1,
        "lengthChange": false,
        "dom": "lrtip", //hide search bar
        "info": false,
        "paging": false
      });
      // dataTable.search('baju').draw();
    });
  </script>
  <script>
    $('#nRPMahasiswa').on('keyup', (event) => {
      const nrp = $('#nRPMahasiswa').val();
      $.ajax({
        url: '<?= site_url('/panitia/pelanggaran/TambahPelanggaran/getMahasiswa') ?>' + nrp,
        method: 'GET',
        success: function (response) {
          $('#nrpValue').text(response.nrp);
          $('#namaValue').text(response.nama);
          $('#jurusanValue').text(response.jurusan);
        }
      })
    })
  </script>

  <script>
    var ayatDropdown = document.getElementById("pilihAyat");
    $('#pasalTerlanggar').on('change', (event) => {
      const bab = $('#pasalTerlanggar').val();
      $.ajax({
        url: '<?= site_url('/panitia/pelanggaran/TambahPelanggaran/getAyat') ?>' + bab,
        method: 'GET',
        success: function (response) {
          console.log(response);
          ayatDropdown.innerHTML = "";
          response.dataAyat.forEach(ayat => {
            if (ayat.deleted_at == null) {
              var option = document.createElement("option");
              option.value = ayat.ID + "|" + ayat.Pasal + "|" + ayat.sistemTegur + "|" + ayat.idPasal;
              console.log(option.value);
              option.text = ayat.Pasal + ". " + ayat.Keterangan;
              ayatDropdown.appendChild(option);
            }
          });
        }
      })
    })
  </script>

</body>
</html>