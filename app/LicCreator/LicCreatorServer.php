<?php
class LicCreatorServer
{


    public function __construct()
    {



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

            case "ready":        echo "Core status: ready.\n";                                 break;

            case "failed ":       echo "Core status: blueprint #$blueprintId failed.";          break;

            case "create":
                echo "Created task.";
                $this->sendBlueprintsFromQueue();
                break;

            case "getcorestatus":
                $this->getCoreStatus();
                break;

            case "busy":
                echo "Core is busy.";
                sleep (10);

                break;

            default:
                echo "Core status: unknown. Buffer: ";
                var_dump($buffer);

                break;


        }

    }
    socket_close($Socket);
}
}
