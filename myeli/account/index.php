<?php
require_once "../../Core/Utils/Config.php";
require_once "../../vendor/autoload.php";


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
                <h4 class="text-center">My ELI Profile</h4>
                <hr>

                <div class="row flex-grow">
                    <div class="col-8 offset-2">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center"><?php
                                        echo $FNAME . " " . $LNAME
                                        ?></h4>
                                    <h6 class="card-title text-center"><?php
                                        echo $EMAIL
                                        ?></h6>


                                    <img class="img img-fluid" src='<?php echo URL_ROOT . "/images/profiles/$PIC" ?>'>

                                    <p class="card-description" id="STATUS">

                                    </p>

                                    <p class="text-center"><a class="btn btn-success" href="change_pic.php">Change
                                            Picture</a>
                                        | <a class="btn btn-danger" href="change_pass.php">Change Password</a></p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                <br>


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


</body>

</html>
