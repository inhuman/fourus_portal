<?php
require_once __DIR__."/../class/DrawTable.php";

$id = $_GET['id'];
DrawTable::RideCardTable($id);
require_once __DIR__."/RideEditCard.php";