<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data ayat</title>
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
            <a class="nav-link active" href="<?= site_url("/panitia/pelanggaran/list") ?>">Data Ayat</a>
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

<script>
  $(document).ready( function () {
    $('#tbl').DataTable({
    });
});
</script>

  <div class="mt-4 pt-2 mx-1 mx-md-3 mx-lg-4 mx-xl-5 mb-4">
    <div class="table-responsive" style="max-width: 1400px;">
      <table class="display w-100" id="tbl">
        <thead>
          <tr>
            <th scope="col">Pasal</th>
            <th scope="col">Ayat</th>
            <th scope="col">sistem tegur</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dataAyat as $ayat): ?>
            <tr>
              <td>
                <?= htmlspecialchars($ayat->Pasal), ". " ?>
                <?php foreach ($dataPasal as $pasal):
                  if ($ayat->idPasal == $pasal->id) {
                    echo $pasal->Keterangan;
                  }
                  ?>
                <?php endforeach ?>
              </td>
              <td>
                <?= /*htmlspecialchars($ayat->No), ". ",*/ htmlspecialchars($ayat->Keterangan) ?>
              </td>
              <td> <?php
                if($ayat-> sistemTegur == 0){
                  echo htmlspecialchars("Tidak");
                } else {
                  echo htmlspecialchars("Ya");
                }
              ?> </td>
              <td>
                <a href="<?= site_url('/panitia/pelanggaran/edit' . $ayat->ID) ?>" class="btn btn-secondary btn-sm">Edit</a>
                <button name="hapusData" class="hapus_data btn btn-danger btn-sm">Hapus</button>
                <?= form_open(site_url('/panitia/pelanggaran/hapus/' . $ayat->ID),
                              ['class' => 'confirmdelete', 'method' => 'post']
                              ) ?>
                              <input type="hidden" name="_method" value="delete">
                <?= form_close() ?>
                <!-- <a href="<//?= site_url('/panitia/pelanggaran/hapus' . $ayat->ID) ?>" class="btn btn-danger btn-sm">Hapus</a> -->
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <script>
        $(document).ready(function () {
            $('#tbl').on('click', '.hapus_data', function () {
                swal.fire({
                    title: 'Apakah anda yakin?',
                    Text: "Data yang dipilih akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).siblings('.confirmdelete').submit();
                        swal.fire({
                            title: 'Terhapus!',
                            Text: 'Data telah berhasil dihapus',
                            icon: 'success'
                        })
                    }
                })
            })
        });
    </script>

</body>
</html>