<?php
require_once __DIR__.'/LicCreator/TaskManager.php';
$TaskManager = new TaskManager();
/*
$blueprintId = 248 ;

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($sock, '192.168.0.211', 1024);
$msg = "create ".$blueprintId." wmv  ";
socket_send($sock,$msg,strlen($msg),MSG_OOB);
socket_close($sock);
*/