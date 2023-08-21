
<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<style>
    body{
        background-color: #F0EDD4;

    }
/* 
    .tb_kelompok{
        background-color: aliceblue;
        margin-left:auto;
        margin-right: auto;
        width: 80vw;
        padding: 30px 20px ;

    } */

    .area{
        background-color: aliceblue;
    }
</style>

<?=$this->renderSection('css')?>
<?= $this->endSection('css') ?>



<!-- body -->
<?= $this->section('base_content') ?>
<!-- isi body di sini -->
<?= $this->include('kelompok/kelompok_navbar.php'); ?>    
<?php

// $arrayMahasiswa = array_column($all_mahasiswa, 'nrp');
// $arrayFrontline = array_column($all_frontline, 'nrp');


?>

    <?php if(session()->has('msg_success')):?>
          <script>
              Swal.fire({
              icon: 'success',
              title: '<?=session()->getFlashdata('msg_success')?>',
              })
          </script>
                      
      <?php elseif(session()->has('msg_error')): ?>
          <script>
              Swal.fire({
              icon: 'error',
              title: '<?=session()->getFlashdata('msg_error')?>',

              
              })
          </script>
      
      <?php endif ?>

<?php
$error = session()->has('error_val');
$error_val = session()->getFlashdata('error_val');
?>
<div class="container area py-4">
<?= form_open() ?>            
              <!-- <h1><?= $data_kelompok[0]->id ?></h1> -->
    
        <label for="kelompok" class="form-label">Nama Kelompok: </label>
        <input type="text" name="nama_kelompok" id="kelompok"  placeholder="nama_kelompok" value="<?=old('nama_kelompok')?? htmlspecialchars($data_kelompok[0]->nama_kelompok)?>" class="form-control<?=$error && !empty($error_val['nama_kelompok']) ? ' is-invalid' : ''?>">
        <?php if ($error && !empty($error_val['nama_kelompok'])): ?>
                <div class="invalid-feedback">
                    <?=$error_val['nama_kelompok']?>

                </div>
            <?php endif ?>
            <br>
            
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?=htmlspecialchars($data_kelompok[0]->id)?>">
            <a class="btn btn-primary btn-sm" id="btn_update">Update Nama Kelompok</a>
            
            <button type="submit" name="sub" style="display: none;"  id="submitted" value="ya"></button>



    <?= form_close() ?>
    <br>    
    <h4>Frontline</h4>
    <table id="frontline-table">
                    <thead>
                        <tr>
                            <th>Nrp</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                            foreach($data_frontline as $frontline):?>
                            
                            <tr>
                                <td><?=htmlspecialchars($frontline->nrp)?> </td> 
                                <td><?=htmlspecialchars($frontline->nama)?> </td> 
                                <td>
                                    <?= form_open("panitia/kelompok/sunting/frontline/hapus_kelompok")?>
                                    <input type="hidden" name="id_frontline_delete" value="<?=htmlspecialchars($frontline->id)?>">
                                    <input type="hidden" name="id_kelompok" value="<?=htmlspecialchars($data_kelompok[0]->id)?>">

                                    <input type="hidden" name="_method" value="PUT">

                                        <button name="submit" value="ya" class="btn btn-danger btn-sm">Hapus</button> 
                                    <?= form_close()?>
                                 </td>
                            </tr>
                            <?php endforeach?>
                    </tbody>
                </table>

            <!-- tagify -->
            <!-- tambah frontline -->
            <?= form_open("panitia/kelompok/sunting/frontline/tambah") ?>
                <label for="frontline" class="form-label">Data Frontline: </label>
                <input type="hidden" name="id_kelompok" value="<?=htmlspecialchars($data_kelompok[0]->id)?>">
                    <input name='tag_frontline' id="frontline" value='<?=old('tag_frontline')?>' pattern='^{1,15}$' class="form-control<?=$error && !empty($error_val['tag_frontline']) ? ' is-invalid' : ''?>">
                    <?php if ($error && !empty($error_val['tag_frontline'])): ?>
                            <div class="invalid-feedback">
                                <?=$error_val['tag_frontline']?>
                            </div>
                    <?php endif ?>
                    <br>
                    <br>
                    <input type="hidden" name="_method" value="PUT">

                <button name="submit" value="ya" class="btn btn-primary btn-sm">Tambah</button> 
                <?= form_close()?>





    <br>    
    <br>    
 

    <h4>Anggota</h4>
    <table id="anggota">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nrp</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>no_hp</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                            foreach($data_mahasiswa as $idx => $mahasiswa):
                            ?>
                            
                            <tr>
                                <td><?= $idx+1 ?></td>
                                <td><?=htmlspecialchars($mahasiswa->nrp)?> </td> 

                                <td><?=htmlspecialchars($mahasiswa->nama)?> </td> 
                               
                                <td><?=htmlspecialchars($mahasiswa->prodi)?> </td>

                                <td><?=htmlspecialchars($mahasiswa->no_hp)?> </td>
                                <td>

                                    <?= form_open("panitia/kelompok/sunting/mahasiswa/hapus_kelompok")?>
                                    <input type="hidden" name="id_mahasiswa_delete" value="<?=htmlspecialchars($mahasiswa->id)?>">
                                    <input type="hidden" name="id_kelompok" value="<?=htmlspecialchars($data_kelompok[0]->id)?>">
                                    <input type="hidden" name="_method" value="PUT">
                                    <?php if($mahasiswa->id == $data_kelompok[0]->id_ketua):?>
                                        <input type="hidden" name="is_ketua" value=true >
                                     <?php else:?>
                                        <input type="hidden" name="is_ketua" value=false >
                                      <?php endif?>




                                        <button name="submit" value="ya" class="btn btn-danger btn-sm">Hapus</button> 
                                    <?=form_close()?>
                                        
                                    <!-- SET KETUA -->
                                    <?=form_open("panitia/kelompok/sunting/mahasiswa/set_ketua")?>
                                    <?php if(!($mahasiswa->id == $data_kelompok[0]->id_ketua)):?>
                                        <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name='id_mahasiswa' value="<?=htmlspecialchars($mahasiswa->id) ?>">
                                        <input type="hidden" name="id_kelompok" value="<?=htmlspecialchars($data_kelompok[0]->id)?>">
                                        <button class="btn btn-success btn-sm">Set Ketua</button>
                                      <?php endif?>
                                    
                                    <?= form_close()?>                                 </td>
                            </tr>


                            <?php endforeach?>
                    </tbody>
                </table>
                <!-- tagify -->
                <?= form_open("panitia/kelompok/sunting/mahasiswa/tambah") ?>
                <label for="mahasiswa" class="form-label">Data Mahasiswa: </label>
                <input type="hidden" name="id_kelompok" value="<?=htmlspecialchars($data_kelompok[0]->id)?>">
                    <input name='tag_mahasiswa' id="mahasiswa" value='<?=old('tag_mahasiswa')?>' pattern='^{1,15}$' class="form-control<?=$error && !empty($error_val['tag_mahasiswa']) ? ' is-invalid' : ''?>">
                    <?php if ($error && !empty($error_val['tag_mahasiswa'])): ?>
                            <div class="invalid-feedback">
                                <?=$error_val['tag_mahasiswa']?>
                            </div>
                    <?php endif ?>
                    <br>
                    <br>
                    <input type="hidden" name="_method" value="PUT">

                <button name="submit" value="ya" class="btn btn-primary btn-sm">Tambah</button> 
                <?= form_close()?>

    

        <br>
        <div class="d-grid gap-2 col-6 mx-auto">
        <a href="<?=site_url("panitia/kelompok/main")?>" class="btn btn-secondary  btn-block ">Back </a>

        </div>


</div>


<?=$this->renderSection('content')?>

<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

<!-- Swal -->
<script>
    $(document).ready(function(){
        $('#btn_update').click(function(e) {
            // Form submission logic here
            e.preventDefault();
            var ambilAttribute = $(this).attr('id')
            Swal.fire({
                title: 'Submit Perubahan?',
                text: "Yakin Melakukan Perubahan?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Update'
                }).then((result) => {
                    if (result.isConfirmed) {
                     
                        $('#submitted').click();

                    }
                })
        });
    });
</script>
<script>
$(document).ready(function () {
    $('#anggota').DataTable({
        "searching": false,
        "paging" :false,
        "info":false,
    });
});


$(document).ready(function () {
    $('#frontline-table').DataTable({
        "searching": false,
        "paging" :false,
        "info":false,
    });
});




//tagify

var input = document.querySelector('input[name=tag_mahasiswa]'),
    tagify = new Tagify(input, {
        pattern             : /^.{0,20}$/,  // Validate typed tag(s) by Regex. Here maximum chars length is defined as "9"
        delimiters          : ",|\t|\n|\r| ",        // add new tags when a comma or a space character is entered
        trim                : false,        // if "delimiters" setting is using space as a delimeter, then "trim" should be set to "false"
        keepInvalidTags     : false,         // remove invalid tags (kalau 'true' keep them marked as invalid)
        enforceWhitelist: false,
        // createInvalidTags: false,
        editTags            : {
            clicks: 2,              // single click to edit a tag
            keepInvalid: false      // if after editing, tag is invalid, auto-revert
        },
        maxTags             : 20,
        // blacklist           : ["foo", "bar", "baz"],
          
        whitelist           : [],
        transformTag        : transformTag,
        backspace           : "edit",
        placeholder         : "Input Mahasiswa",
        dropdown : {
            enabled: 1,            // show suggestion after 1 typed character
            fuzzySearch: false,    // match only suggestions that starts with the typed characters
            position: 'text',      // position suggestions list next to typed text
            caseSensitive: false,   //(kalau True) allow adding duplicate items if their case is different
        },
        
        templates: {
            dropdownItemNoMatch: function(data) {
                return `<div class='${this.settings.classNames.dropdownItem}' value="noMatch" tabindex="0" role="option">
                    No suggestion found for: <strong>${data.value}</strong>
                </div>`
            }
        }

    }),controller

    

// generate a random color (in HSL format, which I like to use)
function getRandomColor(){
    function rand(min, max) {
        return min + Math.random() * (max - min);
    }

    var h = rand(1, 360)|0,
        s = rand(40, 70)|0,
        l = rand(65, 72)|0;

    return 'hsl(' + h + ',' + s + '%,' + l + '%)';
}

function transformTag( tagData ){
    tagData.value = tagData.value.toUpperCase();
    tagData.color = getRandomColor();
    tagData.style = "--tag-bg:" + tagData.color;

    // if( tagData.value.toLowerCase() == 'shit' )
    //     tagData.value = 's✲✲t'
}


var input = document.querySelector('input[name=tag_frontline]'),
    tagify2 = new Tagify(input, {
        pattern             : /^.{0,20}$/,  // Validate typed tag(s) by Regex. Here maximum chars length is defined as "9"
        delimiters          : ",|\t|\n|\r| ",        // add new tags when a comma or a space character is entered
        trim                : false,        // if "delimiters" setting is using space as a delimeter, then "trim" should be set to "false"
        keepInvalidTags     : false,         // remove invalid tags (kalau 'true' keep them marked as invalid)
        enforceWhitelist: false,
        // createInvalidTags: false,
        editTags            : {
            clicks: 2,              // single click to edit a tag
            keepInvalid: false      // if after editing, tag is invalid, auto-revert
        },
        maxTags             : 20,
        // blacklist           : ["foo", "bar", "baz"],
          
        whitelist           : [],
        transformTag        : transformTag,
        backspace           : "edit",
        placeholder         : "Input Frontline",
        dropdown : {
            enabled: 1,            // show suggestion after 1 typed character
            fuzzySearch: false,    // match only suggestions that starts with the typed characters
            position: 'text',      // position suggestions list next to typed text
            caseSensitive: false,   //(kalau True) allow adding duplicate items if their case is different
        },
        
        templates: {
            dropdownItemNoMatch: function(data) {
                return `<div class='${this.settings.classNames.dropdownItem}' value="noMatch" tabindex="0" role="option">
                    No suggestion found for: <strong>${data.value}</strong>
                </div>`
            }
        }

    }),controller

    
tagify.on('input',onInput1)
function onInput1( e ){
  var value = e.detail.value
  // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
  controller && controller.abort()
  controller = new AbortController()

  // show loading animation and hide the suggestions dropdown
  tagify.loading(true).dropdown.hide()

  //check Valuenya kosong apa ga, karena kalau kosong fetchnya error
    if(value ==""){
        console.log("value = null")
        return;   
    }
    
     fetch('../suggest/'+ value, {signal:controller.signal})
    .then(RES => RES.json())
    .then(function(newWhitelist){
        list = $.map(newWhitelist['suggest'], function(item) {
                    return item.nrp;
                    });
      tagify.whitelist = (tagify.whitelist).concat(list.filter(function(value) {
                return !(tagify.whitelist).includes(value);
        }));// update whitelist Array in-place
      tagify.loading(false).dropdown.show(value) // render the suggestions dropdown
    })
}


    
tagify2.on('input',onInput2)
function onInput2( e ){
  var value = e.detail.value
  // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
  controller && controller.abort()
  controller = new AbortController()

  // show loading animation and hide the suggestions dropdown
  tagify2.loading(true).dropdown.hide()

  //check Valuenya kosong apa ga, karena kalau kosong fetchnya error
    if(value ==""){
        console.log("value = null")
        return;   
    }

     fetch('../suggest/frontline/'+ value, {signal:controller.signal})
    .then(RES => RES.json())
    .then(function(newWhitelist){
        list = $.map(newWhitelist['suggest'], function(item) {
                    return item.nrp;
                    });
      tagify2.whitelist = (tagify2.whitelist).concat(list.filter(function(value) {
                return !(tagify2.whitelist).includes(value);
        }));// update whitelist Array in-place
      tagify2.loading(false).dropdown.show(value) // render the suggestions dropdown
    })
}



</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>