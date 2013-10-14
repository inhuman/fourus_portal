<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Bootstrap dropdown with navbar example</title>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <a class="brand" href="/portal/">Fourus</a>
                   <li class="dropdown" id="licmenu">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-list"></i> Лицензии<b class="caret"></b></a>
                     <ul class="dropdown-menu">
                       <li><a href="?page=create_lic"><i class="icon-file"></i>Создать</a></li>
                       <li><a href="?page=validity"><i class="icon-calendar"></i> Сроки</a></li>
                    </ul>
                   </li>
                <li ><a href="?page=attraction"><i class="icon-facetime-video"></i> Аттракционы</a></li>
                <li><a href="?page=rides"><i class="icon-film"></i> Райды</a></li>
                <li><a href="?page=manuals"><i class="icon-book"></i> Инструкции</a></li>



                <li class="dropdown" id="settingsmenu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-wrench"></i> Настройки<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="?page=ride_card">Карточка райда</a></li>
                        <li><a href="?page=attr_card">Карточка аттракциона</a></li>
                    </ul>
                </li>

            </ul>
            <form class="navbar-search pull-right" >
                <input type="text" class="search-query" placeholder="Search">
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>
</body>
</html>
