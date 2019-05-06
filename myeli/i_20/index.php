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
                <h4 class="text-center">I-20 Dashboard</h4>

                <div class="row flex-grow">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <p class="card-description" id="STATUS">

                                </p>

                                <p class="text-center">  <a class="btn btn-success" href="extend.php">Extend I-20</a>
                                    | <a class="btn btn-danger" href="transfer.php">Transfer I-20</a> </p>
                            </div>

                        </div>
                    </div>

                </div>


                <br>
                <div class="row flex-grow">
                    <div class="col-md-3 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">School Approved Extensions
                                </h4>
                                <hr>

                                <div class="col-12" id="Approved">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">I-20 Request Record
                                </h4>
                                <hr>
                                <div class="col-12" id="Requests">

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
        let UI = $("#STATUS");
        let ExtendI20 = $("#ExtendI20");
        let Approved = $("#Approved");
        let Requests = $("#Requests");

        $.get("../../Core/Controller/i_20_ctrl.php?action=default", (data, status) => {

            if (status === 'success') {
                UI.empty().append(data);
            } else {
                UI.empty().append("<h5>There was an error checking your status.</h5>");
            }
        });

        ExtendI20.submit((event) => {
            event.preventDefault();
            $.post("../../Core/Controller/i_20_ctrl.php?action=extend", ExtendI20.serialize(), (data, status) => {
                if (status === 'success') {
                    UI.empty().append(data);
                    LoadApprovedI20();

                    LoadPendingI20();
                } else {

                }
            });
        });


        function LoadApprovedI20() {
            $.get("../../Core/Controller/i_20_ctrl.php?action=approved", (data, status) => {
                if (status === "success") {
                    Approved.empty().append(data);
                } else {
                    Approved.empty().append("<h5 class='text-center'>There was a connection error with the server. Refresh page</h5>");
                }
            });

        }

        function LoadPendingI20() {
            $.get("../../Core/Controller/i_20_ctrl.php?action=pending", (data, status) => {
                if (status === "success") {
                    Requests.empty().append(data);
                } else {
                    Requests.empty().append("<h5 class='text-center'>There was a connection error with the server. Refresh page</h5>");
                }
            });

        }


        LoadApprovedI20();
        LoadPendingI20();

    })
</script>

</body>

</html>
