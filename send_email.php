<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log start
file_put_contents('debug.log', "Script started\n", FILE_APPEND);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'biredudave@gmail.com';
    $mail->Password   = 'salah><602';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Debugging output
    $mail->SMTPDebug = 2;
    file_put_contents('debug.log', "SMTP settings configured\n", FILE_APPEND);

    $mail->setFrom('biredudave@gmail.com', 'Your Name');
    $mail->addAddress('recipient@example.com');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Debug form data
    file_put_contents('debug.log', "Form data received\n", FILE_APPEND);

    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission From: $subject";
    $mail->Body    = "You have received a new message from the contact form.<br><br>".
                      "Name: $name<br>".
                      "Email: $email<br>".
                      "Subject: $subject<br>".
                      "Message:<br>$message<br>";

    // Send email
    $mail->send();
    file_put_contents('debug.log', "Email sent successfully\n", FILE_APPEND);
    echo 'Email sent successfully.';
} catch (Exception $e) {
    file_put_contents('debug.log', "Mailer Error: {$mail->ErrorInfo}\n", FILE_APPEND);
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
