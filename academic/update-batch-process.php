<?php

require "../MySQL.php";

$batchId = $_POST['batch-id'];
$batchName = $_POST['bname'];
$year = $_POST['year'];

if (empty($batchName)) {
    echo "Batch name cannot be empty";
} else if ($year == 0) {
    echo "Select the year";
} else {

    $batchRs = MySQL::search("SELECT * FROM batch WHERE batch_name = '${batchName}' AND year_id = '${year}'");

    if ($batchRs->num_rows > 0) {
        echo "Batch name already used";
    } else {
        MySQL::iud("UPDATE batch SET batch_name = '${batchName}', year_id = '${year}' WHERE id = '${batchId}'");
        echo "success";
    }

}

