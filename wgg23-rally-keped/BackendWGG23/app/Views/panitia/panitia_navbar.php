<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= site_url('/panitia')?>">
            <img src="<?= site_url('assets/images/wgg.png')?>" width="auto" height="35" class="d-inline-block align-top" alt="">
            Panitia WGG 2023
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php foreach ($rute as $r) : ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?= site_url(str_replace("\\", "", $r['route'],))?>"><?= $r['nama_route'] ?></a>
                </li>
            <?php endforeach; ?>

            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= site_url("logout")?>">Logout</a>
            </li>
            </ul>
        </div>
    </div>
</nav>