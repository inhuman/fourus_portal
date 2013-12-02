<?php
class AttractionDynamicModule {

     private $DynamicModuleMotorModel, $DynamicModulePlugType, $DynamicModuleBearingType, $DynamicModuleSensorType,
             $DynamicModuleArmLenght, $DynamicModuleLinkageLenght;

    public function setDynamicModuleArmLenght($DynamicModuleArmLenght){$this->DynamicModuleArmLenght = $DynamicModuleArmLenght;}
    public function getDynamicModuleArmLenght(){return $this->DynamicModuleArmLenght;}

    public function setDynamicModuleBearingType($DynamicModuleBearingType){$this->DynamicModuleBearingType = $DynamicModuleBearingType;}
    public function getDynamicModuleBearingType(){return $this->DynamicModuleBearingType;}

    public function setDynamicModuleLinkageLenght($DynamicModuleLinkageLenght){$this->DynamicModuleLinkageLenght = $DynamicModuleLinkageLenght;}
    public function getDynamicModuleLinkageLenght(){return $this->DynamicModuleLinkageLenght;}

    public function setDynamicModuleMotorModel($DynamicModuleMotorModel){$this->DynamicModuleMotorModel = $DynamicModuleMotorModel;}
    public function getDynamicModuleMotorModel(){return $this->DynamicModuleMotorModel;}

    public function setDynamicModulePlugType($DynamicModulePlugType){$this->DynamicModulePlugType = $DynamicModulePlugType;}
    public function getDynamicModulePlugType(){return $this->DynamicModulePlugType;}

    public function setDynamicModuleSensorType($DynamicModuleSensorType){$this->DynamicModuleSensorType = $DynamicModuleSensorType;}
    public function getDynamicModuleSensorType(){return $this->DynamicModuleSensorType;}




}