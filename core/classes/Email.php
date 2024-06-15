<?php
class Email
{
    private $senderName = EMAIL_NAMA;
    private $senderEmail = EMAIL_ADR;
    private $password = EMAIL_PASS;
    private $SMTPhost = SMTP_HOST;


    public function sendMail($reciever, $subject = "Test subject", $body = "Test body")
    {

        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host =  $this->SMTPhost;                            // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $this->senderEmail;                 // SMTP username
        $mail->Password = $this->password;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom($this->senderEmail, $this->senderName);
        $mail->addAddress($reciever);                     // Add a recipient

        $mail->addReplyTo($this->senderEmail);

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;
        $mail->send();
    }
    public static function Kirim($reciever, $subject = "Test subject", $body = "Test body")
    {

        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host =  SMTP_HOST;                            // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL_ADR;                 // SMTP username
        $mail->Password = EMAIL_PASS;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom(EMAIL_ADR, EMAIL_NAMA);
        $mail->addAddress($reciever);                     // Add a recipient

        $mail->addReplyTo(EMAIL_ADR);

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;
        $mail->send();
    }
}
