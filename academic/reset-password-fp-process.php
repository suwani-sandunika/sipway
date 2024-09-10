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

    $academicRs = MySQL::search("SELECT * FROM academic_officer WHERE verification_code='${vc}'");

    if ($academicRs->num_rows > 0) {
        $academicData = $academicRs->fetch_assoc();

        MySQL::iud("UPDATE academic_officer SET password='${newPass}', verification_code=null WHERE email = '" . $academicData['email'] . "'");
        echo "success";
    } else {
        echo "Invalid credentials... Please use the link attached to the email";
    }

}