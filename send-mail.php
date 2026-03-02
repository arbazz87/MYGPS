<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $query   = htmlspecialchars($_POST['query']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtpout.secureserver.net';  // ✅ From your screenshot
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@mygpslive.com';
        $mail->Password   = 'Shakera@959595';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // ✅ SSL (not STARTTLS)
        $mail->Port       = 465;                          // ✅ From your screenshot

        $mail->setFrom('info@mygpslive.com', 'MYGPS Website');
        $mail->addAddress('info@mygpslive.com');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Contact Message - MYGPS";

        $mail->Body = "
            <h3>New Contact Message</h3>
            <b>Name:</b> $name <br>
            <b>Email:</b> $email <br>
            <b>Phone:</b> $phone <br>
            <b>Query Type:</b> $query <br>
            <b>Message:</b> $message
        ";

        $mail->send();

        echo "<script>
                alert('Message Sent Successfully!');
                window.location.href='about.html';
              </script>";

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>