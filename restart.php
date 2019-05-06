<?php
require_once "vendor/autoload.php";
require_once "./Core/Utils/Config.php";
if (isset($_SESSION['STD_ID'])) {
    header("location:" . STUDENT);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>My Eli | Student Portal</title>


    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MyELI | Home</title>

    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>/Core/UX/css/eli.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/Core/UX/css/style.css">


    <style>
        body {
            overflow-x: hidden;
            background: url("images/background.png") no-repeat center !important;
            background-size: cover !important; /* <------ */
            background-position: center center !important;


        }

        .mdi {
            color: #E55000 !important;
        }
    </style>
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auto-form-wrapper">
                        <h4 class="text-center">MyELI | Reset Password</h4>
                        <hr>
                        <div class="col-md-12" id="UI">

                        </div>

                        <?php

                        if (isset($_GET['tk'])) {


                            ?>
                            <form method="post" id="ChangePassword" class="forms-sample" data-parsley-validate>

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
                            <hr>
                            <p class="text-center"><a href="index.php">Login Here</a></p>
                            <?php

                        } else {
                            echo "<h5 class='text-center text-danger'>This link is invalid. <a href='index.php'>Login Here</a> </h5>";
                        }
                        ?>

                    </div>
                    <ul class="auth-footer">
                        <li>
                            <a href="#">Conditions</a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li>
                        <li>
                            <a href="#">Terms</a>
                        </li>
                    </ul>

                    <p class="footer-text text-center">
                        copyright ELI © <?php echo date("Y") ?>. All rights reserved.
                        <br/>Developed By <a href="https://www.linkedin.com/in/jfngozo" target="_blank">Joel F Ngozo</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<script src="vendors/js/vendor.bundle.base.js"></script>
<script src="vendors/js/vendor.bundle.addons.js"></script>

<script src="Core/UX/js/off-canvas.js"></script>
<script src="Core/UX/js/misc.js"></script>


<script>
    $(() => {
        let UI = $("#UI");
        let ChangePassword = $("#ChangePassword");

        const token = GetURLParameter('tk');

        ChangePassword.submit((event) => {
            event.preventDefault();
            $.post("Core/Controller/std_ctrl.php?action=update&tk=" + token, ChangePassword.serialize(), (data, status) => {
                if (status === 'success') {
                    UI.empty().append(data);

                } else {

                }
            });
        });

        function GetURLParameter(sParam) {
            let sPageURL = window.location.search.substring(1);
            let sURLVariables = sPageURL.split('&');
            for (let i = 0; i < sURLVariables.length; i++) {
                let sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1];
                }
            }

        }

    });


</script>
</body>

</html>