<?php
require "../MySQL.php";

$subId = $_POST['sub-id'];
$subName = $_POST['sub-name'];
$yearId = $_POST['year-id'];

if (empty($subId)) {
    echo "Something went wrong!";
} else if (empty($subName)) {
    echo "Please enter the subject name";
} else if ($yearId == 0) {
    echo "Please select a year";
} else {

    $subRs = MySQL::search("SELECT * FROM subject WHERE id = '${subId}'");
    if ($subRs->num_rows > 0) {
        MySQL::iud("UPDATE subject SET subject_name='${subName}', year_id = '${yearId}' WHERE id='${subId}'");
        echo "success";
    } else {
        echo "Something went wrong! Please try again";
    }


}