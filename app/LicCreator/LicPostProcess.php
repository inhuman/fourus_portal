<?php
require_once __DIR__."/../../class/PDOConfig.php";
require_once __DIR__."/../../class/FactoryRide.php";
require_once __DIR__."/../../class/FactoryAttraction.php";
require_once __DIR__."/../../class/Net/SFTP.php";
class LicPostProcess {


    public function __construct($blueprintID)
    {

        $this->downloadFromCore($blueprintID);

    }

    private  function downloadFromCore($blueprintID)
    {

        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT attr_id, ride_id, licOnly, volume FROM LicBlueprint WHERE id=:id");
        $stmt->bindValue(":id",$blueprintID);
        $stmt->execute();
        $status = $stmt->fetch();
        $stmt->closeCursor();

        echo "attr_id: ".$status['attr_id'];
        echo "<br>ride_id: ".$status['ride_id'];

        $ride = FactoryRide::findRide($status['ride_id']);
        $attr = FactoryAttraction::findOne($status['attr_id']);

        echo "<br>";
        var_dump($ride);
        echo "<br>";
        var_dump($attr);

        if($status['licOnly'] == 1)
        {
           $remoteFileNameWmv = '/processing/'.$ride->getFileName().'.lic';
           $remoteFileNamePrvk = '/processing/'.$ride->getPrvkName().'.lic';

           $attrFolder = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID;

           echo "attrFolder: ".$attrFolder;
           mkdir($attrFolder, 0775, true);


           $localFileNameWmv = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'.lic';
           $localFileNamePrvk = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'.lic';

            $sftp = new Net_SFTP('192.168.0.211');
            if (!$sftp->login('id', 'id1@')) {
                exit('Login Failed');
            }

            $sftp->get($remoteFileNameWmv, $localFileNameWmv);
            $sftp->get($remoteFileNamePrvk, $localFileNamePrvk);




            $link = '<a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'.lic">wmv.lic</a>
                     <a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'.lic">prvk.lic</a>';

            $dbh = new PDOConfig();
            $stmt = $dbh->prepare('UPDATE LicBlueprint SET location=:location WHERE id=:id');
            $stmt->bindValue(':location',$link);
            $stmt->bindValue(':id',$blueprintID);
            $stmt->execute();
            $stmt->closeCursor();

          $sftp->delete($remoteFileNameWmv);
            $sftp->delete($remoteFileNamePrvk);


        }
        elseif($status['licOnly'] == 0)
        {
            //TODO: что делать если снята галка "только лицензия"
            $remoteFileNameWmvLic   = '/processing/'.$ride->getFileName().'.lic';
            $remoteFileNamePrvkLic  = '/processing/'.$ride->getPrvkName().'.lic';
            $remoteFileNameWmvCab   = '/processing/'.$ride->getFileName().'_'.$ride->getRideName().'_'.$status['volume'].'.cab';
            $remoteFileNamePrvkCab  = '/processing/'.$ride->getPrvkName().'_'.$ride->getRideName().'_'.$status['volume'].'.cab';;

            $attrFolder = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID;

            echo "attrFolder: ".$attrFolder;
            mkdir($attrFolder, 0775, true);


            $localFileNameWmvLic   = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'.lic';
            $localFileNamePrvkLic  = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'.lic';
            $localFileNameWmvCab   = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'_'.$ride->getRideName().'_'.$status['volume'].'.cab';
            $localFileNamePrvkCab  = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'_'.$ride->getRideName().'_'.$status['volume'].'.cab';

            $sftp = new Net_SFTP('192.168.0.211');
            if (!$sftp->login('id', 'id1@')) {
                exit('Login Failed');
            }
/*
            $sftp->get($remoteFileNameWmvLic, $localFileNameWmvLic);
            $sftp->get($remoteFileNamePrvkLic, $localFileNamePrvkLic);
            $sftp->get($remoteFileNamePrvkCab, $localFileNamePrvkCab);
            $sftp->get($remoteFileNameWmvCab, $localFileNameWmvCab);
*/



            $link = '<a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'.lic">wmv.lic</a>
                     <a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'.lic">prvk.lic</a>
                     <a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'_'.$ride->getRideName().'_'.$status['volume'].'.cab">wmv.cab</a>
                     <a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'_'.$ride->getRideName().'_'.$status['volume'].'.cab">prvk.cab</a>';

            $dbh = new PDOConfig();
            $stmt = $dbh->prepare('UPDATE LicBlueprint SET location=:location WHERE id=:id');
            $stmt->bindValue(':location',$link);
            $stmt->bindValue(':id',$blueprintID);
            $stmt->execute();
            $stmt->closeCursor();
/*
            $sftp->delete($remoteFileNameWmvLic);
            $sftp->delete($remoteFileNamePrvkLic);
            $sftp->delete($remoteFileNamePrvkCab);
            $sftp->delete($remoteFileNameWmvCab);
*/
        }


    }
}
