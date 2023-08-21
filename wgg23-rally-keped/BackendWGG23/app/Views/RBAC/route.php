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
    <h1 class="h1 text-center mb-5">Assign Routes</h1>
    <div class="row justify-content-center">
        <div class="col-lg-4" id="col-roles">
            <h4 class="h4 text-center">Roles</h4>
            <input class="form-control my-3" id="roleInput" type="text" placeholder="Search Role">
            <div class="list-group overflow-y-scroll" id="roleList" style="height: 75vh;">
                
                <?php foreach($roles as $role): ?>
                
                <button type="button" class="list-group-item list-group-item-action btn-role" id="<?= $role['id'] ?>">
                    <span class="d-inline-block text-truncate" style="max-width: 70%;"><?= $role['nama'] ?></span>
                </button>

                <?php endforeach; ?>
                
            </div>
        </div>

        <div class="col-lg-4 d-lg-block" id="col-routes" style="display: none">
            <h4 class="h4 text-center">Routes
                <span class="badge badge-sm bg-danger rounded-pill float-end fs-6" style="display: none" id="btn-close">X</span>
            </h4>
            
            <input class="form-control my-3" id="routeInput" type="text" placeholder="Search Routes">
            
            <div class="mb-2" id="title-route"></div>

            <ul class="list-group overflow-y-scroll" id="routeList" style="height: 75vh;">

                <?php foreach($routes as $route): ?>

                <li class="list-group-item">
                    <form action="" method="post" class="form-route">
                        <input class="form-check-input me-1 checkbox" type="checkbox" name="route" value="<?= $route['id'] ?>" id="route<?= $route['id'] ?>">
                        <label class="form-check-label stretched-link" for="route<?= $route['id'] ?>"><?= $route['route']?></label>
                        <span class="badge bg-secondary rounded-pill float-end"><?= $route['nama'] ?></span>
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
        id_role = "";
        toogle = true;

        $("#col-routes").hide();

        //filter
        $("#roleInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#roleList button").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
        //filter
        $("#routeInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#routeList li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $(".btn-role").on("click", function(){
            //set selected role
            $(".btn-role").removeClass("active");
            $(this).toggleClass("active");

            $("#title-route").text($(this).text() + "routes");
            
            //hide and show when in mobile
            if ($(window).width() < 1200) {
                $("#col-roles").hide();     //hide list roles
                $("#col-routes").show();     //show list routes
                $("#btn-close").show();     //show btn close
            }

            site_url = "<?= site_url() ?>";
            id_role = $(this).prop("id");

            //get assign route to this role
            $.ajax({
                method: "GET",
                url: site_url + "panitia/rbac/route/" + id_role,
                success(response){
                    setColRoute(response);
                }
            });
        });

        function setColRoute(data){
            //reset checked box
            $(".checkbox").prop("checked", false);
            
            for(datum of data.assignRoles){
                $("#route"+datum.id).prop("checked", true);
            }            
        }

        $(".form-route").click(function(e){
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
                url: site_url + "panitia/rbac/route/" + id_role,     //id ambil dari btn-role click
                data: {
                    __csrf: $("#csrf").val(),
                    _method: method,
                    route: $(this).children(".checkbox").val()
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
                $("#col-roles").show();     //show list rols
                $("#col-routes").hide();     //hide list routes
                $("#btn-close").hide();     //hide btn close
            }else{
                $("#col-roles").show();     //hide list roles
                $("#col-routes").show();     //show list routes
                $("#btn-close").hide();     //hide btn close
            }
        });
    });
</script>

<?= $this->endSection('script') ?>