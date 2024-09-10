<?php

require "../MySQL.php";

$email = $_GET["email"];

if (empty($email)) {
    echo "Email not found";
} else {
    $admin_rs = MySQL::search("SELECT * FROM admin WHERE email = '${email}'");
    if ($admin_rs->num_rows > 0) {

        MySQL::iud("DELETE FROM admin WHERE email = '${email}'");
        echo "success";

    }
}

