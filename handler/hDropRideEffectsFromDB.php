<?php
require_once __DIR__."/../class/PDOConfig.php";

$ride_id = $_POST['ride_id'];

echo '-----Handler test output --------';
echo '<br>ride id: '.$ride_id;
echo '<br>-------- End output -----------';


$dbh = new PDOConfig();
$effx = $dbh->prepare("DELETE FROM RidesEffectsLinks WHERE ride_id=:ride_id");
$effx->bindValue(':ride_id',$ride_id);
$effx->execute();
unset($dbh);
header('Location: /portal/?page=ride_card&id='.$ride_id);