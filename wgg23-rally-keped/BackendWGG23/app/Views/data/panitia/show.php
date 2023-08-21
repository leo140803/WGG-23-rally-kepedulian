<?= $this->extend('data/data_layout'); ?>

<?= $this->section('css') ?>

<?=$this->include('layouts/datatable_css.php')?>

<?= $this->endSection('css') ?>

<?= $this->section('content') ?>

<div class="container">
    <h1 class="text-center my-5">Data Panitia</h1>

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-striped" id="data">
                <thead>
                    <th>NO</th>

                    <?php if(isset($edit)): ?>
                        <th>ACTIVE</th>
                    <?php endif; ?>

                    <?php foreach($panitia[0] as $key => $value): ?>
                        <?php if(in_array($key, ['id', 'created_at', 'updated_at', 'deleted_at'])): continue; else: ?>
                            <th> <?= strtoupper($key) ?> </th>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                </thead>
                <tbody>
                    <?php foreach($panitia as $i => $panit): ?>
                        <tr class="<?= isset($edit) && isset($panit['deleted_at']) ? "table-danger" : "" ?>">
                            <td><?= $i+1 ?></td>

                            <?php if(isset($edit)): ?>
                                <td>
                                    <?= form_open(current_url()."/".$panit['id']) ?>
                                        <input type="hidden" name="_method" value="<?= isset($panit['deleted_at']) ? "PUT" : "DELETE" ?>">
                                        <button type="submit" class="btn <?= isset($panit['deleted_at']) ? "btn-danger" : "btn-success" ?>">
                                            <?= isset($panit['deleted_at']) ? "INACTIVE" : "ACTIVE" ?>
                                        </button>
                                    <?= form_close() ?>
                                </td>
                            <?php endif; ?>

                            <?php foreach($panit as $key => $value): ?>
                                <?php if(in_array($key, ['id', 'created_at', 'updated_at', 'deleted_at'])): continue; else: ?>
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