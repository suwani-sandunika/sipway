<?php
session_start();
require "../MySQL.php";

$assignmentName = $_POST['assignment-name'];
$subjectId = $_POST['subject'];
$startDate = $_POST['start-date'];
$endDate = $_POST['end-date'];
$batchId = $_POST['batch-name'];
$file = $_FILES['file-uploaded'];

if (empty($assignmentName)) {
    echo "Please enter the assignment name";
} else if ($subjectId == 0) {
    echo "Please select a subject";
} else if (empty($startDate)) {
    echo "Please enter the start date";
} else if (empty($endDate)) {
    echo "Please enter the end date";
} else if ($batchId == 0) {
    echo "Please select a batch";
} else {

    if (!empty($file['name'])) {
        $filePath = "assets/assignments/" . uniqid() . $file['name'];
        move_uploaded_file($file['tmp_name'], "../" . $filePath);

        MySQL::iud("INSERT INTO assignments(name, start_date, end_date, url, subject_id, batch_id) VALUE ('${assignmentName}', '${startDate}', '${endDate}', '${filePath}', '${subjectId}', '${batchId}')");
        echo "success";
    } else {
        echo "Please select a file";
    }

}
