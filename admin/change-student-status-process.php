<?php

require_once "../MySQL.php";

$email = $_GET["email"];
$status = $_GET["status"];

if (empty($email)) {
    echo "Email cannot be empty";
} else if (!isset($status)) {
    echo "Status is no found";
} else {
    $student_rs = MySQL::search("SELECT * FROM student WHERE email = '${email}'");
    if ($student_rs->num_rows > 0) {

        if ($status === "true") {
            MySQL::iud("UPDATE student SET status = '1' WHERE email = '${email}'");
        } else if ($status === "false") {
            MySQL::iud("UPDATE student SET status = '0' WHERE email = '${email}'");
        }

        echo "success";
    }
}