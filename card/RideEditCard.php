<?php



echo '<legend>Изменение описания райда #'.$id.'</legend>';

echo '<div class="container">';
  echo '<div class="row">';

    echo '<div class="span3"> ';
        echo '<form action="handler/hWriteRideEffectsToDB.php">';
        echo '<fieldset>';
        echo '<label><b>Установить эффекты</b></label>';
        echo '<img src="img/wind.png"> <input type="checkbox"> Ветер';
        echo '<br><img src="img/water.png"> <input type="checkbox" name="water" value="true"> Брызги';
        echo '<br><img src="img/boobles.png"> <input type="checkbox" name="boobles" value="true"> Пузыри';
        echo '<br><img src="img/lighting.png"> <input type="checkbox" name="lighting" value="true"> Молния';
        echo '<br><img src="img/vibro.png"> <input type="checkbox" name="vibro" value="true"> Вибро';
        echo '<br><img src="img/mouse.png"> <input type="checkbox" name="mouse" value="true"> Мыши';


        echo '<br><br><button type="submit" class="btn">Сохранить</button>';
        echo '</fieldset>';
        echo '</form>';
    echo '</div>';

    echo '<div class="span3"> ';
      echo 'Второй столбец';
    echo '</div>';

    echo '<div class="span3"> ';
      echo 'Третий столбец';
    echo '</div>';

    echo '<div class="span3"> ';
      echo 'Четвертый столбец';
    echo '</div>';
  echo '</div>';
echo '</div>';