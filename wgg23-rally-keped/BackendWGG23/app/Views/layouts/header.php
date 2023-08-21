<nav class="navbar navbar-expand-lg bg-blue" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand ps-2" href="<?= site_url('/peserta/home') ?>">
            
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
            width="18" height="18" viewBox="0 0 512.000000 512.000000"
            preserveAspectRatio="xMidYMid meet" style="top: -4px; position: relative;">

            <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
            fill="#ffffff" stroke="none">
            <path d="M3590 5102 c-81 -21 -137 -54 -220 -129 -703 -633 -2239 -2029 -2279
            -2071 -102 -106 -143 -251 -121 -424 13 -105 51 -187 121 -260 40 -42 1585
            -1446 2284 -2076 126 -114 262 -158 404 -133 362 65 500 493 245 759 -33 34
            -486 449 -1009 922 -522 474 -950 865 -950 870 0 5 428 396 950 870 523 473
            976 888 1009 922 176 184 175 456 -4 635 -61 61 -127 98 -211 118 -82 19 -138
            18 -219 -3z"/>
            </g>
            </svg>

            
            <span class="h4 mx-4 text-white"><?=(isset($title) && $title != '' ? $title : 'Lainnya') ?></span>
        </a>
    </div>
</nav>