<?= $this->extend('RBAC/rbac_layouts') ?>


<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->

<?= $this->endSection('css') ?>


<?= $this->section('content') ?>

<div class="container">
    <h1 class="h1 text-center mb-5">Role Based Access Control</h1>
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Roles
                </div>
                <div class="card-body">
                    <h5 class="card-title">Assign Role(s) to user</h5>
                    <p class="card-text">Menambahkan NRP atau divisi tertentu untuk memiliki role tertentu</p>
                    <a href="<?= site_url('/panitia/rbac/role')?>" class="btn btn-primary">Go to Roles</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Routes
                </div>
                <div class="card-body">
                    <h5 class="card-title">Assign Route(s) to Role(s)</h5>
                    <p class="card-text">Menambahkan route(s) mana saja yang dapat diakses oleh role tertentu</p>
                    <a href="<?= site_url('/panitia/rbac/route')?>" class="btn btn-primary">Go to Routes</a>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row justify-content-center mt-4">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Roles
                </div>
                <div class="card-body">
                    <h5 class="card-title">Add Role</h5>
                    <p class="card-text">Menambahkan Role baru</p>
                    <a href="<?= site_url('/panitia/rbac/addRole')?>" class="btn btn-primary">Go to Add Roles</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Routes
                </div>
                <div class="card-body">
                    <h5 class="card-title">Add Route</h5>
                    <p class="card-text">Menambahkan Route baru</p>
                    <a href="<?= site_url('/panitia/rbac/addRoute')?>" class="btn btn-primary">Go to Add Routes</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script>
    
</script>

<?= $this->endSection('script') ?>