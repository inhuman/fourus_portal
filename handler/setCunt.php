<?php
require_once __DIR__."/"."../class/Photostat.php";
require_once __DIR__."/"."../class/FactoryPhotostat.php";


$page = $_POST['thisPage'];
$imgTempId = $_POST['imgTempId'];
$cunt = $_POST['people'];






$localPathRaw = FactoryPhotostat::getTempRecordFromDB($imgTempId);
$localPathArr = explode('"',$localPathRaw);
$localPath = $localPathArr[1];
$fullPath = '/home/FTP-shared'.$localPath;

Photostat::setCunt($fullPath,$cunt);

$imgTempId--;

header("Location: /portal/$page$imgTempId");