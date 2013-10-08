<?php
require_once('ImageStat.php');
require_once('FactoryRide.php');


class DrawTable {


    public  function RideTable()
    {

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
        while (FactoryRide::CountAllRides() > $i)
        {
            $i++ ;
            $ride = FactoryRide::findRide($i);
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$ride->getRideName().'</td>';
            echo '<td>'.$ride->getDuration().'</td>';
            echo '<td>'.$ride->getDemo().'</td>';
            echo '<td>'.$ride->getPoster60x80().'</td>';
            echo '<td>'.$ride->getPrvk().'</td>';

            echo '<td>';
            foreach($ride->getEffx() as $img){echo '<img src='.$img[0].'>';}
            echo '<td>';

            echo '<td>'.$ride->getDescription().'</td>';
            echo '</tr>';
        }
        echo "</tbody></table>";


    }

    public function ImageStatTable()
    {
       // TODO: написать  ImageStatTable()
    }

}