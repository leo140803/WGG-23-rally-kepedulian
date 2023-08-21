<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title> Ruangan Kelompok </title>
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

  <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      width: 100%;
      height: auto;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .container {
      width: 90vw;
      background-color: #fff;
      padding: 2%;
      border-radius: 7px;
      box-shadow: 0 5px 30px rgba(0, 0, 0, 0.5);
    }

    .btn-light {
      margin-top: 5vh;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
      font-weight: 500;
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

  <div class="container content my-4">
    <div class="title">View Ruangan Kelompok</div>
    </br>
    
    <script>
      new DataTable('#listkelompok')
    </script>
    <div class="px-5 container-fluid table-responsive-md">
      <table id="listkelompok" class="table table-striped dataTable no-footer" style="width:100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama kelompok</th>
            <th>ruang 1</th>
            <th>ruang 2</th>
            <th>ruang 3</th>
            <th>ruang 4</th>
            <th>ruang 5</th>
            <th>ruang 6</th>
            <th>ruang 7</th>
            <th>aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php 
            $i = 1;
            foreach ($rotasi as $arr) {
          ?>
            <tr>
              <td> <?= $i ?></td>
              <td> <?= htmlspecialchars($arr->nama) ?> </td>
              <td> <?= htmlspecialchars($arr->ruang1) ?> </td>
              <td> <?= htmlspecialchars($arr->ruang2) ?> </td>
              <td> <?= htmlspecialchars($arr->ruang3) ?> </td>
              <td> <?= htmlspecialchars($arr->ruang4) ?> </td>
              <td> <?= htmlspecialchars($arr->ruang5) ?> </td>
              <td> <?= htmlspecialchars($arr->ruang6) ?> </td>
              <td> <?= htmlspecialchars($arr->ruang7) ?> </td>
              <td>
                <a href="<?= site_url('panitia/games/rotasi/edit/' . $arr->id) ?>" class="btn btn-secondary btn-sm mb-2 mt-2">Edit</a>


                <button name="hapus_data" class="hapus_data btn btn-danger btn-sm mb-2 mt-2" value="ya">Delete</button>
                <?= form_open(site_url('panitia/games/rotasi/delete/' . htmlspecialchars($arr->id)), ['class' => 'confirmdelete', 'method' => 'post']) ?>
                <input type="hidden" name="_method" value="DELETE">
                <?= form_close() ?>
              </td>
            <?php 
              $i++;
            }?>

            </tr>
        </tbody>

      </table>
    </div>
  </div>
  <a href="<?= site_url('panitia/games/rotasi/add') ?>" class="btn btn-primary">Add Rotasi</a>


  <script>
    $(document).ready(function() {
      $('#listkelompok').on('click', '.hapus_data', function() {

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
      $('#listkelompok').DataTable();
    });

    $('#listkelompok').dataTable({
      "ordering": true
    });
  </script>


</body>

</html>