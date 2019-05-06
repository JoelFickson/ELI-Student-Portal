<?php

/**
 * Created by PhpStorm.
 * User: JFNgozo
 * Date: 3/5/2019
 * Time: 1:11 PM
 */
class Students extends Student
{
    public static function SaveNewStudent()
    {

    }

    public static function LoginStudent($Email, $Password)
    {


        $PST = "SELECT * FROM students WHERE email ='$Email'";

        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {


            foreach ($RST as $row) {


                $DB_PASS = $row['password'];

                if (password_verify($Password, $DB_PASS)) {

                    @session_start();
                    $student_id = $row['student_id'];
                    $phone = $row['phone'];
                    $dob = $row['dob'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $last_name = $row['last_name'];
                    $Profile = $row['profile'];

                    //Set up session
                    $_SESSION['STD_ID'] = $student_id;
                    $_SESSION['F_NAME'] = $first_name;
                    $_SESSION['L_NAME'] = $last_name;
                    $_SESSION['EMAIL'] = $Email;
                    $_SESSION['PIC'] = $Profile;
                    echo "<script>window.location.href = 'myeli/index';</script>";
                } else {
                    echo "<h5 class='alert alert-danger text-danger text-center'>Sorry, authentication error!!</h5>";
                }
            }


        } else {
            echo "<h5 class='alert alert-danger text-danger text-center'>Sorry, account not found!!</h5>";
        }


    }

    public static function LoginStudentWithID()
    {

    }

    public static function LoadStatus($STD_ID)
    {
        $PST = "SELECT * FROM i_20 WHERE student_id='$STD_ID'";

        $RST = DSN::getInstance()->CRUD($PST);
        if ($RST->rowCount() > 0) {
            echo "We found info";
        } else {
            echo "<h6 class='text-center'>There is no record of your 1-20 Document in the system.</h6>";
            echo "<p class='text-center'>This does not mean you dont have an I-20, it just means we haven't updated our records.</p>";
        }
    }

    public static function RequestExtension($STD_ID, $Period)
    {
        $PST = "SELECT * FROM i_20_ext WHERE student_id='$STD_ID' AND status='PENDING'";
        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {
            echo "<h6 class='text-center text-danger'>Sorry, you already have an I-20 Extension request.</h6>";
            echo "<h6 class='text-center text-danger'>You can not have two extension requests at once. Delete the other request first and try again.</h6>";

        } else {
            $NewDate = date("m-d-Y");
            $random = new PragmaRX\Random\Random();
            $UID = $random->mixedcase()->get();
            $PST = "INSERT INTO i_20_ext(req_uid, student_id, date, period)
                        VALUES('$UID','$STD_ID','$NewDate','$Period')";

            $RST = DSN::getInstance()->CRUD($PST);

            if ($RST->rowCount() > 0) {
                echo "<h4 class='text-center text-danger'>Successfully requested for an I-20 Extension. We will be in touch
                        soon!!
                        </h4>";
            } else {
                echo "<h5 class='text-center text-danger'>Sorry, there was an error processing your transaction. Try later.</h5>";
            }
        }
    }

    public static function LoadApprovedI20($STD_ID)
    {
        $PST = "SELECT * FROM i_20 WHERE  student_id='$STD_ID'";

        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {

            echo "<div class='table-responsive'><table class='table table-striped'>
  <tr>
    <td>I-20 Number</td>
    <td>Expiry</td>
    <td>Issued</td>
    
  <tr>
";


            foreach ($RST as $row) {

                $IssuedDate = $row['issued'];
                $Expiry = $row['expiry'];

                $ID = $row['uid'];
                echo " <tr>
    <td>$IssuedDate</td>
    <td>$IssuedDate</td>
    <td>$Expiry</td>

  </tr>
";
            }
        } else {
            echo "<table></div>";

            echo "<h6 class='text-center'>You do not have approved I-20 System Documented Approvals.</h6>";

        }
    }

    public static function LoadPendingI20($STD_ID)
    {
        $PST = "SELECT * FROM i_20_ext WHERE  student_id='$STD_ID'";

        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {

            echo "<div class='table-responsive'><table class='table table-striped'>
  <tr>
    <td>Request No</td>
    <td>Date Requested</td>
    <td>Period</td>
    <td>Status</td>
    <td>Action</td>
    
  <tr>
";


            foreach ($RST as $row) {

                $req_uid = $row['req_uid'];
                $ReqDate = $row['date'];
                $Period = $row['period'];
                $status = $row['status'];
                echo " <tr>
    <td>$req_uid</td>
    <td>$ReqDate</td>
    <td>$Period</td>
    <td>$status</td>
    <td><p>
    <a href='#'> <i class='fa fa-xing-square'></i></a>
    <a href='#'> <i class='fa fa-edit'></i> </a>
    
    </p>
    
    </td>

  </tr>
";
            }
        } else {
            echo "<table></div>";

            echo "<h6 class='text-center'>You do not have any I-20 extension requests.</h6><br/>";

        }
    }

    public static function CheckTransfer($STD_ID, $Date, $School)
    {
        $PST = "SELECT * FROM transfers WHERE student_id='$STD_ID'";
        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {
            echo "<h5 class='text-center'>You have already requested a transfer. Please wait while we process it.</h5>";
        } else {
            $PST = "INSERT INTO transfers(student_id, date, school) 
                VALUES('$STD_ID','$Date','$School')";
            $RST = DSN::getInstance()->CRUD($PST);

            if ($RST->rowCount() > 0) {
                echo "<h5 class='text-center text success'>Your transfer has been received. We will get back to you as 
 soon as possible.</h5>";
            } else {
                echo "<h5 class='text-center'>There was an error processing your request.</h5>";
            }
        }
    }

    public static function ChangePassword($OldPass, $NewPass, $STD_ID)
    {
        $PST = "SELECT * FROM students WHERE student_id='$STD_ID'";
        $RST = DSN::getInstance()->CRUD($PST);

        if ($RST->rowCount() > 0) {
            foreach ($RST as $row) {
                $DB_PASS = $row['password'];

                if (password_verify($OldPass, $DB_PASS)) {
                    $NewPass = password_hash($NewPass, PASSWORD_BCRYPT);
                    $Update = "UPDATE students SET password='$NewPass' WHERE student_id='$STD_ID'";
                    $Update = DSN::getInstance()->CRUD($Update);
                    if ($Update->rowCount() > 0) {
                        echo "Password changed successfully";
                    } else {
                        echo "There was an error changing your password";
                    }
                } else {
                    echo "Sorry, the password you provided is wrong.";
                }
            }
        } else {
            echo "Sorry, we can't identify your account. Please contact the school for assistance.";

        }
    }

    public static function RestPassword($NewPass, $Token)
    {

        $TKCheck = "SELECT * FROM resets WHERE token='$Token'";
        $TKCheck = DSN::getInstance()->CRUD($TKCheck);

        if ($TKCheck->rowCount() > 0) {
            $TKCheck = $TKCheck->fetch();
            $Email = $TKCheck['email'];
            $NewPass = password_hash($NewPass, PASSWORD_BCRYPT);

            $Update = "UPDATE students SET password='$NewPass' WHERE email='$Email'";
            $Update = DSN::getInstance()->CRUD($Update);
            if ($Update->rowCount() > 0) {
                echo "Password changed successfully";
            } else {
                echo "There was an error changing your password";
            }
        } else {
            echo "Validation check error. There seems like there is an integrity check. This link is not valid anymore.";

        }

    }

    public static function ResetPassword($Email)
    {
        $Check = "SELECT * FROM students WHERE email='$Email'";
        $Check = DSN::getInstance()->CRUD($Check);
        if ($Check->rowCount() > 0) {
            $factory = new RandomLib\Factory;
            $generator = $factory->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
            $UID = $generator->generateString(24, 'abcdefghijklmnopqrst1234567890');

            $PST = "INSERT INTO resets(email, token) VALUES('$Email','$UID')";
            $RST = DSN::getInstance()->CRUD($PST);
            if ($RST->rowCount() > 0) {
                $mail = new PHPMailer(true);
                try {

                    //Recipients
                    $mail->setFrom('no-reply@eli.edu', 'ELI San Francisco');
//                                                        $mail->setFrom('info@eli.edu', 'ELI San Francisco');
                    $mail->addAddress($Email);     // Add a recipient

                    $mail->addReplyTo('info@eli.edu', 'ELI San Francisco');


                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'ELI Password Reset ';

                    $mail->Body .= '<p>You recently requested a password reset for your account on ELI Student Portal.</p>';
                    $mail->Body .= "<p><a href='www.eli.tecules.net/restart.php?tk=$UID'>Reset here</a>.</p>";
                    $mail->AltBody = "You recently requested a password reset for your account on ELI Student Portal.";
                    $mail->AltBody = "<a href='www.eli.edu/restart.php?tk=$UID'>Reset here</a>.";

//Sending Email to ELI
                    if ($mail->send()) {


                    } else {

                        echo "<p class='text-warning text-center'>Sorry, there was an error processing your request.</p>";


                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            } else {
                echo "<p class='text-center text-danger'>There was an error processing your request.</p>";
            }

        } else {
            echo "<p class='text-center text-danger'>This email is not registered with us.</p>";

        }
    }


}