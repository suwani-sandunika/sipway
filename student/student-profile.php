<?php
session_start();
require_once "../MySQL.php";
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
    <title>Sipway - Profile Setting</title>

    <!-- Google font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- Linear Icon css -->
    <link rel="stylesheet" href="../assets/css/linearicon.css">

    <!-- fontawesome css  -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/font-awesome.css">

    <!-- Themify icon css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">

    <!--Drop zon css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/dropzone.css">

    <!-- Feather icon css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/select2.min.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- Bootstrap-tag input css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap-tagsinput.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>

<body>
<!-- tap on top start-->
<div class="tap-top">
    <span class="lnr lnr-chevron-up"></span>
</div>
<!-- tap on tap end-->

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

        <!-- Settings Section Start -->
        <div class="page-body">
            <div class="title-header">
                <h5>Profile Setting</h5>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">

                                    <!-- Profile Image Start -->
                                    <div class="card col-12 col-md-6 offset-md-3">
                                        <div class="card-body">
                                            <div class="card-header-2 mb-3">
                                                <h5>Profile Image</h5>
                                            </div>

                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <?php

                                                $studentRs = MySQL::search("SELECT * FROM student WHERE email = '" . $_SESSION["student"]["email"] . "'");
                                                $studentData = $studentRs->fetch_assoc();
                                                ?>
                                                <img style="height: 200px;"
                                                     src="../<?= ($studentData['profile_img'] != '') ? $studentData['profile_img'] : "assets/images/profile/user.png" ?>"
                                                     id="student-profile-img-tag">
                                                <div class="mt-3">
                                                    <input type="file" id="profile-img" class="d-none" accept="image/*"
                                                           onchange="updateStudentProfileImg()">
                                                    <label for="profile-img" class="btn btn-dark">UPLOAD PROFILE</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Profile Image End -->

                                    <!-- Details Start -->
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="card-header-2 mb-3">
                                                <h5>Student Details</h5>
                                            </div>

                                            <!-- Accordion Starts -->
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                aria-expanded="true" aria-controls="collapseOne">
                                                            Personal Details
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                         aria-labelledby="headingOne"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <!-- Form Starts -->
                                                            <div id="student-profile-details-form"
                                                                 class="theme-form theme-form-2 mega-form">
                                                                <div class="row">

                                                                    <div>
                                                                        <span class="text-danger fw-bold"
                                                                              id="err-msg"></span>
                                                                    </div>

                                                                    <?php

                                                                    $studentRs = MySQL::search("SELECT * FROM student WHERE email = '" . $_SESSION['student']['email'] . "'");
                                                                    $student = $studentRs->fetch_assoc();
                                                                    ?>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <label class="form-label-title col-sm-2 mb-0">First
                                                                            Name</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control" type="text"
                                                                                   id="fname"
                                                                                   value="<?= $student['first_name'] ?>"
                                                                                   placeholder="Enter Your First Name">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <label class="form-label-title col-sm-2 mb-0">Last
                                                                            Name</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control" type="text"
                                                                                   id="lname"
                                                                                   value="<?= $student['last_name'] ?>"
                                                                                   placeholder="Enter Your Last Name">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <label class="form-label-title col-sm-2 mb-0">Mobile
                                                                            Number</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control" type="number"
                                                                                   id="mobile"
                                                                                   value="<?= $student['mobile'] ?>"
                                                                                   placeholder="Enter Your Number">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <label class="form-label-title col-sm-2 mb-0">Email
                                                                            Address</label>
                                                                        <div class="col-sm-10">
                                                                            <input disabled class="form-control"
                                                                                   type="email" id="aemail"
                                                                                   value="<?= $student['email'] ?>"
                                                                                   placeholder="Enter Your Email Address">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                                            <button onclick="updateStudent()"
                                                                                    type="submit"
                                                                                    class="btn btn-primary">UPDATE
                                                                                PROFILE
                                                                            </button>

                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-end">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Form Starts -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingTwo">
                                                        <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                aria-expanded="false" aria-controls="collapseTwo">
                                                            Reset Password
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                         aria-labelledby="headingTwo"
                                                         data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <!--Form Starts-->
                                                            <form id="student-reset-pass-form"
                                                                  class="theme-form theme-form-2 mega-form"
                                                                  onsubmit="resetStudentPassword(event)">
                                                                <div class="row">

                                                                    <div class="my-2">
                                                                        <span class="text-danger fw-bold"
                                                                              id="err-msg2"></span>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <label class="form-label-title col-sm-2 mb-0">Current
                                                                            Password</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control" type="password"
                                                                                   name="current-pass"
                                                                                   placeholder="Enter Your Current Password">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <label class="form-label-title col-sm-2 mb-0">Password</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control" type="password"
                                                                                   name="new-pass"
                                                                                   placeholder="Enter Your New Password">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <label class="form-label-title col-sm-2 mb-0">Confirm
                                                                            Password</label>
                                                                        <div class="col-sm-10">
                                                                            <input class="form-control" type="password"
                                                                                   name="confirm-pass"
                                                                                   placeholder="Enter Your Confirm Passowrd">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-4 row align-items-center">
                                                                        <div class="col-sm-12 d-flex justify-content-end">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">RESET
                                                                                PASSWORD
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex justify-content-end">
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <!--Form Starts-->
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--Accordion Ends -->

                                        </div>
                                    </div>
                                    <!-- Details End -->

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Settings Section End -->
    </div>
    <!-- Page Body End-->

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
<!-- page-wrapper End-->

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
                    <button type="button" class="btn  btn--yes btn-primary">Yes</button>
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

<!-- latest jquery-->
<script src="../assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- scrollbar simplebar js-->
<script src="../assets/js/scrollbar/simplebar.js"></script>
<script src="../assets/js/scrollbar/custom.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/config.js"></script>
<!-- Plugins JS start-->

<!-- bootstrap tag-input JS start-->
<script src="../assets/js/bootstrap-tagsinput.min.js"></script>
<script src="../assets/js/sidebar-menu.js"></script>

<!--Dropzon start-->
<script src="../assets/js/dropzone/dropzone.js"></script>
<script src="../assets/js/dropzone/dropzone-script.js"></script>

<!--Dropzon start-->
<script src="../assets/js/notify/index.js"></script>
<!-- Plugins JS Ends-->

<!-- Theme js-->
<script src="../assets/js/script.js"></script>

<!-- student Js -->
<script src="../assets/js/student.js"></script>

</body>
</html>