<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>
        <?=(isset($title) && $title != '' ? $title . ' | ' : '') ?> WGG 2023
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Website WGG 2023" name="description" />
    <meta content="Welcome Grateful Generation 2023" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= site_url('assets/images/favicon.ico')?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <?= $this->renderSection('css') ?>
</head>
<body>

    <?=$this->renderSection('base_content')?>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <?= $this->renderSection('script') ?>
</body>
</html>