<?php

require_once "../MySQL.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];

if (empty($fname)) {
    echo "Please enter the first name";
} else if (empty($lname)) {
    echo "Please enter the last name";
} else if (empty($mobile)) {
    echo "Please enter the mobile number";
} else if (empty($email)) {
    echo "Please enter the email";
} else {

    $student_rs = MySQL::search("SELECT * FROM student WHERE email = '${email}'");
    if ($student_rs->num_rows > 0) {

        MySQL::iud("UPDATE student SET first_name = '${fname}', last_name = '${lname}', mobile='${mobile}' WHERE email ='${email}'");
        echo "success";

    } else {
        echo "User with this email not found";
    }

}