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
    $academic = $_SESSION['academic'];
    $academicRs = MySQL::search("SELECT * FROM academic_officer WHERE email='" . $academic['email'] . "' AND password = '${currentPass}'");

    if ($academicRs->num_rows > 0) {
        MySQL::iud("UPDATE academic_officer SET password = '${newPass}' WHERE email = '" . $academic['email'] . "'");
        echo 'success';
    } else {
        echo "Couldn't find an academic officer with the current password";
    }

}
