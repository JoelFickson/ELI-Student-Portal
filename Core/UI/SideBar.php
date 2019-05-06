<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img class="img-xs rounded-circle" src="<?php
                        echo URL_ROOT . "/images/profiles/$PIC"
                        ?>" alt="<?php echo $FNAME ?>">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name"><?php echo $FNAME . " " . $LNAME ?></p>

                    </div>
                </div>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href='<?php echo STUDENT ?>'>
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href='<?php echo STUDENT ?>/attendance'>
                <i class="fa fa-calendar"></i> &nbsp
                <span class="menu-title">Attendance</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href='<?php echo STUDENT ?>/vacation'>
                <i class="fas fa-glass-cheers"></i> &nbsp
                <span class="menu-title">Vacation</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href='<?php echo STUDENT ?>/i_20'>
                <i class="fas fa-file-alt"></i>&nbsp
                <span class="menu-title">My I-20</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href='<?php echo STUDENT ?>/tuition'>
                <i class="fas fa-money-check-alt"></i>&nbsp
                <span class="menu-title">Tuition</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href='<?php echo STUDENT ?>/certificates'>
                <i class="fas fa-user-graduate"></i>&nbsp
                <span class="menu-title">Certificates</span>
            </a>
        </li>

    </ul>
</nav>
