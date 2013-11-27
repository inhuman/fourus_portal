<?php
require_once __DIR__."/../class/DrawTable.php";


$attrId=$_GET['attrId'];

//echo "Редактирование комплектации и/или создание новой";
//echo "<br>attrId = ".$attrId;

if ($attrId == "new")
{
    $attrId = FactoryAttraction::getLastId() + 1;
}
echo $attrId;

DrawTable::AttractionEditCardTable($attrId);


