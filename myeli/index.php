<?php
require_once "../Core/Utils/Config.php";
require_once "../vendor/autoload.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MyELI | Home</title>

    <?php

    require_once "../Core/UI/header.php"
    ?>


</head>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php

    require_once "../Core/UI/NavBar.php"
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->

        <?php

        require_once "../Core/UI/SideBar.php"
        ?>


        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h4 class="text-center">Dashboard</h4>
                <hr>
                <br>


                <div class="row flex-grow">
                    <div class="col-md-6 grid-margin stretch-card">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Manage Your I-20</h4>
                                <hr>
                                <p class="card-description" id="STATUS">
                                    Extend, transfer your I-20 documents. We have made it easier
                                    for you to manage your I-20.
                                </p>

                                <p class="text-center"><a class="btn btn-success" href="<?php
                                    echo STUDENT ?>/i_20/">See It Now</a>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Attendance Tracker</h4>
                                <hr>
                                <p class="card-description" id="STATUS">
                                    See how your attendance is fairing like, check your attendance percentages plus
                                    more.
                                </p>

                                <p class="text-center"><a class="btn btn-primary" href="<?php
                                    echo STUDENT ?>/attendance/">Check It Now</a>
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Tuition</h4>
                                <hr>
                                <p class="card-description" id="STATUS">
                                    Pay your tuition without a hustle from now onwards. Pay from anywhere you are.
                                </p>

                                <p class="text-center"><a class="btn btn-info" href="<?php
                                    echo STUDENT ?>/tuition/">Go Now</a>
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-primary">Vacation</h4>
                                <hr>
                                <p class="card-description" id="STATUS">
                                    Manage your vacation. Plan, request, schedule and see your vacation history.
                                </p>

                                <p class="text-center"><a class="btn btn-inverse-info" href="<?php
                                    echo STUDENT ?>/vacation/">Check Now</a>
                                </p>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
            <?php

            require_once "../Core/UI/credits.php"
            ?>

        </div>

        <!-- partial -->
    </div>

</div>

</div>

<?php

require_once "../Core/UI/footer.php"
?>


</body>

</html>
