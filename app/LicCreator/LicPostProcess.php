<?php
require_once __DIR__."/../../class/PDOConfig.php";
require_once __DIR__."/../../class/FactoryRide.php";
require_once __DIR__."/../../class/FactoryAttraction.php";
class LicPostProcess {


    public function __construct($blueprintID)
    {

        $this->downloadFromCore($blueprintID);

    }

    private  function downloadFromCore($blueprintID)
    {

        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT attr_id, ride_id, licOnly FROM LicBlueprint WHERE id=:id");
        $stmt->bindValue(":id",$blueprintID);
        $stmt->execute();
        $status = $stmt->fetch();
        $stmt->closeCursor();

        echo "attr_id: ".$status['attr_id'];
        echo "<br>ride_id: ".$status['ride_id'];
        echo "<br>licOnly: ".$status['licOnly'];

        $ride = FactoryRide::findRide($status['ride_id']);
        $attr = FactoryAttraction::findOne($status['attr_id']);

        echo "<br>";
        var_dump($ride);
        echo "<br>";
        var_dump($attr);

        if($status['licOnly'] == '1')
        {
           $remoteFileNameWmv = '/processing/'.$ride->getFileName().'.lic';
           $remoteFileNamePrvk = '/processing/'.$ride->getPrvkName().'.lic';

           mkdir("/var/www/city/$attr->getSerialId() - $attr->getTown()/$blueprintID/", 0775, true);

           $localFileNameWmv = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'.lic';
           $localFileNamePrvk = '/var/www/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'.lic';

            $link = '<a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getFileName().'.lic">wmv.lic</a>
                     <a href="/city/'.$attr->getSerialId().' - '.$attr->getTown().'/'.$blueprintID.'/'.$ride->getPrvkName().'.lic">prvk.lic</a>';


            $dbh = new PDOConfig();
            $stmt = $dbh->prepare('UPDATE LicBlueprint SET location=:location WHERE id=:id');
            $stmt->bindValue(':location',$link);
            $stmt->bindValue(':id',$blueprintID);
            $stmt->execute();
            $stmt->closeCursor();



            echo "<br>remote wmv: $remoteFileNameWmv" ;
            echo "<br>remote prvk: $remoteFileNamePrvk" ;

            echo "<br>local wmv: $localFileNameWmv" ;
            echo "<br>local wmv: $localFileNamePrvk" ;

            echo "<br>link wmv: $link" ;
        }


/*
        $local_file_wmv = file_get_contents('/var/www/portal/licences/blueprints/blueprint['.$blueprintId.']._wmv');
        $remote_file_wmv = '/queue/blueprint['.$blueprintId.']._wmv';

        $local_file_prvk = file_get_contents('/var/www/portal/licences/blueprints/blueprint['.$blueprintId.']._prvk');
        $remote_file_prvk = '/queue/blueprint['.$blueprintId.']._prvk';

        $sftp = new Net_SFTP('192.168.0.211');
        if (!$sftp->login('id', 'id1@')) {
            exit('Login Failed');
        }

        $sftp->put($remote_file_wmv, $local_file_wmv);
        $sftp->put($remote_file_prvk, $local_file_prvk);
*/
    }
}

$r = new LicPostProcess($argv[1]);