<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Sipway - Academic Officer Reset Password</title>

    <!-- Google font-->
    <link
            href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
            rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>

<body>
<!-- login page start-->
<div class="container-fluid p-0">
    <div class="row m-0">
        <div class="col-12 p-0">
            <div class="login-section">
                <div class="materialContainer">
                    <form class="box" id="pass-reset-form"
                          onsubmit="forgotAcademicPassword(event, '<?= $_GET['vc'] ?>')">

                        <div class="login-title">
                            <h2>Password Reset</h2>
                        </div>

                        <div class="input">
                            <label for="new-pass">New Password</label>
                            <input type="password" name="new-pass" id="new-pass">
                        </div>

                        <div class="input mb-4">
                            <label for="confirm-pass">Confirm Password</label>
                            <input type="password" name="confirm-pass" id="confirm-pass">
                        </div>
                        <div>
                            <span class="text-danger" id="pass-err"></span>
                        </div>
                        <div class="button login">
                            <button type="submit">
                                <span>Reset Password</span>
                            </button>
                        </div>

                        <p>All rights reserved by <a href="login.php">Sipway</a></p>
                    </form>
                </div>
            </div>
        </div>
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

    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>

    <!-- Teacher Js -->
    <script src="../assets/js/academic.js"></script>

</div>
</body>

</html>