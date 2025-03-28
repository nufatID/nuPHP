<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    private $senderName = EMAIL_NAMA;
    private $senderEmail = EMAIL_ADR;
    private $password = EMAIL_PASS;
    private $SMTPhost = SMTP_HOST;

    public function sendMail($reciever, $subject = "Test subject", $body = "Test body")
    {
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = 2; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = $this->SMTPhost; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $this->senderEmail; // SMTP username
            $mail->Password = $this->password; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to (587 for TLS, 465 for SSL)

            // Recipients
            $mail->setFrom($this->senderEmail, $this->senderName);
            $mail->addAddress($reciever); // Add a recipient
            $mail->addReplyTo($this->senderEmail);

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            echo "Message has been sent\n";
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
            return false;
        }
    }
}
