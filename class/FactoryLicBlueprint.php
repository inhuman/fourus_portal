<?php
require_once __DIR__."/LicBlueprint.php";
require_once __DIR__."/PDOConfig.php";
require_once __DIR__."/FactoryRide.php";
require_once __DIR__."/FactoryAttraction.php";

class FactoryLicBlueprint extends LicBlueprint {

    public function __construct($attrId, $rideId, $dateTo, $volume, $licOnly)
    {
        parent::__construct($attrId, $rideId, $dateTo, $volume, $licOnly);
        $this->addLicBlueprintToQueue();
        $this->createAutoLicIni();
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

    private function  createAutoLicIni()
    {
        $ride        = FactoryRide::findRide($this->getRideId());
        $attraction  = FactoryAttraction::findOne($this->getAttrId());

        $string1 = "name=".$ride->getRideName();
        $string2 = "path=".$ride->getFileName();

        $dateArr = explode('-',$this->getDateTo());
        $string3 = "date=$dateArr[2]{RIGHT}$dateArr[1]{RIGHT}$dateArr[0]";

        $string4 = "id=".$attraction->getSerialId();

        if($this->getLicOnly() == true){$string5 = "lic=''";}
        else{$string5 = "lic='{SPACE}'";}

        $vol = 100 - $this->getVolume();
        $string6 = "volume={DOWN $vol}";


        echo "<br>".$string1;
        echo "<br>".$string2;
        echo "<br>".$string3;
        echo "<br>".$string4;
        echo "<br>".$string5;
        echo "<br>".$string6;
    }



}


$ew = new FactoryLicBlueprint(114,9,'2013-12-30',80,0);