<?php
require_once __DIR__."/../class/DrawTable.php";


$attrId=$_GET['attrId'];

//echo "Редактирование комплектации и/или создание новой";
//echo "<br>attrId = ".$attrId;

if ($attrId == "new")
{
    DrawTable::AttractionAddNewCardTable();
}
else
{
    DrawTable::AttractionEditCardTable($attrId);
}





