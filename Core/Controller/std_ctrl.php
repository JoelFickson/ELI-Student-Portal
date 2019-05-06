<?php


require_once "../../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === "GET") {


    if (!empty(htmlentities($_REQUEST['action'], ENT_QUOTES, "UTF-8"))) {
        $Request = htmlentities($_REQUEST['action'], ENT_QUOTES, "UTF-8");
        switch ($Request) {
            case "login":
                $Email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
                $Password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
                Students::LoginStudent($Email, $Password);

                break;

            case "load":
                $StudentID = htmlentities($_POST['StudentID'], ENT_QUOTES, "UTF-8");
                Vacation::LoadMyVacations("");
                break;
            case "change":
                $OldPass = htmlentities($_POST['old_pass'], ENT_QUOTES, "UTF-8");
                $NewPass = htmlentities($_POST['new_pass'], ENT_QUOTES, "UTF-8");
                $ConfPass = htmlentities($_POST['conf_pass'], ENT_QUOTES, "UTF-8");

                if ($NewPass != $ConfPass) {
                    echo "Passwords do not match. Please verify before continuing.";
                } else {
                    session_start();
                    $StudentID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
                    Students::ChangePassword($OldPass, $NewPass, $StudentID);
                }

                break;
            case "update":
                $Token = htmlentities($_GET['tk'], ENT_QUOTES, "UTF-8");
                $NewPass = htmlentities($_POST['new_pass'], ENT_QUOTES, "UTF-8");
                $ConfPass = htmlentities($_POST['conf_pass'], ENT_QUOTES, "UTF-8");

                if ($NewPass != $ConfPass) {
                    echo "Passwords do not match. Please verify before continuing.";
                } else {


                    Students::RestPassword($NewPass, $Token);
                }

                break;
            case "reset":
                $Email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
                Students::ResetPassword($Email);
                break;
        }

    }
}