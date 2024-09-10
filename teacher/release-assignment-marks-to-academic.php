<?php

require "../MySQL.php";

if (isset($_GET['assId'])) {
    $assignmentId = $_GET['assId'];

    $assRs = MySQL::search("SELECT * FROM assignments WHERE id='${assignmentId}'");

    if ($assRs->num_rows > 0) {
        $ass = $assRs->fetch_assoc();
        if ($ass['released_state'] == 0) {
            MySQL::iud("UPDATE assignments SET released_state = 1 WHERE id = '${assignmentId}'");
            echo "success";
        } else {
            echo "Assignment Marks are already released to the academic";
        }
    }

}