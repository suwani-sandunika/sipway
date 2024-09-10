<?php
$e = '';
$p = '';

if (isset($_COOKIE["ae"])) {
    $e = $_COOKIE["ae"];
}

if (isset($_COOKIE["ap"])) {
    $p = $_COOKIE["ap"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Sipway - Admin Login</title>

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
                    <form class="box" id="login-form" onsubmit="adminLogin(event)">

                        <div class="login-title">
                            <h2>Admin Login</h2>
                        </div>

                        <div class="input">
                            <label for="name" <?= ($e != '') ? 'style="line-height: 18px; font-weight: 100; top: 0px;"' : '' ?>>Username</label>
                            <input type="text" name="name" id="name" value="<?= $e ?>">
                            <span class="text-danger mt-3" id="name-err"></span>
                        </div>

                        <div class="input mb-4">
                            <label for="pass" <?= ($p != '') ? 'style="line-height: 18px; font-weight: 100; top: 0px;"' : '' ?>>Password</label>
                            <input type="password" name="pass" id="pass" value="<?= $p ?>">
                            <span class="text-danger mt-3" id="pass-err"></span>
                        </div>

                        <div>
                            <div class="pass-remember">
                                <input type="checkbox" name="remember"
                                       id="remember" <?= ($e != '' && $p != '') ? 'checked' : '' ?>/>
                                <label for="remember">Remember Me</label>
                            </div>
                            <a href="forgot-password.php" class="pass-forgot">Forgot your password?</a>
                        </div>

                        <div class="button login">
                            <button>
                                <span>Log In</span>
                            </button>
                        </div>

                        <p>All rights reserved by <a href="#">Sipway</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>

    <!-- Admin Js -->
    <script src="../assets/js/admin.js"></script>

</div>
</body>

</html>