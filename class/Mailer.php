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

        $to = 'adm.fourus@gmail.com';
        //$to = 'id.backup@mail.ru';
        $subject = 'Лицензии';


        $filename = "/data/city/test/test.txt";
        $attachment = chunk_split(base64_encode(file_get_contents($filename)));

        $boundary =md5(date('r', time()));
        $message='Инструкция по продлению лицензий';

        $headers = "From: Портал Fourus <noreply@studio-fourus.ru>\r\nReply-To: adm.fourus@gmail.com";
        $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";

        $message="This is a multi-part message in MIME format.

        --_1_$boundary
        Content-Type: multipart/alternative; boundary=\"_2_$boundary\"

        --_2_$boundary
        Content-Type: text/plain; charset=\"utf-8\"
        Content-Transfer-Encoding: 7bit

        $message

        --_2_$boundary--
        --_1_$boundary
        Content-Type: application/octet-stream; name=\"$filename\"
        Content-Transfer-Encoding: base64
        Content-Disposition: attachment

        $attachment
        --_1_$boundary--";

        mail($to, $subject, $message, $headers);
    }

    public function XMail( $from, $to, $subj, $text, $filename)
    {
        $f         = fopen($filename,"rb");
        $un        = strtoupper(uniqid(time()));
        $head      = "From: $from\n";
        $head     .= "To: $to\n";
        $head     .= "Subject: $subj\n";
        $head     .= "X-Mailer: PHPMail Tool\n";
        $head     .= "Reply-To: $from\n";
        $head     .= "Mime-Version: 1.0\n";
        $head     .= "Content-Type:multipart/mixed;";
        $head     .= "boundary=\"----------".$un."\"\n\n";
        $zag       = "------------".$un."\nContent-Type:text/html;\n";
        $zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
        $zag      .= "------------".$un."\n";
        $zag      .= "Content-Type: application/octet-stream;";
        $zag      .= "name=\"".basename($filename)."\"\n";
        $zag      .= "Content-Transfer-Encoding:base64\n";
        $zag      .= "Content-Disposition:attachment;";
        $zag      .= "filename=\"".basename($filename)."\"\n\n";
        $zag      .= chunk_split(base64_encode(fread($f,filesize($filename))))."\n";

        if (!@mail("$to", "$subj", $zag, $head))
            return 0;
        else
            return 1;
    }

}

$mail = new Mailer();




//$mail->subject = 'Ваш аккаунт под угрозой!';
//$mail->message = 'Это фейковое сообщение!!  ';

$mail->XMail('Портал Fourus <noreply@studio-fourus.ru>','adm.fourus@gmail.com','Лицензии','Инструкция хуем буем','/data/city/test/test.txt');