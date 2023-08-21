<?= $this->extend('ijin/panitia_ijin_layout') ?>


<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->
<style>
    .overflow-y-scroll{
        overflow-y: scroll;
    }

    ::-webkit-scrollbar {
        width: 15px;
    }

    ::-webkit-scrollbar-track {
        background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #d6dee1;
        border-radius: 10px;
        border: 6px solid transparent;
        background-clip: content-box;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #a8bbbf;
    }
</style>
<?= $this->endSection('css') ?>


<?= $this->section('base_content') ?>

<div class="container">
    <h1 class="h1 text-center mb-5">Tanggal Perijinan</h1>
    <div class="row justify-content-center">
        <div class="col-lg-6" id="col-roles">

            <div class="container mb-5">
                <?= form_open("panitia/ijin/tambahTanggal"); ?>
                <div class="input-group">
                    <input type="date" class="form-control" placeholder="tanggal" name="tanggal" required>
                    <button class="btn btn-success" type="submit">ADD</i></button>
                </div>
                <?= form_close(); ?>
    
                <div class="d-grid">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <!-- Kalo sukses nambah data -->
                        <div class="alert alert-success alert-dismissible mt-3" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <!-- Kalo gagal tambah data -->
                        <div class="alert alert-danger alert-dismissible mt-3" role="alert">
                            <?= session()->getFlashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <table class="table table-hover table-striped">
                <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                    <th>Delete</th>
                </thead>
                <tbody class="table-group-divider">

                    <?php foreach($tanggal as $i => $tgl): ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $tgl['tanggal'] ?></td>
                        <td>
                            <?= form_open("panitia/ijin/bukaTutup"); ?>
                            <!-- <input type="hidden" name="_method" value="POST"> -->
                            <?php if($tgl['open'] == 1): ?>
                                <button class="btn btn-danger" type="submit" id="btn-tutup">Tutup</button>
                                <input type="hidden" id="id-<?= ($i+1) ?>" name="id" value="<?= $tgl['id'] ?>">
                                <input type="hidden" id="aksi-<?= ($i+1) ?>" name="aksi" value="0">
                            <?php endif; ?>
                            <?php if($tgl['open'] == 0): ?>
                                <button class="btn btn-success" type="submit" id="btn-buka">Buka</button>
                                <input type="hidden" id="id-<?= ($i+1) ?>" name="id" value="<?= $tgl['id'] ?>">
                                <input type="hidden" id="aksi-<?= ($i+1) ?>" name="aksi" value="1">
                            <?php endif; ?>
                            <?= form_close(); ?>
                        </td>
                        <td>
                            <?= form_open("panitia/ijin/deleteTanggal/".$tgl['id']); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" type="submit" id="btn-delete"><i class="bi bi-trash-fill"></i></button>
                            <?= form_close(); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>


        </div>
    </div>
    
    <!-- editable editor element -->
    <div class="input-group" id="editable-group" style="display: none">
        <input type="text" class="form-control" placeholder="Input something" id="editable-input" autocomplete="off" required>
        <button class="btn btn-success" type="button" id="editable-ok"><i class="bi bi-check-lg"></i></button>
        <button class="btn btn-danger" type="button" id="editable-cancel"><i class="bi bi-x-lg"></i></button>
    </div>

    <input id="csrf" type="hidden" name="__csrf" value="<?= csrf_hash() ?>">
    
    <!-- Isi Disini Content nya -->    
</div>

<?= $this->endSection('base_content') ?>


<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script>
    $(document).ready(() => {
        currentEditing = null;

        $("[editable=true]").on("click", function(e){
            //check is there any element editing if yes then cancel the prev then edit current
            if(currentEditing != null){
                exitEdit();
            }

            //set current editing
            currentEditing = $(this);

            //hide real text
            $(this).hide();

            //add edit form
            $(this).parent().append($("#editable-group").show());

            //set value to input form and focus on it
            $("#editable-input").val($(this).text());
            $("#editable-input").focus();

        });

        $("#editable-ok").on("click", function(){
            //get url detination
            url = currentEditing.attr("editable-url");

            //get column name to update
            colEdit = currentEditing.attr("editable-col");

            //the new value to be assign
            newValue = $("#editable-input").val();

            //the body data
            col = {};
            col[colEdit] = newValue;

            //required
            if(newValue == ""){
                return;
            }
            
            $.ajax({
                method: "POST",
                url: url,     //url ambil href
                data: {
                    __csrf: $("#csrf").val(),
                    _method: "PUT",
                    col: col
                },
                success(response){
                    $("#csrf").val(response.csrf);
                    currentEditing.text(newValue);
                    exitEdit();
                },
                error(jqXHR, textStatus, errorThrown){
                    console.log("error");
                }
            });
        });
        
        $("#editable-cancel").on("click", function(){
            exitEdit();
        });

        function exitEdit(){
            $("#editable-group").hide();
            currentEditing.show();
            currentEditing = null;
        }
    });
</script>

<?= $this->endSection('script') ?>