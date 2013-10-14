<?php
require_once __DIR__."/../class/DrawTable.php";

$id = $_GET['id'];

DrawTable::AttrCardTable($id);
