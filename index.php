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
                        <h4 class="text-center">MyELI Student Portal</h4>
                        <hr>
                        <div class="col-md-12" id="LoginUI">

                        </div>
                        <form id="LoginForm" action="#" method="post">
                            <div class="form-group">
                                <label class="label">Email</label>
                                <div class="input-group">
                                    <input name="email" type="text" class="form-control" placeholder="email">
                                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="label">Password</label>
                                <div class="input-group">
                                    <input name="password" type="password" class="form-control" placeholder="*********">
                                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary submit-btn btn-block">Login</button>
                            </div>
                            <div class="form-group d-flex justify-content-between">

                                <a href="reset.php" class="text-small forgot-password text-black">Forgot Password</a>
                            </div>


                        </form>
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
    $(document).ready(() => {
        const LoginForm = $('#LoginForm');
        const LoginUI = $('#LoginUI');

        LoginForm.submit((event) => {
            event.preventDefault();

            $.post("Core/Controller/std_ctrl.php?action=login", LoginForm.serialize(), (data, status) => {

                if (status === "success") {
                    LoginUI.empty().append(data);
                } else {
                    LoginUI.empty().append(data);
                }
            })


        })
    })
</script>
</body>

</html>