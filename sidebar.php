<!DOCTYPE html>
<html lang="ru">
<html>
<head>
    <script src='js/count_rabbits.js'></script>



</head>
<body>
<?php

echo '<br><a href="index.php?page=create_lic.php"><button class="btn btn-info btn-block" type="button" onclick="count_rabbits()"><i class="icon-list"></i><b>  Лицензии</b></button></a>';
echo '<br><a href="attractions"><button class="btn btn-info btn-block " type="button"><i class="icon-facetime-video"></i><b> Аттракционы</b></button></a>';

echo '<br><a href="index.php?page=rides.php"><button class="btn btn-info btn-block" type="button"><i class="icon-film"></i><b> Райды</b></button></a>';
echo '<br><a href="validity"><button class="btn btn-info btn-block" type="button"><i class="icon-calendar"></i><b> Сроки</b></button></a>';


echo '<br><a href="setings"><button class="btn btn-info btn-block" type="button"><i class="icon-wrench"></i><b> Настройки</b></button></a>';
echo '<br><a href="wiki"><button class="btn btn-info btn-block" type="button"><i class="icon-book"></i><b> Инструкции</b></button></a>';

