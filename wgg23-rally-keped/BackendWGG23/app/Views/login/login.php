<?= $this->extend('layouts/base_layouts') ?>

<!-- css -->
<?= $this->section('css') ?>
<style>
    iframe{
        display: initial!important;
    }
</style>
<?= $this->endSection('css') ?>

<!-- body -->
<?= $this->section('base_content') ?>

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    
                    <div class="card-body p-4"> 
                        <div class="text-center mt-2">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p class="text-muted">Sign in to continue.</p>
                        </div>
                        <div class="p-2 mt-4 text-center">
                            
                            <?php if(session()->getFlashdata('error') !== null): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="uil uil-exclamation-octagon me-2"></i>
                                <?= session()->getFlashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <?php endif; ?>

                            <script src="https://accounts.google.com/gsi/client" async defer></script>
                            <div id="g_id_onload"
                                data-client_id="422658755343-sitjrg8qkcie4pcdd0htihnrqucjrml3.apps.googleusercontent.com"
                                data-context="signin"
                                data-ux_mode="redirect"
                                data-login_uri="<?=site_url("/auth2")?>"
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

                            <?php if(0): ?>
                                <a href="<?= $link ?>"> test </a>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>

                <div class="mt-5 text-center">
                    <p>© <script>document.write(new Date().getFullYear())</script> IT WGG</p>
                </div>

            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<?= $this->endSection('base_content') ?>


<!-- script -->
<?= $this->section('script') ?>

<?= $this->endSection('script') ?>