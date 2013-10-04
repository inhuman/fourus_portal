<?php
include('class/Ride.php');
include('class/PDOConfig.php');
echo "тут будет список райдов, с картинками, со всеми делами";

$ride = new Ride("2");
echo "<br>ride_name: ".$ride->getRideName();
echo "<br>adfasdfa: ".$ride->getValuesFromDB();
var_dump($ride);

?>
<table class="table table-bordered table-hover">

        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Описание</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>1</th>
            <td>Атака вирусов</td>
            <td>Это райд про атаку вирусов на организм</td>
        </tr>
        <tr>
            <th>2</th>
            <td>Тайны пирамид</td>
            <td>Это райд про тайны пирамид</td>
        </tr>
        <tr>
            <th>3</th>
            <td>Опасные джунгли</td>
            <td>Это райд про опасные джунгли</td>
        </tr>


        </tbody>

</table>