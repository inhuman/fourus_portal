<?php
require_once __DIR__."/../../class/FactoryLicBlueprint.php";
require_once __DIR__."/../../class/Net/SFTP.php";

require_once __DIR__."/../../class/PDOConfig.php";

class TaskManager{

    private  $licBlueprintsArr;

    public function __construct()
    {
        $this->sendBlueprintsFromQueue();
        $this->getCoreStatus();
        $this->getDBDataQueueLicBlueprints();
    }

    private function sendBlueprint($blueprintId)
    {
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

        $this->changeLicBlueprintStatus('in queue',$blueprintId);
    }

    private function sendBlueprintsFromQueue()
    {
        foreach($this->getQueueFromDB() as $blueprintId)
        {
            $this->sendBlueprint($blueprintId[0]);
        }
    }

    private function changeLicBlueprintStatus($status,$blueprintId)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('SET NAMES utf8; UPDATE LicBlueprint SET status=:status WHERE id=:id');
        $stmt->bindValue(':status',$status);
        $stmt->bindValue(':id',$blueprintId);
        $stmt->execute();
        $stmt->closeCursor();
    }

    private function getCoreStatus()
    {
        $CoreAddress = '192.168.0.211';

        echo $this->pingDomain($CoreAddress);

        $sftp = new Net_SFTP($CoreAddress);
        if (!$sftp->login('id', 'id1@')) {
            exit('<br>Core status: transport failed (can not login)');
        }
        // outputs the contents of filename.remote to the screen

        echo '<br>Core status: '.$sftp->get('/status/status.pid').'<br>';

        $blueprintId = explode('#',$sftp->get('/status/status.pid'));
        $this->changeLicBlueprintStatus('in progress',$blueprintId[1]);
        // copies filename.remote to filename.local from the SFTP server
        //$sftp->get('filename.remote', 'filename.local');

    }

    private function getQueueFromDB()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT id FROM  LicBlueprint WHERE  status = 'added'; ");

        $stmt->execute();
        $idArr = $stmt->fetchAll();

        $stmt->closeCursor();
        return $idArr;

    }

    private function getDBDataQueueLicBlueprints()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('SELECT id, attr_id, ride_id, createDate, dateTo, licOnly, status, location FROM LicBlueprint;');
        $stmt->execute();
        $this->setLicBlueprintsArr($stmt->fetchAll());
        $stmt->closeCursor();
    }


    private function pingDomain($host)
    {
        $port = 22;
        $waitTimeoutInSeconds = 1;
        if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){
            echo '<br>Core online';
        } else {
            echo '<br>Core offline';
        }
        fclose($fp);
    }


        public function getLicBlueprintsArr(){return $this->licBlueprintsArr;}
    public function setLicBlueprintsArr($licBlueprintsArr){$this->licBlueprintsArr = $licBlueprintsArr;}


}
