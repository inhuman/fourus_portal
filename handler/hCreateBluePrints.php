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



$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($sock, '127.0.0.1', 1024);
//$msg = "create#1";
$msg = "getcorestatus#1";
socket_send($sock,$msg,strlen($msg),MSG_OOB);
socket_close($sock);


header('Location: /portal');