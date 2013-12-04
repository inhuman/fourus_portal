<?php
require_once __DIR__.'/../class/PDOConfig.php';
require_once __DIR__.'/../class/FactoryAttraction.php';
echo "Add new attr handler";

$AttractionTownName     = $_POST['inputTownName'];
$AttractionSerialID     = $_POST['inputAttrSerialId'];
$AttractionMobility     = $_POST['inputType'];
$AttractionComment      = $_POST['inputComment'];


$PlayerCase             = $_POST['inputPlayerCase'];
$PlayerMotherboard      = $_POST['inputPlayerMotherboard'];
$PlayerPowerUnit        = $_POST['inputPlayerPowerUnit'];
$PlayerCPU              = $_POST['inputPlayerCPU'];
$PlayerCoolingSystem    = $_POST['inputPlayerCoolingSystem'];
$PlayerRAM              = $_POST['inputPlayerRAM'];
$PlayerHDD              = $_POST['inputPlayerHDD'];
$PlayerMOXA             = $_POST['inputPlayerMOXA'];
$PlayerPCICOM           = $_POST['inputPlayerPCICOM'];
$PlayerlicController    = $_POST['inputPlayerlicController'];
$PlayerProjector1       = $_POST['inputPlayerProjector1'];
$PlayerProjector2       = $_POST['inputPlayerProjector2'];
$PlayerVideoCard        = $_POST['inputPlayerVideoCard'];
$PlayerEffectBlock      = $_POST['inputPlayerEffectBlock'];

$TerminalCase           = $_POST['inputTerminalCase'];
$TerminalMotherboard    = $_POST['inputTerminalMotherboard'];
$TerminalPowerUnit      = $_POST['inputTerminalPowerUnit'];
$TerminalCPU            = $_POST['inputTerminalCPU'];
$TerminalCoolingSystem  = $_POST['inputTerminalCoolingSystem'];
$TerminalRAM            = $_POST['inputTerminalRAM'];
$TerminalHDD            = $_POST['inputTerminalHDD'];
$TerminalVideoCapture   = $_POST['inputTerminalVideoCapture'];
$TerminalCamera         = $_POST['inputTerminalCamera'];



$DynamicModuleMotorModel    = $_POST['inputDynamicModuleMotorModel'];
$DynamicModulePlugType      = $_POST['inputDynamicModulePlugType'];
$DynamicModuleBearingType   = $_POST['inputDynamicModuleBearingType'];
$DynamicModuleSensorType    = $_POST['inputDynamicModuleSensorType'];
$DynamicModuleArmLenght     = $_POST['inputDynamicModuleArmLenght'];
$DynamicModuleLinkageLenght = $_POST['inputDynamicModuleLinkageLenght'];

$AttractionPlayerID = FactoryAttraction::AddAttractionPlayerToDB($PlayerCase, $PlayerMotherboard, $PlayerPowerUnit,
                      $PlayerCPU, $PlayerCoolingSystem, $PlayerRAM, $PlayerHDD, $PlayerMOXA, $PlayerPCICOM,
                      $PlayerlicController, $PlayerProjector1, $PlayerProjector2, $PlayerVideoCard, $PlayerEffectBlock);

$AttractionTerminalID = FactoryAttraction::AddAttractionTerminalToDB($TerminalCase, $TerminalMotherboard, $TerminalPowerUnit,
                        $TerminalCPU, $TerminalCoolingSystem, $TerminalRAM, $TerminalHDD, $TerminalVideoCapture, $TerminalCamera);

$AttractionDynamicModuleID =  FactoryAttraction::AddAttractionDynamicModuleToDB($DynamicModuleMotorModel, $DynamicModulePlugType,
                              $DynamicModuleBearingType, $DynamicModuleSensorType, $DynamicModuleArmLenght, $DynamicModuleLinkageLenght);
echo "<br>vardump";

FactoryAttraction::AddAttractionToDB($AttractionTownName,$AttractionSerialID,$AttractionMobility, $AttractionPlayerID, $AttractionTerminalID, $AttractionDynamicModuleID);
/*
if(1==1)
{
echo '<br>$PlayerCase '                     .$PlayerCase  ;
echo '<br>$PlayerMotherboard '              .$PlayerMotherboard  ;
echo '<br>$PlayerPowerUnit '                .$PlayerPowerUnit  ;
echo '<br>$PlayerCPU '                      .$PlayerCPU  ;
echo '<br>$PlayerCoolingSystem '            .$PlayerCoolingSystem  ;
echo '<br>$PlayerRAM '                      .$PlayerRAM  ;
echo '<br>$PlayerHDD '                      .$PlayerHDD  ;
echo '<br>$PlayerMOXA '                     .$PlayerMOXA  ;
echo '<br>$PlayerPCICOM '                   .$PlayerPCICOM  ;
echo '<br>$PlayerlicController '            .$PlayerlicController  ;
echo '<br>$PlayerProjector1 '               .$PlayerProjector1  ;
echo '<br>$PlayerProjector2 '               .$PlayerProjector2  ;
echo '<br>$PlayerVideoCard '                .$PlayerVideoCard  ;
echo '<br>$PlayerEffectBlock '              .$PlayerEffectBlock  ;
echo '<br>';
echo '<br>$TerminalCase '                   .$TerminalCase  ;
echo '<br>$TerminalMotherboard '            .$TerminalMotherboard  ;
echo '<br>$TerminalPowerUnit '              .$TerminalPowerUnit  ;
echo '<br>$TerminalCPU '                    .$TerminalCPU  ;
echo '<br>$TerminalCoolingSystem '          .$TerminalCoolingSystem  ;
echo '<br>$TerminalRAM '                    .$TerminalRAM  ;
echo '<br>$TerminalHDD '                    .$TerminalHDD  ;
echo '<br>$TerminalVideoCapture '           .$TerminalVideoCapture  ;
echo '<br>$TerminalCamera '                 .$TerminalCamera  ;
echo '<br>';
echo '<br>$Comment '                        .$AttractionComment ;
echo "<br>";
echo '<br>$DynamicModuleMotorModel '        .$DynamicModuleMotorModel ;
echo '<br>$DynamicModulePlugType '          .$DynamicModulePlugType ;
echo '<br>$DynamicModuleBearingType '       .$DynamicModuleBearingType ;
echo '<br>$DynamicModuleSensorType '        .$DynamicModuleSensorType ;
echo '<br>$DynamicModuleArmLenght '         .$DynamicModuleArmLenght ;
echo '<br>$DynamicModuleLinkageLenght '     .$DynamicModuleLinkageLenght ;
*/



header('Location: /portal/?page=attraction');