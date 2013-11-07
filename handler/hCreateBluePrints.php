<?php
require_once __DIR__."/../class/FactoryLicBlueprint.php";

echo 'Blueprint creator';

$attr_id = $_POST['inputAttrID'];

$rideIdArr  = $_POST['inputLic'];
$licDateArr = $_POST['inputLicDate'];
$volumeArr  = $_POST['volume'];
$licOnlyArr = $_POST['LicOnly'];

$i=0;
while($i < 20)
{
    $i++;
    if($rideIdArr[$i] != 'none')
    {
       if($licDateArr[$i])
       {
           //echo '<br>'.$attr_id.','.$rideIdArr[$i].','.$licDateArr[$i].','.$volumeArr[$i].','.$licOnlyArr[$i].'';
           $lic[$i] = new FactoryLicBlueprint($attr_id, $rideIdArr[$i], $licDateArr[$i], $volumeArr[$i], $licOnlyArr[$i]);
       }

    }
}

