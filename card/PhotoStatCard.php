<?php
require_once __DIR__."/../class/DrawTable.php";

$id = $_GET['id'];
DrawTable::PhotostatCard($id);
?>
<script>
    $(document).ready(function(){
        $("#photostat").tablesorter( {sortList: [[0,1]]});});
</script>



<script type="text/javascript">
    $('#reservation').daterangepicker(
        {
            format: 'YYYY-MM-DD',
            ranges: {
                'Сегодня': [moment(), moment()],
                'Вчера': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Последние 7 дней': [moment().subtract('days', 6), moment()],
                'Последние 30 дней': [moment().subtract('days', 29), moment()],
                'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
                'Прошлый месяц': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            startDate: moment().subtract('days', 29),
            endDate: moment()
        },
        function(start, end) {
            $('#reservation span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );
</script>