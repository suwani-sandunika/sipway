<?php
require_once "../MySQL.php";

?>

<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="index.php">
                    <img class="img-fluid main-logo" src="../assets/images/logo/logo.png" alt="logo">
                    <img class="img-fluid white-logo" src="../assets/images/logo/logo-white.png" alt="logo">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>

        <form class="form-inline search-full col" action="javascript:void(0)" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                               placeholder="Search Sipway .." name="q" title="" autofocus>
                        <i class="close-search" data-feather="x"></i>
                        <div class="spinner-border Typeahead-spinner" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>

        <div class="nav-right col-4 pull-right right-header p-0">
            <ul class="nav-menus">
                <li>
                            <span class="header-search">
                                <span class="lnr lnr-magnifier"></span>
                            </span>
                </li>
                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <span class="lnr lnr-alarm"></span>
                        <span class="badge rounded-pill badge-theme">5</span>
                    </div>

                </li>
                <li class="onhover-dropdown">
                    <span class="lnr lnr-bubble"></span>

                </li>

                <li class="maximize">
                    <a class="text-dark" href="javascript:void(0)" onclick="javascript:toggleFullScreen()">
                        <span class="lnr lnr-frame-expand"></span>
                    </a>
                </li>
                <li class="profile-nav onhover-dropdown pe-0 me-0">
                    <div class="media profile-media">
                        <?php
                        $email = $_SESSION["academic"]['email'];
                        $academicRs = MySQL::search("SELECT * FROM academic_officer WHERE email = '${email}'");
                        $academic = $academicRs->fetch_assoc();

                        ?>
                        <img class="user-profile rounded-circle"
                             src="../<?= ($academic['profile_img'] != null) ? $academic['profile_img'] : 'assets/images/profile/user.png' ?>"
                             alt="">
                        <div class="user-name-hide media-body">
                            <span><?= $_SESSION["academic"]["first_name"] . " " . $_SESSION["academic"]["last_name"] ?></span>
                            <p class="mb-0 font-roboto">Academic<i class="middle fa fa-angle-down"></i></p>
                        </div>

                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <a href="support-ticket.html">
                                <i data-feather="phone"></i>
                                <span>Spports Tickets</span>
                            </a>
                        </li>
                        <li>
                            <a href="academic-profile.php">
                                <i data-feather="settings"></i>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                               href="javascript:void(0)">
                                <i data-feather="log-out"></i>
                                <span>Log out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Modal Start -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                <p>Are you sure you want to log out?</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="button-box">
                    <button type="button" class="btn btn--no " data-bs-dismiss="modal">No</button>
                    <a href="signout-process.php" type="button" class="btn  btn--yes btn-primary">Yes</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->