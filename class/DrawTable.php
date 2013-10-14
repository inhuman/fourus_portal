<?php
//require_once __DIR__."/ImageStat.php";
require_once __DIR__."/FactoryRide.php";
require_once __DIR__."/FactoryAttraction.php";

class DrawTable {

   public $attraction;

   public static function AllRideTable()
    {

        echo '<table class="table table-bordered table-hover tbl_pointer">';
        echo "<thead style='background:#000000; color:#777777'  ><tr>";
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

            echo "<tr style='cursor: pointer;' id=tr$i href=?page=ride_card&id=$i>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ride->getRideName() . '</td>';
            echo '<td>' . $ride->getDuration() . '</td>';
            echo '<td>' . $ride->getDemo() . '</td>';
            echo '<td>' . $ride->getPoster60x80() . '</td>';
            echo '<td>' . $ride->getPrvk() . '</td>';

            echo '<td>';
            foreach($ride->getEffx() as $img){echo '<img src=' . $img[0] . ' title='.$img[1] . '> ';}
            echo '</td>';

            echo '<td>' . $ride->getDescription() . '</td>';
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

        $name = explode('.',$ride->getFileName());

        if(file_exists('img/preview/'.$name[0].'_preview.png'))
        {
            echo "<br><img src='img/preview/$name[0]_preview.png' class='img-rounded' width='300' alt='img/preview/$name[0]_preview.png'>";
        }
        else{echo "<br><img src='img/preview/default_preview.png' class='img-rounded' width='300'>";}

        echo '</div>';
        echo '<div class="span8">';
        echo '<h2>#'.$id.' '.$ride->getRideName().'</h2>';
        echo '<b>Длительность:</b> '.$ride->getDuration();
        echo '<br><b>Имя файла: </b>'.$ride->getFileName();
        echo '<br>name: '.$name[0];
        echo '<br><b>Динамика:</b> prv, prvk';
        echo '<br><b>Эффекты: </b>';
        foreach($ride->getEffx() as $img){echo '<img src=' . $img[0] . ' title=' . $img[1] . '> ';}

        echo '<br><b>Ссылка на демо:</b><button class="btn btn-small" type="button">Копировать</button>';
        echo '<br><b>Ссылка на постер:</b><button class="btn btn-small" type="button">Копировать</button>';
        echo '<br><b>Описание: </b>'.$ride->getDescription();
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

   public static function AllAttractionTable()
   {
       echo '<table class="table table-bordered table-hover tbl_pointer">';
       echo "<thead style='background:#000000; color:#777777'  ><tr>";
       echo "<th>#</th>";
       echo "<th>Город</th>";
       echo "<th>iD аттракциона</th>";
       echo "<th>Тип</th>";
       echo "<th>Вместимость</th>";
       echo "<th>Эффекты</th>";
       echo "<th>Коментарий</th>";
       echo "</tr></thead><tbody></b>";


       echo "Аттракционов в базе: ".FactoryAttraction::CountAll();

       foreach(FactoryAttraction::findAll() as $attraction)
       {
           $i = $attraction->getId();
           echo "<tr style='cursor: pointer;' id=tr$i href=?page=attr_card&id=$i>";
           echo '<td>' . $i . '</td>';
           echo '<td>' . $attraction->getTown() . '</td>';
           echo '<td>' . $attraction->getSerialId() . '</td>';
           echo '<td>' . $attraction->getMobility() . '</td>';
           echo '<td>' . $attraction->getCapacity() . '</td>';

           echo '<td>';
           foreach($attraction->getEffects() as $img){echo '<img src=' . $img[0] . ' title='.$img[1] . '> ';}
           echo '</td>';

           echo '<td>' . $attraction->getComment() . '</td>';
           echo '</tr>';
       }
       echo "</tbody></table>";
   }

   public static function AttrCardTable($id)
   {
       $attr = FactoryAttraction::findOne($id);
       $townArr = $attr->getTown();

       echo '<div class="container">';
          echo '<div class="row">';

             echo '<div class="span8"> ';
               echo '<h2>#'.$id. " ".$townArr[0].'</h2>';
             echo '</div>';

             echo '<div class="span4"> ';
               echo '<h3 align="right">'.$attr->getSerialId().'</h3>';
             echo '</div>';

          echo '</div>';
       echo '</div>';
   }

    public function ImageStatTable()
    {
       // TODO: написать  ImageStatTable()
    }

}