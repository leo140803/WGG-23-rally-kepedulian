<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <style>
        /* body {
            background-color: #3ded97;
        } */

        .judul {
            margin-top: 50px;
            margin-bottom: 30px;
            text-align: center;
            font-size: 40px;
        }

        #kelompok th,
        #kelompok td {
            border-color: #000;
        }

        #kelompok_filter label input[type="search"] {
            background-color: #fff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: #fff !important;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 55px;
            display: inline-block;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            padding: 0.5rem;
            font-weight: bold;
        }

        .button {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
        }

        .save-button {
            margin-left: auto;
        }
    </style>

</head>

<body>
    <?php include_once("kelompok_navbar.php"); ?>
    <div>
        <h1 class="judul">Tabel Kelompok</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="button">
                    <?= form_open(site_url('panitia/kelompok/ruangan/editShowHide'), ['method' => 'post']) ?>
                    <button id="toggleButton" class="btn btn-info hide-button">
                        Hide/Show
                    </button>
                    <p>Button untuk menghide/show ruangan maba</p>
                    <?= form_close() ?>
                    <?php if ($ruanganHidden == 0): ?>
                        <span>Current Status: Hidden</span>
                    <?php else: ?>
                        <span>Current Status: Shown</span>
                    <?php endif; ?>
                </div>
                <?= form_open(site_url('panitia/kelompok/ruangan/editRuang'), ['method' => 'post']) ?>
                <button type="submit" name="update" class="btn btn-primary save-button"
                    style="margin-bottom: 10px;">Save
                    Selection</button>

                <table id="kelompok" class="table table-striped table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Ruangan</th>
                            <th>Jumlah Anggota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kelompok as $row): ?>
                            <tr>
                                <td>
                                    <?= $row['nama'] ?>
                                </td>
                                <td>
                                    <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                                    <select name="ruangan[]" class="" data-live-search="true">
                                        <option disabled value="-" <?= ($row['ruangan'] === null) ? 'selected' : '' ?>>-</option>
                                        <?php foreach ($ruangan as $ruanganRow): ?>
                                            <?php $selected = ($ruanganRow['id'] == $row['ruangan']) ? 'selected' : ''; ?>
                                            <option value="<?= $ruanganRow['id'] ?>" <?= $selected ?>>
                                                <?= $ruanganRow['ruangan'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <?php foreach ($jumlah_mahasiswa as $jmlh): ?>
                                        <?php if ($jmlh['nama_kelompok'] === $row['nama']): ?>
                                            <?= $jmlh['jumlah_mahasiswa'] ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= form_close() ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('select').selectpicker();
            $('#kelompok').DataTable();

            <?php if (session()->has('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?= session()->getFlashdata('success') ?>',
                });
            <?php endif ?>
        });
    </script>

</body>

</html>