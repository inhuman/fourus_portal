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

        $this->createBlueprintWmv();
        $this->createBlueprintPrvk();
    }

    private function addLicBlueprintToQueue()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('SET NAMES utf8; INSERT INTO LicCreationQueue (licblueprint_id) VALUES (:licblueprint_id);');
        $stmt->bindValue(':licblueprint_id',$this->getId());
        $stmt->execute();
        $stmt->closeCursor();

    }

    private function  createBlueprintWmv()
    {
        $ride        = FactoryRide::findRide($this->getRideId());
        $attraction  = FactoryAttraction::findOne($this->getAttrId());

        $string1     = "name=\"".$ride->getRideName().'"';
        $string2     = "path=\"M:\\wmv\\".$ride->getFileName().'"';

        $dateArr     = explode('-',$this->getDateTo());
        $string3     = "date=\"$dateArr[2]{RIGHT}$dateArr[1]{RIGHT}$dateArr[0]\"";

        $string4     = "id=\"".$attraction->getSerialId().'"';

        if($this->getLicOnly() == true){$string5 = "lic=\"\"";}
        else{$string5 = "lic=\"{SPACE}\"";}

        $vol         = 100 - $this->getVolume();
        $string6     = "volume=\"{DOWN $vol}\"";

        $string7     = 'blueprint id='.$this->getId().'';

        echo "<br>[Licence blueprint]";
        echo "<br>".$string1;
        echo "<br>".$string2;
        echo "<br>".$string3;
        echo "<br>".$string4;
        echo "<br>".$string5;
        echo "<br>".$string6;
        echo "<br>".$string7;


        $dataToWrite = "[LicenseBlueprint]\n".$string1."\n".$string2."\n".$string3."\n".$string4."\n".$string5."\n".$string6."\n".$string7;
        $fileName = 'blueprint['.$this->getId().']._wmv';

        $this->writeBlueprint($fileName,$dataToWrite);

    }

    private function  createBlueprintPrvk()
    {
        $ride        = FactoryRide::findRide($this->getRideId());
        $attraction  = FactoryAttraction::findOne($this->getAttrId());



        $string1     = "name=\"".$ride->getRideName().'"';
        $string2     = "path=\"M:\\dynamic\\".$ride->getPrvkName().'"';

        $dateArr     = explode('-',$this->getDateTo());
        $string3     = "date=\"$dateArr[2]{RIGHT}$dateArr[1]{RIGHT}$dateArr[0]\"";

        $string4     = "id=\"".$attraction->getSerialId().'"';

        if($this->getLicOnly() == true){$string5 = "lic=\"\"";}
        else{$string5 = "lic=\"{SPACE}\"";}

        $vol         = 100 - $this->getVolume();
        $string6     = "volume=\"{DOWN $vol}\"";

        $string7     = 'blueprint id='.$this->getId().'';

        echo "<br>[Licence blueprint]";
        echo "<br>".$string1;
        echo "<br>".$string2;
        echo "<br>".$string3;
        echo "<br>".$string4;
        echo "<br>".$string5;
        echo "<br>".$string6;
        echo "<br>".$string7;

        $dataToWrite = "[LicenseBlueprint]\n".$string1."\n".$string2."\n".$string3."\n".$string4."\n".$string5."\n".$string6."\n".$string7;
        $fileName = 'blueprint['.$this->getId().']._prvk';

        $this->writeBlueprint($fileName,$dataToWrite);
    }

    private function writeBlueprint($fileName,$dataToWrite)
    {
        //$dataToWrite = mb_convert_encoding($dataToWrite,'UTF-8');
        file_put_contents('../licences/blueprints/'.$fileName,$dataToWrite);
    }

}


