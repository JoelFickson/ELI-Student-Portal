<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo STUDENT ?>">
            MyELI
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo STUDENT ?>">
            MyELI
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
            <li class="nav-item">
                <a href="<?php echo STUDENT ?>/vacation/" class="nav-link">Schedule
                    <span class="badge badge-primary ml-1">New Vacation</span>
                </a>
            </li>
            <li class="nav-item active">
                <a href="<?php echo STUDENT ?>/attendance" class="nav-link">
                    <i class="mdi mdi-elevation-rise"></i>Attendance</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo STUDENT ?>/certificates" class="nav-link">
                    <i class="mdi mdi-file-document-box"></i>Certificates</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item">
                <a class="nav-link" id=""
                   href="<?php echo STUDENT ?>/notifications"
                >
                    <i class="fa fa-bell"></i>

                </a>

            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <span class="profile-text">Howdy, <?php echo $FNAME ?> !</span>
                    <img class="img-xs rounded-circle" src="<?php
                    echo URL_ROOT . "/images/profiles/$PIC"
                    ?>" alt="<?php echo $FNAME ?>">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">

                    <a href="<?php echo STUDENT ?>/account" class="dropdown-item mt-2">
                        Manage Profile
                    </a>
                    <a href="<?php echo STUDENT ?>/account" class="dropdown-item">
                        Change Password
                    </a>

                    <a href="<?php echo STUDENT ?>/signout" class="dropdown-item">
                        Sign Out
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="fa fa-bars"></span>
        </button>
    </div>
</nav>