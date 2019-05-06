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
                    <a href="index.php" class="btn btn-success">Back</a>
                </p>


                <br>
                <div class="row flex-grow">
                    <div class="col-md-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body" id="Display">


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

        const ID = GetURLParameter('id');
        const Cancel = $("#CancelRequest");


        const UI = $("#Display");
        LoadMyVacation(ID);

        function LoadMyVacation(ID) {

            $.get("../../Core/Controller/vacation_controller.php?action=view&id=" + ID, (data, status) => {
                if (status === "success") {
                    UI.empty().append(data);
                } else {
                    UI.empty().append("<h6>There was an error loading vacation information</h6>");
                }
            })
        }

        Cancel.click((event) => {
            event.preventDefault();
            console.log("Helli");
        });


        function GetURLParameter(sParam) {
            let sPageURL = window.location.search.substring(1);
            let sURLVariables = sPageURL.split('&');
            for (let i = 0; i < sURLVariables.length; i++) {
                let sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1];
                }
            }

        }

    });


</script>

</body>

</html>
