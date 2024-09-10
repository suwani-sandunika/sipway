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
    $student = $_SESSION['student'];
    $studentRs = MySQL::search("SELECT * FROM student WHERE email='" . $student['email'] . "' AND password = '${currentPass}'");

    if ($studentRs->num_rows > 0) {
        MySQL::iud("UPDATE student SET password = '${newPass}' WHERE email = '" . $student['email'] . "'");
        echo 'success';
    } else {
        echo "Couldn't find a student with the current password";
    }

}
