<?php
require_once __DIR__ . '/PDOConfig.php';
require_once __DIR__ . '/Mailer.php';
class FactoryMail {



    static public function getRecipient($FactoryID)
    {

        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT Name, Email, Phone FROM Accounting WHERE AttractionFactoryID=:AttractionFactoryID");
        $stmt->bindValue(":AttractionFactoryID",$FactoryID);
        $stmt->execute();
        $recipient = $stmt->fetch();
        $stmt->closeCursor();
        return $recipient;

    }


}