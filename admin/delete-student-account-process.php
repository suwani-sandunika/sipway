<?php

require "../MySQL.php";

$email = $_GET["email"];

if (empty($email)) {
    echo "Email not found";
} else {
    $studentRs = MySQL::search("SELECT * FROM student WHERE email = '${email}'");
    if ($studentRs->num_rows > 0) {

        MySQL::iud("DELETE FROM student WHERE email = '${email}'");
        echo "success";

    }
}

