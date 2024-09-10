<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../assets/PHPMailer/Exception.php';
require '../assets/PHPMailer/PHPMailer.php';
require '../assets/PHPMailer/SMTP.php';
require "../MySQL.php";

$email = $_POST['email'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$cemail = $_POST['cemail'];
$mobile = $_POST['mobile'];

if (empty($fname)) {
    echo "Please enter the first name";
} else if (empty($lname)) {
    echo "Please enter the last name";
} else if (empty($email)) {
    echo "Please enter the email address";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address";
} else if (empty($cemail)) {
    echo "Please re-enter the email address";
} else if ($email != $cemail) {
    echo "Email address doesn't match";
} else if (empty($mobile)) {
    echo "Please enter the mobile number";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]{7}+/", $mobile) == 0) {
    echo "Invalid mobile number";
} else {

    $academic_rs = MySQL::search("SELECT * FROM academic_officer WHERE email = '${email}' OR mobile = '${mobile}'");
    if ($academic_rs->num_rows > 0) {
        echo "Already have an account created with this email or mobile number";
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $creation_date = $d->format("Y-m-d");

        $verification_code = substr(md5(uniqid(rand(), true)), 16, 6);
        $password = substr(md5(uniqid(rand(), true)), 16, 8);

        // Register new academic
        MySQL::iud("INSERT INTO academic_officer(email, first_name, last_name, mobile, password, verification_code, creation_time) VALUE ('${email}','${fname}', '${lname}', '${mobile}', '${password}', '${verification_code}', '${creation_date}')");

        // Send email verification to the newly created academic
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'example@gmail.com'; // SMTP username TODO: Change the email
            $mail->Password = 'password'; // SMTP password // TODO: Change the password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port = 465; // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('example@gmail.com', 'Sipway'); // TODO: Change the email
            $mail->addAddress($email, $fname . ' ' . $lname); // Add a recipient
            $mail->addReplyTo('example@gmail.com', 'Sipway'); // TODO: Change the email

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Verify Academic Officer Account - SipWay';
            $mail->Body = '<!DOCTYPE html>

<html lang="en">
<head>
    <title></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <!--[if mso]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            <o:AllowPNG/>
        </o:OfficeDocumentSettings>
    </xml><![endif]-->
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: inherit !important;
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
        }

        p {
            line-height: inherit
        }

        .desktop_hide,
        .desktop_hide table {
            mso-hide: all;
            display: none;
            max-height: 0px;
            overflow: hidden;
        }

        @media (max-width: 660px) {

            .desktop_hide table.icons-inner,
            .social_block.desktop_hide .social-table {
                display: inline-block !important;
            }

            .icons-inner {
                text-align: center;
            }

            .icons-inner td {
                margin: 0 auto;
            }

            .image_block img.big,
            .row-content {
                width: 100% !important;
            }

            .mobile_hide {
                display: none;
            }

            .stack .column {
                width: 100%;
                display: block;
            }

            .mobile_hide {
                min-height: 0;
                max-height: 0;
                max-width: 0;
                overflow: hidden;
                font-size: 0px;
            }

            .desktop_hide,
            .desktop_hide table {
                display: table !important;
                max-height: none !important;
            }
        }
    </style>
</head>
<body style="background-color: #f8f8f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
<table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation"
       style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9;" width="100%">
    <tbody>
    <tr>
        <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation"
                   style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #1aa19c;" width="100%">
                <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack"
                               role="presentation"
                               style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; background-color: #1aa19c; width: 640px;"
                               width="640">
                            <tbody>
                            <tr>
                                <td class="column column-1"
                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                    width="100%">
                                    <table border="0" cellpadding="0" cellspacing="0" class="divider_block block-1"
                                           role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                           width="100%">
                                        <tr>
                                            <td class="pad">
                                                <div align="center" class="alignment">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation"
                                                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                           width="100%">
                                                        <tr>
                                                            <td class="divider_inner"
                                                                style="font-size: 1px; line-height: 1px; border-top: 4px solid #1AA19C;">
                                                                <span> </span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation"
                   style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
                <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack"
                               role="presentation"
                               style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fff; color: #000000; width: 640px;"
                               width="640">
                            <tbody>
                            <tr>
                                <td class="column column-1"
                                    style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;"
                                    width="100%">
                                    <table border="0" cellpadding="0" cellspacing="0" class="divider_block block-1"
                                           role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                           width="100%">
                                        <tr>
                                            <td class="pad" style="padding-bottom:12px;padding-top:60px;">
                                                <div align="center" class="alignment">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation"
                                                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                           width="100%">
                                                        <tr>
                                                            <td class="divider_inner"
                                                                style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;">
                                                                <span> </span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" class="image_block block-2"
                                           role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                           width="100%">
                                        <tr>
											<div style="display: flex; justify-content: center;">
												<span style="font-size:30px;color:#2b303a;font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; "><strong>SipWay - Academic Account</strong></span>
											</div>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" class="divider_block block-3"
                                           role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                           width="100%">
                                        <tr>
                                            <td class="pad" style="padding-top:50px;">
                                                <div align="center" class="alignment">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation"
                                                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                           width="100%">
                                                        <tr>
                                                            <td class="divider_inner"
                                                                style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;">
                                                                <span> </span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" class="text_block block-4"
                                           role="presentation"
                                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                           width="100%">
                                        <tr>
                                            <td class="pad"
                                                style="padding-bottom:10px;padding-left:40px;padding-right:40px;padding-top:10px;">
                                                <div style="font-family: sans-serif">
                                                    <div class=""
                                                         style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #555555; line-height: 1.2; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;">
                                                        <p style="margin: 0; font-size: 16px; text-align: center; mso-line-height-alt: 19.2px;">
                                                            <span style="font-size:20px;color:#2b303a;"><strong>Your Account Login Details</strong></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="10" cellspacing="0" class="paragraph_block block-5"
                                           role="presentation"
                                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;"
                                           width="100%">
                                        <tr>
                                            <td class="pad">
                                                <div style="color:#000000;font-size:14px;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-weight:400;line-height:120%;text-align:center;direction:ltr;letter-spacing:0px;mso-line-height-alt:16.8px;">
                                                    <p style="margin: 0; margin-bottom: 5px;"><strong>Username</strong>:
                                                        <span style="color: #ff0368;">' . $email . '</span></p>
                                                    <p style="margin: 0;"><strong>Password</strong>: <span
                                                            style="color: #ff0368;">' . $password . '</span></p>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" class="button_block block-6"
                                           role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                           width="100%">
                                        <tr>
                                            <td class="pad"
                                                style="padding-left:10px;padding-right:10px;padding-top:15px;text-align:center;">
                                                <div align="center" class="alignment">
                                                    <!--[if mso]>
                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                                                 xmlns:w="urn:schemas-microsoft-com:office:word"
                                                                 style="height:62px;width:188px;v-text-anchor:middle;"
                                                                 arcsize="97%" stroke="false" fillcolor="#ff0070">
                                                        <w:anchorlock/>
                                                        <v:textbox inset="0px,0px,0px,0px">
                                                            <center style="color:#ffffff; font-family:Tahoma, sans-serif; font-size:16px">
                                                    <![endif]-->
                                                    <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#ff0070;border-radius:60px;width:auto;border-top:0px solid transparent;font-weight:400;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:15px;padding-bottom:15px;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;text-align:center;mso-border-alt:none;word-break:keep-all;">
                                                        <span style="padding-left:30px;padding-right:30px;font-size:16px;display:inline-block;letter-spacing:normal;">
                                                        <a href="http://localhost/sipway/academic/verify-academic.php?academic_code=' . $verification_code . '" style="margin: 0; word-break: break-word; line-height: 32px; color: white; text-decoration: none;"><strong>Verify Your Email</strong></a>
                                                        </span>
                                                    </div>
													<div style="margin-top: 25px">
														<span style="font-size:15px;font-family: Tahoma; color:gray;">Please click the button verify email to verify your newly created academic account</span>
													</div>
                                                    <!--[if mso]></center></v:textbox></v:roundrect><![endif]-->
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table border="0" cellpadding="0" cellspacing="0" class="divider_block block-7"
                                           role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                           width="100%">
                                        <tr>
                                            <td class="pad" style="padding-bottom:12px;padding-top:60px;">
                                                <div align="center" class="alignment">
                                                    <table border="0" cellpadding="0" cellspacing="0"
                                                           role="presentation"
                                                           style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;"
                                                           width="100%">
                                                        <tr>
                                                            <td class="divider_inner"
                                                                style="font-size: 1px; line-height: 1px; border-top: 0px solid #BBBBBB;">
                                                                <span> </span></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>
    </tbody>
</table><!-- End -->
</body>
</html>';

            $mail->send();
            echo 'success';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}