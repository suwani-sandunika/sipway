<?php
require_once "../MySQL.php";
session_start();


if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filePath = "assets/images/profile/" . uniqid() . basename($file['name']);

    $allowedImageExtensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (in_array($file['type'], $allowedImageExtensions)) {
        $studentRs = MySQL::search("SELECT * FROM student WHERE email = '" . $_SESSION['student']['email'] . "'");

        if ($studentRs->num_rows > 0) {
            move_uploaded_file($file['tmp_name'], "../" . $filePath);

            MySQL::iud("UPDATE student SET profile_img = '${filePath}' WHERE email = '" . $_SESSION['student']['email'] . "'");
            echo 'success';
        } else {
            echo "Student couldn't find";
        }
    } else {
        echo "Only images are accepted. Please select an image.";
    }

}