<?php
require_once __DIR__.'/FactoryAttraction.php';


echo "--- Test ---";
echo '<br>Player:';
$attractionPlayer = FactoryAttraction::findPlayer(1);
echo '<br>case: '.$attractionPlayer->getPlayerCPU().'<br>';
echo '<br>vardump: ';
var_dump($attractionPlayer);


echo '<br>Terminal:';
$attractionTerminal = FactoryAttraction::findTerminal(1);
echo '<br>case: '.$attractionTerminal->getTerminalCPU()."<br>";
echo '<br>vardump: ';
var_dump($attractionTerminal);


echo '<br>DynamicModule:';
$attractionDynamicModule = FactoryAttraction::findDynamicModule(1);
var_dump($attractionDynamicModule);
echo '<br>case: '.$attractionDynamicModule->getDynamicModuleMotorModel()."<br>";
echo '<br>vardump: ';


echo '<br>AttractionFullComplect:';
$FullComplect = FactoryAttraction::findAttractionFullComplect(117);
var_dump($FullComplect);
echo '<br>AttractionPlayerID: '.$FullComplect[1]->AttractionPlayerID."<br>";
echo '<br>vardump: ';


