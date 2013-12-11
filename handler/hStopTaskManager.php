<?php
$TaskManagerPID = `ps -eo pid,comm | grep php5 | awk  '{print $1}'`;
echo $TaskManagerPID;
var_dump(posix_kill($TaskManagerPID,9));