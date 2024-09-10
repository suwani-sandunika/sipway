<?php
require_once "../MySQL.php";
session_start();
if (!isset($_SESSION["admin"])) {
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
    <title>Sipway - All Academic Officers</title>
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
                <h5>All Academic Officers</h5>
                <form class="d-inline-flex">
                    <a href="add-new-admin.php" class="align-items-center btn btn-theme">
                        <i data-feather="plus-square"></i>Add New
                    </a>
                </form>
            </div>

            <!-- All academic Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3 col-3 offset-9">
                                    <input type="text" class="form-control" placeholder="Search..."
                                           onkeyup="searchAcademics(0)" id="academic-search">
                                </div>

                                <div id="card-body">

                                    <div>
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped all-package">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Email</th>
                                                    <th>Verified</th>
                                                    <th>Registered</th>
                                                    <th>Options</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                <?php

                                                if (isset($_GET["page"]) && $_GET["page"] != 0) {
                                                    $page_no = $_GET["page"];
                                                } else {
                                                    $page_no = 1;
                                                }

                                                $academic_rs = MySQL::search("SELECT * FROM academic_officer");
                                                $no_of_academics = $academic_rs->num_rows;

                                                $results_per_page = 10;
                                                $no_of_pages = ceil($no_of_academics / $results_per_page);
                                                $viewed_count = ((int)$page_no - 1) * $results_per_page;

                                                $academic_rs2 = MySQL::search("SELECT * FROM academic_officer ORDER BY creation_time DESC LIMIT ${results_per_page} OFFSET ${viewed_count}");

                                                $x = 1;
                                                while ($academic = $academic_rs2->fetch_assoc()) {
                                                    ?>
                                                    <tr>

                                                        <td class="switch-td mt-2">
                                                            <div class="form-check form-switch">
                                                                <input id="academic_status_switch<?= $x ?>"
                                                                       class="form-check-input" type="checkbox"
                                                                       role="switch"
                                                                       onchange="changeAcademicStatus('<?= $academic["email"] ?>', 'academic_status_switch<?= $x ?>')" <?= ($academic["status"] == 1) ? "checked" : "" ?>>
                                                            </div>
                                                        </td>

                                                        <td>
                                                    <span>
                                                    <img src="../<?= ($academic['profile_img'] != null) ? $academic['profile_img'] : 'assets/images/profile/user.png' ?>"
                                                         alt="users">
                                                    </span>
                                                        </td>

                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <span class="d-block "><?= $academic['first_name'] . ' ' . $academic['last_name'] ?></span>
                                                                <span class="text-muted">Academic</span>
                                                            </a>
                                                        </td>

                                                        <td><?= $academic['mobile'] ?></td>

                                                        <td><?= $academic['email'] ?></td>

                                                        <td class="<?= ($academic['is_verified'] == 1) ? "order-success" : "order-cancle" ?>"><?= ($academic['is_verified'] == 1) ? "<span>Verified</span>" : '<span>Not Verified</span>' ?></td>

                                                        <td><?= $academic['creation_time'] ?></td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <!--data-bs-toggle="modal" data-bs-target="#update-academic"-->
                                                                    <button class="table-button text-primary"
                                                                            onclick='showAcademicUpdateModal(<?= json_encode($academic) ?>)'>
                                                                        <span class="lnr lnr-pencil"></span>
                                                                    </button>
                                                                </li>

                                                                <li>
                                                                    <button onclick="showAcademicDeleteConfirmModal('<?= $academic["email"] ?>')"
                                                                            class="table-button text-danger">
                                                                        <span class="lnr lnr-trash"></span>
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                    $x++;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="pagination-box d-flex justify-content-center mt-3">
                                        <nav class="ms-auto me-auto " aria-label="...">
                                            <ul class="pagination pagination-primary">
                                                <li class="page-item">
                                                    <a class="page-link"
                                                       href="<?= ($page_no <= 1) ? "#" : "?page=" . ($page_no - 1) ?>">Previous</a>
                                                </li>


                                                <?php
                                                for ($i = 1; $i <= $no_of_pages; $i++) {
                                                    if ($page_no == $i) {
                                                        ?>
                                                        <li class="page-item active">
                                                            <a class="page-link"
                                                               href="<?= "?page=" . ($i) ?>"><?= $i ?></a>
                                                        </li>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li class="page-item">
                                                            <a class="page-link"
                                                               href="<?= "?page=" . ($i) ?>"><?= $i ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <li class="page-item">
                                                    <a class="page-link"
                                                       href="<?= ($page_no >= $no_of_pages) ? "#" : "?page=" . ($page_no + 1) ?>">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- All academic Table Ends-->

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

<!-- Modal Start -->
<div class="modal fade" id="update-academic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="academic-update" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Update Academic Officer</h5>

                <form>
                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname">
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile">
                    </div>
                    <div class="mb-3">
                        <label for="aemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="aemail" name="aemail" disabled>
                    </div>
                    <div>
                        <span id="err-msg" class="text-danger"></span>
                    </div>
                </form>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="button-box">
                    <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn--yes btn-primary" onclick="updateAcademic()">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Modal Start -->
<div class="modal fade" id="delete-confirm-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title">Delete Account</h5>
                <p>Are you sure you want to delete this academic account?</p>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="button-box">
                    <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn  btn--yes btn-primary" id="modal-confirm-btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

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
<script src="../assets/js/admin.js"></script>

</body>

</html>