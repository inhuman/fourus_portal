<?php
require_once __DIR__."/../../class/PDOConfig.php";

class CoreServer
{

   private
   $LocalAddress = '127.0.0.1',
   $LocalPort = 1024,
   $LocalSocket,

   $ClientAddress = '192.168.0.211',
   $ClientPort = 1024,
   $ClientSocket;


   public function __construct()
   {
       echo "CoreServer starting\n";
       $this->LocalSocket = socket_create_listen($this->LocalPort);
       socket_getsockname($this->LocalSocket, $this->LocalAddress, $this->LocalPort);

       print "Server Listening on $this->LocalAddress:$this->LocalPort\n";

       $this->Listen();

   }

   private function Listen()
   {

       while(true)
       {

           sleep(5);
           $this->SendCommand("getstatus ");

           $Client = socket_accept($this->LocalSocket);
           $buffer=socket_read($Client, 512);
           $bufferArr = explode('#',$buffer);

           $CoreStatus = $bufferArr[0];
           $blueprintId = $bufferArr[1];

           echo "Response: ".$CoreStatus.$blueprintId;


           Switch($CoreStatus)
           {
             case "ready"   :   $this->SaveCoreStatus("ready");     print "Core status: ready";     break;
             case "busy"    :   $this->SaveCoreStatus("busy");      print "Core status: busy";      break;
             default        :   $this->SaveCoreStatus("unknown");
             echo "Unrecognizible response ".$buffer; break;

           }
       }

   }

   private function SendCommand($command)
   {
       echo "\nSend $command to core";
       $this->ClientSocket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
       socket_connect($this->ClientSocket, $this->ClientAddress,  $this->ClientPort);
       $msg = $command;
       socket_send($this->ClientSocket,$msg,strlen($msg),MSG_OOB);
       socket_close($this->ClientSocket);

   }

    private function SaveCoreStatus($status)
    {
        $dbh = new PDOConfig();
        $stmt = $dbh->prepare("UPDATE Transport SET Status=:status WHERE Subject='Core'");
        $stmt->bindValue(':status',$status);
        $stmt->execute();
        $stmt->closeCursor();

    }
}

$CoreServer = new CoreServer();