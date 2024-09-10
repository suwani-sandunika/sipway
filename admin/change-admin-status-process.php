<?php

require_once "../MySQL.php";

$email = $_GET["email"];
$status = $_GET["status"];

if (empty($email)) {
    echo "Email cannot be empty";
} else if (!isset($status)) {
    echo "Status is no found";
} else {
    $admin_rs = MySQL::search("SELECT * FROM admin WHERE email = '${email}'");
    if ($admin_rs->num_rows > 0) {

        if ($status === "true") {
            MySQL::iud("UPDATE admin SET status = '1' WHERE email = '${email}'");
        } else if ($status === "false") {
            MySQL::iud("UPDATE admin SET status = '0' WHERE email = '${email}'");
        }

        echo "success";
    }
}