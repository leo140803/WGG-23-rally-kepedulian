<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?= $title ?> </title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

  <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

  </br>

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



  <section class="my-4">
    <div class="px-5 container-fluid table-responsive-md">
      <table id="example" class="table table-striped dataTable no-footer" style="width:100%">
        <thead>
          <tr>
            <th>NRP</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Deskripsi</th>
            <th>Status</th>
            <th>Aksi</th>

          </tr>
        </thead>

        <tbody>
          <?php foreach ($data_absen as $arr) { ?>
            <tr>
              <td> <?= htmlspecialchars($arr->nrp) ?> </td>
              <td> <?= htmlspecialchars($arr->nama) ?> </td>
              <td> <?= htmlspecialchars($arr->tanggal) ?> </td>
              <td> <?= htmlspecialchars($arr->jam_masuk) ?> </td>
              <td> <?= $arr->jam_keluar ?> </td>
              <td> <?= htmlspecialchars($arr->deskripsi) ?> </td>
              <td> <?= $arr->status ?> </td>
              <td>
                <a href="<?= site_url('panitia/datapoli/sunting/' . $arr->id) ?>" class="btn btn-secondary btn-sm mb-2 mt-2">Edit</a>

                <button name="hapus_data" class="hapus_data btn btn-danger btn-sm mb-2 mt-2" value="ya">Hapus</button>
                <?= form_open(site_url('panitia/datapoli/hapus/' . htmlspecialchars($arr->id)), ['class' => 'confirmdelete', 'method' => 'post']) ?>
                <input type="hidden" name="_method" value="DELETE">

                <?= form_close() ?>
              </td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>


  <script>
    $(document).ready(function() {
      $('#example').on('click', '.hapus_data', function() {
        
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $(this).siblings('.confirmdelete').submit();
            Swal.fire(
              'Deleted!',
              'Your data has been deleted.',
              'success'
            )
          }
        })
      })
      $('#example').DataTable();
    });

    $('#example').dataTable({
      "ordering": false
    });
  </script>

</body>

</html>