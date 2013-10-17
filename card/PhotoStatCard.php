<?php
require_once __DIR__."/../class/DrawTable.php";

$id = $_GET['id'];
DrawTable::PhotostatCard($id);
?>
<script>
    $(document).ready(function(){
        $("#photostat").tablesorter();});
</script>