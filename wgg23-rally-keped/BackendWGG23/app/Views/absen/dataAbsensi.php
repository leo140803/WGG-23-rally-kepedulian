<?= $this->extend('absen/absen_layout'); ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<?= $this->endSection('css') ?>


<?= $this->section('content') ?>


<div class="mx-5">
    <h4 class="text-center mb-0">Kegiatan <?= (($tipePeserta === 'panitia') ? ucwords($tipePeserta) : ' Mahasiswa Baru') ?> WGG 2023</h4>
    <h1 class="text-center"><?= $kegiatan['nama'] ?></h1>
    <hr>
</div>

<main class="container-fluid px-lg-5 px-md-4">
    <section class="mb-5">
        <div class="mx-auto" style="width: 600px;">
            <div class="d-flex justify-content-center">
                <label for="" class="form-label">Waktu Regis In</label>
            </div>
            <div class="input-group mb-4">
                <input type="time" name="start-regis-in" id="start-regis-in" class="form-control text-center">
                <span class="input-group-text">-</span>
                <input type="time" name="end-regis-in" id="end-regis-in" class="form-control text-center">
                <button class="btn btn-danger">X</button>
            </div>
            <div class="d-flex justify-content-center">
                <label for="" class="form-label">Waktu Regis Out</label>
            </div>
            <div class="input-group">
                <input type="time" name="start-regis-out" id="start-regis-out" class="form-control text-center">
                <span class="input-group-text">-</span>
                <input type="time" name="end-regis-out" id="end-regis-out" class="form-control text-center">
                <button class="btn btn-danger">X</button>
            </div>
        </div>
    </section>
    <section class="">
        <div class="table-responsive px-1">
            <table id="dataAbsensi" class="table dataTable no-footer w-100">
                <thead>
                    <tr>
                        <th class="">#</th>
                        <th class="">Nama <?= (($tipePeserta === 'panitia') ? ucwords($tipePeserta) : ' Mahasiswa Baru') ?></th>
                        <th class="">NRP</th>
                        <th class=""><?= ($tipePeserta === 'panitia') ? 'Divisi' : 'Kelompok' ?></th>
                        <th class="">Regis-In</th>
                        <th class="">Regis-Out</th>
                    </tr>
                    <tr class="filters">
                        <th></th>
                        <th><input type="text" class="form-control" placeholder="Nama"></th>
                        <th><input type="text" class="form-control" placeholder="NRP"></th>
                        <th><input type="text" class="form-control" placeholder="<?= ($tipePeserta === 'panitia') ? 'Divisi' : 'Kelompok' ?>"></th>
                        <th class="jam-absen"><select name="" id="" class="form-select">
                            <option selected>semua</option>
                            <option>absen</option>
                            <option>tidak absen</option>
                        </select></th>
                        <th class="jam-absen"><select name="" id="" class="form-select">
                            <option selected>semua</option>
                            <option>absen</option>
                            <option>tidak absen</option>
                        </select></th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>
</main>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script>
    $(document).ready(() => {
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var min = new $('#start-regis-in').val();
            var max = new $('#end-regis-in').val();
            var date = data[4];
            if (
                (min === '' && max === '') ||
                (min === '' && date <= max) ||
                (min <= date && max === '') ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var min = $('#start-regis-out').val();
            var max = $('#end-regis-out').val();
            var date = data[5];
            if (
                (min === '' && max === '') ||
                (min === '' && date <= max) ||
                (min <= date && max === '') ||
                (min <= date && date <= max)
            ) {
                return true;
            }
            return false;
        });
        const tipePeserta = '<?= $tipePeserta ?>';
        const dataAbsensi = $('#dataAbsensi').DataTable({
            ajax: {
                url: '<?= site_url("panitia/absen/$tipePeserta/fetchDataAbsensi/") ?><?= $kegiatan['id'] ?>',
                type: 'POST',
                data: {
                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                }
            },
            columns: [{
                data: 'rn',
                width: '20px',
            }, {
                data: 'nama'
            }, {
                data: 'nrp'
            }, {
                data: (tipePeserta === 'panitia') ? 'divisi' : 'kelompok'
            }, {
                data: 'jam_regis_in',
            }, {
                data: 'jam_regis_out',
            }],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf',
                // {
                //     text: 'CUSTOM',
                //     action: function(e, dt, node, config) {
                //         window.open('<?= site_url("panitia/absen/$tipePeserta/customExport/") ?><?= $kegiatan['id'] ?>');
                //     },
                //     padding: 0,
                // }
            ],
            orderCellsTop: true,
            fixedHeader: true,
            initComplete: function() {
                var api = this.api();
                $('.filters th select').on('change', function() {
                    const selectedValue = $(this).val();
                    const colIdx = $(this).parent().index();
                    if (selectedValue === 'semua') {
                        api.column(colIdx)
                            .search('^.*', true, false)
                            .draw();
                    } else if (selectedValue === 'absen') {
                        api.column(colIdx)
                            .search('^(?!\s*$).+', true, false)
                            .draw();
                    } else if (selectedValue === 'tidak absen') {
                        api.column(colIdx)
                            .search('^$', true, false)
                            .draw();
                    } else {
                        alert('hai');
                    }
                });
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // On every keypress in this input
                        var cursorPosition;
                        $(
                                'input',
                                $('.filters th:not(.jam-absen)').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
                                cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function(e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
        });
        $('#start-regis-in, #end-regis-in, #start-regis-out, #end-regis-out').on('input', function() {
            dataAbsensi.draw();
        });
        $('.input-group button').click(function() {
            $(this).siblings('input').val('');
            dataAbsensi.draw();
        });
    });
</script>
<?= $this->endSection('script') ?>w