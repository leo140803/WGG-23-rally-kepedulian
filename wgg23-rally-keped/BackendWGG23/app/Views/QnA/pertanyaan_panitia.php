<?= $this->extend('panitia/home_layout') ?>


<?= $this->section('css') ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<style>
  .dataTables_wrapper {
    background-color: #fff;
    border-radius: 4px;
    padding: 10px;
  }

  .dataTables_paginate {
    margin-top: 10px;
  }

  .dataTables_paginate .paginate_button {
    padding: 4px 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    cursor: pointer;
    margin-right: 5px;
  }

  .dataTables_paginate .paginate_button.current {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
  }

  .dataTables_paginate .paginate_button.disabled {
    opacity: 0.5;
    cursor: default;
  }

  .dataTables_length select {
    padding: 6px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  .dataTables_info {
    margin-top: 10px;
  }

  .dataTables_wrapper .dataTables_empty {
    font-style: italic;
    color: #999;
  }

  #myTable {
    width: 100%;
    border: 1px solid #ccc;
    margin-top: 3.5em;
  }

  #myTable th,
  #myTable td {
    padding: 12px;
  }

  #myTable thead {
    background-color: #007bff;
    color: #fff;
  }

  #myTable tbody tr:nth-child(even) {
    background-color: #f5f5f5;
  }

  #myTable tbody tr:hover {
    background-color: #f0f0f0;
  }
</style>
<?= $this->endsection() ?>


<?= $this->section('content') ?>

<?= $this->include('panitia/panitia_navbar.php') ?>

<div class="container my-5">
    <h3>Pertanyaan Talkshow</h3>

    <?php if ($allowed_div): ?>
      <?php $is_open = (isset($is_open_qna) && $is_open_qna->is_open == 1); ?>

        <?=form_open(site_url('panitia/qna-peserta'), ['method' => 'get']) ?>
          <div class="mt-3 mb-4">
            <input type="hidden" name="act" value="switch">
            <button class="btn btn-<?=$is_open ? 'danger' : 'primary'?>"><?=$is_open ? 'Nonaktifkan' : 'Aktifkan'?> QnA</button>
          </div>
        <?=form_close()?>

    <?php endif ?>


    <div class="mt-4">
        <table id="myTable" class="table">
            <thead>
                <tr>
                    <th style="width: 50px">#</th>
                    <th style="width: 400px">Pertanyaan</th>
                    <th style="width: 250px">Dari</th>
                    <th style="width: 120px">NRP</th>
                    <th style="width: 200px">Ditanyakan Pada</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data_pertanyaan) > 0): ?>
                    
                    <?php 
                      $i = 1;
                      foreach($data_pertanyaan as $pertanyaan): ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><?=htmlspecialchars($pertanyaan->pertanyaan)?></td>
                        <td><?=$pertanyaan->is_anonym == 1 ? '<span class="text-muted">(Anonym)</span>' : htmlspecialchars($pertanyaan->nama)?></td>
                        <td><?=$pertanyaan->is_anonym == 1 ? '<span class="text-muted">-</span>' : htmlspecialchars(strtoupper($pertanyaan->nrp))?></td>
                        <td><?=htmlspecialchars($pertanyaan->created_at)?></td>
                    </tr>
                    <?php 
                    $i++;
                    endforeach ?>
                <?php endif ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endsection() ?>


<?= $this->section('script') ?>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(function()
    {
        new DataTable('#myTable', {
          "pageLength": 100
        });
    })
</script>
<?= $this->endsection() ?>