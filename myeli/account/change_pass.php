<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Utils/Config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MyELI | Home</title>

    <?php

    require_once "../../Core/UI/header.php"
    ?>


</head>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php

    require_once "../../Core/UI/NavBar.php"
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->

        <?php

        require_once "../../Core/UI/SideBar.php"
        ?>


        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h4 class="text-center">Account Dashboard</h4>
                <hr/>
                <p class="text-center">
                    <a href="index.php" class="btn btn-info">Back</a>
                </p>

                <div class="row flex-grow">
                    <div class="col-6 offset-3">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Change Password</h4>

                                    <p id="UI"></p>
                                    <hr>
                                    <p id="Status"></p>
                                    <form method="post" id="ChangePassword" class="forms-sample" data-parsley-validate>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Old Password</label>
                                            <input class="form-control" name="old_pass" type="password" id=""
                                                   required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">New Password</label>
                                            <input class="form-control" name="new_pass" type="password" id=""
                                                   required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Confirm New Password </label>
                                            <input class="form-control" name="conf_pass" type="password" id=""
                                                   required="required">
                                        </div>

                                        <button type="submit" class="btn btn-success mr-2">Submit</button>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <?php

            require_once "../../Core/UI/credits.php"
            ?>
            <!-- partial -->
        </div>

    </div>

</div>
<?php

require_once "../../Core/UI/footer.php"
?>

<script>
    $(() => {
        let UI = $("#UI");
        let ChangePassword = $("#ChangePassword");


        ChangePassword.submit((event) => {
            event.preventDefault();
            $.post("../../Core/Controller/std_ctrl.php?action=change", ChangePassword.serialize(), (data, status) => {
                if (status === 'success') {
                    UI.empty().append(data);

                } else {

                }
            });
        });


    });

    $('input[name="period"]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {

    });


</script>

</body>

</html>
