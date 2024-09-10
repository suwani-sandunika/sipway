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
    $user_rs = MySQL::search("SELECT * FROM teacher WHERE email = '${name}' AND password ='${pass}'");

    if ($user_rs->num_rows > 0) {

        $user = $user_rs->fetch_assoc();
        if ($user["is_verified"] == 0) {
            $result['pass-err'] = "Your account has not been verified yet.";
        } else if ($user["status"] == 0) {
            $result['pass-err'] = "Your account has been disabled.";
        } else {
            session_start();
            $_SESSION['teacher'] = $user;

            if (!empty($_POST['remember'])) {
                setcookie('te', $name, time() + (60 * 60 * 24 * 7));
                setcookie('tp', $pass, time() + (60 * 60 * 24 * 7));
            } else {
                setcookie('te', '', -1);
                setcookie('tp', '', -1);
            }

            $result['status'] = 'success';
        }

    } else {
        $result["pass-err"] = "Username or password invalid";
    }
}

echo json_encode($result);