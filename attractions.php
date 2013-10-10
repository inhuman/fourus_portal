<?php
require_once('class/FactoryAttraction.php');

echo "тут будут атракционы";


$attr = FactoryAttraction::findOne('7');
var_dump($attr);
echo 'serial: '.$attr->getSerialId;


