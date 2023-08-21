<?= $this->extend('ijin/panitia_ijin_layout') ?>

<?= $this->section('base_content') ?>

<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-10 pt-5">

                 <table class="table table-hover table-striped d-none" id="tableExport">
                    <thead>
                        <th>#</th>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Jenis</th>
                        <th>Alasan</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                        <th>Comment</th>
                        <th>Waktu Masuk</th>
                    </thead>
                    
                    <tbody>
                        <?php
                            $num = 1;
                            foreach($ijin as $row){
                                echo "<tr>";
                                echo "<td>$num</td>";
                                echo "<td>".$row['nrp']."</td>";
                                echo "<td>".$row['nama']."</td>";
                                echo "<td>".$row['tanggal']."</td>";
                                echo "<td>". $row['waktu_mulai']. "</td>";
                                echo "<td>". $row['waktu_selesai']. "</td>";
                                if($row['jenis_ijin'] == 1){
                                    echo "<td>Dispensasi</td>";
                                }else{
                                    echo "<td>Izin</td>";
                                }
                                echo "<td>
                                <span>". $row['keterangan'] ."</span>
                                </td>";
                                echo "<td>".site_url('/assets/uploads/buktiIjin/'.$row['bukti'])."</td>";
                                echo "<td><input type='hidden' id='id-".$num."' value='".$row['id']."'>";
                                if($row['terima'] == 0){
                                    echo "<p class='text-warning' id='st-".$num."'>Menunggu</p>";
                                }else if($row['terima'] == 1){
                                    echo "<p class='text-success' id='st-".$num."'>Perizinan Diterima</p>";
                                }else{
                                    echo "<p class='text-danger' id='st-".$num."'>Perizinan Ditolak</p>";
                                }
                                echo "</td>";
                                echo "<td>". $row['comment'] ."</td>";
                                echo "<td>". $row['created_at'] ."</td>";
                                echo "</tr>";
                                $num+=1;
                            }
                        ?>
                    </tbody>
                </table>
            
                <table class="table table-hover table-striped" id="tableIzin">
                    <thead>
                        <th>#</th>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Jenis</th>
                        <th>Alasan</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                        <th>Comment</th>
                        <th>Waktu Masuk</th>
                        <!-- <tr>
                        </tr> -->
                    </thead>
                    
                    <tbody>
                        <?php
                            $num = 1;
                            foreach($ijin as $row){
                                echo "<tr>";
                                echo "<td>$num</td>";
                                echo "<td>".$row['nrp']."</td>";
                                echo "<td>".$row['nama']."</td>";
                                echo "<td>".$row['tanggal']."</td>";
                                echo "<td>". $row['waktu_mulai']. "</td>";
                                echo "<td>". $row['waktu_selesai']. "</td>";
                                if($row['jenis_ijin'] == 1){
                                    echo "<td>Dispensasi</td>";
                                }else{
                                    echo "<td>Izin</td>";
                                }
                                echo "<td>
                                <span class='d-none'>". $row['keterangan'] ."</span>
                                <button class='btn btn-primary viewAlasan' data-bs-toggle='modal' data-bs-target='#modalku' id='alas-".$num."'>Alasan</button>
                                <input type='hidden' id='alasan-".$num."' value='".$row['keterangan']."'>
                                </td>";
                                echo "<td><a href='".site_url('/assets/uploads/buktiIjin/'.$row['bukti'])."' target='_blank'><button class='btn btn-primary'>Bukti</button></a></td>";
                                echo "<td><input type='hidden' id='id-".$num."' value='".$row['id']."'>";
                                if($row['terima'] == 0){
                                    echo "<p class='text-warning' id='st-".$num."'>Menunggu</p>";
                                }else if($row['terima'] == 1){
                                    echo "<p class='text-success' id='st-".$num."'>Perizinan Diterima</p>";
                                }else{
                                    echo "<p class='text-danger' id='st-".$num."'>Perizinan Ditolak</p>";
                                }
                                echo "<button class='btn btn-warning aksi' id='aksi-".$num."'>Ubah Status</button></td>";
                                echo "<td>". $row['comment'] ."</td>";
                                echo "<td>". $row['created_at'] ."</td>";
                                echo "</tr>";
                                $num+=1;
                            }
                        ?>
                    </tbody>
                </table>

                
            
        </div>
    </div>
    <input type="hidden" id="csrf" value="<?= csrf_hash() ?>">
</div>
<!-- Modal -->
    <div class="modal fade" id="modalku" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="judulModal">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="isiModal"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
<?= $this->endSection('base_content') ?>

<?= $this->section('script') ?>
    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-secondary',
                denyButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
        $(document).ready(function(){
            $("#tableIzin").DataTable({
                // dom: 'Blfrtip',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                scrollX : true,
            });

            tableExport = $("#tableExport").DataTable({
                dom: 'B',
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
                scrollX : true,
            });



            // Alasan Modal
            $('.viewAlasan').on('click',function(){
                let id = $(this).attr("id");
                let loc = id.split('-')[1];
                $("#judulModal").text('Alasan Perizinan');
                $('#isiModal').text($('#alasan-'+loc).val());
            });

            $('.aksi').on('click',function(){
                let id = $(this).attr('id');
                let loc = id.split('-')[1];
                Swal.fire({
                    title:"Lakukan Perubahan Status",
                    html:`<textarea class="form-control" id="comment" rows="3"></textarea>`,
                    showCancelButton : true,
                    showDenyButton : true,
                    confirmButtonText : 'Terima',
                    denyButtonText : 'Tolak',
                    preConfirm: () => {
                        let comment = $("#comment").val();
                        if(comment==undefined || comment==''){
                            comment = 'NULL';
                        }
                        return { comment : comment }
                    }
                }).then((result) => {
                    if(result.isConfirmed) {
                        $.ajax({
                            url : '<?= site_url('panitia/ijin/aksi')?>',
                            type : 'post',
                            data : {
                                __csrf : $('#csrf').val(),
                                id : $('#id-'+loc).val(),
                                aksi : 1,
                                comment :`${result.value.comment}`,
                            },
                            success : function(response){
                                $('#csrf').val(response.csrf);
                                swalWithBootstrapButtons.fire(
                                    response.title,
                                    response.message,
                                    response.status
                                ).then((result)=>{
                                    window.location.reload();
                                });
                            }
                        })
                    }else if(result.isDenied){
                        $.ajax({
                            url : '<?= site_url('panitia/ijin/aksi')?>',
                            method : 'post',
                            data : {
                                __csrf : $('#csrf').val(),
                                id : $('#id-'+loc).val(),
                                aksi : 2,
                                comment :`${result.value.comment}`,
                            },
                            success : function(response){
                                $('#csrf').val(response.csrf);
                                swalWithBootstrapButtons.fire(
                                    response.title,
                                    response.message,
                                    response.status
                                ).then((result)=>{
                                    window.location.reload();
                                });
                            }
                        })
                    }
                })
            });
        })
    </script>
<?= $this->endSection('script') ?>