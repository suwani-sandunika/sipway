<?php
require "../MySQL.php";

if (isset($_GET['aid'])) {
    $assignmentId = $_GET['aid'];

    $assignmentRs = MySQL::search("SELECT * FROM assignments WHERE id = '${assignmentId}'");
    if ($assignmentRs->num_rows > 0) {
        $assignmentData = $assignmentRs->fetch_assoc();

        MySQL::iud("DELETE FROM assignments WHERE id = '${assignmentId}'");
        unlink('../' . $assignmentData['url']);
        echo "success";

    }
}


