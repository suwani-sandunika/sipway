<?php

require "../MySQL.php";
session_start();

$currentPass = $_POST['current-pass'];
$newPass = $_POST['new-pass'];
$confirmPass = $_POST['confirm-pass'];

if (empty($currentPass)) {
    echo "Please enter the current password";
} else if (empty($newPass)) {
    echo "Please enter the new password";
} else if ($newPass != $confirmPass) {
    echo "New password doesn't match. Please check your password";
} else {
    $admin = $_SESSION['admin'];
    $adminRs = MySQL::search("SELECT * FROM admin WHERE email='" . $admin['email'] . "' AND password = '${currentPass}'");

    if ($adminRs->num_rows > 0) {
        MySQL::iud("UPDATE admin SET password = '${newPass}' WHERE email = '" . $admin['email'] . "'");
        echo 'success';
    } else {
        echo "Couldn't find a admin with the current password";
    }

}
