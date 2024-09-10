<?php

require "../MySQL.php";

$email = $_GET["email"];

if (empty($email)) {
    echo "Email not found";
} else {
    $academic_rs = MySQL::search("SELECT * FROM academic_officer WHERE email = '${email}'");
    if ($academic_rs->num_rows > 0) {

        MySQL::iud("DELETE FROM academic_officer WHERE email = '${email}'");
        echo "success";

    }
}

