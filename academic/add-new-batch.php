<?php
require_once "../MySQL.php";
session_start();
if (!isset($_SESSION["academic"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Sipway - Add New Batch</title>

    <!-- Google font -->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/font-awesome.css">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="../assets/css/linearicon.css">

    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">

    <!--Dropzon css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/dropzone.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

</head>

<body>
<!-- tap on top start -->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end -->

<!-- page-wrapper Start -->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">

    <!-- Page Header Start -->
    <?php require "header.php" ?>
    <!-- Page Header End -->

    <!-- Page Body Start -->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php require "sidebar.php" ?>
        <!-- Page Sidebar Ends-->

        <!-- Page Sidebar Start -->
        <div class="page-body">
            <div class="title-header">
                <h5>Add New Batch</h5>
            </div>
            <!-- New User start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">

                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="pills-home-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-home"
                                                        type="button">Batch
                                                </button>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                                <form class="theme-form theme-form-2 mega-form" id="batch-register-form"
                                                      onsubmit="registerBatch(event)">
                                                    <div class="card-header-1">
                                                        <h5>Batch Information</h5>
                                                    </div>

                                                    <div class="row">

                                                        <div class="mb-2">
                                                            <span class="text-danger fw-bold"
                                                                  id="register_form_err"></span>
                                                        </div>

                                                        <div class="mb-4 row align-items-center">
                                                            <label class="form-label-title col-lg-2 col-md-3 mb-0">Batch
                                                                Name</label>
                                                            <div class="col-md-9 col-lg-10">
                                                                <input class="form-control" type="text" name="bname">
                                                            </div>
                                                        </div>

                                                        <div class="mb-4 row align-items-center">
                                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Year</label>
                                                            <div class="col-md-9 col-lg-10 d-grid">
                                                                <select name="year" id="year">
                                                                    <option value="0">Select Year</option>
                                                                    <?php
                                                                    $yearRs = MySQL::search("SELECT * FROM year");
                                                                    while ($year = $yearRs->fetch_assoc()) {
                                                                        ?>
                                                                        <option value="<?= $year['id'] ?>"><?= $year['year_name'] ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mb-4">
                                                            <button type="submit" class="btn btn-primary"
                                                                    id="register-btn">Register New Batch
                                                            </button>

                                                            <button class="btn btn-primary d-none" type="button"
                                                                    disabled id='loading-btn'>
                                                                <span class="spinner-grow spinner-grow-sm" role="status"
                                                                      aria-hidden="true"></span>
                                                                Loading...
                                                            </button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User End -->

            <!-- footer start -->
            <div class="container-fluid">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2021 © Sipway</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- footer end -->
        </div>
        <!-- Page Sidebar End -->
    </div>
</div>
<!-- page-wrapper End -->

<!--Toast Start-->
<div class="toast-container position-fixed bottom-0 end-0 p-3 z-index-9">
    <div id="confirm-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="../assets/images/logo/logo.png" class="rounded me-2" alt="...">
            <strong class="me-auto">SipWay</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
    </div>
</div>
<!--Toast Ends-->

<!-- latest js -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap js -->
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js -->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- scrollbar simplebar js -->
<script src="../assets/js/scrollbar/simplebar.js"></script>
<script src="../assets/js/scrollbar/custom.js"></script>

<!-- Sidebar js-->
<script src="../assets/js/config.js"></script>

<!-- Plugins JS -->
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/notify/index.js"></script>

<!--Dropzon js -->
<script src="../assets/js/dropzone/dropzone.js"></script>
<script src="../assets/js/dropzone/dropzone-script.js"></script>

<!-- Theme js -->
<script src="../assets/js/script.js"></script>

<!-- Academic Js -->
<script src="../assets/js/academic.js"></script>

</body>

</html>