<?= $this->extend('data/data_layout'); ?>

<?= $this->section('css') ?>

<?=$this->include('layouts/datatable_css.php')?>

<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">

            <div class="my-5">
                <h1 class="text-center h1">Upload Data Mahasiswa</h1>
            </div>
            
            <?php $success = session('success'); ?>
            <?php if(isset($success) && $success): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div>Success Mengupload File</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php $errors = session('errors') ?>
            <?php if(isset($errors)): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <div>Error: <?= $errors['mahasiswa'] ?></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= form_open_multipart("/panitia/data/mahasiswa/upload", ["class" => "my-5"]) ?>
            
                <div class="input-group mb-4">
                    <input type="file" accept=".csv" class="form-control" id="mahasiswa" name="mahasiswa" onchange="readURL(this)" required>
                    <button class="btn btn-outline-primary" type="submit" id="btn-sumbit">Submit</button>
                </div>

            <?= form_close() ?>
                
            <h5>Ketentuan</h5>
            <ul>
                <li>Format file CSV (Comma delimited) (*.csv)</li>
                <li>Baris pertama berisi judul</li>
                <li>Baris kedua kosong</li>
                <li>Baris ketiga nama kolom</li>
                <li>Data mahasiswa dimulai pada baris keempat dst</li>
                <li>Mempunyai urutan kolom sebagai berikut</li>
                <ul>
                    <li>No</li>
                    <li>NIM</li>
                    <li>Nama</li>
                    <li>Jurusan</li>
                    <li>Kelamin</li>
                    <li>Asal Kota</li>
                    <li>Jaket</li>
                    <li>Muts</li>
                    <li>Agama</li>
                    <li>SMA Asal</li>
                    <li>Email</li>
                    <li>HP</li>
                    <li>PAC ID</li>
                    <li>PAC PASS</li>
                    <li>Dosen Wali</li>
                </ul>
            </ul>

            
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-10">
            
            <div class="my-5">
                <h1 class="text-center h1">Log Upload Data Mahasiswa</h1>
            </div>
            <div class="row mb-4">
                <div class="col-1 col-lg-3"></div>
                <div class="col-10 col-lg-6">
                    <?= form_open(site_url('panitia/data/mahasiswa/upload/api'),['method' => 'post']) ?>
                        <button type="submit" class="btn btn-primary" style="width:100%;">Upload</button>
                    <?= form_close() ?>
                </div>
            </div>
            <table class="table table-striped" id="data">
                <thead>
                    <th>NO</th>
        
                    <?php foreach($logs[0] as $key => $value): ?>
                        <?php if(in_array($key, ['id', 'updated_at', 'deleted_at'])): continue; else: ?>
                            <th> <?= strtoupper($key) ?> </th>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                </thead>
                <tbody>
                    <?php foreach($logs as $i => $log): ?>
                        <tr class="">
                            <td><?= $i+1 ?></td>
        
                            <?php foreach($log as $key => $value): ?>
                                <?php if(in_array($key, ['id', 'updated_at', 'deleted_at'])): continue; else: ?>
                                    <td> <?= $value; ?> </td>
                                <?php endif; ?>
                            <?php endforeach; ?>    
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<?=$this->include('layouts/datatable_script.php')?>

<script>
    $(document).ready( function () {

        $('#data thead th').each(function () {
            var title = $(this).text();
            $(this).html(title + '<input class="form-control" type="text" placeholder="Search ' + title + '" />');
        });

        var t = $('#data').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            {
            extend: 'excel',
            },
            {
            extend: 'pdf',
            },
            {
            extend: 'print',
            }
        ],
        
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "scrollX": true,
        "order": [[ 0, "asc" ]],

        initComplete: function () {    
            this.api()
                .columns()
                .every(function () {
                    var that = this;

                    $('input', this.header()).on('keyup change clear', function () {
                        if (that.search() !== this.value) {
                            that.search(this.value).draw();
                        }
                    });
                });
            },
        });
    });
</script>
<?= $this->endSection('script') ?>