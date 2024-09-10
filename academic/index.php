<?php
session_start();
require_once "../MySQL.php";
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
    <title>Sipway - Academic Dashboard</title>

    <!-- Google font-->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="../assets/css/linearicon.css">

    <!-- fontawesome css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/font-awesome.css">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">

    <!-- ratio css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/ratio.css">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vector-map.css">

    <!-- slick slider css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/slick-theme.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>

<body>
<!-- tap on top start -->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end -->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">

    <!-- Page Header Start-->
    <?php require "header.php" ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <?php require "sidebar.php" ?>
        <!-- Page Sidebar Ends-->

        <!-- index body start -->
        <div class="page-body">
            <div class="container-fluid">
                <div class="row">
                    <!-- chart caard section start -->
                    <div class="col-sm-6 col-xxl-3 col-lg-6">
                        <div class="b-b-primary border-5 border-0 card o-hidden">
                            <div class="custome-1-bg b-r-4 card-body">
                                <div class="media align-items-center static-top-widget">
                                    <div class="media-body p-0">
                                        <span class="m-0">No of Students</span>
                                        <h4 class="mb-0 counter">
                                            <?= MySQL::search("SELECT * FROM student")->num_rows ?>
                                            <span class="badge badge-light-primary grow">
                                                    <i data-feather="trending-up"></i>8.5%</span>
                                        </h4>
                                    </div>
                                    <div class="align-self-center text-center">
                                        <i data-feather="database"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xxl-3 col-lg-6">
                        <div class="b-b-danger border-5 border-0 card o-hidden">
                            <div class=" custome-2-bg  b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body p-0">
                                        <span class="m-0">No of Teachers</span>
                                        <h4 class="mb-0 counter">
                                            <?= MySQL::search("SELECT * FROM teacher")->num_rows ?>
                                            <span class="badge badge-light-danger grow">
                                                    <i data-feather="trending-down"></i>8.5%</span>
                                        </h4>
                                    </div>
                                    <div class="align-self-center text-center">
                                        <i data-feather="shopping-bag"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xxl-3 col-lg-6">
                        <div class="b-b-secondary border-5 border-0  card o-hidden">
                            <div class=" custome-3-bg b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body p-0">
                                        <span class="m-0">No of Admin</span>
                                        <h4 class="mb-0 counter">
                                            <?= MySQL::search("SELECT * FROM admin")->num_rows ?>
                                            <span class="badge badge-light-secondary grow ">
                                                    <i data-feather="trending-up"></i>8.5%</span>
                                        </h4>
                                    </div>

                                    <div class="align-self-center text-center">
                                        <i data-feather="message-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xxl-3 col-lg-6">
                        <div class="b-b-success border-5 border-0 card o-hidden">
                            <div class=" custome-4-bg b-r-4 card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body p-0">
                                        <span class="m-0">No of Academic Officers</span>
                                        <h4 class="mb-0 counter">
                                            <?= MySQL::search("SELECT * FROM academic_officer")->num_rows ?>
                                            <span class="badge badge-light-success grow">
                                                    <i data-feather="trending-down"></i>8.5%</span>
                                        </h4>
                                    </div>

                                    <div class="align-self-center text-center">
                                        <i data-feather="user-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- chart caard section End -->

                    <!-- Earning chart star-->
                    <div class="col-xl-4">
                        <div class="card o-hidden card-hover">
                            <div class="card-header border-0 pb-1">
                                <div class="card-header-title">
                                    <h4>Earning</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="bar-chart-earning"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Earning chart end-->

                    <!-- Earning chart star-->
                    <div class="col-xl-8">
                        <div class="card o-hidden ">
                            <div class="card-header border-0 pb-1">
                                <div class="card-header-title">
                                    <h4>Revenue Report</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div id="report-chart"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Earning chart  end-->

                    <!-- Transactions start-->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card o-hidden card-hover">
                            <div class="card-header border-0">
                                <div class="card-header-title">
                                    <h4>Transactions</h4>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div>
                                    <div class="table-responsive table-desi">
                                        <table class="user-table transactions-table table border-0">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="transactions-icon">
                                                        <i data-feather="shield"></i>
                                                    </div>
                                                    <div class="transactions-name">
                                                        <h6>Wallets</h6>
                                                        <p>Starbucks</p>
                                                    </div>
                                                </td>

                                                <td class="lost">-$74</td>
                                            </tr>
                                            <tr>
                                                <td class="td-color-1">
                                                    <div class="transactions-icon">
                                                        <i data-feather="check"></i>
                                                    </div>
                                                    <div class="transactions-name">
                                                        <h6>Bank Transfer</h6>
                                                        <p>Add Money</p>
                                                    </div>
                                                </td>

                                                <td class="success">+$125</td>
                                            </tr>
                                            <tr>
                                                <td class="td-color-2">
                                                    <div class="transactions-icon">
                                                        <i data-feather="dollar-sign"></i>
                                                    </div>
                                                    <div class="transactions-name">
                                                        <h6>Paypal</h6>
                                                        <p>Add Money</p>
                                                    </div>
                                                </td>

                                                <td class="lost">-$50</td>
                                            </tr>
                                            <tr>
                                                <td class="td-color-3">
                                                    <div class="transactions-icon">
                                                        <i data-feather="credit-card"></i>
                                                    </div>
                                                    <div class="transactions-name">
                                                        <h6>Mastercard</h6>
                                                        <p>Ordered Food</p>
                                                    </div>
                                                </td>

                                                <td class="lost">-$40</td>
                                            </tr>
                                            <tr>
                                                <td class="td-color-4 pb-0">
                                                    <div class="transactions-icon">
                                                        <i data-feather="trending-up"></i>
                                                    </div>
                                                    <div class="transactions-name">
                                                        <h6>Transfer</h6>
                                                        <p>Refund</p>
                                                    </div>
                                                </td>

                                                <td class="success pb-0">+$90</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Transactions end-->

                    <!-- visitors chart start-->
                    <div class="col-xxl-4 col-md-6">
                        <div class="h-100">
                            <div class="card o-hidden card-hover">
                                <div class="card-header border-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="card-header-title">
                                            <h4>Visitors</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="pie-chart">
                                        <div id="pie-chart-visitors"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- visitors chart end-->
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- footer start-->
            <div class="container-fluid">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2021 © Sipway</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- footer End-->
        </div>
        <!-- index body end -->
    </div>
    <!-- Page Body End -->
</div>
<!-- page-wrapper End-->


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

<!-- Sidebar jquery -->
<script src="../assets/js/config.js"></script>

<!-- tooltip init js -->
<script src="../assets/js/tooltip-init.js"></script>

<!-- Plugins JS -->
<script src="../assets/js/sidebar-menu.js"></script>
<!--<script src="../assets/js/notify/bootstrap-notify.min.js"></script>-->
<script src="../assets/js/notify/index.js"></script>

<!-- Apexchar js -->
<script src="../assets/js/chart/apex-chart/apex-chart1.js"></script>
<script src="../assets/js/chart/apex-chart/moment.min.js"></script>
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="../assets/js/chart/apex-chart/chart-custom1.js"></script>

<!-- ratio js -->
<script src="../assets/js/ratio.js"></script>

<!-- Theme js -->
<script src="../assets/js/script.js"></script>

<!-- Teacher js -->
<script src="../assets/js/academic.js"></script>
</body>

</html>