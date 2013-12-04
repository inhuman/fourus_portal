<?php
require_once __DIR__.'/FactoryAttraction.php';




$AttractionPlayerID = FactoryAttraction::AddAttractionPlayerToDB('case', '', '', '', '', '', '', '', '', '', '', '', '', '');

$AttractionTerminalID = FactoryAttraction::AddAttractionTerminalToDB('case', '', '', '', '', '', '', '', '');

$AttractionDynamicModuleID = FactoryAttraction::AddAttractionDynamicModuleToDB('sfvsdfgsd', '', '', '', '', '');

FactoryAttraction::AddAttractionToDB('test','11111','',$AttractionPlayerID,$AttractionTerminalID,$AttractionDynamicModuleID);