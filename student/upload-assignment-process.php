<?php

require_once "../MySQL.php";
session_start();

if (isset($_FILES['file']) && isset($_POST['assId'])) {
    $assId = $_POST['assId'];
    $file = $_FILES['file'];
    $filePath = "assets/assignments/answer-sheets/" . uniqid() . basename($file['name']);

    $studentRs = MySQL::search("SELECT * FROM student WHERE email = '" . $_SESSION['student']['email'] . "'");

    $assignmentRs = MySQL::search("SELECT * FROM assignments WHERE id = '${assId}'");

    if ($studentRs->num_rows > 0 && $assignmentRs->num_rows > 0) {
        move_uploaded_file($file['tmp_name'], "../" . $filePath);

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $current_date = $d->format("Y-m-d H:i:s");

        $shaRs = MySQL::search("SELECT * FROM student_has_assignments WHERE assignments_id = '${assId}' AND student_email='" . $_SESSION['student']['email'] . "'");

        if ($shaRs->num_rows > 0) {
            MySQL::iud("UPDATE student_has_assignments SET submitted_date='${current_date}', url='${filePath}' WHERE assignments_id = '${assId}' AND student_email='" . $_SESSION['student']['email'] . "'");
            echo "re uploaded";
        } else {
            MySQL::iud("INSERT INTO student_has_assignments(student_email, assignments_id, submitted_date, url) VALUE ('" . $_SESSION['student']['email'] . "', '${assId}', '${current_date}', '${filePath}')");
            echo "uploaded";
        }

    } else {
        echo "Upload Failed! Something went wrong...";
    }

}