<?php
require_once __DIR__."/TaskManager.php";
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
        $ServerPort = 512;
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

                        break;


                socket_close($SocketLicChecker);
            }

        }

    }
//----------------------------------------------------------------------------------------------------------------------





//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------




}


$r = new LicChecker();