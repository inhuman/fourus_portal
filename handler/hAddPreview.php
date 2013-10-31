<?php
require_once __DIR__."/../class/FactoryRide.php";

$ride_id = $_POST['ride_id'];

$ride = FactoryRide::findRide($ride_id);

$uploaddir = '/var/www/portal/img/preview/';
$path_parts = pathinfo($ride->getFileName());
$uploadfile = $uploaddir . $path_parts['filename'] . '_preview.png';

if ($_FILES["file"]["error"] > 0)
{
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else
{
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
}

header('Location: /portal/?page=ride_card&id='.$ride_id);
