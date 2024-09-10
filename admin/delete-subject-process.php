<?php

require "../MySQL.php";


if (isset($_GET['subId'])) {
    $subId = $_GET['subId'];

    $subRs = MySQL::search("SELECT * FROM subject WHERE id='${subId}'");

    if ($subRs->num_rows > 0) {
        MySQL::iud("DELETE FROM subject WHERE id='${subId}'");
        echo "success";
    }
}
