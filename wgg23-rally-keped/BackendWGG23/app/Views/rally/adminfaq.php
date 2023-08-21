<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            background-color: #9BABB8;
        }

        table {
            margin-top: 15px;
            border-collapse: collapse;
        }

        thead {
            border-color: black;
            background-color: #C4DFDF;
        }

        tbody {
            background-color: #F8F6F4;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        .container {
            max-width: 1200px;
            margin-top: 20px;
        }

        .card {
            background-color: #F5F5F5;
        }

        .cell {
            width: 400px;
            word-wrap: break-word;
            text-align: justify;
        }

        .white-button {
            background-color: white;
        }
    </style>
    <?php //include 'checkViewport.php' ?>
</head>

<body>
    <!-- Navbar -->
    <?php include 'panitia_navbar.php'; ?>
    <div class="container">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                List FAQ
            </div>
            <div class="card-body">
                <!-- Search -->
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="<?php echo $keyword ?>" name="keyword" placeholder="Input keyword" aria-label="Input keyword" aria-describedby="button-addon2" id="inputKeyword">
                        <button class="btn btn-outline-secondary white-button" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add FAQ
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add FAQ</h1>
                                <button type="button" class="btn-close closeButton" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Error -->
                                <div class="alert alert-danger error" role="alert" style="display:none;"></div>
                                <!-- Success -->
                                <div class="alert alert-primary success" role="alert" style="display:none;"></div>
                                <!-- Input FAQ -->
                                <input type="hidden" id="inputId">
                                <div class="mb-3">
                                    <label for="inputQuestion" class="col-sm-2 col-form-label">Question</label>
                                    <textarea class="form-control" id="inputQuestion"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="inputAnswer" class="col-sm-2 col-form-label">Answer</label>
                                    <textarea class="form-control" id="inputAnswer"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary closeButton" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveButton">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = ($pager->getCurrentPage() - 1) * $pager->getPerPage();
                        foreach ($list_faq as $faqrally) {
                            $no++;
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td class="cell"><?= htmlspecialchars($faqrally->question) ?></td>
                                <td class="cell"><?= htmlspecialchars($faqrally->answer) ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="edit(<?php echo $faqrally->id ?>)">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="del(<?php echo $faqrally->id ?>)">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                $linkPagination = $pager->links();
                $linkPagination = str_replace('<li class="active">', '<li class="page-item active">', $linkPagination);
                $linkPagination = str_replace('<li>', '<li class="page-item">', $linkPagination);
                $linkPagination = str_replace("<a", "<a class='page-link'", $linkPagination);
                echo $linkPagination;
                ?>
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>
        $('#saveButton').on('click', function() {
            var $id = $('#inputId').val();
            var $question = $('#inputQuestion').val();
            var $answer = $('#inputAnswer').val();
            $.ajax({
                url: "<?php echo site_url('panitia/games/faq/save'); ?>",
                type: "POST",
                data: {
                    id: $id,
                    question: $question,
                    answer: $answer,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function(response) {
                    var $obj = $.parseJSON(response);
                    if ($obj.success == false) {
                        $('.success').hide();
                        $('.error').show();
                        $('.error').html($obj.error);
                    } else {
                        $('.error').hide();
                        $('.success').show();
                        $('.success').html($obj.success);
                    }
                }
            });
            clear();
        });

        function edit($id) {
            $.ajax({
                url: "<?php echo site_url('panitia/games/faq/edit') ?>/" + $id,
                type: "GET",
                success: function(response) {
                    var $obj = $.parseJSON(response);
                    if ($obj.id != '') {
                        $('#inputId').val($obj.id);
                        $('#inputQuestion').val($obj.question);
                        $('#inputAnswer').val($obj.answer);
                    }
                }
            });
        }

        function del($id) {
            var result = confirm('Are you sure?');
            if (result) {
                window.location = "<?php echo site_url("panitia/games/faq/del") ?>/" + $id;
            }
        }

        function clear() {
            $('#inputId').val('');
            $('#inputQuestion').val('');
            $('#inputAnswer').val('');
        }

        $('.closeButton').on('click', function() {
            if ($('.success').is(":visible")) {
                window.location.href = "<?php echo current_url() . "?" . $_SERVER['QUERY_STRING'] ?>";
            }
            $('.alert').hide();
            clear();
        });
    </script>

</body>

</html>