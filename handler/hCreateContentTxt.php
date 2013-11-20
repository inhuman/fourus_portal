<?php
require_once __DIR__."/../class/FactoryRide.php";

$rideIdArr  = $_POST['inputRide'];
$volumeArr  = $_POST['volume'];

$contentTxt = fopen('/var/www/portal/temp/content.txt','wt');

fwrite($contentTxt,"test\nvolume=80\nname=Тест проекторов\nfile=test.wmv\n\n");
fwrite($contentTxt,"list\nvolume=80\nname=Заставка\nfile=zastavka.wmv\n\n");

$i=0;
while($i < 20)
{
    $i++;
    if($rideIdArr[$i] != 'none')
    {
            echo "$i block";

            //echo '<br>'.$attr_id.','.$rideIdArr[$i].','.$licDateArr[$i].','.$volumeArr[$i].','.$licOnlyArr[$i].'';
          //  $ride[$i] = new FactoryLicBlueprint($attr_id, $rideIdArr[$i], $licDateArr[$i], $volumeArr[$i], $licOnlyArr[$i]);
           $ride[$i] = FactoryRide::findRide($rideIdArr[$i]);


            $string1 = "movie\n";
            $string2 = "volume=$volumeArr[$i]\n";
            $string3 = "name=".$ride[$i]->getRideName()."\n";
            $string4 = "file=".$ride[$i]->getFileName()."\n\n";

            $rideRecord[$i] = $string1.$string2.$string3.$string4;
            echo $rideRecord[$i];


            fwrite($contentTxt,$rideRecord[$i]);


    }

}
fclose($contentTxt);
header('Location: /portal?page=create_content_txt&link=yes');
