<?php

require_once "../MySQL.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$batch = $_POST['batch'];
$payment_status = $_POST['payment_status'];

if (empty($fname)) {
    echo "Please enter the first name";
} else if (empty($lname)) {
    echo "Please enter the last name";
} else if (empty($mobile)) {
    echo "Please enter the mobile number";
} else if (empty($email)) {
    echo "Please enter the email";
} else if ($batch == '0') {
    echo "Please select the academic year of the student";
} else {

    $studentRs = MySQL::search("SELECT * FROM student WHERE email = '${email}'");
    if ($studentRs->num_rows > 0) {

        MySQL::iud("UPDATE student SET first_name = '${fname}', last_name = '${lname}', mobile='${mobile}', batch_id='${batch}', payment_status = '${payment_status}' WHERE email ='${email}'");
        echo "success";

    } else {
        echo "Student with this email not found";
    }

}