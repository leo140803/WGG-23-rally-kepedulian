<?= $this->extend('RBAC/rbac_layouts') ?>


<?= $this->section('css') ?>
<!-- css tambahan taruh sini -->
<style>
    .overflow-y-scroll{
        overflow-y: scroll;
    }

    ::-webkit-scrollbar {
        width: 15px;
    }

    ::-webkit-scrollbar-track {
        background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #d6dee1;
        border-radius: 10px;
        border: 6px solid transparent;
        background-clip: content-box;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #a8bbbf;
    }
</style>
<?= $this->endSection('css') ?>


<?= $this->section('content') ?>

<div class="container">
    <h1 class="h1 text-center mb-5">Assign Roles</h1>
    <div class="row justify-content-center">
        <div class="col-lg-4" id="col-users">
            <h4 class="h4 text-center">Users</h4>
            <input class="form-control my-3" id="userInput" type="text" placeholder="Search User">
            <div class="list-group overflow-y-scroll" id="userList" style="height: 75vh;">
                
                <?php foreach($users as $user): ?>
                
                <button type="button" class="list-group-item list-group-item-action btn-user" id="<?= $user['nrp'] ?>">
                    <span class="d-inline-block text-truncate" style="max-width: 70%;"><?= $user['user'] ?></span>
                    <span class="badge bg-secondary rounded-pill float-end"><?= $user['divisi'] ?></span>
                </button>

                <?php endforeach; ?>
                
            </div>
        </div>

        <div class="col-lg-4 d-lg-block" id="col-roles" style="display: none">
            <h4 class="h4 text-center">Roles
                <span class="badge badge-sm bg-danger rounded-pill float-end fs-6" style="display: none" id="btn-close">X</span>
            </h4>
            
            <input class="form-control my-3" id="roleInput" type="text" placeholder="Search Role">
            
            <div class="mb-2" id="title-role"></div>

            <ul class="list-group overflow-y-scroll" id="roleList" style="height: 75vh;">

                <?php foreach($roles as $role): ?>

                <li class="list-group-item">
                    <form action="" method="post" class="form-role">
                        <input class="form-check-input me-1 checkbox" type="checkbox" name="role" value="<?= $role['id'] ?>" id="role<?= $role['id'] ?>">
                        <label class="form-check-label stretched-link" for="role<?= $role['id'] ?>"><?= $role['nama'] ?></label>
                    </form>
                </li>

                <?php endforeach; ?>

            </ul>
        </div>
    </div>

    <div class="toast-container bottom-0 end-0 p-3 position-fixed">

        <!-- Toas berhasil -->
        <div class="toast" id="toast-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto">SUCCESS</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body-success">
                Berhasil Hore
            </div>
        </div>
        
        <!-- Toas gagal -->
        <div class="toast" id="toast-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <i class="bi bi-exclamation-circle-fill"></i>
                <strong class="me-auto">ERROR</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body-danger">
                Gagal Hore
            </div>
        </div>
    </div>

    <input id="csrf" type="hidden" name="__csrf" value="<?= csrf_hash() ?>">
    
    <!-- Isi Disini Content nya -->    
</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>
<!-- script tambahan taruh sini -->
<script>
    $(document).ready(() => {
        nrp = "";
        toogle = true;

        //filter
        $("#userInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#userList button").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
        //filter
        $("#roleInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#roleList li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $(".btn-user").on("click", function(){
            //set selected user
            $(".btn-user").removeClass("active");
            $(this).toggleClass("active");

            $("#title-role").text($(this).text() + "roles");
            
            //hide and show when in mobile
            if ($(window).width() < 1200) {
                $("#col-users").hide();     //hide list user
                $("#col-roles").show();     //show list roles
                $("#btn-close").show();     //show btn close
            }

            site_url = "<?= site_url() ?>";
            nrp = $(this).prop("id");

            //get assign role to this user
            $.ajax({
                method: "GET",
                url: site_url + "panitia/rbac/role/" + nrp,
                success(response){
                    setColRole(response);
                }
            });
        });

        function setColRole(data){
            //reset checked box
            $(".checkbox").prop("checked", false);
            
            for(datum of data.assignRoles){
                $("#role"+datum.id).prop("checked", true);
            }            
        }

        $(".form-role").click(function(e){
            if(toogle){
                toogle = false;
            }else{
                toogle = true;
                return;
            }

            site_url = "<?= site_url() ?>";

            //check assign or unassign
            method = "";
            if($(this).children(".checkbox").is(":checked")){      //kalo udah ada checked nya berarti mau delete
                method = "DELETE";
            }else{
                method = "POST";
            }

            $.ajax({
                method: "POST",
                url: site_url + "panitia/rbac/role/" + nrp,     //nrp ambil dari btn-user click
                data: {
                    __csrf: $("#csrf").val(),
                    _method: method,
                    role: $(this).children(".checkbox").val()
                },
                success(response){
                    $("#csrf").val(response.csrf);
                    showToast("success", response.msg);
                },
                error(jqXHR, textStatus, errorThrown){
                    showToast("danger", jqXHR.responseJSON.msg);
                    console.log("error");
                }
            });
        });

        function showToast(type, msg){
            if(type == "success"){
                toastElement = $("#toast-success");
            }else{
                toastElement = $("#toast-danger");
            }

            $(".toast-body").text(msg);
            
            toast = new bootstrap.Toast(toastElement);
    
            toast.show();
        }

        $("#btn-close").on("click", function(){
            if ($(window).width() < 1200) {
                $("#col-users").show();     //show list user
                $("#col-roles").hide();     //hide list roles
                $("#btn-close").hide();     //hide btn close
            }else{
                $("#col-users").show();     //hide list user
                $("#col-roles").show();     //show list roles
                $("#btn-close").hide();     //hide btn close
            }
        });
    });
</script>

<?= $this->endSection('script') ?>