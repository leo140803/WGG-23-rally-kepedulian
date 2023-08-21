<?= $this->extend('ijin/peserta_ijin_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center justify-content-center align-items-center mt-5">
            <p class="text-center">Mahasiswa harap membaca SOP izin dan dispensasi terlebih dahulu</p>
            <!-- <button type="button" class="btn btn-danger" data-bs-toggle='modal' data-bs-target='#modalizin'><strong> SOP Izin</strong></button> -->
            <button type="button" class="btn btn-danger" data-bs-toggle='modal' data-bs-target='#modaldispensasi'><strong> SOP </strong></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center justify-content-center align-items-center mt-5">
            <!-- <p class="pt-5 text-center">Untuk menambah perizinan, silahkan klik tombol di bawah ini</p> -->
            <a href="<?= site_url('/peserta/ijin/insert') ?>"><button type="button" class="btn btn-primary bg-blue"><strong> <i class="bi bi-plus"></i> Tambah Izin / Dispensasi</strong></button></a>
        </div>
    </div>
    <div class='row mt-4'>
        <h3 class="text-center">Status Izin / Dispensasi</h3>
        <div class="table-responsive">
            <table class="table" id="statusIzin">
                <thead>
                    <tr class="bg-blue text-white">
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Jenis</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                        $num = 1;
                        if($ijin == null){
                            echo "<tr><td colspan='9'>No Data Available</td></tr>";
                        }
                        else{
                            foreach($ijin as $row){
                                echo "<tr>";
                                echo "<td>$num</td>";
                                echo "<td>". $row['tanggal']. "</td>";
                                echo "<td>". $row['waktu_mulai']. "</td>";
                                echo "<td>". $row['waktu_selesai']. "</td>";
                                if($row['jenis_ijin'] == 1){
                                    echo "<td>Dispensasi</td>";
                                }else{
                                    echo "<td>Izin</td>";
                                }
                                echo "<td>
                                <button class='btn btn-primary bg-blue viewAlasan' data-bs-toggle='modal' data-bs-target='#modalku' id='alas-".$num."'>Alasan</button>
                                <input type='hidden' id='alasan-".$num."' value='".$row['keterangan']."'>
                                </td>";
                                if($row['terima'] == 0){
                                    echo "<td class='text-warning'><strong>Menunggu respon</strong></td>";
                                }else if($row['terima'] == 1){
                                    echo "<td class='text-success'><strong>Perizinan Diterima</strong></td>";
                                }else{
                                    echo "<td class='text-danger'><strong>Perizinan Ditolak</strong></td>";
                                }
                                echo "<td><a href='".site_url('/assets/uploads/buktiIjin/'.$row['bukti'])."' target='_blank'><button class='btn btn-primary bg-blue'>Bukti</button></a></td>";
                                if($row['comment']==null){
                                    echo "<td>No comment</td>";
                                }else{
                                    echo "<td>
                                    <button class='btn btn-primary bg-blue viewComment' data-bs-toggle='modal' data-bs-target='#modalku' id='alas-".$num."'>Comment</button>
                                    <input type='hidden' id='Comment-".$num."' value='".$row['comment']."'>
                                    </td>";
                                }
                                echo "</tr>";
                                $num+=1;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
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
            <button type="button" class="btn btn-primary bg-blue" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalizin" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">SOP Izin</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>

            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary bg-blue" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaldispensasi" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5">SOP Izin / Dispensasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <ol>
                <li class="my-3">
                    Perizinan tidak mengikuti kegiatan WGG maksimal H-3 dari tanggal berhalangan hadir dengan menyertakan surat keterangan orang tua.
                </li>
                <li class="my-3">
                    Perizinan sakit dapat dilakukan H-1 dengan menyertakan surat keterangan dokter.
                </li>
                <li class="my-3">
                    Perizinan dispensasi maksimal H-3 dari hari pertama WGG dengan menyertakan foto bukti pelanggaran.
                </li>


            </ol>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary bg-blue" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
    <script>
        $(document).ready(function(){
            <?php if($ijin != null): ?>
            $("#statusIzin").DataTable(
                {"scrollX" : false}
            );
            <?php endif; ?>
            $('.viewAlasan').on('click',function(){
                let id = $(this).attr("id");
                let loc = id.split('-')[1];
                $("#judulModal").text('Alasan Perizinan');
                $('#isiModal').text($('#alasan-'+loc).val());
            });
            $('.viewComment').on('click',function(){
                let id = $(this).attr("id");
                let loc = id.split('-')[1];
                $("#judulModal").text('Comment Perizinan');
                $('#isiModal').text($('#Comment-'+loc).val());
            });
        })
    </script>
<?= $this->endSection('script') ?>