<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // If using Composer
require 'PHPMailer/PHPMailer.php';  // If manually installed
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Change to your SMTP server (e.g., SMTP of Outlook, Yahoo)
        $mail->SMTPAuth = true;
        $mail->Username = 'janersolis5@gmail.com';  // Replace with your email
        $mail->Password = 'fcdw ihxh awxw ekmq';  // Use an App Password (DO NOT use your actual password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email content
        $mail->setFrom($email, $name);
        $mail->addAddress('janersolis5@gmail.com');  // Where to receive the email
        $mail->Subject = "New Contact Form Message";
        $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        // Send email
        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        error_log("Mail Error: {$mail->ErrorInfo}");  // Log the error
        echo "Sorry, something went wrong. Please try again later.";
    }    
} else {
    echo "Invalid request.";
}
?>
