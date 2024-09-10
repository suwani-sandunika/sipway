<?php

require "../MySQL.php";

$shaId = $_POST['sha-id'];
$marks = $_POST['marks'];

if (empty($shaId)) {
    echo "Something went wrong!";
} else if (empty($marks)) {
    echo "Please enter marks";
} else if (!is_numeric($marks)) {
    echo "Invalid Marks";
} else if ($marks > 100) {
    echo "Marks cannot be exceed 100%";
} else {

    $shaRs = MySQL::search("SELECT * FROM student_has_assignments WHERE id = '${shaId}'");
    if ($shaRs->num_rows > 0) {

        MySQL::iud("UPDATE student_has_assignments SET marks = '${marks}' WHERE id='${shaId}'");
        echo "success";
    }


}
