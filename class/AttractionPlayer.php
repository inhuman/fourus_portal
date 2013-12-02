<?php
class AttractionPlayer {
    private $PlayerCase, $PlayerMotherboard, $PlayerPowerUnit, $PlayerCPU, $PlayerCoolingSystem, $PlayerRAM,
            $PlayerHDD, $PlayerMOXA, $PlayerPCICOM, $PlayerlicController, $PlayerProjector1, $PlayerProjector2,
            $PlayerVideoCard, $PlayerEffectBlock;

    public function setPlayerCPU($PlayerCPU){$this->PlayerCPU = $PlayerCPU;}
    public function getPlayerCPU(){return $this->PlayerCPU;}

    public function setPlayerCase($PlayerCase){$this->PlayerCase = $PlayerCase;}
    public function getPlayerCase(){return $this->PlayerCase;}

    public function setPlayerCoolingSystem($PlayerCoolingSystem){$this->PlayerCoolingSystem = $PlayerCoolingSystem;}
    public function getPlayerCoolingSystem(){return $this->PlayerCoolingSystem;}

    public function setPlayerEffectBlock($PlayerEffectBlock){$this->PlayerEffectBlock = $PlayerEffectBlock;}
    public function getPlayerEffectBlock(){return $this->PlayerEffectBlock;}

    public function setPlayerHDD($PlayerHDD){$this->PlayerHDD = $PlayerHDD;}
    public function getPlayerHDD(){return $this->PlayerHDD;}

    public function setPlayerMOXA($PlayerMOXA){$this->PlayerMOXA = $PlayerMOXA;}
    public function getPlayerMOXA(){return $this->PlayerMOXA;}

    public function setPlayerMotherboard($PlayerMotherboard){$this->PlayerMotherboard = $PlayerMotherboard;}
    public function getPlayerMotherboard(){return $this->PlayerMotherboard;}

    public function setPlayerPCICOM($PlayerPCICOM){$this->PlayerPCICOM = $PlayerPCICOM;}
    public function getPlayerPCICOM(){return $this->PlayerPCICOM;}

    public function setPlayerPowerUnit($PlayerPowerUnit){$this->PlayerPowerUnit = $PlayerPowerUnit;}
    public function getPlayerPowerUnit(){return $this->PlayerPowerUnit;}

    public function setPlayerProjector1($PlayerProjector1){$this->PlayerProjector1 = $PlayerProjector1;}
    public function getPlayerProjector1(){return $this->PlayerProjector1;}

    public function setPlayerProjector2($PlayerProjector2){$this->PlayerProjector2 = $PlayerProjector2;}
    public function getPlayerProjector2(){return $this->PlayerProjector2;}

    public function setPlayerRAM($PlayerRAM){$this->PlayerRAM = $PlayerRAM;}
    public function getPlayerRAM(){return $this->PlayerRAM;}

    public function setPlayerVideoCard($PlayerVideoCard){$this->PlayerVideoCard = $PlayerVideoCard;}
    public function getPlayerVideoCard(){return $this->PlayerVideoCard;}

    public function setPlayerlicController($PlayerlicController){$this->PlayerlicController = $PlayerlicController;}
    public function getPlayerlicController(){return $this->PlayerlicController;}

}