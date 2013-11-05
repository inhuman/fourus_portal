<?php
require_once __DIR__."/LicBlueprint.php";
require_once __DIR__."/PDOConfig.php";

class FactoryLicBlueprint extends LicBlueprint {

    public function __construct($attrId, $rideId, $dateTo, $volume, $licOnly)
    {
        parent::__construct($attrId, $rideId, $dateTo, $volume, $licOnly);
        $this->addLicBlueprintToQueue();
    }

    private function addLicBlueprintToQueue()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('SET NAMES utf8; INSERT INTO LicCreationQueue (licblueprint_id) VALUES (:licblueprint_id)');
        $stmt->bindValue(':licblueprint_id',$this->getId());
        $stmt->execute();
        $stmt->closeCursor();

        $this->changeLicBlueprintStatus('in queue');
    }

    private function changeLicBlueprintStatus($status)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('SET NAMES utf8; UPDATE LicBlueprint SET status=:status WHERE id=:id');
        $stmt->bindValue(':status',$status);
        $stmt->bindValue(':id',$this->getId());
        $stmt->execute();
        $stmt->closeCursor();
    }

    private function  createIniSection(){}
    private function createAutoLicIni(){}
}


$ew = new FactoryLicBlueprint(114,4,'2013-12-30',80,1);