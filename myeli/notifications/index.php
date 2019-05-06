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


                <br>
                <div class="row flex-grow">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Personal Notifications
                                </h4>
                                <p id="Display">These are your personal notifications</p>

                                <hr>
                                <?php
                                $PST = "SELECT * FROM personal_notifications WHERE student_id='$STD_ID' ORDER BY  note_id";
                                $RST = DSN::getInstance()->CRUD($PST);
                                if ($RST->rowCount() > 0) {
                                    echo "<ul class='list-group'>";
                                    foreach ($RST as $row) {
                                        $Title = $row['note_title'];
                                        $ID = $row['note_id'];
                                        echo "<p class=''><a href='read-personal.php?id=$ID'>$Title</a></p>";
                                    }
                                    echo "</ul>";

                                } else {
                                    echo "<h6 class='text-center'>There are no notifications available.</h6>";
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">School Notifications
                                </h4>
                                <p id="Display">These notifications are for every student</p>
                                <hr>

                                <?php
                                $PST = "SELECT * FROM school_notifications ORDER BY  note_id";
                                $RST = DSN::getInstance()->CRUD($PST);
                                if ($RST->rowCount() > 0) {
                                    echo "<ul class='list-group'>";
                                    foreach ($RST as $row) {
                                        $Title = $row['note_title'];
                                        $ID = $row['note_id'];
                                        echo "<p class=''><a href='read.php?id=$ID'>$Title</a></p>";
                                    }
                                    echo "</ul>";

                                } else {
                                    echo "<h6 class='text-center'>There are no notifications available.</h6>";
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

        const UI = $("#Display");
        const MyVacs = $("#MyVacs");
        let RequestVacation = $("#RequestVacation");

        RequestVacation.submit((Event) => {

            Event.preventDefault();


            $.post("../../Core/Controller/vacation_controller.php?action=request",
                RequestVacation.serialize(), (data, status) => {
                    if (status === "success") {
                        UI.empty().append(data);
                        LoadVacations();
                    } else {
                        UI.empty().append("<h5 class='text-center text-warning'>" +
                            "Sorry there was an internal error. Try again</h5>");
                    }

                });

        });

        LoadVacations();

        function LoadVacations() {
            $.get("../../Core/Controller/vacation_controller.php?action=load", (data, status) => {
                if (status === "success") {
                    MyVacs.empty().append(data);
                } else {
                    MyVacs.empty().append('Sorry');
                }
            });
        }

        $('input[name="period"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {

        });

    });


</script>

</body>

</html>
