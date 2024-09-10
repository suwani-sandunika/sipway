<?php
require_once "../MySQL.php";
session_start();
if (!isset($_SESSION["academic"])) {
    header("Location: login.php");
    exit();
}

$assignmentId = $_GET['aid'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Sipway - Assignment Answer Sheets</title>
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
                <h5>Assignments Answer Sheets</h5>
            </div>

            <!-- All Admin Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-body">

                                <div id="card-body">
                                    <div class="mb-2 d-flex justify-content-between">
                                        <h4 class="fw-bold"><?= $_GET['subname'] ?> - <?= $_GET['batch'] ?></h4>

                                        <div class="d-flex gap-2">
                                            <div>
                                                <input type="text" class="form-control" placeholder="Search..."
                                                       id="aas-input"
                                                       onkeyup="searchAssignmentAnswerSheets('<?= $assignmentId ?>')"/>
                                            </div>
                                            <button onclick="releaseAssignmentMarksToStudents('<?= $assignmentId ?>')"
                                                    class="btn btn-primary">Release Marks to Students
                                            </button>
                                        </div>

                                    </div>

                                    <div>
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>Student</th>
                                                    <th>Submitted Date</th>
                                                    <th>Marks</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody id="table-body">

                                                <?php
                                                $assignmentRs = MySQL::search("SELECT *,student_has_assignments.url as url, student_has_assignments.id as sha_id, a.name as ass_name FROM student_has_assignments JOIN student s on student_has_assignments.student_email = s.email JOIN assignments a on student_has_assignments.assignments_id = a.id JOIN batch b on s.batch_id = b.id WHERE assignments_id = '${assignmentId}'");
                                                while ($assignmentData = $assignmentRs->fetch_assoc()) {
                                                    ?>
                                                    <tr class="text-center">
                                                        <td class="d-flex flex-column justify-content-center">
                                                            <span><?= $assignmentData['first_name'] . ' ' . $assignmentData['last_name'] ?></span>
                                                            <span class="text-muted"
                                                                  style="font-size: 10px"><?= $assignmentData['email'] ?></span>
                                                        </td>
                                                        <td class="text-center"><?= explode(' ', $assignmentData['submitted_date'])[0] ?></td>
                                                        <td><?= ($assignmentData['released_state'] == 0) ? "Not Released to Academic" : $assignmentData['marks'] ?></td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <!--data-bs-toggle="modal" data-bs-target="#update-student"-->
                                                                    <a href="../<?= $assignmentData['url'] ?>"
                                                                       download="<?= $assignmentData['first_name'] . ' ' . $assignmentData['last_name'] . ' - ' . $assignmentData['ass_name'] ?>"
                                                                       class="table-button text-primary">
                                                                        <span class="lnr lnr-download text-primary"></span>
                                                                        Download
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

<!-- Academic Js -->
<script src="../assets/js/academic.js"></script>

</body>

</html>