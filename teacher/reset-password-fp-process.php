<?php
require '../MySQL.php';

$newPass = $_POST['new-pass'];
$confirmPass = $_POST['confirm-pass'];
$vc = $_POST['vc'];

if (empty($vc)) {
    echo "Something went wrong. Please check the email";
} else if (empty($newPass)) {
    echo "Please enter a password";
} else if ($newPass != $confirmPass) {
    echo "Password mismatch. Re-check your new password";
} else {

    $teacherRs = MySQL::search("SELECT * FROM teacher WHERE verification_code='${vc}'");

    if ($teacherRs->num_rows > 0) {
        $teacherData = $teacherRs->fetch_assoc();

        MySQL::iud("UPDATE teacher SET password='${newPass}', verification_code=null WHERE email = '" . $teacherData['email'] . "'");
        echo "success";
    } else {
        echo "Invalid credentials... Please use the link attached to the email";
    }

}