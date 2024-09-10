<?php

require "../MySQL.php";

if (isset($_GET['assId'])) {
    $assignmentId = $_GET['assId'];

    $assRs = MySQL::search("SELECT * FROM assignments WHERE id='${assignmentId}'");

    if ($assRs->num_rows > 0) {
        $ass = $assRs->fetch_assoc();
        if ($ass['released_state'] == 0) {
            echo "Assignments marks are not released to academic yet.";
        } else if ($ass['released_state'] == 1) {
            MySQL::iud("UPDATE assignments SET released_state = 2 WHERE id = '${assignmentId}'");
            echo "success";
        } else {
            echo "Assignment Marks are already released to the students";
        }
    }

}