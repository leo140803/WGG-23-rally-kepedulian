<?= $this->extend('data/data_layout'); ?>

<?= $this->section('css') ?>

<?=$this->include('layouts/datatable_css.php')?>

<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="my-5">
        <h1 class="text-center">Data Mahasiswa</h1>
        <h5 class="text-center">Last Update at <?= $log ?></h5>
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-striped" id="data">
                <thead>
                    <th>NO</th>

                    <?php if(isset($edit)): ?>
                        <th>ACTIVE</th>
                    <?php endif; ?>

                    <?php foreach($mahasiswa[0] as $key => $value): ?>
                        <?php if(in_array($key, isset($edit) ? ['id', 'no_hp'] : ['id', 'created_at', 'updated_at', 'deleted_at', 'no_hp'])): continue; else: ?>
                            <th> <?= strtoupper($key) ?> </th>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                </thead>
                <tbody>
                    <?php foreach($mahasiswa as $i => $maba): ?>
                        <tr class="<?= isset($edit) && isset($maba['deleted_at']) ? "table-danger" : "" ?>">
                            <td><?= $i+1 ?></td>

                            <?php if(isset($edit)): ?>
                                <td>
                                    <?= form_open(current_url()."/".$maba['nrp']) ?>
                                        <input type="hidden" name="_method" value="<?= isset($maba['deleted_at']) ? "PUT" : "DELETE" ?>">
                                        <button type="submit" class="btn <?= isset($maba['deleted_at']) ? "btn-danger" : "btn-success" ?>">
                                            <?= isset($maba['deleted_at']) ? "INACTIVE" : "ACTIVE" ?>
                                        </button>
                                    <?= form_close() ?>
                                </td>
                            <?php endif; ?>

                            <?php foreach($maba as $key => $value): ?>
                                <?php if(in_array($key, isset($edit) ? ['id', 'no_hp'] : ['id', 'created_at', 'updated_at', 'deleted_at', 'no_hp'])): continue; else: ?>
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