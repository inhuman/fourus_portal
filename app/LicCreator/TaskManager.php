<?php
require_once __DIR__."/../../class/FactoryLicBlueprint.php";

require_once __DIR__."/../../class/Net/SFTP.php";


class TaskManager{


    public $blueprintId;

    public function __construct($blueprintId)
    {

        $this->blueprintId = $blueprintId;
        $this->sendBlueprint();
        $this->getCoreStatus();

    }

    private function sendBlueprint()
    {
        $local_file_wmv = file_get_contents('/var/www/portal/licences/blueprints/blueprint['.$this->blueprintId.']._wmv');
        $remote_file_wmv = '/queue/blueprint['.$this->blueprintId.']._wmv';

        $local_file_prvk = file_get_contents('/var/www/portal/licences/blueprints/blueprint['.$this->blueprintId.']._prvk');
        $remote_file_prvk = '/queue/blueprint['.$this->blueprintId.']._prvk';

        echo 'blueprint id:';
        var_dump($this->blueprintId);

        $sftp = new Net_SFTP('192.168.0.211');
        if (!$sftp->login('id', 'id1@')) {
            exit('Login Failed');
        }

        $sftp->put($remote_file_wmv, $local_file_wmv);
        $sftp->put($remote_file_prvk, $local_file_wmv);


     //   $sftp->put('filename.remote', 'filename.local', NET_SFTP_LOCAL_FILE);
    }

    private function changeLicBlueprintStatus($status)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('SET NAMES utf8; UPDATE LicBlueprint SET status=:status WHERE id=:id');
        $stmt->bindValue(':status',$status);
        $stmt->bindValue(':id',$this->blueprintId);
        $stmt->execute();
        $stmt->closeCursor();
    }

    private function getCoreStatus()
    {

        $sftp = new Net_SFTP('192.168.0.211');
        if (!$sftp->login('id', 'id1@')) {
            exit('Login Failed');
        }
        // outputs the contents of filename.remote to the screen
        echo $sftp->get('/status/status.pid');
        // copies filename.remote to filename.local from the SFTP server
        //$sftp->get('filename.remote', 'filename.local');

    }

}

$r = new TaskManager('203');