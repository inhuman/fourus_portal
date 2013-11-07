<?php
require_once __DIR__."/../../class/FactoryLicBlueprint.php";
require_once __DIR__."/../../class/SFTConnection.php";


class TaskManager{


    public $blueprintId;

    public function __construct($blueprintId)
    {

        $this->blueprintId = $blueprintId;
        $this->sendBlueprint();

    }


    private function sendBlueprint()
    {
        $local_file_wmv = '/var/www/portal/licences/blueprints/blueprint['.$this->blueprintId.']._wmv';
        $remote_file_wmv = '/queue/blueprint['.$this->blueprintId.']._wmv';

        $local_file_prvk = '/var/www/portal/licences/blueprints/blueprint['.$this->blueprintId.']._prvk';
        $remote_file_prvk = '/queue/blueprint['.$this->blueprintId.']._prvk';

        echo 'blueprint id:';
        var_dump($this->blueprintId);


        try
        {
            $sftp = new SFTPConnection("192.168.0.211", 22);
            $sftp->login("id", "id1@");
            $sftp->uploadFile($local_file_wmv, $remote_file_wmv);
            $sftp->uploadFile($local_file_prvk, $remote_file_prvk);

            echo '<br>files sent';
            $this->changeLicBlueprintStatus('in queue',$this->blueprintId);
        }
        catch (Exception $e)
        {
            echo $e->getMessage() . "\n";
            echo '1';
        }



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
/*
    private function getCoreStatus()
    {
        try
        {
            $sftp = new SFTPConnection("192.168.0.211", 22);
            $sftp->login("id", "id1@");
            //$sftp->receiveFile("/log/log.txt", "/var/www/portal/class/testtest");

            $this->changeLicBlueprintStatus('in queue',$this->blueprintId);
        }
        catch (Exception $e)
        {
            echo $e->getMessage() . "\n";
        }
    }
*/
}

$r = new TaskManager(203);