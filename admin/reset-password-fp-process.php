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

    $adminRs = MySQL::search("SELECT * FROM admin WHERE verification_code='${vc}'");

    if ($adminRs->num_rows > 0) {
        $adminData = $adminRs->fetch_assoc();

        MySQL::iud("UPDATE admin SET password='${newPass}', verification_code=null WHERE email = '" . $adminData['email'] . "'");
        echo "success";
    } else {
        echo "Invalid credentials... Please use the link attached to the email";
    }

}