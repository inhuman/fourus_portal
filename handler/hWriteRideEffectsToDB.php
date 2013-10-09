<?php
require_once __DIR__."/../class/PDOConfig.php";

$ride_id = $_POST['ride_id'];
$effect = $_POST['effect'];

echo '-----Handler test output --------';
echo '<br>ride id: '.$ride_id;
echo '<br>effect 1 - Lighting: '.$effect[1];
echo '<br>effect 2 - Water: '.$effect[2];
echo '<br>effect 3 - Vibro: '.$effect[3];
echo '<br>effect 4 - Snow: '.$effect[4];
echo '<br>effect 5 - Wind: '.$effect[5];
echo '<br>effect 6 - Boobles: '.$effect[6];
echo '<br>effect 7 - Mouse: '.$effect[7];
echo '<br>-------- End output -----------';


$dbh = new PDOConfig();
$effx = $dbh->prepare("INSERT INTO RidesEffectsLinks (ride_id,effx_id) VALUES (:ride_id,:effx_id)");
$effx->bindValue(':ride_id',$ride_id);
foreach($effect as $effx_id)
{
  $effx->bindValue(':effx_id',$effx_id);
  $effx->execute();
}
unset($dbh);
header('Location: /portal/?page=ride_card&id='.$ride_id);