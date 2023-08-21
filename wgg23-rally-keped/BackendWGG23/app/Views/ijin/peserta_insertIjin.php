<?= $this->extend('ijin/peserta_ijin_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid p-4 align-items-center">
        <?= form_open_multipart('', ['id'=>'form-ijin','class' => 'mx-auto text-center']) ?>
            <h2 class="text-center animate__animated animate__fadeInUp mb-5">Perizinan Mahasiswa</h2>
            <div class="row mb-3">
                <div class="col-lg-2"></div>
                <div class="col-lg-4 col-12">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <select class="form-select form-select-md" aria-label=".form-select-md" id="tanggal" name="tanggal" required>
                        <?php
                            if($tanggal == null){
                                echo '<option value="-1">Tidak ada tanggal yang dapat dipilih</option>';
                            }else{
                                echo '<option value="-1">-- Pilih tanggal --</option>';
                                foreach($tanggal as $tgl){
                                    echo '<option value='.$tgl['id'].'>'.$tgl["tanggal"].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-4 col-12">
                    <label for="jenis" class="form-label">Jenis Perizinan</label>
                    <select class="form-select form-select-md" aria-label=".form-select-md" id="jenis" name="jenis" required>
                        <option value="0">-- pilih jenis ijin --</option>
                        <option value="1">Dispensasi</option>
                        <option value="2">Izin</option>
                    </select>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-12">
                    <label for="" class="form-label">Waktu Ijin</label>
                    <div class="input-group col-lg-8 col-12">
                        <input type="time" name="start-izin" id="start-izin" class="form-control text-center">
                        <span class="input-group-text">-</span>
                        <input type="time" name="end-izin" id="end-izin" class="form-control text-center">
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row mb-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-12">
                    <label for="alasan" class="form-label">Alasan</label>
                    <textarea class="form-control" id="alasan" name="alasan" rows="4" required></textarea>
                </div>
                <div class="col-lg-2"></div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-12">
                    <label for="bukti" class="form-label">Bukti</label>
                    <p class='text-danger'><strong>Format nama file: NRP_Nama lengkap_Hari <br> Bukti hanya bisa berupa 1 file pdf (.pdf) </strong></p>
                    <input type="file" class="form-control" id="bukti" name="bukti" accept=".pdf" required>
                </div>
                <div class="col-lg-2"></div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-100 bg-blue" id="ajukan">Submit</button>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <input id="csrf" type="hidden" name="__csrf" value="<?= csrf_hash() ?>">
        <?= form_close() ?>
    </div>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            denyButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });
    $(document).ready(() => {
        $('#ajukan').on("click",function(e){
            e.preventDefault();
            var dataForm = new FormData();
            dataForm.append('tanggal', parseInt($('#tanggal :selected').val()));
            dataForm.append('jenis', parseInt($('#jenis :selected').val()));
            dataForm.append('start-izin', $('#start-izin').val());
            dataForm.append('end-izin', $('#end-izin').val());
            dataForm.append('alasan', $('#alasan').val());
            dataForm.append('__csrf', $('#csrf').val());
            $.each($('#bukti')[0].files, function(i, file) {
                dataForm.append('bukti', file);
            });
            console.log(dataForm['start-izin']);
            swalWithBootstrapButtons.fire({
                title : 'apakah anda ingin mengajukan perijinan!',
                text: 'Anda hanya dapat mengajukan perizinan untuk tanggal yang sama 1 kali!',
                icon : 'warning',
                showDenyButton: true,
                confirmButtonText: 'Ajukan',
                denyButtonText: 'Batal ajukan'
            }).then((result) => {
                if (result.isConfirmed){
                    $.ajax({
                        url : "<?= site_url('peserta/ijin/insert')?>",
                        method : 'POST',
                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        data : dataForm,
                        success(response){
                            swalWithBootstrapButtons.fire(
                                response.title,
                                response.message,
                                response.status
                            ).then((result)=>{
                                if(response.status == 'success'){
                                    window.location.replace('<?= site_url('peserta/ijin')?>');
                                }
                            })
                            $("#csrf").val(response.csrf);
                        }               
                    });
                }else{
                    swalWithBootstrapButtons.fire(
                        'Batal!',
                        'Perijinan Batal diajukan!',
                        'error'
                    )
                }
            })
        });
    });
</script>
<?= $this->endSection('script') ?>