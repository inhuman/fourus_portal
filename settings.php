<?php
require_once __DIR__."/class/DrawTable.php";

DrawTable::LicCreatorStatusPanel();

echo "<br><br>";
echo "<input type='button' class='btn btn-success' id='start' value='Start Task Manager'>";

echo "<br><br>";
echo "<input type='button' class='btn btn-danger' id='stop' value='Stop Task Manager'>";