<?php
//require_once __DIR__."/ImageStat.php";
require_once __DIR__."/FactoryRide.php";


class DrawTable {


   public static function AllRideTable()
    {

        echo '<table class="table table-bordered table-hover">';
        echo "<thead style='background:#000000; color:#777777'><tr>";
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

            //echo "<tr id=tr$i href=?page=ride_card&id=$i>";
            echo "<tr>";
            echo '<td>'.$i.'</td>';
            echo '<td><a href=?page=ride_card&id='.$i.'>'.$ride->getRideName().'</a></td>';
            echo '<td>'.$ride->getDuration().'</td>';
            echo '<td>'.$ride->getDemo().'</td>';
            echo '<td>'.$ride->getPoster60x80().'</td>';
            echo '<td>'.$ride->getPrvk().'</td>';

            echo '<td>';
            foreach($ride->getEffx() as $img){echo '<img src='.$img[0].'> ';}
            echo '</td>';

            echo '<td>'.$ride->getDescription().'</td>';
            echo '</tr>';
        }
        echo "</tbody></table>";

    }

   public static function RideCardTable($id)
    {
        $ride = FactoryRide::findRide($id);

        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="span4"> ';
        echo '<br><img src="img/preview/Virus_attack.jpg" class="img-rounded" width="300"></div>';
        echo '<div class="span8">';
        echo '<h2>#'.$id.' '.$ride->getRideName().'</h2>';
        echo '<b>Длительность:</b> '.$ride->getDuration();
        echo '<br><b>Динамика:</b> prv, prvk';
        echo '<br><b>Эффекты: </b>';
        foreach($ride->getEffx() as $img){echo '<img src='.$img[0].'> ';}

        echo '<br><b>Ссылка на демо:</b><button class="btn btn-small" type="button">Копировать</button>';
        echo '<br><b>Ссылка на постер:</b><button class="btn btn-small" type="button">Копировать</button>';
        echo '<br><b>Описание: </b>'.$ride->getDescription();
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function ImageStatTable()
    {
       // TODO: написать  ImageStatTable()
    }

}