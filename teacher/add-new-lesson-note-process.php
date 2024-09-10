<?php

session_start();
require "../MySQL.php";

$teacherEmail = $_SESSION['teacher']['email'];
$lessonName = $_POST['lesson-name'];
$subjectId = $_POST['subject'];

if (empty($lessonName)) {
    echo "Please enter the lesson name";
} else if ($subjectId == 0) {
    echo "Please select a subject";
} else {
    $file = $_FILES['file-uploaded'];

    if (!empty($file['name'])) {

        $filePath = "assets/notes/" . uniqid() . $file['name'];
        move_uploaded_file($file['tmp_name'], "../" . $filePath);

        $d = new DateTime();
        $tz = new DateTimeZone('Asia/Colombo');
        $d->setTimezone($tz);
        $date = $d->format('Y-m-d H:i:s');

        $thsRs = MySQL::search("SELECT * FROM teacher_has_subject WHERE subject_id='${subjectId}' AND teacher_email = '${teacherEmail}'");
        $thsData = $thsRs->fetch_assoc();
        $thsId = $thsData['id'];


        MySQL::iud("INSERT INTO lesson_notes(lesson_name, url, date_added, teacher_has_subject_id) VALUE ('${lessonName}', '${filePath}', '${date}', '${thsId}')");
        echo 'success';

    } else {
        echo "Please select a file first";
    }

}
