<?php

$page = $_GET['page'];

switch($page){
    case create_lic:            $page = 'create_lic.php';           break;
    case create_content_txt:    $page = 'CreateContentTxt.php';     break;
    case validity:              $page = 'validity.php';             break;
    case attraction:            $page = 'attractions.php';          break;
    case rides:                 $page = 'rides.php';                break;
    case settings:              $page = 'settings.php';             break;

    case ride_card:             $page = 'card/RideCard.php';        break;
    case attr_card:             $page = 'card/AttractionCard.php';  break;
    case photostat_card:        $page = 'card/PhotoStatCard.php';   break;


    default:                    $page = 'home.php';                break;


}
require_once __DIR__."/".$page;
