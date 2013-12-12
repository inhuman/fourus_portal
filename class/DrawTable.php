<?php
require_once __DIR__."/FactoryPhotostat.php";
require_once __DIR__."/FactoryRide.php";
require_once __DIR__."/FactoryAttraction.php";
require_once __DIR__."/FactoryLic.php";
require_once __DIR__."/../app/LicCreator/TaskManager.php";


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
       echo "<th>Factory iD #</th>";
       echo "<th>Город</th>";
       echo "<th>serial iD аттракциона</th>";
       echo "<th>Тип</th>";
       echo "<th>Вместимость</th>";
       echo "<th>Эффекты</th>";
       echo "<th>Коментарий</th>";
       echo "</tr></thead><tbody></b>";

       echo '<a href="?page=attr_edit&attrId=new" class="btn btn-inverse btn-mini" title="Добавить" type="button"><h7>+</h7></a>';
       echo " Аттракционов в базе: ".FactoryAttraction::CountAll();

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
       $FullComplect = FactoryAttraction::findAttractionFullComplect($id);
       $townHistoryArr = $attr->getTownHistory();

       $terminalHardwareArr = array(
           array("Case","Корпус"),
           array("Motherboard","Материнская плата"),
           array("PowerUnit","Блок питания"),
           array("CPU","Процессор"),
           array("CoolingSystem","Система охлаждения"),
           array("RAM","Оперативная память"),
           array("HDD","Жесткий диск"),
           array("VideoCapture","Видеозахват"),
           array("Camera","Камера"));

       $playerHardwareArr = array(
           array("Case","Корпус"),
           array("Motherboard","Материнская плата"),
           array("PowerUnit","Блок питания"),
           array("CPU","Процессор"),
           array("CoolingSystem","Система охлаждения"),
           array("RAM","Оперативная память"),
           array("HDD","Жесткий диск"),
           array("MOXA","МОХА"),
           array("PCICOM","PCI-COM controller"),
           array("licController","Контроллер лицензий"),
           array("Projector1","Проектор 1"),
           array("Projector2","Проектор 2"),
           array("VideoCard","Видеокарта"),
           array("EffectBlock","Блок эффектов"));

       $dynamicModuleArr = array(
           array("MotorModel","Модель мотора"),
           array("PlugType","Тип вилки"),
           array("BearingType","Тип опоры"),
           array("SensorType","Тип датчиков"),
           array("ArmLenght","Длина рычага"),
           array("LinkageLenght","Длина тяги"));


       self::AttrActionPanel($id);

       // echo '<label align="right">'.$attr->getComment().'</label>';
       /*
               if($townHistoryArr){
                    echo '<br><b>История перемещений</b>';
                    foreach($townHistoryArr as $i)
                    {
                       echo '<br>' .' '. $i[0] .' '. $i[1];
                    }
               }
             */

       echo '<div class="container">';
         echo '<div class="row">';
            echo '<div class="span3"> ';
              echo '</div>';
                 echo '<div class="span6"> ';
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
            echo '<div class="span3"> ';
         echo '</div>';
       echo '</div>';

       echo '<div class="container">';
           echo '<div class="row">';
               echo '<div class="span3"> ';
                   echo '</div>';
                   echo '<div class="span6"> ';
                   echo '<table class="table">';
                   echo "<thead ><tr>";
                   echo "<th>Player</th>";
                   echo "<th> </th>";
                   echo "</tr></thead><tbody></b>";

                   foreach($playerHardwareArr as $hardware)
                   {
                      echo '<tr>';
                      echo "<td>$hardware[1]</td>";
                      $getter = 'getPlayer'.$hardware[0];
                      echo '<td>'. $FullComplect[2]->$getter() .'</td>';
                      echo '</tr>';
                   }
                   echo '</tbody></table>';

       echo '<table class="table">';
       echo "<thead ><tr>";
       echo "<th>Terminal</th>";
       echo "<th> </th>";
       echo "</tr></thead><tbody></b>";



       foreach($terminalHardwareArr as $hardware)
       {
           echo '<tr>';
           echo "<td>$hardware[1]</td>";
           $getter = 'getTerminal'.$hardware[0];
           echo '<td>'. $FullComplect[3]->$getter() .'</td>';
           echo '</tr>';

       }

       echo '</tbody></table>';


       echo '<table class="table">';
       echo "<thead ><tr>";
       echo "<th>Dynamic Module</th>";
       echo "<th> </th>";
       echo "</tr></thead><tbody></b>";



       foreach($dynamicModuleArr  as $hardware)
       {
           echo '<tr>';
           echo "<td>$hardware[1]</td>";
           $getter = 'getDynamicModule'.$hardware[0];
           echo '<td>'. $FullComplect[4]->$getter() .'</td>';
           echo '</tr>';

       }



       echo '<div class="span3"> ';
       echo '</div>';
       echo '</div>';
       echo '</div>';
       echo '</div>';
   }

   public static function AttrActionPanel($id)
   {
       echo '<div class="container">';
            echo '<div class="row">';

                 echo '<div class="span4"> ';
                     $attr = FactoryAttraction::findOne($id);


                     echo '<h2>#'.$id. " ".$attr->getTown().' </h2></a>' ;
                 echo '</div>';

                 echo '<div class="span4"> ';
                    echo "<div class='btn-group'>";
                        echo "<br>";
                        echo ' <a href="?page=attr_card&id='.$id.'" class="btn btn-info btn-mini" title="Сводная информация"><i class="icon-home"></i></a>';

                        echo "<a href='?page=create_lic&attr_id=$id' class='btn btn-info btn-mini' title='Cделать лицензии' ><b>Cоздать лицензии</b></a>";
                        echo '<a href="?page=attr_edit&attrId='.$id.'" class="btn btn-inverse btn-mini" title="Редактировать комплектацию" ><b>Редактировать</b></a>';

                        if($attr->getModem() == 2){
                            echo '<a href="?page=photostat_card&id='.$id.'" class="btn btn-success btn-mini" title="Фотостатистика"><img src="img/modem.png" width="18"><b>Статистика</b></a> ';
                        }
                        else{echo '<a class="btn btn-success btn-mini disabled" title="Фотостатистика"><img src="img/modem.png" width="18">Контроль</a> ';}
                    echo "</div>";
                echo '</div>';

                echo '<div class="span4"> ';
                   echo '<h3 align="right">' . $attr->getSerialId() . '</h3>';
                echo '</div>';


            echo '</div>';
       echo '</div>';

   }

   public static function AttractionEditCardTable($attrId)
   {
       self::AttrActionPanel($attrId);

       echo '<div class="control-group">';
       echo '<label class="control-label" for="inputAttrSerialId">Serial iD аттракциона</label>';
       echo '<div class="controls">';
       echo '<input type="text" id="inputAttrSerialId" name="inputAttrSerialId" placeholder="Serial iD аттракциона">';
       echo '</div>';
       echo '</div>';

   }

    public static function AttractionAddNewCardTable()
    {
        $newId = FactoryAttraction::getLastId() + 1;
        echo "<h2>Добавление новой комплектации - Factory iD #$newId</h2>";
        echo "<h3>Основная информация</h3>";

        echo '<form class="form-horizontal" method="post" action="/portal/handler/hAttractionAddNew.php">';
            echo '<div class="control-group">';
                echo '<label class="control-label" for="inputAttrSerialId">Serial iD аттракциона</label>';
                echo '<div class="controls">';
                    echo '<input type="text" id="inputAttrSerialId" name="inputAttrSerialId" placeholder="Serial iD аттракциона">';
                echo '</div>';
            echo '</div>';

            echo '<div class="control-group">';
                echo '<label class="control-label" for="inputTownName">Город</label>';
                echo '<div class="controls">';
                    echo '<input type="text" id="inputTownName" name="inputTownName" placeholder="Город">';
                echo '</div>';
            echo '</div>';


             echo '<div class="control-group">';
                echo '<label class="control-label" for="inputType">Тип</label>';
                echo '<div class="controls">';
                    echo '<select id="inputType" name="inputType">';
                        echo '<option value="0"></option>';
                        echo '<option value="mobile">Мобильный</option>';
                        echo '<option value="stationary">Стационарный</option>';
                        echo '<option value="stationaryTurned">Стационарный поворотка</option>';
                    echo '</select>';
                echo '</div>';
             echo '</div>';

        echo '<div class="control-group">';
        echo '<label class="control-label" for="inputComment">Коментарий</label>';
        echo '<div class="controls">';
        echo '<textarea rows="3"  id="inputComment" name="inputComment"></textarea>';
        echo '</div>';
        echo '</div>';

             echo "<h3>Комплектация</h3>";

             echo "<h4>Player</h4>";

             $playerHardwareArr = array(
                 array("Case","Корпус"),
                 array("Motherboard","Материнская плата"),
                 array("PowerUnit","Блок питания"),
                 array("CPU","Процессор"),
                 array("CoolingSystem","Система охлаждения"),
                 array("RAM","Оперативная память"),
                 array("HDD","Жесткий диск"),
                 array("MOXA","МОХА"),
                 array("PCICOM","PCI-COM controller"),
                 array("licController","Контроллер лицензий"),
                 array("Projector1","Проектор 1"),
                 array("Projector2","Проектор 2"),
                 array("VideoCard","Видеокарта"),
                 array("EffectBlock","Блок эффектов"));

             $terminalHardwareArr = array(
                 array("Case","Корпус"),
                 array("Motherboard","Материнская плата"),
                 array("PowerUnit","Блок питания"),
                 array("CPU","Процессор"),
                 array("CoolingSystem","Система охлаждения"),
                 array("RAM","Оперативная память"),
                 array("HDD","Жесткий диск"),
                 array("VideoCapture","Видеозахват"),
                 array("Camera","Камера"));


             foreach($playerHardwareArr as $hardware)
             {
                 echo '<div class="control-group">';
                 echo '<label class="control-label" for="inputPlayer'.$hardware[0].'">'.$hardware[1].'</label>';
                 echo '<div class="controls">';
                 echo '<input id="inputPlayer'.$hardware[0].'" name="inputPlayer'.$hardware[0].'">';
                 echo '</div>';
                 echo '</div>';
             }

             echo '<div class="control-group">';
                echo '<div class="controls">';
                    echo '<label class="checkbox" ><img src="../portal/img/lighting.png" /><input type="checkbox" id="lighting" name="lighting"> Молния</label>';
                    echo '<label class="checkbox"><img src="../portal/img/water.png"  /><input type="checkbox" name="water"> Брызги</label>';
                    echo '<label class="checkbox"><img src="../portal/img/vibro.png" /><input type="checkbox" name="vibro"> Вибрация</label>';
                    echo '<label class="checkbox"><img src="../portal/img/snow.png" /><input type="checkbox" name="snow"> Снег</label>';
                    echo '<label class="checkbox"><img src="../portal/img/wind.png" /><input type="checkbox" name="wind"> Ветер</label>';
                    echo '<label class="checkbox"><img src="../portal/img/boobles.png" /><input type="checkbox" name="bubbles"> Пузыри</label>';
                    echo '<label class="checkbox"><img src="../portal/img/mouse.png" /><input type="checkbox" name="rats"> Мышиные хвосты</label>';
                echo '</div>';
             echo '</div>';


         echo "<h4>Terminal</h4>";
        foreach($terminalHardwareArr as $hardware)
        {
            echo '<div class="control-group">';
            echo '<label class="control-label" for="inputTerminal'.$hardware[0].'">'.$hardware[1].'</label>';
            echo '<div class="controls">';
            echo '<input id="inputTerminal'.$hardware[0].'" name="inputTerminal'.$hardware[0].'">';
            echo '</div>';
            echo '</div>';

        }





        echo "<h3>Динамический модуль</h3>";


        echo '<div class="control-group">';
        echo '<label class="control-label" for="inputCapacity">Вместимость</label>';
        echo '<div class="controls">';
        echo '<select id="inputCapacity" name="inputCapacity">';
        echo '<option value="0"></option>';
        echo '<option value="3">3</option>';
        echo '<option value="5">5</option>';
        echo '<option value="6">6</option>';
        echo '<option value="7">7</option>';
        echo '</select>';
        echo '</div>';
        echo '</div>';


        echo '<div class="control-group">';
        echo '<label class="control-label" for="inputPlatformType">Тип платформы</label>';
        echo '<div class="controls">';
        echo '<select id="inputPlatformType" name="inputPlatformType">';
        echo '<option value="0"></option>';
        echo '<option value="hydraulic">Гидравлическая</option>';
        echo '<option value="electric2">Электрическая 2 мотора</option>';
        echo '<option value="electric3">Электрическая 3 мотора</option>';
        echo '</select>';
        echo '</div>';
        echo '</div>';


        //TODO: динамический модуль: модель мотора, тип вилки, тип опоры, тип датчиков, длина рычага, длина тяги,


        $dynamicModuleArr = array(
            array("MotorModel","Модель мотора"),
            array("PlugType","Тип вилки"),
            array("BearingType","Тип опоры"),
            array("SensorType","Тип датчиков"),
            array("ArmLenght","Длина рычага"),
            array("LinkageLenght","Длина тяги"));

        foreach($dynamicModuleArr as $hardware)
        {
            echo '<div class="control-group">';
            echo '<label class="control-label" for="inputDynamicModule'.$hardware[0].'">'.$hardware[1].'</label>';
            echo '<div class="controls">';
            echo '<input id="inputDynamicModule'.$hardware[0].'" name="inputDynamicModule'.$hardware[0].'">';
            echo '</div>';
            echo '</div>';

        }


        echo '<button type="submit" class="btn btn-primary">Создать комплектацию</button>';
        echo '</div>';
        echo '</div>';
        echo '</form>';


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

        self::AttrActionPanel($id);

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

   public static function LicCreateCard()
   {
       $attr_id = $_GET['attr_id'];
       self::AttrActionPanel($attr_id);
       echo "<form class='form-horizontal' method='post' action='/portal/handler/hCreateBluePrints.php'>";
         echo "<div class='control-group'>";
           echo "<label class='control-label' for='inputAttrID'>Attraction ID</label>";
             echo "<div class='controls'>";
               echo "<select name='inputAttrID' id='inputAttrID'>";
                  if($attr_id)
                  {
                    $attraction = FactoryAttraction::findOne($attr_id);
                    echo '<option value='.$attraction->getId().'>'.$attraction->getSerialId().'</option>';
                  }
                  else{echo '<option value="none">none</option>';}

                 echo '<option value="none">none</option>';
                 foreach(FactoryAttraction::findAll() as $attraction)
                 {
                   echo '<option value='.$attraction->getId().'>'.$attraction->getSerialId().'</option>' ;
                 }
               echo "</select>";
               echo "<select id='inputTownName'>";
                 if($attr_id)
                 {
                     $attraction = FactoryAttraction::findOne($attr_id);
                     echo '<option value='.$attraction->getId().'>'.$attraction->getTown().'</option>';
                 }
                 else{echo '<option value="none">none</option>';}

                 foreach(FactoryAttraction::findAll() as $attraction)
                 {
                   echo '<option value='.$attraction->getId().'>'.$attraction->getTown().'</option>' ;
                 }
               echo "</select>";
               echo "  Town Name";
             echo "</div>";
           echo "</div>";
           $i=0;
           while($i < 20)
           {
             $i++;
             echo "<div class='control-group'>";
               echo "<label class='control-label' for='inputLic[$i]'>License $i</label>";
               echo "<div class='controls'>";
                  echo "<select name='inputLic[$i]' id='inputLic[$i]'>";
                    echo '<option value="none">none</option>';
                    $ii=0;
                    while (FactoryRide::CountAllRides() > $ii)
                    {
                      $ii++ ;
                      $ride = FactoryRide::findRide($ii);
                      echo '<option value='.$ride->getId().'>'.$ride->getRideName().'</option>' ;
                    }
                  echo "</select>";
                  echo "<input type='date' name='inputLicDate[$i]' id='inputLicDate[$i]' >";
                  echo "<input class='input-mini' type='number' value='80' name='volume[$i]' id='volume[$i]' min='1' max='100' />";

                  echo "<input type='checkbox' checked='checked' name='LicOnly[$i]' id='LicOnly[$i]' value='1'> License only";
               echo "</div>";
             echo "</div>";
           }
           echo "<button type='submit' class='btn btn-block btn-primary'>Создать лицензии</button>";

         echo "</div>";
       echo "</form>";

   }

   public static function LicQueueCard()
   {

       //$r = new TaskManager();

       self::LicCreatorStatusPanel();

       echo '<table class="table table-bordered table-hover tbl_pointer">';
       echo "<thead style='background:#000000; color:#777777'  ><tr>";
       echo "<th>#</th>";
       echo "<th>Город</th>";
       echo "<th>Имя райда</th>";
       echo "<th>Дата</th>";
       echo "<th>Только лицензия?</th>";
       echo "<th>Статус</th>";
       echo "<th>Расположение</th>";
       echo "</tr></thead><tbody></b>";


       foreach(TaskManager::getDBDataQueueLicBlueprints() as $LicBlueprint)
       {

           $ride = FactoryRide::findRide($LicBlueprint[2]);
           $attr = FactoryAttraction::findOne($LicBlueprint[1]);

           echo "<tr>";
           echo '<td>' . $LicBlueprint[0] . '</td>';
           echo '<td>' . $attr->getTown() . '</td>';
           echo '<td>' . $ride->getRideName() . '</td>';
           echo '<td>' . $LicBlueprint[4] . '</td>';
           echo '<td>' . $LicBlueprint[5] . '</td>';
           echo '<td>' . $LicBlueprint[6] . '</td>';
           echo '<td>' . $LicBlueprint[7] . '</td>';



           echo '</tr>';
       }


       echo "</tbody></table>";
   }

   public static function LicCreatorStatusPanel()
   {
       $rawPsDataArr = `ps aux | grep LicCreatorCron.php`;
       $PsData = explode('php5',$rawPsDataArr);
       if ($PsData[1] == '')
       {
           echo '<span class="label label-important"><b>Task Manager: OFFLINE</b></span>';
       }
       else{echo '<span class="label label-success"><b>Task Manager: ONLINE</b></span>';}


       $rawPsDataArr = `ps aux | grep LicChecker.php`;
       $PsData = explode('php5',$rawPsDataArr);
       if ($PsData[1] == '')
       {
           echo '<span class="label label-important"><b>Lic Checker: OFFLINE</b></span>';
       }
       else{echo '<span class="label label-success"><b>Lic Checker: ONLINE</b></span>';}





       $CoreVMStatus = TaskManager::pingDomain('192.168.0.211');
       if($CoreVMStatus == 'online')
       {
           echo '<span class="label label-success"><b>Core VM: ONLINE</b></span>';
       }
       elseif($CoreVMStatus == 'offline')
       {
           echo '<span class="label label-important"><b>Core VM: OFFLINE</b></span>';
       }


       $dbh = new PDOConfig();
       $stmt = $dbh->prepare("SELECT Status FROM Transport WHERE Subject='Core'");
       $stmt->execute();
       $status = $stmt->fetch();
       $stmt->closeCursor();
       $CoreStatus = $status[0];

       switch($CoreStatus)
       {
           case 'ready':
               echo '<span class="label label-success"><b>Core: READY</b></span>'; break;

           case 'busy':
               echo '<span class="label label-warning"><b>Core: BUSY</b></span>'; break;

           case 'unknown':
               echo '<span class="label label-important"><b>Core: UNKNOWN</b></span>'; break;


       }





   }

   public static function ContentTxtCreateCard()
   {
       $linkEnable = $_GET['link'];
       if($linkEnable == 'yes'){$link = '<a href="/portal/temp/content.txt">content.txt</a>';}
       else {$link='';}

       echo "Создание content.txt <b>(заставка и тест проекторов уже включены!)</b> ".$link;
       echo "<form class='form-horizontal' method='post' action='/portal/handler/hCreateContentTxt.php'>";

       $i=0;
       while($i < 20)
       {
           $i++;
           echo "<div class='control-group'>";
           echo "<label class='control-label' for='inputLic[$i]'>Ride #$i</label>";
           echo "<div class='controls'>";
           echo "<select name='inputRide[$i]' id='inputRide[$i]'>";
           echo '<option value="none">none</option>';
           $ii=0;
           while (FactoryRide::CountAllRides() > $ii)
           {
               $ii++ ;
               $ride = FactoryRide::findRide($ii);
               echo '<option value='.$ride->getId().'>'.$ride->getRideName().'</option>' ;
           }
           echo "</select>";
           echo "<input class='input-mini' type='number' value='80' name='volume[$i]' id='volume[$i]' min='1' max='100' />";


           echo "</div>";
           echo "</div>";
       }
       echo "<button type='submit' class='btn btn-block btn-primary'>Создать content.txt</button>";

       echo "</form>";
   }
}
