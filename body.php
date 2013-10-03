<?php

echo 'THIS HOME BODY !<br>';

$page = $_GET['page'];

switch($page){
    case create_lic:$page = 'create_lic.php';   break;
    case validity:  $page = 'validity.php';     break;
    case attraction:$page = 'attractions.php';  break;
    case rides:     $page = 'rides.php';        break;
    case manuals:   $page = 'manuals.php';      break;
    case settings:  $page = 'settings.php';     break;

}
echo "U choose ".$page.'<br>';
include ($page);