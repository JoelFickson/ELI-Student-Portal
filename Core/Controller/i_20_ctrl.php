<?php


require_once "../../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === "GET") {


    if (!empty(htmlentities($_REQUEST['action'], ENT_QUOTES, "UTF-8"))) {
        $Request = htmlentities($_REQUEST['action'], ENT_QUOTES, "UTF-8");
        switch ($Request) {
            case "default":

                session_start();
                $STD_ID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
                Students::LoadStatus($STD_ID);

                break;

            case "extend":
                session_start();
                $STD_ID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
                $Period = htmlentities($_POST['period'], ENT_QUOTES, "UTF-8");
                Students::RequestExtension($STD_ID, $Period);
                break;
            case "approved":
                session_start();
                $STD_ID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
                Students::LoadApprovedI20($STD_ID);
                break;
            case "pending":
                session_start();
                $STD_ID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
                Students::LoadPendingI20($STD_ID);
                break;
        }

    }
}