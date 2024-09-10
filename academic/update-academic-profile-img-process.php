<?php
require_once "../MySQL.php";
session_start();

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filePath = "assets/images/profile/" . uniqid() . basename($file['name']);

    $allowedImageExtensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (in_array($file['type'], $allowedImageExtensions)) {
        $academicRs = MySQL::search("SELECT * FROM academic_officer WHERE email = '" . $_SESSION['academic']['email'] . "'");

        if ($academicRs->num_rows > 0) {
            move_uploaded_file($file['tmp_name'], "../" . $filePath);

            MySQL::iud("UPDATE academic_officer SET profile_img = '${filePath}' WHERE email = '" . $_SESSION['academic']['email'] . "'");
            echo 'success';
        } else {
            echo "Academic Officer couldn't find";
        }
    } else {
        echo "Only images are accepted. Please select an image.";
    }

}