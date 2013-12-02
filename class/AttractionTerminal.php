<?php
class AttractionTerminal {

    private $TerminalCase, $TerminalMotherboard, $TerminalPowerUnit, $TerminalCPU, $TerminalCoolingSystem, $TerminalRAM,
            $TerminalHDD, $TerminalVideoCapture, $TerminalCamera;


    public function setTerminalCPU($TerminalCPU){$this->TerminalCPU = $TerminalCPU;}
    public function getTerminalCPU(){return $this->TerminalCPU;}

    public function setTerminalCamera($TerminalCamera){$this->TerminalCamera = $TerminalCamera;}
    public function getTerminalCamera(){return $this->TerminalCamera;}

    public function setTerminalCase($TerminalCase){$this->TerminalCase = $TerminalCase;}
    public function getTerminalCase(){return $this->TerminalCase;}

    public function setTerminalCoolingSystem($TerminalCoolingSystem){$this->TerminalCoolingSystem = $TerminalCoolingSystem;}
    public function getTerminalCoolingSystem(){return $this->TerminalCoolingSystem;}

    public function setTerminalHDD($TerminalHDD){$this->TerminalHDD = $TerminalHDD;}
    public function getTerminalHDD(){return $this->TerminalHDD;}

    public function setTerminalMotherboard($TerminalMotherboard){$this->TerminalMotherboard = $TerminalMotherboard;}
    public function getTerminalMotherboard(){return $this->TerminalMotherboard;}

    public function setTerminalPowerUnit($TerminalPowerUnit){$this->TerminalPowerUnit = $TerminalPowerUnit;}
    public function getTerminalPowerUnit(){return $this->TerminalPowerUnit;}

    public function setTerminalRAM($TerminalRAM){$this->TerminalRAM = $TerminalRAM;}
    public function getTerminalRAM(){return $this->TerminalRAM;}

    public function setTerminalVideoCapture($TerminalVideoCapture){$this->TerminalVideoCapture = $TerminalVideoCapture;}
    public function getTerminalVideoCapture(){return $this->TerminalVideoCapture;}


}