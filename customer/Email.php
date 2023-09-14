<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// include "Includes/Email.php";
// $email = new Email();
// $email->send($client_email, $name, $subject, $body);
class Email {
    private $mail;
    
    public function __construct(){
        try {
            //Server settings
            $this->mail = new PHPMailer(true);
            // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $this->mail->isSMTP(); //Send using SMTP
            $this->mail->Host       = 'smtp-relay.sendinblue.com'; //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true; //Enable SMTP authentication
            $this->mail->Username   = 'kyovarl7@gmail.com'; //SMTP username
            $this->mail->Password   = 'KDpkIBNcEUX7jvtZ'; //SMTP password
            $this->mail->Port       = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        } catch (Exception $e) {
            echo "Could not be set server settings. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function send($email, $name, $subject, $body) {
        try {
            $this->mail->setFrom('no-reply@am.com', 'Baling Thrift Store (BTS) System');
            $this->mail->addAddress($email, $name); 
    
            $this->mail->isHTML(true); 
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;

            $this->mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }
}