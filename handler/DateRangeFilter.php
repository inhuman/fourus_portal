<?php
$range = $_POST['reservation'];
$id = $_POST['id'];

$dateArr = explode(' - ',$range);
$dateFrom = $dateArr[0];
$dateTo = $dateArr[1];

/*
echo '<br>data range '.$range;
echo '<br>id '.$id;
echo '<br>date from ' . $dateFrom;
echo '<br>date to ' . $dateTo;
*/

header('Location: /portal/?page=photostat_card&id='. $id . '&dateFrom=' . $dateFrom . '&dateTo=' . $dateTo);