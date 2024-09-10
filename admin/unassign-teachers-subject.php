<?php

require "../MySQL.php";

$email = $_POST['email'];
$sid = $_POST['sid'];

if (isset($email) && isset($sid)) {

    $thsRs = MySQL::search("SELECT * FROM teacher_has_subject WHERE teacher_email = '${email}' AND subject_id='${sid}'");
    if ($thsRs->num_rows > 0) {

        MySQL::iud("DELETE FROM teacher_has_subject WHERE teacher_email='${email}' AND subject_id='${sid}'");
        echo 'success';

    }


}