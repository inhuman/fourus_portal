<?php
echo '<legend>Изменение описания райда #'.$id.'</legend>';

echo '<div class="container">';
  echo '<div class="row">';

    echo '<div class="span3"> ';
        echo '<form action="handler/hWriteRideEffectsToDB.php" method="post">';
        echo '<fieldset>';
        echo '<label><b>Установить эффекты</b></label>';
        echo '<img src="img/lighting.png"> <input type="checkbox" name="effect[1]" value="1"> Молния';
        echo '<br><img src="img/water.png"> <input type="checkbox" name="effect[2]" value="2"> Брызги';
        echo '<br><img src="img/vibro.png"> <input type="checkbox" name="effect[3]" value="3"> Вибро';
        echo '<br><img src="img/snow.png"> <input type="checkbox" name="effect[4]" value="4"> Снег';
        echo '<br><img src="img/wind.png"> <input type="checkbox" name="effect[5]" value="5"> Ветер';
        echo '<br><img src="img/boobles.png"> <input type="checkbox" name="effect[6]" value="6"> Пузыри';
        echo '<br><img src="img/mouse.png"> <input type="checkbox" name="effect[7]" value="7"> Мыши';
        echo "<input type='hidden' name='ride_id' value='{$id}'>";
        echo '<br><br><button type="submit" class="btn btn-success">Сохранить</button>';
        echo '</fieldset>';
        echo '</form>';

        echo '<form action="handler/hDropRideEffectsFromDB.php" method="post">';
        echo '<fieldset>';
        echo "<input type='hidden' name='ride_id' value='{$id}'>";
        echo '<button type="submit" class="btn btn-danger">Сбросить</button>';
        echo '</fieldset>';
        echo '</form>';
    echo '</div>';

    echo '<div class="span3"> ';
        echo '<label><b>Добавить превью</b></label>';
        echo '<form action="handler/hAddPreview.php" method="post" enctype="multipart/form-data">';
        echo '<input type="hidden" name="MAX_FILE_SIZE" value="300000" />';
        echo '<input name="uploadedfile" type="file" /><br />';
        echo "<input type='hidden' name='ride_id' value='{$id}'>";
        echo '<button type="submit" class="btn btn-success">Сохранить</button>';

        echo '</form>';
    echo '</div>';

    echo '<div class="span3"> ';
      echo 'Третий столбец';
    echo '</div>';

    echo '<div class="span3"> ';
      echo 'Четвертый столбец';
    echo '</div>';
  echo '</div>';
echo '</div>';