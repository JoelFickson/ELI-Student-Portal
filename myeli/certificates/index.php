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
                <h4 class="text-center">Certificates Dashboard</h4>
                <hr/>


                <br>
                <div class="row flex-grow">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Your Certifications
                                </h4>
                                <p id="Display">Download and view your certificates</p>

                                <hr>
                                <?php
                                $PST = "SELECT * FROM certificates WHERE student_id='$STD_ID' ORDER BY  cert_id";
                                $RST = DSN::getInstance()->CRUD($PST);
                                if ($RST->rowCount() > 0) {
                                    echo "<ul class='list-group'>";
                                    foreach ($RST as $row) {
                                        $ID = $row['cert_id'];
                                        $Name = $row['name'];
                                        $Doc = $row['doc_url'];
                                        $started = $row['started'];
                                        $completed = $row['completed'];
                                        echo "<p class=''>$Name [$started - $completed]
                                                <a href='../../Core/Certificates/$Doc' download='' target='_blank'> Download</a></p>";
                                    }
                                    echo "</ul>";

                                } else {
                                    echo "<h6 class='text-center'>There are no certifications available.</h6>";
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


<script>
    $(() => {


    });


</script>

</body>

</html>
