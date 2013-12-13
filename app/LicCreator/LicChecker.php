<?php
require_once __DIR__."/TaskManager.php";
require_once __DIR__."/LicPostProcess.php";
class LicChecker{
//----------------------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        $this->CoreStatusReciever();
    }
//----------------------------------------------------------------------------------------------------------------------
    private function CoreStatusReciever()
    {

        $ServerAddress = '127.0.0.1';
        $ServerPort = 1025;
        $SocketLicChecker = socket_create_listen($ServerPort);


        while(true)
        {
            sleep(1);

            socket_getsockname($SocketLicChecker, $ServerAddress, $ServerPort);
            $Client = socket_accept($SocketLicChecker);
            $buffer=socket_read($Client, 512);


                echo "<br>Buffer is: ".$buffer;
                $bufferArr = explode('#',$buffer);
                $CoreStatus = $bufferArr[0];
                $blueprintId = $bufferArr[1];

                switch($CoreStatus)
                {
                    case "in progress ":
                        TaskManager::changeLicBlueprintStatus("in progress",$blueprintId);

                        break;

                    case "done ":
                        TaskManager::changeLicBlueprintStatus("done",$blueprintId);
                        $r = new LicPostProcess($blueprintId);

                        break;


                socket_close($SocketLicChecker);
            }

        }

    }

}

$r = new LicChecker();