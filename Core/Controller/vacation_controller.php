<?php

require_once "../Utils/mail/PHPMailerAutoload.php";
require_once "../../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === "GET") {


    if (!empty(htmlentities($_REQUEST['action'], ENT_QUOTES, "UTF-8"))) {
        $Request = htmlentities($_REQUEST['action'], ENT_QUOTES, "UTF-8");
        switch ($Request) {
            case "request":

                session_start();
                $STD_ID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
                $Period = htmlentities($_POST['period'], ENT_QUOTES, "UTF-8");
                $Reason = htmlentities($_POST['reason'], ENT_QUOTES, "UTF-8");
                Vacation::RequestVacation($STD_ID, $Period, $Reason);

                break;

            case "load":
                session_start();
                $STD_ID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
                Vacation::LoadMyVacations($STD_ID);
                break;

            case "view":
                $ID = htmlentities($_GET['id'], ENT_QUOTES, "UTF-8");
                Vacation::View($ID);
                break;
        }

    }
}