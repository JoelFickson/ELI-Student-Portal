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
                <h4 class="text-center">Notifications Dashboard</h4>
                <hr/>

                <p class="card-description text-center" id="">
                    <a href="index.php" class="btn btn-success">Back</a>
                </p>

                <br>
                <div class="row flex-grow">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">


                                <?php
                                if (isset($_GET['id'])) {
                                    $ID = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
                                    $PST = "SELECT * FROM school_notifications WHERE note_id='$ID' ORDER BY  note_id";
                                    $RST = DSN::getInstance()->CRUD($PST);
                                    if ($RST->rowCount() > 0) {

                                        foreach ($RST as $row) {
                                            $Title = $row['note_title'];
                                            $Msg = $row['message'];
                                            echo "<h5>$Title</h5>";

                                            echo "<hr><p class=''>$Msg</p>";
                                        }


                                    } else {
                                        echo "<h6 class='text-center'>There are no notifications available.</h6>";
                                    }
                                } else {
                                    echo "<h6 class='text-center'>This is a broken link.</h6>";
                                }

                                ?>

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


</body>

</html>
