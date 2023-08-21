<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Rally</title>

    <style>
        body {
            background-image: url('<?= site_url('assets/images/rally/faq.png') ?>');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }

        .title {
            margin-top: 30px;
            text-align: center;
            margin-bottom: 20px;
        }

        #titlerally {
            font-size: 72px;
            text-shadow:
                -1px -1px 0 white,
                1px -1px 0 white,
                -1px 1px 0 white,
                1px 1px 0 white,
                -2px -2px 0 white,
                2px -2px 0 white,
                -2px 2px 0 white,
                2px 2px 0 white;
            letter-spacing: 10px;
        }

        #bg {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            backdrop-filter: blur(8px);
        }

        .box {
            width: 600px;
            height: 400px;
            background-color: #FAF0E4;
            border-radius: 30px;
            margin: 0 auto;
            position: relative;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        #lumi {
            width: 350px;
            object-fit: cover;
            top: 40px;
            left: 410px;
            position: absolute;
            transform: rotate(5deg);
        }

        .box2 {
            width: 350px;
            height: 250px;
            position: absolute;
            left: 60px;
            top: 70px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        h3 {
            margin-top: -10px;
            color: grey;
        }

        .boxalert {
            width: 300px;
            height: 50px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .boxsignin {
            width: 250px;
            height: 45px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <?php include 'checkViewport.php' ?>
</head>

<body>
    <div id='bg'>
        <div class="title">
            <h1 id="titlerally">The Dilemmatic Pathways</h1>
        </div>
        <div class="box">
            <div class="box2">
                <h1>Welcome Back!</h1>
                <h3>Sign in to continue.</h3>

                <div class="boxalert">
                <?php if (session()->getFlashdata('error') !== null) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="uil uil-exclamation-octagon me-2"></i>
                                <?= session()->getFlashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php endif; ?>
                </div>

                <div class="boxsignin">
                <script src="https://accounts.google.com/gsi/client" async defer></script>
                            <div id="g_id_onload"
                                data-client_id="422658755343-sitjrg8qkcie4pcdd0htihnrqucjrml3.apps.googleusercontent.com"
                                data-context="signin"
                                data-ux_mode="redirect"
                                data-login_uri="<?=site_url("/games/auth2")?>"
                                data-auto_prompt="false">
                            </div>

                            <div class="g_id_signin"
                                data-type="standard"
                                data-shape="rectangular"
                                data-theme="outline"
                                data-text="signin_with"
                                data-size="large"
                                data-logo_alignment="left">
                            </div>
                </div>
            </div>
            <img src="<?= site_url('assets/images/rally/lumi.png') ?>" alt="Lumi" id="lumi">
        </div>
    </div>
</body>

</html>