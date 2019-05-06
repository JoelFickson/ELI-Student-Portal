<?php
ob_start();
require_once "../../Core/Utils/Config.php";
require_once "../../vendor/autoload.php";
require_once "../../Core/Utils/mail/PHPMailerAutoload.php";


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
                    <div class="col-md-8 offset-2 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body" id="Display">
                                <div class="" id="Hide">

                                    <?php

                                    if (isset($_GET['id'])) {

                                        ?>
                                        <form enctype="multipart/form-data" method="post" id="RequestVacation"
                                              class="forms-sample" data-parsley-validate>
                                            <p class="text-center">Are you sure you want to cancel this request?</p>

                                            <p class="text-center">
                                                <button type="submit" name="cancel" class="btn btn-danger">Yes Cancel
                                                </button>
                                            </p>

                                        </form>

                                        <?php


                                        if (isset($_POST['cancel'])) {
                                            $ID = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");

                                            $PST = "UPDATE vacation set status='CANCELLED' WHERE uid='$ID'";
                                            $RST = DSN::getInstance()->CRUD($PST);
                                            if ($RST->rowCount() > 0) {


                                                $mail = new PHPMailer(true);
                                                try {

                                                    $FNAME = htmlentities($_SESSION['F_NAME'], ENT_QUOTES, "UTF-8");
                                                    $LNAME = htmlentities($_SESSION['L_NAME'], ENT_QUOTES, "UTF-8");
                                                    $EMAIL = htmlentities($_SESSION['EMAIL'], ENT_QUOTES, "UTF-8");


                                                    //Recipients
                                                    $mail->setFrom('Joelngozo@gmail.com', 'ELI San Francisco');
//                                                        $mail->setFrom('info@eli.edu', 'ELI San Francisco');
                                                    $mail->addAddress($EMAIL, $FNAME . $LNAME);     // Add a recipient

                                                    $mail->addReplyTo('info@eli.edu', 'ELI San Francisco');


                                                    //Content
                                                    $mail->isHTML(true);
                                                    $mail->Subject = 'Vacation Cancelling';

                                                    $mail->Body .= "<p>This email is to notify you that you have cancelled your vacation request.</p>";
                                                    $mail->AltBody = 'This email is to notify you that you have cancelled your vacation request..';

//Sending Email to ELI
                                                    if ($mail->send()) {


                                                        $mail->addAddress('Joelngozo@gmail.com', 'ELI San Francisco');
//                                                            $mail->addAddress('info@eli.edu', 'ELI San Francisco');
                                                        $mail->setFrom($EMAIL, $FNAME . $LNAME);     // Add a recipient

                                                        $mail->addReplyTo($EMAIL, $FNAME . $LNAME);


                                                        //Content
                                                        $mail->isHTML(true);                                  // Set email format to HTML
                                                        $mail->Subject = "$FNAME $LNAME Vacation Request";

                                                        $mail->Body .= "<p>$FNAME $LNAME has cancelled their vacation request.</p>";

                                                        $mail->AltBody = "$FNAME $LNAME has cancelled their vacation request.";


                                                        if ($mail->send()) {


                                                            echo "<h4 class='text-center'>Successfully cancelled your vacation request.</h4>";
                                                            header("refresh:5;url=index.php");
                                                            echo "<small>You will bne redirected in a few seconds..</small>";

                                                        } else {
                                                            echo "<p class='text-warning text-center'>Sorry, there was an error processing your request.</p>";

                                                        }


                                                    } else {

                                                        echo "<p class='text-warning text-center'>Sorry, there was an error processing your request.</p>";


                                                    }
                                                } catch (Exception $e) {
                                                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                                }


                                            } else {
                                                echo "<h4 class='text-center'>There was an error processing your request. The request may
                                                have already been cancelled.</h4>";
                                            }
                                        }
                                    }
                                    ?>
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


    });


</script>

</body>

</html>
