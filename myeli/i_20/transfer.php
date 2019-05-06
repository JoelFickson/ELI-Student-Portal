<?php
require_once "../../vendor/autoload.php";
require_once "../../Core/Utils/Config.php";
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

                                    <?php
                                    if (isset($_POST['Transfer'])) {
                                        $SchoolName = htmlentities($_POST['SchoolName'], ENT_QUOTES, "UTF-8");
                                        $MyTransferDate = htmlentities($_POST['MyTransferDate'], ENT_QUOTES, "UTF-8");
                                        if ($_FILES['Letter']['error'] !== UPLOAD_ERR_OK) {
                                            die("Upload failed with error " . $_FILES['Letter']['error']);
                                        }
                                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                        $mime = finfo_file($finfo, $_FILES['Letter']['tmp_name']);
                                        $ok = false;
                                        switch ($mime) {
                                            case 'application/pdf':
                                            case 'application/msword':
                                            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                                                $extention = pathinfo($_FILES['Letter']['name'], PATHINFO_EXTENSION);

                                                $Date = date("mdy");
                                                $NewName = str_replace(' ', '', $FNAME . $LNAME . $Date);

                                                $NewName = $NewName . "." . $extention;
                                                if (move_uploaded_file($_FILES["Letter"]["tmp_name"],
                                                    "../../Core/Letters/$NewName")) {
                                                    $mail = new PHPMailer(true);
                                                    try {

                                                        //Recipients
                                                        $mail->setFrom('Joelngozo@gmail.com', 'ELI San Francisco');
//                                                        $mail->setFrom('info@eli.edu', 'ELI San Francisco');
                                                        $mail->addAddress($EMAIL, $FNAME . $LNAME);     // Add a recipient

                                                        $mail->addReplyTo('info@eli.edu', 'ELI San Francisco');


                                                        //Content
                                                        $mail->isHTML(true);                                  // Set email format to HTML
                                                        $mail->Subject = 'Transfer I-20 Request';

                                                        $mail->Body .= '<p>This email is to notify you that we have received your I-20 transfer request. We will be in touch soon.</p>';
                                                        $mail->AltBody = 'This email is to notify you that we have received your I-20 transfer request. We will be in touch soon.';

//Sending Email to ELI
                                                        if ($mail->send()) {


                                                            $mail->addAddress('Joelngozo@gmail.com', 'ELI San Francisco');
//                                                            $mail->addAddress('info@eli.edu', 'ELI San Francisco');
                                                            $mail->setFrom($EMAIL, $FNAME . $LNAME);     // Add a recipient

                                                            $mail->addReplyTo($EMAIL, $FNAME . $LNAME);


                                                            //Attachments
                                                            $mail->addAttachment('../../Core/Letters/' . $NewName);         // Add attachments

                                                            //Content
                                                            $mail->isHTML(true);                                  // Set email format to HTML
                                                            $mail->Subject = "$FNAME $LNAME Transfer I-20 Request";

                                                            $mail->Body .= "<p>$FNAME $LNAME would like to transfer their I-20 to $SchoolName on
                                                                        $MyTransferDate
                                                                        </p>";
                                                            $mail->Body .= "<pThis email is attached with the acceptance letter, the student attached.</p>";
                                                            $mail->AltBody = "$FNAME $LNAME would like to transfer their I-20 to $SchoolName on
                                                                        $MyTransferDate";
                                                            $mail->AltBody .= "This email is attached with the acceptance letter, the student attached.";

                                                            if ($mail->send()) {

                                                                $PST = "INSERT INTO transfers(date, school,doc_url) 
                                                                                         VALUES ('$MyTransferDate', '$SchoolName','$NewName')
                                                                                            ";
                                                                $RST = DSN::getInstance()->CRUD($PST);
                                                                if ($RST->rowCount() > 0) {
                                                                    echo "<h6 class='text-info'>Your request has been received. We will process it 
                                                                            and let you know via email. You can also check with the school office</h6><hr/>";
                                                                } else {
                                                                    echo "<h6 class='text-warning'>Sorry, there was an error processing your request. Try again!</h6>";
                                                                }
                                                            }


                                                        } else {

                                                            echo "<p class='text-warning text-center'>Sorry, there was an error sending you an an activation link.</p>";


                                                        }
                                                    } catch (Exception $e) {
                                                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                                    }
                                                }
                                                $ok = true;
                                                break;
                                            default:
                                                echo "<small class='text-danger'>Unsupported file format. Please
                                                upload only PDF/DOC file format</small>    <hr>";
                                        }

                                    }
                                    ?>


                                    <form enctype="multipart/form-data" method="post" id="ExtendI20"
                                          class="forms-sample" data-parsley-validate>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Transfer Date</label>
                                            <input class="form-control" name="MyTransferDate" type="text"
                                                   id="reservation"
                                                   required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">School Name</label>
                                            <input class="form-control" name="SchoolName" type="text" id=""
                                                   required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Acceptance Letter</label>
                                            <input class="form-control" name="Letter" type="file" id=""
                                                   required="required">
                                            <p>
                                                <small class="text-danger">Please upload your acceptance letter from the
                                                    school you are transferring
                                                    to
                                                </small>
                                            </p>
                                        </div>

                                        <button type="submit" name="Transfer" class="btn btn-success">Submit</button>

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


        $('input[name="MyTransferDate"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            opens: 'left'
        }, function (start, end, label) {

        });
    });


</script>

</body>

</html>
