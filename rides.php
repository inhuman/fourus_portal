<?php
include('class/Ride.php');

echo "тут будет список райдов, с картинками, со всеми делами";


echo '<table class="table table-bordered table-hover">';
echo "<thead><tr>";
echo "<th>#</th>";
echo "<th>Название</th>";
echo "<th>Время</th>";
echo "<th>Демо</th>";
echo "<th>Постер</th>";
echo "<th>Динамика</th>";
echo "<th>Эффекты</th>";
echo " <th>Описание</th>";
echo "</tr></thead><tbody></b>";


$i=0;
while($i<100)
{
  $i++ ;
  $ride = findRide($i);

  echo '<tr>';
  echo '<th>'.$i.'</th>';
  echo '<th>'.$ride->getRideName().'</th>';
  echo '<th>'.$ride->getDuration().'</th>';
  echo '<th>'.$ride->getDemo().'</th>';
  echo '<th>'.$ride->getPoster60x80().'</th>';
  echo '<th>'.$ride->getPrvk.'</th>';
  echo '<th>эффекты</th>';
  echo '<th>'.$ride->getDescription().'</th>';
  echo '</tr>';
}
echo "</tbody></table>";
