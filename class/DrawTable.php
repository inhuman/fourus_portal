<?php
require_once __DIR__."/FactoryPhotostat.php";
require_once __DIR__."/FactoryRide.php";
require_once __DIR__."/FactoryAttraction.php";
require_once __DIR__."/FactoryLic.php";

class DrawTable {

   public $attraction;

   public static function AllRideTable()
    {

        echo '<table class="table table-bordered table-hover tbl_pointer">';
        echo "<thead style='background:#000000; color:#777777'  ><tr>";
        echo "<th>#</th>";
        echo "<th>Название</th>";
        echo "<th>Имя файла</th>";
        echo "<th>Время</th>";
        echo "<th>Демо</th>";
        echo "<th>Постер</th>";
        echo "<th>Динамика</th>";
        echo "<th>Эффекты</th>";

        echo "</tr></thead><tbody></b>";

        $i=0;
        while (FactoryRide::CountAllRides() > $i)
        {
            $i++ ;
            $ride = FactoryRide::findRide($i);

            echo "<tr style='cursor: pointer;' id=tr$i href=?page=ride_card&id=$i>";
            echo '<td>' . $i . '</td>';
            echo '<td>' . $ride->getRideName() . '</a></td>';
            echo '<td>' . $ride->getFileName() . '</a></td>';
            echo '<td>' . $ride->getDuration() . '</td>';
            echo '<td>' . $ride->getDemo() . '</td>';
            echo '<td>' . $ride->getPoster60x80() . '</td>';
            echo '<td>' . $ride->getPrvk() . '</td>';

            echo '<td>';
            foreach($ride->getEffx() as $img){echo '<img src=' . $img[0] . ' title='.$img[1] . '> ';}
            echo '</td>';


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
           echo '<td>' . $attraction->getTown()     . '</td>';
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
       $townHistoryArr = $attr->getTownHistory();

       echo '<div class="container">';
          echo '<div class="row">';

             echo '<div class="span8"> ';
               if($attr->getModem() == 2)
               {
                   echo '<h2>#'.$id. " ".$attr->getTown().' </h2><a href="?page=photostat_card&id='.$id.'"><img src="img/modem.png" width="20"></a> ';
               }
               else{ echo '<h2>#'.$id. " ".$attr->getTown().'</h2>';}
             echo '</div>';
             echo '<div class="span4"> ';
               echo '<h3 align="right">'.$attr->getSerialId().'</h3>';
               echo '<label align="right">'.$attr->getComment().'</label>';
             /*
               if($townHistoryArr){
                    echo '<br><b>История перемещений</b>';
                    foreach($townHistoryArr as $i)
                    {
                       echo '<br>' .' '. $i[0] .' '. $i[1];
                    }
               }
             */
             echo '</div>';
          echo '</div>';
       echo '</div>';
       echo '<div class="container">';
         echo '<div class="row">';
           echo '<div class="span5"> ';
             $licArr = FactoryLic::findOne($id);
             echo '<table class="table">';
             echo "<thead ><tr>";
             echo "<th>#</th>";
             echo "<th>Название райда</th>";
             echo "<th>Дата</th>";
             echo "</tr></thead><tbody></b>";
             $i=0;
             foreach($licArr as $lic)
             {
                echo '<tr>';
                echo '<td>' . ++$i . '</td>';
                echo '<td>' . $lic->getOfficialName() . '</td>';
                echo '<td>' . $lic->getDate() . '</td>';
                echo '</tr>';
             }
           echo '</div>';
         echo '</div>';
       echo '</div>';
   }

   public static function PhotostatCard($id)
    {
        $dateTo = $_GET['dateTo'];
        $dateFrom = $_GET['dateFrom'];
        $imgTempId = $_GET['imgTempId'];

        $attraction = FactoryAttraction::findOne($id);
        $file_names = FactoryPhotostat::findAllJpegDateRange($id, $dateFrom, $dateTo);
        $imgLocalPath = FactoryPhotostat::getTempRecordFromDB($imgTempId);

        $thisPage = "?page=photostat_card&id=$id&dateFrom=$dateFrom&dateTo=$dateTo&imgTempId=";

        $online_status_path =  '/var/www/img/stat/'.$attraction->getSerialId().' - '.$attraction->getTown() .'/status.online';
        $lastSync='';

        if(file_exists($online_status_path))
        {
          $lastSync =  '      Sync - '.date("[H:i:s][d F Y]", filemtime($online_status_path));
        }
        else
        {
            $lastSync = ' no sync';
        }

        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="span8"> ';
                     echo '<h2>#' . $id .  " " . $attraction->getTown() . '</h2>';
                echo '</div>';
                echo '<div class="span4"> ';
                    echo '<h3 align="right">' . $attraction->getSerialId() . '</h3>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="span8"> ';

                     echo '<form class="form-horizontal form-inline" method="post" action="../portal/handler/DateRangeFilter.php">';
                        echo '<fieldset>';
                            echo '<div class="control-group">';
                                    echo '<div class="input-prepend">';
                                        echo "<span class='add-on'><i class='icon-calendar'></i></span><input type='text' placeholder='Выберите диапазон' name='reservation' id='reservation' value='$dateFrom - $dateTo'/>";
                                        echo "<input type='hidden' name='id' value='$id'>";
                                        echo '<button type="submit" class="btn">Фильтр</button>';
                                    echo '</div>';
                                    echo $lastSync;
                            echo '</div>';
                        echo '</fieldset>';
                     echo '</form>';
                    echo '<table id="photostat" class="table table-bordered table-hover tbl_pointer table-condensed">';
                        echo "<thead><tr>";
                        echo "<th>#</th>";
                        echo "<th>Название</th>";
                        echo "<th>Дата</th>";
                        echo "<th>Время</th>";
                        echo "<th>Люди</th>";
                    echo "</tr></thead><tbody></b>";

                    $i=0;
                    foreach($file_names as $file)
                    {
                        $i++;
                        if ($i==$imgTempId)
                        {
                           echo '<tr class="warning" id=tr'.$i.' href=' . $thisPage . $i .' >';
                        }
                        else
                        {
                           echo '<tr id=tr'.$i.' href=' . $thisPage . $i .' >';
                        }

                        echo '<td>' . $i . '</td>';
                        echo '<td>' . $file->getRideName() . '</td>';
                        echo '<td>' . $file->getDate() . '</td>';
                        echo '<td>' . $file->getTime() . '</td>';
                        echo '<td>' . $file->getCunt() . '</td>';
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                echo '</div>';
                echo '<div class="span4"> ';


                echo ' <form method="post" action="../portal/handler/setCunt.php">';
                  echo "<input type='text' name='people' autofocus='autofocus'>";
                  echo  ' <b>#'.$imgTempId.'</b>';
                  echo "<img src=$imgLocalPath class='img-polaroid' height='864' width='352'>";
                  echo "<input type='hidden' name='thisPage' value='$thisPage'>";
                  echo "<input type='hidden' name='imgTempId' value='$imgTempId'>";
                echo '</form>';


                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
