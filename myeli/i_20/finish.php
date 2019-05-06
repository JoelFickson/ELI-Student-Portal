<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Utils/Config.php";

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
                <p class="text-center">
                    <a href="index.php" class="btn btn-info">Back</a>
                </p>

                <div class="row flex-grow">
                    <div class="col-6 offset-3">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Extend My I-20</h4>
                                    <hr>
                                    <p id="Status"></p>
                                    <form method="post" id="ExtendI20" class="forms-sample" data-parsley-validate>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select Dates</label>
                                            <input class="form-control" name="period" type="text" id="reservation"
                                                   required="required">
                                        </div>

                                        <button type="submit" class="btn btn-success mr-2">Submit</button>

                                    </form>
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
        let UI = $("#Status");
        let ExtendI20 = $("#ExtendI20");


        ExtendI20.submit((event) => {
            event.preventDefault();
            $.post("../../Core/Controller/i_20_ctrl.php?action=extend", ExtendI20.serialize(), (data, status) => {
                if (status === 'success') {
                    UI.empty().append(data);

                } else {

                }
            });
        });


    });

    $('input[name="period"]').daterangepicker({
        opens: 'left'
    }, function (start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });


</script>

</body>

</html>
