<?php
if($_SESSION['role']==1){
?>
<div class="chartselect">
Search visits per: <select name="visittype" id="visittype" onchange='ChartUpdate(this);'>
    <option value="year">Year</option>
    <option value="month">Month</option>
    <option value="week" selected>Week</option>
    <option value="day">Day</option>
</select>
</div>
<div class="clear"></div>
<div class="chartwidth" id='canvasParent'>
    <canvas id="myChart" width="800" height="600"></canvas>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js'></script>
<script src='js/chart.js'></script>
<?php
}
?>