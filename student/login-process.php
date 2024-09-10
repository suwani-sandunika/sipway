<?php

require "../MySQL.php";

$name = $_POST["name"];
$pass = $_POST["pass"];

$result = array();

if (empty($name)) {
    $result["name-err"] = "Username cannot be empty";
} else {
    $result["name-err"] = '';
}

if (empty($pass)) {
    $result["pass-err"] = "Password cannot be empty";
} else {
    $result["pass-err"] = '';
}

if (empty($result["name-err"]) && empty($result["pass-err"])) {

    $user_rs = MySQL::search("SELECT * FROM student WHERE email = '${name}' AND password ='${pass}'");

    if ($user_rs->num_rows > 0) {

        $user = $user_rs->fetch_assoc();
        if ($user["is_verified"] == 0) {
            $result['pass-err'] = "Your account has not been verified yet.";
        } else if ($user["status"] == 0) {
            $result['pass-err'] = "Your account has been disabled. Please contact an academic officer";
        } else if ($user["payment_status"] == 0 && new DateTime($user["trial_period"]) < new DateTime()) {
            $result['pass-err'] = "Your trial period has expired. Please contact your academic officer.";
        } else {
            session_start();
            $_SESSION['student'] = $user;

            if (!empty($_POST['remember'])) {
                setcookie('stde', $name, time() + (60 * 60 * 24 * 7));
                setcookie('stdp', $pass, time() + (60 * 60 * 24 * 7));
            } else {
                setcookie('stde', '', -1);
                setcookie('stdp', '', -1);
            }

            $result['status'] = 'success';
        }

    } else {
        $result["pass-err"] = "Username or password invalid";
    }

}

echo json_encode($result);