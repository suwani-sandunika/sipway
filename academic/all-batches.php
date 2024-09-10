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
    <title>Sipway - All Batchers</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
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
                <h5>All Batches</h5>
                <form class="d-inline-flex">
                    <a href="add-new-batch.php" class="align-items-center btn btn-theme">
                        <i data-feather="plus-square"></i>Add New
                    </a>
                </form>
            </div>

            <!-- All student Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card">
                            <div class="card-body">

                                <div class="mb-3 col-3 offset-9">
                                    <input type="text" class="form-control" placeholder="Search..."
                                           onkeyup="searchBatches(0)" id="batch-search">
                                </div>

                                <div id="card-body">

                                    <div>
                                        <div class="table-responsive table-desi">
                                            <table class="user-table table table-striped all-package">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Batch</th>
                                                    <th>Year</th>
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

                                                $batchRs = MySQL::search("SELECT * FROM batch");
                                                $noOfBatches = $batchRs->num_rows;

                                                $results_per_page = 10;
                                                $no_of_pages = ceil($noOfBatches / $results_per_page);
                                                $viewed_count = ((int)$page_no - 1) * $results_per_page;

                                                $batchRs2 = MySQL::search("SELECT *, batch.id as batch_id FROM batch JOIN year y on batch.year_id = y.id ORDER BY batch_id ASC LIMIT ${results_per_page} OFFSET ${viewed_count}");

                                                $x = 1;

                                                while ($batch = $batchRs2->fetch_assoc()) {
                                                    ?>
                                                    <tr>

                                                        <td><?= $batch['batch_id'] ?></td>

                                                        <td><?= $batch['batch_name'] ?></td>

                                                        <td><?= $batch['year_name'] ?></td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <!--data-bs-toggle="modal" data-bs-target="#update-student"-->
                                                                    <button class="table-button text-primary"
                                                                            onclick='showUpdateBatchModal(<?= json_encode($batch) ?>)'>
                                                                        <span class="lnr lnr-pencil"></span>
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
                                        <nav class="ms-auto me-auto" aria-label="...">
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
            <!-- All student Table Ends-->

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
<div class="modal fade" id="update-batch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="update-batch" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel">Update Batch</h5>

                <form id="update-batch-form" onsubmit="updateBatch(event)">
                    <div>
                        <span id="err-msg" class="text-danger"></span>
                    </div>

                    <div>
                        <input type="text" class="d-none" id="batch-id" name="batch-id">
                    </div>
                    <div class="mb-3">
                        <label for="fname" class="form-label">Batch Name</label>
                        <input type="text" class="form-control" id="bname" name="bname">
                    </div>
                    <div class="mb-3">
                        <label for="lname" class="form-label">Year</label>
                        <select class="form-select" name="year" id="year">
                            <option value="0">Select year</option>
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

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="button-box mt-3 ">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn--yes btn-primary">Update</button>
                    </div>
                </form>

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
<script src="../assets/js/academic.js"></script>

</body>

</html>