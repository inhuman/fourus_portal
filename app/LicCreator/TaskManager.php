<?php
require_once __DIR__."/../../class/FactoryLicBlueprint.php";
require_once __DIR__."/../../class/Net/SFTP.php";

require_once __DIR__."/../../class/PDOConfig.php";

class TaskManager{


    public function __construct()
    {
        //$this->sendBlueprintsFromQueue();


        $this->CoreServer();
    }

    private function CoreServer()
    {
        $ServerAddress = '127.0.0.1';
        $ServerPort = 1024;
        $Socket = socket_create_listen($ServerPort);

        socket_getsockname($Socket, $ServerAddress, $ServerPort);

        print "Server Listening on $ServerAddress:$ServerPort\n";

        while(true)
        {
            $Client = socket_accept($Socket);
            $buffer=socket_read($Client, 512);

            $bufferArr = explode('#',$buffer);

            $CoreStatus = $bufferArr[0];
            $blueprintId = $bufferArr[1];


            switch($CoreStatus)
            {
                case "done ":
                    echo "Core status: blueprint #$blueprintId done.\n";
                    $this->changeLicBlueprintStatus('done',$blueprintId);


                    break;

                case "in progress ":
                    echo "Core status: blueprint #$blueprintId in progress.\n";
                    $this->changeLicBlueprintStatus('in progress',$blueprintId);
                    break;

                case "ready ":        echo "Core status: ready.\n";                                 break;

                case "failed ":       echo "Core status: blueprint #$blueprintId failed.";          break;

                case "create":
                    echo "Created task.";
                    $this->sendBlueprintsFromQueue();
                    break;

                default:
                    echo "Core status: unknown. Buffer: ";
                    var_dump($buffer);

                    break;


            }

        }
        socket_close($Socket);
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

    private function getQueueFromDB()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("SELECT id FROM  LicBlueprint WHERE  status = 'added'; ");

        $stmt->execute();
        $idArr = $stmt->fetchAll();

        $stmt->closeCursor();
        return $idArr;

    }

    private function sendBlueprintsFromQueue() // TODO: тут должен указываться тип блупринта wmv, prv, prvk
    {
        foreach($this->getQueueFromDB() as $blueprintId)
        {
            $this->sendBlueprint($blueprintId[0]);

            $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_connect($sock, '192.168.0.211', 1024);
            $msg = "create ".$blueprintId[0]." prvk  ";
            socket_send($sock,$msg,strlen($msg),MSG_OOB);
            socket_close($sock);

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

   /* private function getCoreStatus()
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

    }*/



    static public function getDBDataQueueLicBlueprints()
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare('SELECT id, attr_id, ride_id, createDate, dateTo, licOnly, status, location FROM LicBlueprint;');
        $stmt->execute();
        $LicBlueprintsArr = $stmt->fetchAll();
        $stmt->closeCursor();
        return $LicBlueprintsArr;
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




}
