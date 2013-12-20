<?php
require_once __DIR__ . '/PDOConfig.php';
require_once __DIR__ . '/Mailer.php';
class FactoryMail {



    static public function getRecipient($FactoryID)
    {

        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT AccountID, Name, Email, Phone FROM Accounting WHERE AttractionFactoryID=:AttractionFactoryID");
        $stmt->bindValue(":AttractionFactoryID",$FactoryID);
        $stmt->execute();
        $recipientArr = $stmt->fetchAll();
        $stmt->closeCursor();
        return $recipientArr;

    }

    static public function addRecipientToDeliveryList($BlueprintID, $AccountID, $Status)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("INSERT INTO LicDeliveryList VALUES (:BlueprintID, :AccountID, :Status)");
        $stmt->bindValue(":BlueprintID",$BlueprintID);
        $stmt->bindValue(":AccountID",$AccountID);
        $stmt->bindValue(":Status",$Status);
        $stmt->execute();
        $stmt->closeCursor();
    }


}