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
                <h4 class="text-center">Vacation Dashboard</h4>
                <hr/>
                <p class="card-description text-center" id="">
                    Request and view your vacation history.
                </p>



                <br>
                <div class="row flex-grow">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Request New Vacation
                                </h4>
                                <p id="Display"></p>
                                <hr>
                                <form enctype="multipart/form-data" method="post" id="RequestVacation"
                                      class="forms-sample" data-parsley-validate>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Time Period</label>
                                        <input class="form-control" name="period" type="text"
                                               id="reservation"
                                               required="required">
                                        <small class="text-danger">Select start and end date</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Reason For Vacation</label>
                                        <textarea  class="form-control" name="reason" required="required"></textarea>
                                    </div>


                                    <button type="submit" name="Transfer" class="btn btn-success">Submit</button>

                                </form>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="row flex-grow">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Vacation History
                                </h4>
                                <hr>
                                <div class="col-12" id="MyVacs">

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
        }, function(start, end, label) {

        });

    });


</script>

</body>

</html>
