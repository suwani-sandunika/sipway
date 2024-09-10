<?php
require_once "../MySQL.php";
session_start();

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filePath = "assets/images/profile/" . uniqid() . basename($file['name']);

    $allowedImageExtensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (in_array($file['type'], $allowedImageExtensions)) {
        $teacher_rs = MySQL::search("SELECT * FROM teacher WHERE email = '" . $_SESSION['teacher']['email'] . "'");

        if ($teacher_rs->num_rows > 0) {
            move_uploaded_file($file['tmp_name'], "../" . $filePath);

            MySQL::iud("UPDATE teacher SET profile_img = '${filePath}' WHERE email = '" . $_SESSION['teacher']['email'] . "'");
            echo 'success';
        } else {
            echo "Teacher couldn't find";
        }
    } else {
        echo "Only images are accepted. Please select an image.";
    }

}