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
    $teacher = $_SESSION['teacher'];
    $teacherRs = MySQL::search("SELECT * FROM teacher WHERE email='" . $teacher['email'] . "' AND password = '${currentPass}'");

    if ($teacherRs->num_rows > 0) {
        MySQL::iud("UPDATE teacher SET password = '${newPass}' WHERE email = '" . $teacher['email'] . "'");
        echo 'success';
    } else {
        echo "Couldn't find a teacher with the current password";
    }

}
