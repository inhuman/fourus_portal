<?php
//$TaskManagerPID = `ps -eo pid,comm | grep LicCreatorCron.php | awk  '{print $1}'`;

$TaskManagerPID = `ps aux | grep LicCreatorCron.php |  awk  '{print $2}'`;
posix_kill($TaskManagerPID,9);

