<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Sipway - Teacher Verification</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&amp;family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&amp;display=swap"
          rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>
<body style="background-color: #f0f3f8">

<?php
require "../MySQL.php";

if (isset($_GET['teacher_code'])) {
    $code = $_GET['teacher_code'];

    $teacherRs = MySQL::search("SELECT * FROM teacher WHERE verification_code = '${code}'");

    if ($teacherRs->num_rows > 0) {
        $teacher = $teacherRs->fetch_assoc();
        $teacherEmail = $teacher['email'];

        MySQL::iud("UPDATE teacher SET is_verified = 1, verification_code = '' WHERE email = '${teacherEmail}'");

        ?>

        <div class="vh-100 d-flex flex-column justify-content-center align-items-center">
            <div class="login-title">
                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                    <g id="Glyph">
                        <g data-name="Glyph" id="Glyph-2">
                            <path fill="#e22454"
                                  d="M58.4,21.83,53,18.3V5a3,3,0,0,0-3-3H14a3,3,0,0,0-3,3V18.3L5.54,21.88A9,9,0,0,0,2,29.05V53a9.06,9.06,0,0,0,9.05,9H53a9.06,9.06,0,0,0,9-9V29.05A9,9,0,0,0,58.4,21.83ZM53,27.75l4.53-4a6.54,6.54,0,0,1,1.33,1.5L53,30.42Zm-46.54-4,4.54,4v2.68L5.14,25.21A6.74,6.74,0,0,1,6.46,23.71ZM5.57,57.38a6.7,6.7,0,0,1-1-1.75l15.82-14.2,1.5,1.33ZM37.78,38.84a8.72,8.72,0,0,0-11.56,0l-2.9,2.56L13,32.21V5a1,1,0,0,1,1-1H50a1,1,0,0,1,1,1V32.21L40.73,41.36ZM58.66,57.06,42.21,42.71l1.51-1.34L59.61,55.23A6,6,0,0,1,58.66,57.06Z"/>
                            <path fill="#e22454"
                                  d="M42.9,19.21l-8.49,8.48a5,5,0,0,1-7.07,0L23.1,23.45a4,4,0,1,1,5.66-5.66l2.12,2.12,6.36-6.36a4,4,0,0,1,5.66,5.66Z"/>
                        </g>
                    </g>
                </svg>
                <h2 class="mt-3">Email Verification Success!</h2>
            </div>

            <div class="mt-4">
                <a href="login.php" class="btn btn-lg btn-primary">Back to Login</a>
            </div>

        </div>

        <?php
    } else {
        ?>

        <div class="vh-100 d-flex flex-column justify-content-center align-items-center">
            <div class="login-title d-flex justify-content-center flex-column align-items-center">
                <svg height="200px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                    <g id="Glyph">
                        <g data-name="Glyph" id="Glyph-2">
                            <path fill="#e22454"
                                  d="M58.4,21.83,53,18.3V5a3,3,0,0,0-3-3H14a3,3,0,0,0-3,3V18.3L5.54,21.88A9,9,0,0,0,2,29.05V53a9.06,9.06,0,0,0,9.05,9H53a9.06,9.06,0,0,0,9-9V29.05A9,9,0,0,0,58.4,21.83ZM53,27.75l4.53-4a6.54,6.54,0,0,1,1.33,1.5L53,30.42Zm-46.54-4,4.54,4v2.68L5.14,25.21A6.74,6.74,0,0,1,6.46,23.71ZM5.57,57.38a6.7,6.7,0,0,1-1-1.75l15.82-14.2,1.5,1.33ZM37.78,38.84a8.72,8.72,0,0,0-11.56,0l-2.9,2.56L13,32.21V5a1,1,0,0,1,1-1H50a1,1,0,0,1,1,1V32.21L40.73,41.36ZM58.66,57.06,42.21,42.71l1.51-1.34L59.61,55.23A6,6,0,0,1,58.66,57.06Z"/>
                            <path fill="#e22454"
                                  d="M36,13.87l-1.44,7.06a2.62,2.62,0,0,1-5.12,0L28,13.87a4.09,4.09,0,0,1,1.72-4.22,4.32,4.32,0,0,1,4.58,0A4,4,0,0,1,36,13.87Z"/>
                            <circle fill="#e22454" cx="32" cy="28.5" r="3.5"/>
                        </g>
                    </g>
                </svg>
                <h2 class="mt-3">User has been already verified or verification failed!</h2>
            </div>

            <div class="mt-4">
                <button class="btn btn-lg btn-primary">Please check the verification email</button>
            </div>
        </div>

        <?php
    }
} else {
    ?>

    <div class="vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="login-title text-center">
            <svg baseProfile="tiny" height="200px" id="Layer_1" version="1.2" viewBox="0 0 24 24" xml:space="preserve"
                 xmlns="http://www.w3.org/2000/svg"><g>
                    <path fill="#ffbe00"
                          d="M12,5.511c0.561,0,1.119,0.354,1.544,1.062l5.912,9.854C20.307,17.842,19.65,19,18,19H6c-1.65,0-2.307-1.159-1.456-2.573   l5.912-9.854C10.881,5.865,11.439,5.511,12,5.511 M12,3.511c-1.296,0-2.482,0.74-3.259,2.031l-5.912,9.856   c-0.786,1.309-0.872,2.705-0.235,3.83S4.473,21,6,21h12c1.527,0,2.77-0.646,3.406-1.771s0.551-2.521-0.235-3.83l-5.912-9.854   C14.482,4.251,13.296,3.511,12,3.511z"/>
                </g>
                <g>
                    <circle fill="#ffbe00" cx="12" cy="16" r="1.3"/>
                </g>
                <g>
                    <path fill="#ffbe00"
                          d="M13.5,10c0-0.83-0.671-1.5-1.5-1.5s-1.5,0.67-1.5,1.5c0,0.199,0.041,0.389,0.111,0.562C11.165,11.938,12,14,12,14   s0.835-2.062,1.391-3.438C13.459,10.389,13.5,10.199,13.5,10z"/>
                </g></svg>
            <h2 class="mt-3" style="color:#ffbe00;">Sorry cannot find the user</h2>
        </div>
    </div>

    <?php
}
?>
</body>
</html>