<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fredoka One">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    body{
        background-image: url('<?= site_url('assets/images/info/plain-bg.webp') ?>');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
    #bg{
        backdrop-filter: blur(8px) !important;
        /* width: 100vw;
        height: 100vh; */
    }

    #info{
        max-height: 90vh;
        width: auto;
    }

    .bg-purple{
        background-color: #f7f1e1;
    }

    .opacity-90{
        opacity: 0.9;
    }

    /* social media css */
    .text{
        transform: translateX(-100%);
    }
    .fab{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .wrapper .icon{
        position: relative;
        background-color: #ffffff;
        border-radius: 50%;
        margin: 5px;
        width: 45px;
        height: 45px;
        line-height: 45px;
        font-size: 22px;
        display: inline-block;
        align-items: center;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        color: #333;
        text-decoration: none;
    }

    .wrapper .tooltip {
        position: absolute;
        top: 0;
        line-height: 1.5;
        font-size: 14px;
        background-color: #ffffff;
        color: #ffffff;
        padding: 5px 8px;
        border-radius: 5px;
        box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .wrapper .tooltip::before {
        position: absolute;
        content: "";
        height: 8px;
        width: 8px;
        background-color: #ffffff;
        bottom: -3px;
        left: 50%;
        transform: translate(-50%) rotate(45deg);
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    .wrapper .icon:hover .tooltip {
        top: -45px;
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }
    .wrapper .icon:hover span,
    .wrapper .icon:hover .tooltip {
        text-shadow: 0px -1px 0px rgba(0, 0, 0, 0.1);
    }
    .wrapper .facebook:hover,
    .wrapper .facebook:hover .tooltip,
    .wrapper .facebook:hover .tooltip::before {
        background-color: #3b5999;
        color: #ffffff;
    }
    .wrapper .twitter:hover,
    .wrapper .twitter:hover .tooltip,
    .wrapper .twitter:hover .tooltip::before {
        background-color: #46c1f6;
        color: #ffffff;
    }
    .wrapper .instagram:hover,
    .wrapper .instagram:hover .tooltip,
    .wrapper .instagram:hover .tooltip::before {
        background-color: #e1306c;
        color: #ffffff;
    }
    .wrapper .github:hover,
    .wrapper .github:hover .tooltip,
    .wrapper .github:hover .tooltip::before {
        background-color: #333333;
        color: #ffffff;
    }
    .wrapper .youtube:hover,
    .wrapper .youtube:hover .tooltip,
    .wrapper .youtube:hover .tooltip::before {
        background-color: #de463b;
        color: #ffffff;
    }

    /* timeline css */
    .timeline_area {
        position: relative;
        z-index: 1;
    }
    .single-timeline-area {
        position: relative;
        z-index: 1;
        padding-left: 180px;
    }
    @media only screen and (max-width: 575px) {
        .single-timeline-area {
            padding-left: 100px;
        }
    }
    .single-timeline-area .timeline-date {
        position: absolute;
        width: 180px;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -ms-grid-row-align: center;
        align-items: center;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
        padding-right: 60px;
    }
    @media only screen and (max-width: 575px) {
        .single-timeline-area .timeline-date {
            width: 100px;
        }
    }
    .single-timeline-area .timeline-date::after {
        position: absolute;
        width: 3px;
        height: 100%;
        content: "";
        background-color: #ebebeb;
        top: 0;
        right: 30px;
        z-index: 1;
    }
    .single-timeline-area .timeline-date::before {
        position: absolute;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background-color: #f1c40f;
        content: "";
        top: 50%;
        right: 26px;
        z-index: 5;
        margin-top: -5.5px;
    }
    .single-timeline-area .timeline-date p {
        margin-bottom: 0;
        color: #020710;
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 500;
    }
    .single-timeline-area .single-timeline-content {
        position: relative;
        z-index: 1;
        padding: 30px 30px 25px;
        border-radius: 6px;
        margin-bottom: 15px;
        margin-top: 15px;
        -webkit-box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        box-shadow: 0 0.25rem 1rem 0 rgba(47, 91, 234, 0.125);
        border: 1px solid #ebebeb;
        background-color: #f7f1e1;
    }
    @media only screen and (max-width: 575px) {
        .single-timeline-area .single-timeline-content {
            padding: 20px;
        }
    }
    .single-timeline-area .single-timeline-content .timeline-icon {
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
        width: 30px;
        height: 30px;
        background-color: #f1c40f;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 30px;
        flex: 0 0 30px;
        text-align: center;
        max-width: 30px;
        border-radius: 50%;
        margin-right: 15px;
    }
    .single-timeline-area .single-timeline-content .timeline-icon i {
        color: #ffffff;
        line-height: 30px;
    }
    .single-timeline-area .single-timeline-content .timeline-text h6 {
        -webkit-transition-duration: 500ms;
        transition-duration: 500ms;
    }
    .single-timeline-area .single-timeline-content .timeline-text p {
        font-size: 13px;
        margin-bottom: 0;
    }
    .single-timeline-area .single-timeline-content:hover .timeline-icon,
    .single-timeline-area .single-timeline-content:focus .timeline-icon {
        background-color: #020710;
    }
    .single-timeline-area .single-timeline-content:hover .timeline-text h6,
    .single-timeline-area .single-timeline-content:focus .timeline-text h6 {
        color: #3f43fd;
    }
</style>

<?= $this->endSection('css') ?>


<!-- body -->
<?= $this->section('base_content') ?>


<div id="bg">
    <nav class="navbar navbar-expand-lg sticky-top bg-purple opacity-90" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="">
                <h5 class="nav-item" >WGG 2023</h5 class="nav-item" >
                <!-- <img src="<?= site_url('assets/images/wgg.png')?>" width="auto" height="35" class="d-inline-block align-top" alt=""> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#announcement">ANNOUNCEMENT</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#briefing">BRIEFING</a>
                    </li>
                    <!-- <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#sarasehan">SARASEHAN</a>
                    </li> -->
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#timeline">TIMELINE</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#ta">PERATURAN</a>
                    </li>
                    <!-- <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#formkonkes">FORM KONKES</a>
                    </li> -->
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#reels">SOP IG REELS</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#obat">FORM OBAT</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#bus">PETRA SHUTTLE BUS</a>
                    </li>
                    <!-- <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#rc">RC Kalkulus</a>
                    </li> -->
                    <li class="nav-item mx-2">
                        <a class="nav-link" aria-current="page" href="#faq">FAQ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-3">
        <h1 class="text-center text-white mb-5" id="announcement">ANNOUNCEMENT</h1>
        <img id="info" src="<?= site_url("assets/images/info/info-portrait.webp") ?>" class="img-thumbnail">

        <div class="row justify-content-center my-5">
            <div class="col-sm-6" id="briefing">
                <h1 class="text-center text-white mb-4">BRIEFING WGG 2023</h1>

                <div class="bg-purple rounded p-3">
                    
                    <h4 class="text-center my-3">Briefing WGG 2023 dapat diakses pada <a href="<?= site_url('/briefing')?>">wgg.petra.ac.id/wgg23/briefing</a> </h4>
                </div>
            </div>
        </div>

        <!-- <div class="row justify-content-center my-5">
            <div class="col-sm-6" id="sarasehan">
                <h1 class="text-center text-white mb-4">INFO SARASEHAN</h1>

                <div class="bg-purple rounded p-3">
                <h5 class="mb-4">Pengambilan KTM dan Jas Almamater</h5>

                Mahasiswa Baru dapat melakukan pengambilan pada : <br>
                <br>
                <table>
                    <tr>
                        <td>Hari, tanggal</td>
                        <td>:</td>
                        <td>Jumat, 14 - Sabtu, 15 Juli 2023 (sesuai jadwal sarasehan)</td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>Setelah sarasehan</td>
                    </tr>
                    <tr>
                        <td>Tempat</td>
                        <td>:</td>
                        <td>Ruang VIP, gedung Q lantai 3</td>
                    </tr>
                </table>

                <br>
                    Diingatkan untuk membawa hard-copy/soft-copy bukti pendaftaran definitif (berisi ukuran almamater) saat pengambilan. Berkas definitif dapat diakses melalui website <a href="https://admission.petra.ac.id" target="_blank">admission.petra.ac.id</a> dengan langkah:
                <ol>
                    <li>Login PAC</li>
                    <li>Pilih menu 3. definitif</li>
                    <li>Lihat pada bagian berkas yang harus dikirimkan</li>
                    <li>Klik cetak</li>
                    <li>Bukti pendaftaran definitif dapat dilihat pada halaman paling bawah</li>
                </ol>

                <h5 class="my-4">Perubahan Ruang Sarasehan</h5>
                
                Seluruh Mahasiswa Baru Fakultas Teknik Sipil dan Perencanaan (FTSP), kegiatan sarasehan yang awalnya dilaksanakan di Auditorium Q berubah di Amphitheatre Q. Tidak ada perubahan untuk jadwal pelaksanaannya.
                
                <h5 class="my-4">Reminder Jadwal Sarasehan</h5>

                <?php if( date("Y-m-d H:i:s") > "2023-07-14 15:00:00" ): ?>

                Mengingatkan untuk jadwal Sarasehan Orang Tua Mahasiswa Baru yang dilaksanakan Sabtu, 15 Juli 2023, dengan detail sebagai berikut :
                <br><br>
                <ol>
                    <li class="mb-4">
                        <h6>Faculty of Civil Engineering and Planning (FCEP)</h6>
                        <table>
                            <tr class="align-top">
                                <td>Program Studi</td>
                                <td>:</td>
                                <td>
                                    <ul>
                                        <li> CIVIL ENGINEERING </li>
                                        <li> ARCHITECTURE </li>
                                        <li> ARCHITECTURE OF SUSTAINABLE HOUSING AND REAL ESTATE </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Pukul</td>
                                <td>:</td>
                                <td>09.00 - 10.30 WIB</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>Amphitheatre Q lt. 2</td>
                            </tr>
                        </table>
                    </li>
                    <li class="mb-4">
                        <h6>School of Business Management (SBM)</h6>
                        <table>
                            <tr class="align-top">
                                <td>Program Studi</td>
                                <td>:</td>
                                <td>
                                    <ul>
                                        <li> CREATIVE TOURISM </li>
                                        <li> HOTEL MANAGEMENT </li>
                                        <li> FINANCE AND INVESTMENT </li>
                                        <li> BRANDING AND DIGITAL MARKETING </li>
                                        <li> BUSINESS MANAGEMENT </li>
                                        <li> INTERNATIONAL BUSINESS MANAGEMENT </li>
                                        <li> BUSINESS ACCOUNTING </li>
                                        <li> INTERNATIONAL BUSINESS ACCOUNTING </li>
                                        <li> TAX ACCOUNTING </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Pukul</td>
                                <td>:</td>
                                <td>14.00 - 15.30 WIB</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>Auditorium Q lt. 3</td>
                            </tr>
                        </table>
                    </li>
                </ol>

                <?php else: ?>
                
                Mengingatkan untuk jadwal Sarasehan Orang Tua Mahasiswa Baru yang dilaksanakan Jumat, 14 Juli 2023, dengan detail sebagai berikut :
                <br><br>
                <ol>
                    <li class="mb-4">
                        <h6>Faculty of Industrial Technology (FIT)</h6>
                        <table>
                            <tr class="align-top">
                                <td>Program Studi</td>
                                <td>:</td>
                                <td>
                                    <ul>
                                        <li> ELECTRICAL ENGINEERING </li>
                                        <li> INTERNET OF THINGS </li>
                                        <li> SUSTAINABLE MECHANICAL ENGINEERING AND DESIGN </li>
                                        <li> AUTOMOTIVE </li>
                                        <li> INDUSTRIAL ENGINEERING </li>
                                        <li> INTERNATIONAL BUSINESS ENGINEERING </li>
                                        <li> GLOBAL LOGISTICS AND SUPPLY CHAIN </li>
                                        <li> INFORMATICS </li>
                                        <li> BUSINESS INFORMATION SYSTEM </li>
                                        <li> DATA SCIENCE AND ANALYTICS </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Pukul</td>
                                <td>:</td>
                                <td>09.00 - 10.30 WIB</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>Auditorium Q lt.4</td>
                            </tr>
                        </table>
                    </li>
                    <li class="mb-4">
                        <h6>Faculty of Teacher Education (FTE)</h6>
                        <table>
                            <tr class="align-top">
                                <td>Program Studi</td>
                                <td>:</td>
                                <td>
                                    <ul>
                                        <li> ELEMENTARY TEACHER EDUCATION </li>
                                        <li> EARLY CHILDHOOD TEACHER EDUCATION </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Pukul</td>
                                <td>:</td>
                                <td>09.00 - 10.30 WIB</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>Amphitheatre Q lt.2</td>
                            </tr>
                        </table>
                    </li>
                    <li class="mb-4">
                        <h6>Faculty of Humanities and Creative Industries (FHCI)</h6>
                        <table>
                            <tr class="align-top">
                                <td>Program Studi</td>
                                <td>:</td>
                                <td>
                                    <ul>
                                        <li> ENGLISH FOR BUSINESS </li>
                                        <li> ENGLISH FOR CREATIVE INDUSTRY </li>
                                        <li> CHINESE </li>
                                        <li> INTERIOR PRODUCT DESIGN </li>
                                        <li> INTERIOR DESIGN AND STYLING </li>
                                        <li> VISUAL COMMUNICATION DESIGN </li>
                                        <li> TEXTILE AND FASHION DESIGN </li>
                                        <li> INTERNATIONAL PROGRAM IN DIGITAL MEDIA </li>
                                        <li> BROADCAST AND JOURNALISM </li>
                                        <li> STRATEGIC COMMUNICATION </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Pukul</td>
                                <td>:</td>
                                <td>14.00 - 15.30 WIB</td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td>Auditorium Q lt. 4</td>
                            </tr>
                        </table>
                    </li>
                </ol>

                <?php endif; ?>

                Jika terdapat kendala dapat menghubungi OA LINE: @328readn
                </div>
            </div>
        </div> -->

        <div class="container mt-5">
            <div class="row justify-content-center my-3">
                <div class="col-sm-12" id="timeline">
                    <h1 class="text-center text-white mb-4">TIMELINE</h1>

                    
                    <section class="timeline_area section_padding_130">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Timeline Area-->
                                    <div class="apland-timeline-area">

                                        <!-- DAY 1-->
                                        <div class="single-timeline-area">
                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                <h5 class="text-white text-end">Day 1 <br> Kamis, <br> 20 Juli 2023</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Dress Code</h5>
                                                            <p class="fs-6">Baju berkerah berwarna putih atau biru</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Jam Masuk & Pulang (WIB)</h5>
                                                            <p class="fs-6">07:30 - 13:00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End DAY 1 -->
                                        
                                        <!-- DAY 2-->
                                        <div class="single-timeline-area">
                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                <h5 class="text-white text-end">Day 2 <br> Jumat, <br> 21 Juli 2023</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Dress Code</h5>
                                                            <p class="fs-6">Polo Petra Christian University</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Jam Masuk & Pulang (WIB)</h5>
                                                            <p class="fs-6">07:30 - 15:30</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End DAY 2 -->
                                        
                                        <!-- DAY 3-->
                                        <div class="single-timeline-area">
                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                <h5 class="text-white text-end">Day 3 <br> Sabtu, <br> 22 Juli 2023</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Dress Code</h5>
                                                            <p class="fs-6">Kaos Petra Christian University (Fakultas)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Jam Masuk & Pulang (WIB)</h5>
                                                            <p class="fs-6">07:30 - 15:30</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End DAY 3 -->

                                        <!-- DAY 4-->
                                        <div class="single-timeline-area">
                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                <h5 class="text-white text-end">Day 4 <br> Senin, <br> 24 Juli 2023</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Dress Code</h5>
                                                            <p class="fs-6">Informasi disampaikan melalui grup program studi/fakultas masing-masing</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Jam Masuk & Pulang (WIB)</h5>
                                                            
                                                            <p class="fs-6">Informasi menyusul. Mahasiswa baru diharapkan untuk selalu memantau  <a href="https://instagram.com/wgg.pcu/" target="_blank">instagram</a> dan <a href="https://wgg.petra.ac.id/wgg23" target="_blank">website</a> untuk mendapatkan update informasi terbaru.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End DAY 4 -->


                                        <!-- DAY 5-->
                                        <div class="single-timeline-area">
                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                <h5 class="text-white text-end">Day 5 <br> Selasa, <br> 25 Juli 2023</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Dress Code</h5>
                                                            <p class="fs-6">Polo Petra Christian University</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Jam Masuk & Pulang (WIB)</h5>
                                                            <p class="fs-6">07:30 - 15:30</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End DAY 5 -->
                                        
                                        
                                        <!-- DAY 6-->
                                        <div class="single-timeline-area">
                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                <h5 class="text-white text-end">Day 6 <br> Rabu, <br> 26 Juli 2023</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Dress Code</h5>
                                                            <p class="fs-6">Kaos Petra Christian University (Fakultas)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Jam Masuk & Pulang (WIB)</h5>
                                                            <p class="fs-6">
                                                                <button type="button" class="btn btn-warning m-1" data-bs-toggle="modal" data-bs-target="#shift1">
                                                                    Shift 1
                                                                </button>
                                                                <button type="button" class="btn btn-warning m-1" data-bs-toggle="modal" data-bs-target="#shift2">
                                                                    Shift 2
                                                                </button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End DAY 6 -->
                                        
                                        
                                        <!-- DAY 7-->
                                        <div class="single-timeline-area">
                                            <div class="timeline-date wow fadeInLeft" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">
                                                <h5 class="text-white text-end">Day 7 <br> Kamis, <br> 27 Juli 2023</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Dress Code</h5>
                                                            <p class="fs-6">Baju berkerah berwarna terang</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="single-timeline-content d-flex wow fadeInLeft" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInLeft;">
                                                        <div class="timeline-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                                        </div>
                                                        <div class="timeline-text">
                                                            <h5>Jam Masuk & Pulang (WIB)</h5>
                                                            <p class="fs-6">09:00 - 15:30</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End DAY 7 -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            
            <div class="row justify-content-center my-5">
                <div class="col-sm-8" id="ta">
                    <h1 class="text-center text-white mb-4">PERATURAN</h1>

                    <div class="ratio ratio-16x9">
                        <iframe src="https://docs.google.com/presentation/d/e/2PACX-1vTyb6tRJbZbG_uPCx0M0RDRKulAmTGFEPso6HqVcZUUqN225YZUplYPqvtWuxUBLQ/embed?start=false&loop=false&delayms=3000" frameborder="0" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
                    </div>

                    <h3 class="text-center text-white my-5">Peraturan Peserta juga dapat diakses pada <a href="https://petra.id/peraturanWGG2023" target="_blank">petra.id/peraturanWGG2023</a> </h3>
                </div>
            </div>
            
            
            <!-- <div class="row justify-content-center my-5">
                <div class="col-sm-6" id="formkonkes">
                    <h1 class="text-center text-white mb-4">FORM KONSUMSI & KESEHATAN</h1>

                    <div class="bg-purple rounded p-3">
                        Mahasiswa baru diharapkan mengisi form konsumsi dan kesehatan pada link <a href="https://petra.id/formKonkesWGG2023" target="_blank" class="fs-5">petra.id/formKonkesWGG2023</a>
                        <p>Mahasiswa harap menggunakan email Petra (@john.petra.ac.id) untuk mengisi form</p>
                        <p>Batas pengisian sampai <span class="fs-5 fw-bold text-decoration-underline">12 JULI 2023</span></p>
                    </div>
                </div>
            </div> -->
            
            
            <div class="row justify-content-center my-5">
                <div class="col-sm-6" id="reels">
                    <h1 class="text-center text-white mb-4">SOP IG REELS</h1>

                    <div class="bg-purple rounded p-3">
                        <iframe src="https://drive.google.com/file/d/1VgnKT3ZRqL224zvH72UKHpSp4J56Te-g/preview" class="w-100" height="480" allow="autoplay"></iframe>
                        <h4 class="text-center my-3">SOP IG Reels juga dapat diakses pada <a href="https://petra.id/SOPReelsWGG2023" target="_blank">petra.id/SOPReelsWGG2023</a> </h4>
                    </div>
                </div>
            </div>
            
            
            <div class="row justify-content-center my-5">
                <div class="col-sm-6" id="obat">
                    <h1 class="text-center text-white mb-4">FORM OBAT</h1>

                    <div class="bg-purple rounded p-3">
                        Kepada seluruh Maba 2023, sebelum acara WGG dimulai jika perlu membawa obat harus mendaftarkan obat yang dibawa melalui:
                        <a href="https://petra.id/FormPendaftaranObat" target="_blank" class="fs-5">petra.id/FormPendaftaranObat</a>

                        <p>
                            Dimohon untuk memperhatikan SOP Pendaftaran Obat agar tidak ada kendala yang terjadi.
                        </p>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center my-5">
                <div class="col-sm-6" id="bus">
                    <h1 class="text-center text-white mb-4">PETRA SHUTTLE BUS</h1>

                    <div class="bg-purple rounded p-3">
                        Informasi mengenai Petra Shuttle Bus dapat dilihat melalui highlight instagram @wgg.pcu:
                        
                        <a href="https://petra.id/petraShuttleBus" target="_blank" class="fs-5">petra.id/petraShuttleBus</a>
                    </div>
                </div>
            </div>
            
            
            <!-- <div class="row justify-content-center my-5">
                <div class="col-sm-6" id="rc">
                    <h1 class="text-center text-white mb-4">Tes Penempatan RC Kalkulus</h1>

                    <div class="bg-purple rounded p-3">
                        
                    Bagi mahasiswa Fakultas Teknologi Industri:
                    <ul>
                        <li>Teknik Elektro</li>
                        <li>IoT</li>
                        <li>Teknik Mesin/SMED</li>
                        <li>Otomotif</li>
                        <li>Teknik Industri</li>
                        <li>Global Logistics & SCM</li>
                        <li>International Business Engineering</li>
                        <li>Informatika</li>
                        <li>Sistem Informasi Bisnis</li>
                        <li>Data Science & Analytics</li>
                    </ul>
                    yang berasal dari SMA (Jurusan Non IPA) dan SMK (semua jurusan) <span class="fw-bold"> WAJIB </span>
                    mengikut tes penempatan RC Kalkulus, pada:
                    <br><br>
                    <table>
                        <tr>
                            <td>Hari, tanggal</td>
                            <td>:</td>
                            <td>Selasa, 18 Juli 2023</td>
                        </tr>
                        <tr>
                            <td>Pukul</td>
                            <td>:</td>
                            <td>10.00-11.30 WIB</td>
                        </tr>
                        <tr>
                            <td>Tempat</td>
                            <td>:</td>
                            <td>Gedung P.706 dan P.707</td>
                        </tr>
                    </table>
                    <br>

                    Bahan: 
                    <ul>
                        <li>Dasar Aljabar: komutatif, asosiatif, distributive, faktorisasi</li>
                        <li>Persamaan linier</li>
                        <li>Fungsi dan Grafik</li>
                    </ul>

                    </div>
                </div>
            </div> -->
            
            
            <div class="row justify-content-center my-3">
                <div class="col-sm-6" id="faq">
                    <h1 class="text-center text-white mb-4">FAQ</h1>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <?php foreach($faq as $i => $qna): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-heading<?= $i ?>">
                                <button class="accordion-button collapsed bg-purple" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?= $i ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?= $i ?>">
                                    <?= $qna['question'] ?>
                                </button>
                            </h2>
                            
                            <div id="panelsStayOpen-collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?= $i ?>">
                                <div class="accordion-body">
                                    <?= $qna['answer'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="wrapper mt-3">
            <a href="https://www.instagram.com/lifeatpcu/" target="_blank" class="icon instagram">
                <div class="tooltip">@lifeatpcu</div>
                <span><i class="fab fa-instagram"></i></span>
            </a>
            <a href="https://www.tiktok.com/@lifeatpcu" target="_blank" class="icon github">
                <div class="tooltip">@lifeatpcu</div>
                <span><i class="fab fa-tiktok"></i></span>
            </a>
            
            <a href="https://www.instagram.com/wgg.pcu/" target="_blank" class="icon instagram">
                <div class="tooltip">@wgg.pcu</div>
                <span><i class="fab fa-instagram"></i></span>
            </a>
            <a href="https://www.tiktok.com/@wgg.pcu" target="_blank" class="icon github">
                <div class="tooltip">@wgg.pcu</div>
                <span><i class="fab fa-tiktok"></i></span>
            </a>
            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="shift1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">SHIFT 1</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Jam Masuk & Pulang (WIB)</h5>
            <p class="fs-6">07:30 - 11:00</p>

            <table class="table table-striped">
                <thead>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                </thead>
                <tbody>
                    <tr>
                        <td>CREATIVE TOURISM</td>
                        <td rowspan="9" class="align-middle text-center">SBM</td>
                    </tr>
                    <?php
                    $prodi = [
                        'BUSINESS MANAGEMENT',
                        'INTERNATIONAL BUSINESS ACCOUNTING',
                        'HOTEL MANAGEMENT',
                        'MARKETING MANAGEMENT',
                        'TAX ACCOUNTING',
                        'FINANCE AND INVESTMENT',
                        'INTERNATIONAL BUSINESS MANAGEMENT',
                        'BUSINESS ACCOUNTING',
                    ]
                    ?>
                    <?php foreach($prodi as $prod): ?>
                    <tr>
                        <td><?= $prod ?></td>
                    </tr>
                    <?php endforeach;?>
                    
                    <tr>
                        <td>CIVIL ENGINEERING</td>
                        <td rowspan="3" class="align-middle text-center">FTSP</td>
                    </tr>
                    <?php
                    $prodi = [
                        'ARCHITECTURE',
                        'ARCHITECTURE OF SUSTAINABLE HOUSING AND REAL ESTAT',
                    ];
                    ?>
                    <?php foreach($prodi as $prod): ?>
                    <tr>
                        <td><?= $prod ?></td>
                    </tr>
                    <?php endforeach;?>
                    
                    <tr>
                        <td>ELECTRICAL ENGINEERING</td>
                        <td rowspan="4" class="align-middle text-center">FTI</td>
                    </tr>
                    <?php
                    $prodi = [
                        'AUTOMOTIVE',
                        'INDUSTRIAL ENGINEERING',
                        'SUSTAINABLE MECHANICAL ENGINEERING AND DESIGN',
                    ];
                    ?>
                    <?php foreach($prodi as $prod): ?>
                    <tr>
                        <td><?= $prod ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="shift2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">SHIFT 2</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5>Jam Masuk & Pulang (WIB)</h5>
            <p class="fs-6">12:00 - 15:30</p>

            <table class="table table-striped">
                <thead>
                    <th>Program Studi</th>
                    <th>Fakultas</th>
                </thead>
                <tbody>
                    <tr>
                        <td>INTERNATIONAL BUSINESS ENGINEERING</td>
                        <td rowspan="6" class="align-middle text-center">FTI</td>
                    </tr>
                    <?php
                    $prodi = [
                        'DATA SCIENCE AND ANALYTICS',
                        'INTERNET OF THINGS',
                        'INFORMATICS',
                        'GLOBAL LOGISTICS AND SUPPLY CHAIN',
                        'BUSINESS INFORMATION SYSTEM',  
                    ];
                    ?>
                    <?php foreach($prodi as $prod): ?>
                    <tr>
                        <td><?= $prod ?></td>
                    </tr>
                    <?php endforeach;?>
                    
                    <tr>
                        <td>ELEMENTARY TEACHER EDUCATION</td>
                        <td rowspan="2" class="align-middle text-center">FKIP</td>
                    </tr>
                    <?php
                    $prodi = [
                        'EARLY CHILDHOOD TEACHER EDUCATION'
                    ];
                    ?>
                    <?php foreach($prodi as $prod): ?>
                    <tr>
                        <td><?= $prod ?></td>
                    </tr>
                    <?php endforeach;?>
                    
                    <tr>
                        <td>ENGLISH FOR BUSINESS</td>
                        <td rowspan="10" class="align-middle text-center">FHIK</td>
                    </tr>
                    <?php
                    $prodi = [
                        'ENGLISH FOR CREATIVE INDUSTRY',
                        'CHINESE',
                        'INTERIOR PRODUCT DESIGN',
                        'INTERIOR DESIGN AND STYLING',
                        'VISUAL COMMUNICATION DESIGN',
                        'TEXTILE AND FASHION DESIGN',
                        'INTERNATIONAL PROGRAM IN DIGITAL MEDIA',
                        'BROADCAST AND JOURNALISM',
                        'STRATEGIC COMMUNICATION',
                    ]
                    ?>
                    <?php foreach($prodi as $prod): ?>
                    <tr>
                        <td><?= $prod ?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>


<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>
<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
      } else {
        document.getElementById("navbar").style.top = "-50px";
      }
      prevScrollpos = currentScrollPos;
    }
</script>
<?= $this->endSection('script') ?>
