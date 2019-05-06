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

    <style>
        #example1-card {
            color: #000 !important;

        }
    </style>

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
                <h4 class="text-center">My Tuition Dashboard</h4>
                <h6 class="text-center">Make Payments Below</h6>
                <hr/>


                <br>
                <div class="row flex-grow">
                    <div class="col-10 stretch-card">

                        <div class="card cell" id="example-1">
                            <form class="card-body forms-sample" data-parsley-validate>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Time Period</label>
                                    <input class="form-control" name="period" type="text"
                                           id="reservation"
                                           required="required">
                                    <small class="text-danger">Select start and end date</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Card Number</label>
                                    <div class="form-control" id="example1-card"></div>
                                </div>


                                <button type="submit" class="btn btn-success col-md-12"
                                        data-tid="elements_examples.form.pay_button">Make Payment
                                </button>


                            </form>


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

<script src="https://js.stripe.com/v3/"></script>
<!-- Your JS File -->
<script src="charge.js"></script>


<script>
    $(() => {

        $('input[name="period"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {

        });


        // Create a Stripe client.
        var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx');
        (function () {
            'use strict';

            var elements = stripe.elements({
                fonts: [
                    {
                        cssSrc: 'https://fonts.googleapis.com/css?family=Roboto',
                    },
                ],
                // Stripe's examples are localized to specific languages, but if
                // you wish to have Elements automatically detect your user's locale,
                // use `locale: 'auto'` instead.
                locale: window.__exampleLocale
            });

            var card = elements.create('card', {
                iconStyle: 'solid',
                style: {
                    base: {
                        iconColor: '#2422ff',
                        color: '#000',
                        fontWeight: 500,
                        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                        fontSize: '16px',
                        fontSmoothing: 'antialiased',

                        ':-webkit-autofill': {
                            color: '#fce883',
                        },
                        '::placeholder': {
                            color: '#ccc',
                        },
                    },
                    invalid: {
                        iconColor: '#FFC7EE',
                        color: '#FFC7EE',
                    },
                },
            });
            card.mount('#example1-card');

            registerElements([card], 'example1');
        })();

    });


</script>

</body>

</html>
