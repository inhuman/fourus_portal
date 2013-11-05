<?php
require_once __DIR__."/PDOConfig.php";

class LicBlueprint {

    public $id, $status;

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

      $this->status = '';
    }


    private function addLicBlueprintToDB()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("INSERT INTO LicBlueprint (id, attr_id, ride_id, createDate, dateTo, volume, licOnly)
                               VALUES (:id, :attr_id, :ride_id, :createDate, :dateTo, :volume, :licOnly)");
        $stmt->bindValue(':id',$this->id);
        $stmt->bindValue(':attr_id',$this->getAttrId());
        $stmt->bindValue(':ride_id',$this->getRideId());
        $stmt->bindValue(':createDate',$this->getCreateDate());
        $stmt->bindValue(':dateTo',$this->getDateTo());
        $stmt->bindValue(':licOnly',$this->getLicOnly());
        $stmt->bindValue(':volume',$this->getVolume());

        $stmt->execute();
        $stmt->closeCursor();
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