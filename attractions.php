<?php
require_once('class/FactoryAttraction.php');

echo "тут будут атракционы";


$attr = FactoryAttraction::findOne(7);

echo '<br>serial: '.$attr->getSerialId();


