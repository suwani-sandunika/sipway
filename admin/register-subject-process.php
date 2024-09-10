<?php

require "../MySQL.php";

$subName = $_POST['sub-name'];
$year = $_POST['year'];

if (empty($subName)) {
    echo "Subject name cannot be empty";
} else if ($year == 0) {
    echo "Select the year of the subject";
} else {

    $subRs = MySQL::search("SELECT * FROM subject WHERE subject_name = '${subName}'");
    if ($subRs->num_rows > 0) {
        echo "Subject with the given name is already registered";
    } else {
        MySQL::iud("INSERT INTO subject(subject_name, year_id) VALUE ('${subName}', '${year}')");
        echo "success";
    }

}