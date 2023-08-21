<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akumulasi Poin</title>
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
            <a class="nav-link active" href="<?= site_url("/panitia/pelanggaran/akumulasiPoin") ?>">Akumulasi Poin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<script>
  $(document).ready( function () {
    $('#tbl').DataTable({
    });
} );
</script>

  <div class="mt-4 pt-2 mx-1 mx-md-3 mx-lg-4 mx-xl-5 px-xl-5">
    <div class="tabelAdmin table-responsive">
      <table class="display" id="tbl">
        <thead>
          <tr>
            <th scope="col">NRP</th>
            <th scope="col">Nama Mahasiswa</th>
            <th scope="col">Akumulasi Poin</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $nrpTerpakai = [];
          foreach ($pelanggaranJoined as $pelanggaran):
          if(!in_array($pelanggaran->nrp, $nrpTerpakai)):
          ?>
          <tr>
              <?php array_push($nrpTerpakai, $pelanggaran->nrp) ?>
              <td>
              <?= htmlspecialchars($pelanggaran->nrp) ?>
              </td>
              <td>
                  <?= htmlspecialchars($pelanggaran->nama) ?>
              </td>
              <td>
              <?php
                echo htmlspecialchars($pelanggaran->akumulasi);
              ?>
              </td>
              <td>
              <a href="<?= site_url('/panitia/pelanggaran/detailSpesifik' . $pelanggaran->nrp) ?>" class="btn btn-secondary btn-sm">Detail</a>
              </td>
          </tr>
          <?php endif ?>
          <?php endforeach ?>
          <?php
          foreach ($peringatanJoined as $peringatan):
          $akumulasiPoin = 0;
          if(!in_array($peringatan->nrp, $nrpTerpakai)):
          ?>
          <tr>
              <?php array_push($nrpTerpakai, $peringatan->nrp) ?>
              <td>
              <?= htmlspecialchars($peringatan->nrp) ?>
              </td>
              <td>
                  <?= htmlspecialchars($peringatan->nama) ?>
              </td>
              <td>
              <?php
                echo htmlspecialchars(0);
              ?>
              </td>
              <td>
              <a href="<?= site_url('/panitia/pelanggaran/detailSpesifik' . $peringatan->nrp) ?>" class="btn btn-secondary btn-sm">Detail</a>
              </td>
          </tr>
          <?php endif ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>