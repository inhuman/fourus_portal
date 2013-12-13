<?php
$LicCheckerPID = `ps aux | grep LicChecker.php |  awk  '{print $2}'`;
posix_kill($LicCheckerPID,9);
