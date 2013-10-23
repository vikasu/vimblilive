<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
       var data = new google.visualization.DataTable();
       data.addColumn('string', 'Task');
       data.addColumn('number', 'Hours per Day');
       data.addRows([
       ['A',    roundNumber(11*Math.random(),2)],
       ['B',      roundNumber(7*Math.random(),2)]
       ]);
        var options = {
        width: 450, height: 300,
        colors:['#DCDBDB','#1560AC'],
        legend: {position: 'none'},
           animation:{
               duration: 800,
               easing: 'in'
             }
        };
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawVimChart);
function drawVimChart() {
       var data = new google.visualization.DataTable();
       data.addColumn('string', 'Task');
       data.addColumn('number', 'Hours per Day');
       data.addRows([
       ['A',    roundNumber(11*Math.random(),2)],
       ['B',      roundNumber(9*Math.random(),2)]
       ]);
        var options = {
        width: 450, height: 300,
        colors:['#FEAF00','#DCDBDB'],
        legend: {position: 'none'},
           animation:{
               duration: 800,
               easing: 'in'
             }
        };
    var chart = new google.visualization.PieChart(document.getElementById('vim_chart_div'));
    chart.draw(data, options);
}

function roundNumber(num, dec) {
 var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
 return result;
}
</script>
<h3>cadence</h3>
<section class=switchbtn>
    <a href="#">Today</a>
    <a href="#" class="darkfnt">Week</a>
</section>
<!--Last Week Report Starts-->
<section class=lstwek-rprt>
     <ul class="obsrvatn cadnc">
         <h4>Actual Activity to Ideal</h4>
         <li class="charimgarea lftchrt">
            <div id="chart_div" style="z-index: 1; position: absolute; left: 0px; top: 20px;"></div>
            <div id="circle_div" style="z-index: 2; position: absolute; left: 180px; top: 127px;">
            <img src="<?php echo SITE_URL ?>img/circle.png"></div>
         </li>
     </ul>
</section>
<!--Last Week Report End-->
<!--Next Week Report Starts-->
<section class=lstwek-rprt>
     <ul class="obsrvatn cadnc">
         <h4>Satisfaction</h4>
         <li class=charimgarea>
            <div id="vim_chart_div" style="z-index: 1; position: absolute; left: 0px; top: 0px;"></div>
            <div id="circle_div" style="z-index: 2; position: absolute; left: 180px; top: 105px;">
            <img src="<?php echo SITE_URL ?>img/circle.png"></div>
         </li>
     </ul>
</section>
<!--Next Week Report End-->