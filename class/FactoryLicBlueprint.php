<?php
require_once __DIR__."/LicBlueprint.php";

class FactoryLicBlueprint extends LicBlueprint {



    public function createBluePrint($id, $attrId, $rideId, $dateTo, $createDate, $volume, $licOnly)
    {

        $licBlueprint = parent::__construct($id,$attrId, $rideId, $dateTo, $volume, $licOnly, $createDate);

        $this->addLicBlueprintToQueue($licBlueprint);


    }

    private function  createIniSection(){}

    private function createAutoLicIni(){}

    private function addLicBlueprintToQueue()
    {



    }





}