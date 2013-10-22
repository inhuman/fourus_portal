<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<html lang="ru">
<html>
<head>
    <title>Fourus portal</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/daterangepicker.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>

    <script type="text/javascript" src="js/test.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/daterangepicker-bs2.css" />
    <link rel="stylesheet" type="text/css" href="css/own.css" />

    <script>
        $(document).ready(function(){
            $('table tr').click(function(){
                window.location = $(this).attr('href');
                return false;
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
</head>
<body>

<div class="container">

 <?
   require_once __DIR__."/top.php" ;
   require_once __DIR__."/body.php";
   require_once __DIR__."/bottom.php";
 ?>
</div>

</body>

