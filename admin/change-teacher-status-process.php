<?php

require_once "../MySQL.php";

$email = $_GET["email"];
$status = $_GET["status"];

if (empty($email)) {
    echo "Email cannot be empty";
} else if (!isset($status)) {
    echo "Status is no found";
} else {
    $teacher_rs = MySQL::search("SELECT * FROM teacher WHERE email = '${email}'");
    if ($teacher_rs->num_rows > 0) {

        if ($status === "true") {
            MySQL::iud("UPDATE teacher SET status = '1' WHERE email = '${email}'");
        } else if ($status === "false") {
            MySQL::iud("UPDATE teacher SET status = '0' WHERE email = '${email}'");
        }

        echo "success";
    }
}