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
                <h4 class="text-center">Attendance Dashboard</h4>
                <hr/>
                <p class="text-center">
                    <a href="index.php" class="btn btn-info">Back</a>
                </p>

                <br>
                <div class="row flex-grow">

                    <?php
                    if (!empty($_GET['id'])) {
                        $ID = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");

                        Attendance::LoadAttendance($ID, $STD_ID);


                    }

                    ?>
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


    });


</script>

</body>

</html>
