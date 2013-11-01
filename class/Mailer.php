<?php
class Mailer {

    public $message, $subj, $attach, $to, $addrCopy, $headers;

    public function __construct()
    {
        $this->headers = 'From:   Портал Fourus <noreply@studio-fourus.ru>' . "\r\n" . 'Reply-To:  noreply <noreply@studio-fourus.ru>' . "\r\n" ;
        $this->to      = 'adm.fourus@gmail.com';
    }

    public function sendMail()
    {
        mail($this->to, $this->subject, $this->message, $this->headers);

    }
}

$mail = new Mailer();


$mail->subject = 'Письмо';
$mail->message = 'Тратата ';

$mail->sendMail();