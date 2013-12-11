<?php
require_once __DIR__."/class/DrawTable.php";

DrawTable::LicCreatorStatusPanel();

echo "<br><br>";
echo "<input type='button' class='btn btn-success' id='startTaskManager' value='Start Task Manager'>";

echo "<br><br>";
echo "<input type='button' class='btn btn-danger' id='stopTaskManager' value='Stop Task Manager'>";

echo "<br><br>";
echo "<input type='button' class='btn btn-danger' id='restartVM' value='Restart VM'>";
