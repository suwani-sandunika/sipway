<?php

require "../MySQL.php";


$email = $_POST["ans-email"];
$subjectId = $_POST['ans-subject'];

if (empty($email)) {
    echo "Something went wrong. System cannot find the teacher";
} else if ($subjectId == 0) {
    echo "Please select a subject";
} else {
    $teacherRs = MySQL::search("SELECT * FROM teacher WHERE email = '${email}'");
    if ($teacherRs->num_rows > 0) {
        $thsRs = MySQL::search("SELECT * FROM teacher_has_subject WHERE teacher_email = '${email}' AND subject_id='${subjectId}'");

        if ($thsRs->num_rows > 0) {
            echo "Teacher has been already assigned to this subject";
        } else {
            MySQL::iud("INSERT INTO teacher_has_subject(teacher_email, subject_id) VALUE ('${email}', '${subjectId}')");
            echo "success";
        }
    }
}

