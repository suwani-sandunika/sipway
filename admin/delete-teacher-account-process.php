<?php

require "../MySQL.php";

$email = $_GET["email"];

if (empty($email)) {
    echo "Email not found";
} else {
    $teacher_rs = MySQL::search("SELECT * FROM teacher WHERE email = '${email}'");
    if ($teacher_rs->num_rows > 0) {

        MySQL::iud("DELETE FROM teacher_has_subject WHERE teacher_email = '${email}'");
        MySQL::iud("DELETE FROM teacher WHERE email = '${email}'");
        echo "success";

    }
}

