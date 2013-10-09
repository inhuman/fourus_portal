<?php



echo '<legend>Изменение описания райда #'.$id.'</legend>';

echo '<div class="container">';
  echo '<div class="row">';

    echo '<div class="span3"> ';
        echo '<form action="hWriteRideEffectsToDB.php">';
        echo '<fieldset>';
        echo '<label><b>Установить эффекты</b></label>';
        echo '<input type="checkbox"> Ветер';
        echo '<br><input type="checkbox" name="water" value="true"> Брызги';
        echo '<br><input type="checkbox" name="boobles" value="true"> Пузыри';
        echo '<br><input type="checkbox" name="lighting" value="true"> Молния';
        echo '<br><input type="checkbox" name="vibro" value="true"> Вибро';
        echo '<br><input type="checkbox" name="mouse" value="true"> Мыши';


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