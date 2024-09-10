<?php

require "../MySQL.php";

$batchName = $_POST['bname'];
$yearId = $_POST['year'];

if (empty($batchName)) {
    echo "Batch name cannot be empty";
} else if ($yearId == 0) {
    echo "Please select a year";
} else {

    $batchRs = MySQL::search("SELECT * FROM batch WHERE batch_name = '${batchName}' AND year_id = '${yearId}'");

    if ($batchRs->num_rows > 0) {
        echo "Already have a batch registered with the given name";
    } else {
        MySQL::iud("INSERT INTO batch(batch_name, year_id) VALUE ('${batchName}', '${yearId}')");
        echo "success";
    }

}