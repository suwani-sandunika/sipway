<?php

require "../MySQL.php";

$lessonId = $_GET['lid'];

if (isset($lessonId)) {

    $lessonRs = MySQL::search("SELECT * FROM lesson_notes WHERE id = '${lessonId}'");
    if ($lessonRs->num_rows > 0) {
        $lessonData = $lessonRs->fetch_assoc();
        MySQL::iud("DELETE FROM lesson_notes WHERE id='${lessonId}'");
        unlink('../' . $lessonData['url']);
        echo "success";
    }

}