<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Bootstrap dropdown with navbar example</title>
    <link href="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <a class="brand" href="#">Fourus</a>
                   <li class="dropdown" id="accountmenu">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-list"></i> Лицензии<b class="caret"></b></a>
                   <ul class="dropdown-menu">
                     <li><a href="#">Создать</a></li>
                     <li><a href="#"><i class="icon-calendar"></i> Сроки</a></li>
                   </ul>
                </li>
                <li ><a href="#"><i class="icon-facetime-video"></i> Аттракицоны</a></li>
                <li><a href="#"><i class="icon-film"></i> Райды</a></li>
                <li><a href="#"><i class="icon-wrench"></i> Инструкции</a></li>
                <li><a href="#"><i class="icon-book"></i> Настройки</a></li>

            </ul>
            <form class="navbar-search pull-right" >
                <input type="text" class="search-query" size="10%" placeholder="Search">
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
