<?php
class Mailer {

    public $message, $subj, $attach, $to, $addrCopy, $headers;

    public function __construct()
    {
        //$this->headers = 'From:   Портал Fourus <noreply@studio-fourus.ru>' . "\r\n" . 'Reply-To:  noreply <noreply@studio-fourus.ru>' . "\r\n" ;
      // $this->to      = 'adm.fourus@gmail.com';

        $this->headers = 'From:    ВКонтакте <admin@notify.vk.com>' . "\r\n" . 'Reply-To:  noreply <noreply@notify.vk.com>' . "\r\n" ;
        $this->to      = 'a.isakevich@crystals.ru';


    }

    public function sendMail()
    {
        mail($this->to, $this->subject, $this->message, $this->headers);

    }
}

$mail = new Mailer();


$mail->subject = 'Ваш аккаунт под угрозой!';
$mail->message = 'Это фейковое сообщение!!  ';

$mail->sendMail();