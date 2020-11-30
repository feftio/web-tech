<?php

namespace Framework\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    private $mailer;

    public function __construct() {
        try {
            $this->mailer = new PHPMailer(true);
            $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mailer->isSMTP();
            $this->mailer->Host = "ssl://smtp.gmail.com";
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = '19200114@turan-edu.kz';
            $this->mailer->Password = 'mottsun7979';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = 465;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }

    public function send($to) {
        
    }

}

?>