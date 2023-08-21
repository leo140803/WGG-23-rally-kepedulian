<?= $this->extend('layouts/base_layouts') ?>
<!-- css -->
<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->

<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    body{
        background-color: #F0EDD4;
    }

    .container{
        background-color: aliceblue;
        
    }

</style>

<?=$this->renderSection('css')?>
<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>
<?= $this->include('kelompok/kelompok_navbar.php'); ?>  
<?php

// $arrayMahasiswa = array_column($data_mahasiswa, 'nrp');
// $arrayFrontline = array_column($data_frontline, 'nrp');


?>
<?php
$error = session()->has('error_val');
$error_val = session()->getFlashdata('error_val');


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


<?php if(session()->has('msg_exception')): ?>
<script>
    Swal.fire({
    icon: 'error',
    title: '<?=session()->getFlashdata('msg_exception')?>',
  
    })
</script>
<?php endif ?>

<div class="container py-3">
<?=form_open("", "id='myForm'")?>

<label for="kelompok" class="form-label">Nama Kelompok: </label>
        <input type="text" name="nama_kelompok" id="kelompok"  placeholder="Nama Kelompok" value="<?=old('nama_kelompok')?>" class="form-control<?=$error && !empty($error_val['nama_kelompok']) ? ' is-invalid' : ''?>">
        <?php if ($error && !empty($error_val['nama_kelompok'])): ?>
                <div class="invalid-feedback">
                    <?=$error_val['nama_kelompok']?>
                </div>
            <?php endif ?>
            <br>
<label for="frontline" class="form-label">Data Frontline: </label>
        <input name='tag_frontline' id="frontline" value='<?=old('tag_frontline')?>'  class="form-control<?=$error && !empty($error_val['tag_frontline']) ? ' is-invalid' : ''?>">
        <?php if ($error && !empty($error_val['tag_frontline'])): ?>
                <div class="invalid-feedback">
                    <?=$error_val['tag_frontline']?>
                </div>
            <?php endif ?>
            <br>
            <br>

<label for="ketua" class="form-label">Data Ketua: </label>
        <input name='tag_ketua' id="ketua" value='<?=old('tag_ketua')?>'  class="form-control<?=$error && !empty($error_val['tag_ketua']) ? ' is-invalid' : ''?>">
        <?php if ($error && !empty($error_val['tag_ketua'])): ?>
                <div class="invalid-feedback">
                    <?=$error_val['tag_ketua']?>
                </div>
            <?php endif ?>
        <br>
        <br>


<label for="mahasiswa" class="form-label">Data Anggota: </label>
        <input name='tag_mahasiswa' id="mahasiswa" value='<?=old('tag_mahasiswa')?>'  class="form-control<?=$error && !empty($error_val['tag_mahasiswa']) ? ' is-invalid' : ''?>">
        <?php if ($error && !empty($error_val['tag_mahasiswa'])): ?>
                <div class="invalid-feedback">
                    <?=$error_val['tag_mahasiswa']?>
                </div>
            <?php endif ?>
        <br>
        <br>
        <a class="btn btn-secondary" href="<?=site_url("panitia/kelompok/main")?>"> Back </a>
        <a class='btn btn-primary' id="clickSubmit" >Submit</a>
        <a class='btn btn-danger' id="validate" >Validate</a>

        <button type="submit" style="display: none;" id="submitted" name="sub" ></button>
        
<?= form_close()?>

<figcaption class="blockquote-footer mt-2">
    Sebelum Submit Pastikan Click Validate
    
  </figcaption>



<?=$this->renderSection('content')?>
<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<!-- tagify -->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>


<!-- Swal -->
<script>
     //enter ga akan submit form
     const form = document.getElementById('myForm');
      form.addEventListener('keypress', function(e) {
        if (e.keyCode === 13) {
          e.preventDefault();
        }
      });
    $(document).ready(function() {
        $('#clickSubmit').click(function(e) {
            // Form submission logic here
            e.preventDefault();
            Swal.fire({
            title: 'Mau Menambah Kelompok?',
            text: "Pastikan Sudah Melakukan Validasi",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tambah Kelompok'
            }).then((result) => {
                if (result.isConfirmed) {
                        $('#submitted').click();
                }
            })
  
        });

        $('#clickSubmit').hide();
    });
    


    //validate data
    // function validate(){
           //ambil semua adata
    $('#validate').click(function(e){
        e.preventDefault
        //ini untuk ambil value seluruh tag yang ada dalam bentuk array
        //Anggota
        var arr1 =$('[name=tag_mahasiswa]').val()
        if(arr1 != ""){
        var TagValues1 =JSON.parse(arr1)
        var TagArray1 = []

        for(let i=0;i<TagValues1.length;i++){
            TagArray1.push(TagValues1[i].value)

            fetch('suggest/'+ TagValues1[i].value)
            .then(RES => RES.json())
            .then(function(newWhitelist){
                list = $.map(newWhitelist['suggest'], function(item) {
                            return item.nrp;
                            });

                tagify.whitelist = (tagify.whitelist).concat(list.filter(function(value) {
                        return !(tagify.whitelist).includes(value);
                }));

                if(!tagify.whitelist.includes(TagValues1[i].value)){
                    tagify.removeTag(TagValues1[i].value)
                }
            });

        }}
        
        //Ketua
        var arr2 =$('[name=tag_ketua]').val()
        if(arr2 != ""){
        var TagValues2 =JSON.parse(arr2)
        var TagArray2 = []

        for(let i=0;i<TagValues2.length;i++){
            TagArray2.push(TagValues2[i].value)

            fetch('suggest/'+ TagValues2[i].value)
            .then(RES => RES.json())
            .then(function(newWhitelist){
                list = $.map(newWhitelist['suggest'], function(item) {
                            return item.nrp;
                            });
            tagify3.whitelist = (tagify3.whitelist).concat(list.filter(function(value) {
                        return !(tagify3.whitelist).includes(value);
                }));// update whitelist Array in-place
                if(!tagify3.whitelist.includes(TagValues2[i].value)){
                    tagify3.removeTag(TagValues2[i].value)

                }
            });

        }}

        //Frontline
        var arr3 =$('[name=tag_frontline]').val()
        if(arr3 != ""){
        var TagValues3 =JSON.parse(arr3)
        var TagArray3 = []
        

        for(let i=0;i<TagValues3.length;i++){
            TagArray3.push(TagValues3[i].value)

            fetch('suggest/frontline/'+ TagValues3[i].value)
            .then(RES => RES.json())
            .then(function(newWhitelist){
                list = $.map(newWhitelist['suggest'], function(item) {
                            return item.nrp;
                            });
            tagify2.whitelist = (tagify2.whitelist).concat(list.filter(function(value) {
                        return !(tagify2.whitelist).includes(value);
                }));// update whitelist Array in-place

                if(!tagify2.whitelist.includes(TagValues3[i].value)){
                    tagify2.removeTag(TagValues3[i].value)
                }
            });
        }}
        $('#clickSubmit').show();


        Swal.fire(
        'Berhasil Validasi!',
        '',
        'success'
        )
        
    })
    

    // }



</script>



<script>
    var input = document.querySelector('input[name=tag_mahasiswa]'),
    tagify = new Tagify(input, {
        pattern             : /^.{9,9}$/,  // Validate typed tag(s) by Regex. Here maximum chars length is defined as "9"
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
        placeholder         : "Input Anggota",
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

    })

    

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

  
}



// tagify.on('add', function(e){
//     console.log(e.detail)
// })

// tagify.on('invalid', function(e){
//     console.log(e, e.detail);
// })

var clickDebounce;

tagify.on('click', function(e){
    const {tag:tagElm, data:tagData} = e.detail;

    // a delay is needed to distinguish between regular click and double-click.
    // this allows enough time for a possible double-click, and noly fires if such
    // did not occur.
    clearTimeout(clickDebounce);
    clickDebounce = setTimeout(() => {
        tagData.color = getRandomColor();
        tagData.style = "--tag-bg:" + tagData.color;
        tagify.replaceTag(tagElm, tagData);
    }, 200);
})

tagify.on('dblclick', function(e){
    // when souble clicking, do not change the color of the tag
    clearTimeout(clickDebounce);
})




var input = document.querySelector('input[name=tag_frontline]'),
    tagify2 = new Tagify(input, {
        pattern             : /^.{9,9}$/,  // Validate typed tag(s) by Regex. Here maximum chars length is defined as "9"
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
        whitelist           :[] ,
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
    })
    
var input = document.querySelector('input[name=tag_ketua]'),
    tagify3 = new Tagify(input, {
        pattern             : /^.{9,9}$/,  // Validate typed tag(s) by Regex. Here maximum chars length is defined as "9"
        delimiters          : ",|\t|\n|\r| ",        // add new tags when a comma or a space character is entered
        trim                : false,        // if "delimiters" setting is using space as a delimeter, then "trim" should be set to "false"
        keepInvalidTags     : false,         // remove invalid tags (kalau 'true' keep them marked as invalid)
        enforceWhitelist: false,
        // createInvalidTags: false,
        editTags            : {
            clicks: 2,              // single click to edit a tag
            keepInvalid: false      // if after editing, tag is invalid, auto-revert
        },
        maxTags             : 1,
        blacklist           : ["foo", "bar", "baz"],
        whitelist           : [],
        transformTag        : transformTag,
        backspace           : "edit",
        placeholder         : "Input Ketua",
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

// INI UNTUK DETECT INPUT LALU REKOMENDASI DROPDOWN
tagify3.on('input', onInput)  
function onInput( e ){
  var value = e.detail.value
  // https://developer.mozilla.org/en-US/docs/Web/API/AbortController/abort
  controller && controller.abort()
  controller = new AbortController()

  // show loading animation and hide the suggestions dropdown
  tagify3.loading(true).dropdown.hide()

  //check Valuenya kosong apa ga, karena kalau kosong fetchnya error
    if(value ==""){
        console.log("value = null")
        return;   
    }
    
     fetch('suggest/'+ value, {signal:controller.signal})
    .then(RES => RES.json())
    .then(function(newWhitelist){
        list = $.map(newWhitelist['suggest'], function(item) {
                    return item.nrp;
                    });
      tagify3.whitelist = (tagify3.whitelist).concat(list.filter(function(value) {
                return !(tagify3.whitelist).includes(value);
        }));// update whitelist Array in-place
      tagify3.loading(false).dropdown.show(value) // render the suggestions dropdown
    })
  //aman whitelist detected
//   if(tagify3.whitelist.includes(value)){
//     console.log("detected "+value)
//   }else{
//     console.log("not detect")
//   }
  
}


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
        return;   
    }
    
     fetch('suggest/'+ value, {signal:controller.signal})
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
    
    fetch('suggest/frontline/'+ value, {signal:controller.signal})
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

<?=$this->renderSection('script')?>

<?= $this->endSection('script') ?>