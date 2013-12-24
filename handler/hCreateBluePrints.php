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

$BlueprintIDArr = '';
$MailPackageType = '';

$MailPackageTypeLic = 0;
$MailPackageTypeRide = 0;

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

           switch($licOnlyArr[$i])
           {
               case 0:    $MailPackageTypeRide++;      break;

               case 1:    $MailPackageTypeLic++;      break;

           }
/*
           foreach($recipientArr as $recipient)
           {
               FactoryMail::addRecipientToDeliveryList($lic[$i]->getId(), $recipient[0], 0, 0);

           }
*/
           $BlueprintIDArr[$i] = $lic[$i]->getId();
       }
    }
}

if($MailPackageTypeRide == 0)
{$MailPackageType = 'lic';}

if($MailPackageTypeLic == 0)
{$MailPackageType = 'ride';}

if ($MailPackageTypeLic > 0 and $MailPackageTypeRide  > 0)
{$MailPackageType = 'licnride';}

echo "<br>TypeLic: $MailPackageTypeLic";


echo "<br>TypeRide: $MailPackageTypeRide";

FactoryMail::createDeliveryPackage($BlueprintIDArr, $MailPackageType, $attr_id);


header('Location: /portal');