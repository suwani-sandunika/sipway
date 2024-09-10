<?php
require_once "../MySQL.php";
session_start();
if (!isset($_SESSION["teacher"])) {
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
    <title>Sipway - All Assignments</title>
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
                <h5>All Assignments</h5>
                <form class="d-inline-flex">
                    <a href="add-new-assignment.php" class="align-items-center btn btn-theme">
                        <i data-feather="plus-square"></i>Add New
                    </a>
                </form>
            </div>

            <?php

            $subjectRs = MySQL::search("SELECT *, s.id as sub_id FROM teacher_has_subject JOIN subject s on teacher_has_subject.subject_id = s.id  WHERE teacher_email = '" . $_SESSION['teacher']['email'] . "'");
            while ($teacherData = $subjectRs->fetch_assoc()) {

                ?>
                <!-- All Admin Table Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="card">
                                <div class="card-body">

                                    <div id="card-body">
                                        <div class="mb-2">
                                            <h4 class="fw-bold"><?= $teacherData['subject_name'] ?></h4>
                                        </div>

                                        <div>
                                            <div class="table-responsive table-desi">
                                                <table class="user-table table table-striped all-package">
                                                    <thead>
                                                    <tr>
                                                        <th>Number</th>
                                                        <th>Name</th>
                                                        <th>Batch</th>
                                                        <th>Deadline</th>
                                                        <th>Released Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php

                                                    $assignmentRs = MySQL::search("SELECT *, assignments.id as id FROM assignments JOIN subject s on s.id = assignments.subject_id JOIN batch b on assignments.batch_id = b.id WHERE assignments.subject_id = '${teacherData['sub_id']}'");
                                                    while ($assignmentData = $assignmentRs->fetch_assoc()) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $assignmentData['id'] ?></td>
                                                            <td><?= $assignmentData['name'] ?></td>
                                                            <td><?= $assignmentData['batch_name'] ?></td>
                                                            <td><?= $assignmentData['start_date'] . ' - ' . $assignmentData['end_date'] ?></td>
                                                            <?php

                                                            switch ($assignmentData["released_state"]) {
                                                                case 0:
                                                                    echo "<td class='text-danger'>Not Released</td>";
                                                                    break;
                                                                case 1:
                                                                    echo "<td class='text-warning'>Released To Acdemic</td>";
                                                                    break;
                                                                case 2:
                                                                    echo "<td class='text-success'>Released To Students</td>";
                                                                    break;
                                                            }

                                                            ?>
                                                            <td>
                                                                <ul>
                                                                    <li>
                                                                        <a href="../<?= $assignmentData['url'] ?>"
                                                                           download="<?= $assignmentData['name'] ?>"
                                                                           class="table-button text-primary">
                                                                            <span class="lnr lnr-download"></span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <button onclick="deleteAssignment('<?= $assignmentData['id'] ?>')"
                                                                                class="table-button text-danger">
                                                                            <span class="lnr lnr-trash"></span>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <a href="assignment-answer-sheets.php?aid=<?= $assignmentData['id'] ?>&subname=<?= $teacherData['subject_name'] ?>&batch=<?= $teacherData['batch_name'] ?>"
                                                                           class="table-button text-primary">
                                                                            <span class="lnr lnr-eye"></span>
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

<!-- Admin Js -->
<script src="../assets/js/teacher.js"></script>

</body>

</html>