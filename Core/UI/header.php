<?php
ob_start();
@session_start();
if (!isset($_SESSION['STD_ID'])) {
    header("location:../index");
} else {
    $STD_ID = htmlentities($_SESSION['STD_ID'], ENT_QUOTES, "UTF-8");
    $FNAME = htmlentities($_SESSION['F_NAME'], ENT_QUOTES, "UTF-8");
    $LNAME = htmlentities($_SESSION['L_NAME'], ENT_QUOTES, "UTF-8");
    $EMAIL = htmlentities($_SESSION['EMAIL'], ENT_QUOTES, "UTF-8");
    $PIC = htmlentities($_SESSION['PIC'], ENT_QUOTES, "UTF-8");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MyELI | Home</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.css"
          rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>/Core/UX/css/eli.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo URL_ROOT ?>/Core/UX/css/style.css">


</head>