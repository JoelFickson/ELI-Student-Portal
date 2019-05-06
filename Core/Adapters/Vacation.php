<?php


class Vacation
{

    private static $Status;


    public static function RequestVacation($StudentID, $Date, $Reason)
    {

        self::CheckIfVacationAlreadyExists($StudentID);
        $Result = self::getStatus();

        if ($Result == "ACTIVE") {
            echo "<h6 class='text-danger text-center'>Sorry, but you are not eligible for another vacation.
                    You already have an active vacation.</h6>";

        } else if ($Result == "PENDING") {

            echo "<h6 class='text-danger text-center'>Sorry, but you are not eligible for another vacation.
                    You already have a pending vacation, awaiting approval.</h6>";
        } else {


            $factory = new RandomLib\Factory;
            $generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
            $UID = $generator->generateString(24, 'abcdefghijklmnopqrst1234567890');


            $NewDate = date("m-d-Y");
            $PST = "INSERT INTO vacation(uid, student_id, date_requested, period, reason)
                    VALUES ('$UID','$StudentID', '$NewDate', '$Date', '$Reason');
                    ";
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
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Vacation Request';

                    $mail->Body .= "<p>This email is to notify you that we have received your Vacation Request. We will be in touch soon.
                      This is your request code : <strong>$UID</strong></p>";
                    $mail->AltBody = 'This email is to notify you that we have received your Vacation Request. We will be in touch soon..';

//Sending Email to ELI
                    if ($mail->send()) {


                        $mail->addAddress('Joelngozo@gmail.com', 'ELI San Francisco');
//                                                            $mail->addAddress('info@eli.edu', 'ELI San Francisco');
                        $mail->setFrom($EMAIL, $FNAME . $LNAME);     // Add a recipient

                        $mail->addReplyTo($EMAIL, $FNAME . $LNAME);


                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = "$FNAME $LNAME Vacation Request";

                        $mail->Body .= "<p>$FNAME $LNAME would like to have a vacation during <strong>$Date</strong> period
                                                                        
                                                                        </p>";

                        $mail->AltBody = "$FNAME $LNAME would like to have a vacation during <strong>$Date</strong> period";
                        $mail->AltBody .= "would like to have a vacation during <strong>$Date</strong> period.";

                        if ($mail->send()) {


                            echo "<h6 class='text-info'>Your request has been received. We will process it 

                                    and let you know via email. You can also check with the school office.</h6>
                                    <br>
                                    This is your request code : <strong>$UID</strong>
                                    <hr/>";

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
                echo "<h4 class='text-center text-success'>Sorry, there was an an internal error.</h4>";

            }
        }

    }

    public static function CheckIfVacationAlreadyExists($StudentID)
    {

        $PST = "SELECT * FROM vacation WHERE student_id ='$StudentID' AND status='ACTIVE' OR status='PENDING'";
        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {

            $Result = $RST->fetch();

            $Result = $Result['status'];

            self::setStatus($Result);
        } else {
            self::setStatus("EMPTY");
        }
    }


    /**
     * @return mixed
     */
    public static function getStatus()
    {
        return self::$Status;
    }

    /**
     * @param mixed $Status
     */
    public static function setStatus($Status)
    {
        self::$Status = $Status;
    }

    public static function LoadMyVacations($StudentID)
    {
        $PST = "SELECT * FROM vacation WHERE  student_id='$StudentID'";

        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {

            echo "<div class='table-responsive'><table class='table table-striped'>
  <tr>
    <td>Date Requested</td>
    <td>Period</td>
    <td>Status</td>
    <td>Action</td>
  <tr>
";


            foreach ($RST as $row) {

                $DateRequested = $row['date_requested'];
                $Period = $row['period'];
                $Status = $row['status'];
                $ID = $row['uid'];
                echo " <tr>
    <td>$DateRequested</td>
    <td>$Period</td>
    <td>$Status</td>

    <td><a class='' href='view.php?id=$ID'>Read More</a> </td>
  </tr>
";
            }
        } else {
            echo "<table></div>";

            echo "<h4 class='text-center'>You haven't made any vacation request yet.</h4>";

        }
    }

    public static function View($ID)
    {
        $PST = "SELECT * FROM vacation WHERE uid='$ID'";
        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {
            foreach ($RST as $row) {
                $DateRequested = $row['date_requested'];
                $DateApproved = $row['date_approved'];
                $Period = $row['period'];
                $Status = $row['status'];
                $Reason = $row['reason'];

                echo "<p>You made this request on : $DateRequested</p>";
                echo "<p>Status of this vacation : $Status</p>";
                if ($Status == "PENDING") {

                    if ($DateApproved == "") {
                        echo "<p>Your request hasn't been approved yet.</p>";
                    } else {
                        echo "<p>This request was approved on  : <strong>$DateApproved</strong></p>";
                    }
                    echo "<p>Reason for vacation : <strong>$Reason</strong>.</p><hr>";
                    echo "<p>Vacation Period : <strong>$Period</strong>.</p><hr>";
                    echo "<p class='text-center'><a id='CancelRequest' class='btn btn-danger' href='cancel.php?id=$ID'>Cancel Request</a></p>";
                    echo "<small class='text-danger text-center'>Please note : you can only cancel a pending request</small>";


                } else {
                    echo "<p>Vacation Period : <strong>$Period</strong>.</p><hr>";
                    echo "<p>This request was approved on  : <strong>$DateApproved</strong></p>";
                    echo "<p>Reason for vacation : <strong>$Reason</strong>.</p><hr>";


                }
            }
        }
    }
}