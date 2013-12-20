<?php
require_once __DIR__."/../class/FactoryLicBlueprint.php";
require_once __DIR__."/../app/LicCreator/TaskManager.php";
require_once __DIR__."/../class/FactoryMail.php";

echo 'Blueprint creator';

$attr_id = $_POST['inputAttrID'];

$rideIdArr  = $_POST['inputLic'];
$licDateArr = $_POST['inputLicDate'];
$volumeArr  = $_POST['volume'];
$licOnlyArr = $_POST['LicOnly'];
$recipientArr = $_POST['Recipient'];

$i=0;
while($i < 20)
{
    $i++;
    if($rideIdArr[$i] != 'none')
    {
       if($licDateArr[$i])
       {
           echo '<br>'.$attr_id.','.$rideIdArr[$i].','.$licDateArr[$i].','.$volumeArr[$i].','.$licOnlyArr[$i].'';
           if($licOnlyArr[$i] == ''){$licOnlyArr[$i] = 0;}
           $lic[$i] = new FactoryLicBlueprint($attr_id, $rideIdArr[$i], $licDateArr[$i], $volumeArr[$i], $licOnlyArr[$i]);

           foreach($recipientArr as $recipient)
           {
               FactoryMail::addRecipientToDeliveryList($lic[$i]->getId(), $recipient[0], 'in queue');

           }




       }

    }
}




header('Location: /portal');