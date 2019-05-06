<?php

ob_start();
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
                <h4 class="text-center">My ELI Profile</h4>
                <hr>
                <p class="text-center">
                    <a href="index.php" class="btn btn-info">Back</a>
                </p>
                <div class="row flex-grow">
                    <div class="col-6 offset-3">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Change Profile Picture</h4>
                                    <hr/>

                                    <?php

                                    if (isset($_POST['SaveNewPicture'])) {
                                        $image = new Bulletproof\Image($_FILES);
                                        $image->setSize(1024, 1572864);
                                        $Dir =  "../../images/profiles/";
                                        $image->setLocation($Dir);
                                        $image->setMime(array('jpeg', 'png', 'jpg'));

                                        if ($image["picture"]) {
                                            $upload = $image->upload();

                                            if ($upload) {

                                                $FullPicture = $image->getName() . '.' . $image->getMime();

                                                $PST = "UPDATE students SET profile='$FullPicture' WHERE student_id='$STD_ID'";

                                                $RST = DSN::getInstance()->CRUD($PST);

                                                if ($RST->rowCount() > 0) {
                                                    $_SESSION['PIC'] = $FullPicture;
                                                    echo "<h5 class='text-success text-center'>Profile picture updated successfully!</h5>";
                                                    header("refresh:5;url:index.php");

                                                } else {
                                                    echo "<h5 class='text-center text-danger'>There was an error updating your profile picture</h5>";
                                                }
                                            } else {
                                                echo "<h5 class='text-center text-danger'>" . $image->getError() . "</h5>";

                                            }
                                        }
                                    }
                                    ?>

                                    <form method="post" enctype="multipart/form-data" class="forms-sample"
                                          data-parsley-validate>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Select New Picture</label>
                                            <input class="form-control" name="picture" type="file" id="reservation"
                                                   required="required">
                                        </div>

                                        <button name="SaveNewPicture" type="submit" class="btn btn-success mr-2">Update
                                            Picture
                                        </button>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                <br>


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


</body>

</html>
