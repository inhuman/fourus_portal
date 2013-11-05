<?php
require_once __DIR__."/PDOConfig.php";

class LicBlueprint {

    public $id;

    private  $attrId, $rideId, $dateTo, $volume, $licOnly, $createDate;


    public function __construct($id,$attrId, $rideId, $dateTo, $volume, $licOnly, $createDate)
    {

      $this->setAttrId($attrId);
      $this->setRideId($rideId);
      $this->setDateTo($dateTo);
      $this->setLicOnly($licOnly);
      $this->setVolume($volume);
      $this->setCreateDate($createDate);

      $this->addLicBlueprintToDB();

    }


    private function addLicBlueprintToDB()
    {
        $dbh = new PDOConfig();



    }


    private function setAttrId($attrId){$this->attrId = $attrId;}
    public function getAttrId(){return $this->attrId;}

    private function setDateTo($dateTo){$this->dateTo = $dateTo;}
    public function getDateTo(){return $this->dateTo;}

    private function setLicOnly($licOnly){$this->licOnly = $licOnly;}
    public function getLicOnly(){return $this->licOnly;}

    private function setRideId($rideId){$this->rideId = $rideId;}
    public function getRideId(){return $this->rideId;}

    private function setVolume($volume){$this->volume = $volume;}
    public function getVolume(){return $this->volume;}

    private function setCreateDate($createDate){$this->createDate = $createDate;}
    public function getCreateDate(){return $this->createDate;}



}