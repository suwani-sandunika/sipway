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
    <meta name="description"
          content="Sipway teacher is super flexible, powerful, clean &amp; modern responsive bootstrap 5 teacher template with unlimited possibilities.">
    <meta name="keywords"
          content="teacher template, Sipway teacher template, dashboard template, flat teacher template, responsive teacher template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Sipway - All Teachers</title>
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
                <h5>All teachers</h5>
                <form class="d-inline-flex">
                    <a href="add-new-teacher.php" class="align-items-center btn btn-theme">
                        <i data-feather="plus-square"></i>Add New
                    </a>
                </form>
            </div>

            <!-- All teacher Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3 col-3 offset-9">
                                    <input type="text" class="form-control" placeholder="Search..."
                                           onkeyup="searchTeachers(0)" id="teacher-search">
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

                                                $teacher_rs = MySQL::search("SELECT * FROM teacher");
                                                $no_of_teachers = $teacher_rs->num_rows;

                                                $results_per_page = 10;
                                                $no_of_pages = ceil($no_of_teachers / $results_per_page);
                                                $viewed_count = ((int)$page_no - 1) * $results_per_page;

                                                $teacher_rs2 = MySQL::search("SELECT * FROM teacher ORDER BY creation_time DESC LIMIT ${results_per_page} OFFSET ${viewed_count}");

                                                $x = 1;
                                                while ($teacher = $teacher_rs2->fetch_assoc()) {
                                                    ?>
                                                    <tr>


                                                        <td class="switch-td mt-2">
                                                            <div class="form-check form-switch">
                                                                <input id="teacher_status_switch<?= $x ?>"
                                                                       class="form-check-input" type="checkbox"
                                                                       role="switch"
                                                                       onchange="changeTeacherStatus('<?= $teacher["email"] ?>', 'teacher_status_switch<?= $x ?>')" <?= ($teacher["status"] == 1) ? "checked" : "" ?>>
                                                            </div>

                                                        </td>


                                                        <td>
                                                    <span>
                                                    <img src="../<?= ($teacher['profile_img'] != null) ? $teacher['profile_img'] : 'assets/images/profile/user.png' ?>"
                                                         alt="users">
                                                    </span>
                                                        </td>

                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <span class="d-block "><?= $teacher['first_name'] . ' ' . $teacher['last_name'] ?></span>
                                                                <span class="text-muted">teacher</span>
                                                            </a>
                                                        </td>

                                                        <td><?= $teacher['mobile'] ?></td>

                                                        <td><?= $teacher['email'] ?></td>

                                                        <td class="<?= ($teacher['is_verified'] == 1) ? "order-success" : "order-cancle" ?>"><?= ($teacher['is_verified'] == 1) ? "<span>Verified</span>" : '<span>Not Verified</span>' ?></td>

                                                        <td><?= $teacher['creation_time'] ?></td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <!--data-bs-toggle="modal" data-bs-target="#update-teacher"-->
                                                                    <button class="table-button text-primary"
                                                                            onclick='showTeacherUpdateModal(<?= json_encode($teacher) ?>)'>
                                                                        <span class="lnr lnr-pencil"></span>
                                                                    </button>
                                                                </li>

                                                                <li>
                                                                    <button onclick="showTeachersSubjectModal('<?= $teacher['email'] ?>')"
                                                                            class="table-button text-info">
                                                                        <span class="lnr lnr-book"></span>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button onclick="showTeacherDeleteConfirmModal('<?= $teacher["email"] ?>')"
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
            <!-- All teacher Table Ends-->

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
<div class="modal fade" id="update-teacher" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="teacher-update" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Update teacher</h5>

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
                    <button type="button" class="btn btn--yes btn-primary" onclick="updateTeacher()">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Modal Start -->
<div class="modal fade" id="assign-new-subject-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="teacher-update" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Assign New Subject</h5>

                <form id="assign-new-subject-form" onsubmit="assignNewSubject(event)">
                    <div class="mb-2">
                        <span class="text-danger fw-bold" id="ans-err-msg"></span>
                    </div>
                    <div>
                        <input type="text" class="d-none" name="ans-email" id="ans-email">
                    </div>
                    <div class="mb-3">
                        <label for="fname" class="form-label">Subject</label>
                        <select name="ans-subject" id="ans-subject" class="form-select">
                            <option value="0">Select Subject</option>
                            <?php

                            $subjectRs = MySQL::search("SELECT * FROM subject");
                            while ($subject = $subjectRs->fetch_assoc()) {
                                ?>
                                <option value="<?= $subject['id'] ?>"><?= $subject['subject_name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="button-box">
                        <button type="submit" class="btn btn--yes btn-primary">Assign</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<!-- Modal Start -->
<div class="modal fade" id="manage-subjects" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="teacher-update" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Update teacher</h5>

                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-theme" onclick="showAssignNewSubjectModal()">
                        <i data-feather="plus-square"></i>Add New
                    </button>
                </div>


                <div id="subjects-modal-table">

                </div>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <p>Are you sure you want to delete this teacher account?</p>

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