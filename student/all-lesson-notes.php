<?php
require_once "../MySQL.php";
session_start();
if (!isset($_SESSION["student"])) {
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
    <title>Sipway - Lesson Notes</title>
    <!-- Google font-->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/font-awesome.css">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="../assets/css/linearicon.css">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">

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

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper dark-sidebar" id="pageWrapper">
    <!-- Page Header Start-->
    <?php require "header.php" ?>
    <!-- Page Header Ends-->

    <!-- Page Body Start -->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <?php require "sidebar.php" ?>
        <!-- Page Sidebar Ends-->

        <!-- Container-fluid starts-->
        <div class="page-body">

            <div class="title-header title-header-1">
                <h5>Lesson Notes</h5>
            </div>

            <?php

            // SELECT * FROM lesson_notes JOIN teacher_has_subject ths on lesson_notes.teacher_has_subject_id = ths.id JOIN subject s on ths.subject_id = s.id JOIN year y on s.year_id = y.id JOIN batch b on y.id = b.year_id WHERE b.id = '${student['batch_id']}'
            $subjectRs = MySQL::search("SELECT *, subject.id as sid FROM subject JOIN year y on subject.year_id = y.id JOIN batch b on y.id = b.year_id WHERE b.id = '" . $_SESSION['student']['batch_id'] . "'");

            while ($subjectData = $subjectRs->fetch_assoc()) {

                ?>
                <!-- All Admin Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-body">

                                    <div id="card-body">
                                        <div class="mb-2">
                                            <h4 class="fw-bold"><?= $subjectData['subject_name'] ?></h4>
                                        </div>

                                        <div>
                                            <div class="table-responsive table-desi">
                                                <table class="user-table table table-striped all-package">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Date Added</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php

                                                    $lnRs = MySQL::search("SELECT *, lesson_notes.url as url FROM lesson_notes JOIN teacher_has_subject ths on lesson_notes.teacher_has_subject_id = ths.id JOIN subject s on ths.subject_id = s.id WHERE s.id = '${subjectData['sid']}'");
                                                    while ($lnData = $lnRs->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $lnData['id'] ?></td>
                                                            <td><?= $lnData['lesson_name'] ?></td>
                                                            <td><?= $lnData['date_added'] ?></td>
                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <a href="../<?= $lnData['url'] ?>"
                                                                           download="<?= $lnData['lesson_name'] ?>"
                                                                           class="table-button text-primary">
                                                                            <span class="lnr lnr-download"></span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }

                                                    ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Admin Table Ends-->
                <?php
            }
            ?>


            <div class="container-fluid">
                <!-- footer start-->
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2021 © Sipway</p>
                        </div>
                    </div>
                </footer>
                <!-- footer end-->
            </div>
        </div>
        <!-- Container-fluid end -->
    </div>
    <!-- Page Body End -->
</div>

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
<script src="../assets/js/bootstrap/bootstrap.min.js"></script>

<!-- feather icon js -->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- scrollbar simplebar js -->
<script src="../assets/js/scrollbar/simplebar.js"></script>
<script src="../assets/js/scrollbar/custom.js"></script>

<!-- Sidebar js -->
<script src="../assets/js/config.js"></script>

<!-- Plugins JS -->
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/notify/index.js"></script>

<!-- all checkbox select js -->
<script src="../assets/js/checkbox-all-check.js"></script>

<!-- Theme js -->
<script src="../assets/js/script.js"></script>

<!-- Teacher Js -->
<script src="../assets/js/teacher.js"></script>

</body>

</html>