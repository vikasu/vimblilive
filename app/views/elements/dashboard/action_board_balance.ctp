<?php
//echo '<pre>'; print_r($sheduledDayAvgNxtWeekArr);
//echo '<pre>'; print_r($sheduledDayLastWeekArr);
//echo '===============';
//die;
 if($_SESSION["Schedule"]["day_hrs"] == 'work'){
    $totalDayForAvg = $totalDayForAvg;
    
    //Refine arrays if day is not scheduled then put 0 in the day.
    foreach($sheduledDayAvgNxtWeekArr as $keyN=>$valN){
        if((in_array($keyN,$allSchDaysArr) == false) OR ($valN < 0)){
            $sheduledDayAvgNxtWeekArr[$keyN] = 0;
        }
    }
    
    foreach($sheduledDayLastWeekArr as $keyL=>$valL){
        if((in_array($keyL,$allSchDaysArr) == false) OR ($valL < 0)){
            $sheduledDayLastWeekArr[$keyL] = 0;
        }
    }
    //End Refined arr
    
 } else{
    $totalDayForAvg = 7;
 }
//echo '<pre>'; print_r($sheduledDayAvgNxtWeekArr);
//echo '<pre>'; print_r($sheduledDayLastWeekArr);
//die;
//die;
//echo $totalHrsNextWeek;
//echo '<br>'.$totalHrsLastWeek; die;
    
    $nextWeekAvgSc = round(($totalHrsNextWeek*100)/168); 
    $lastWeekAvgSc = round(($totalHrsLastWeek*100)/168);
    //echo '<pre>'; print_r($sheduledDayAvgNxtWeekArr);
    $nextWeekAvgSc = round(array_sum($sheduledDayAvgNxtWeekArr)/$totalDayForAvg);
    $lastWeekAvgSc = round(array_sum($sheduledDayLastWeekArr)/$totalDayForAvg);
    
    $nextWeekAvgSc = ($nextWeekAvgSc <= 100)?$nextWeekAvgSc:100; 
    $lastWeekAvgSc = ($lastWeekAvgSc <= 100)?$lastWeekAvgSc:100; 
    
?>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load('visualization', '1', {packages: ['corechart']});
        google.load('visualization', '1', {packages: ['imagepiechart']});
 
    </script>
    <script type="text/javascript">
        
      function drawBarVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
        ['Day', 'Scheduled', 'Unscheduled'],
        <?php
        if(isset($_SESSION["Schedule"]["day_hrs"]) AND $_SESSION["Schedule"]["day_hrs"] == "work"){
            if(isset($_SESSION["Schedule"]["week"]) AND $_SESSION["Schedule"]["week"] == "prev"){
            foreach($sheduledDayLastWeekArr as $lastDayKey => $lastDayVal){
            if(in_array($lastDayKey,$scheduledDays)){?>
                ['<?php echo substr($lastDayKey,0,1) ?>',  <?php echo $lastDayVal ?>,   <?php echo (100-$lastDayVal) ?>],
            <?php } else{ ?>
                ['<?php echo substr($lastDayKey,0,1) ?>',  0,   0],
                <?php }
            } } else{ 
            foreach($sheduledDayAvgNxtWeekArr as $nxtDayKey => $nxtDayVal){
            if(in_array($nxtDayKey,$scheduledDays)){?>
            ['<?php echo substr($nxtDayKey,0,1) ?>',  <?php echo $nxtDayVal ?>,   <?php echo (100-$nxtDayVal) ?>],
            <?php } else{ ?>
            ['<?php echo substr($nxtDayKey,0,1) ?>',  0,   0],
            <?php }
            } }
        }else{
            if(isset($_SESSION["Schedule"]["week"]) AND $_SESSION["Schedule"]["week"] == "prev"){
            foreach($sheduledDayLastWeekArr as $lastDayKey => $lastDayVal){ ?>
            ['<?php echo substr($lastDayKey,0,1) ?>',  <?php echo $lastDayVal ?>,   <?php echo (100-$lastDayVal) ?>],
            <?php }
            } else{
            foreach($sheduledDayAvgNxtWeekArr as $nxtDayKey => $nxtDayVal){ ?>
            ['<?php echo substr($nxtDayKey,0,1) ?>',  <?php echo $nxtDayVal ?>,   <?php echo (100-$nxtDayVal) ?>],
            <?php }
            }
        }
        ?>
        ]);
        
        var formatter = new google.visualization.NumberFormat({suffix: '%',fractionDigits: 0});
        formatter.format(data,1); // Apply formatter to second column
        formatter.format(data,2); // Apply formatter to third column
       
        // Create and draw the visualization.
        new google.visualization.ColumnChart(document.getElementById('bar-visualization')).
            draw(data,
                 {//title:"Your Performance",
                  width:380, height:200,
                  hAxis: {title: ""},
                  colors: ['#FEAF00','#1560AC'],
                  isStacked: true,
                  legend: 'none',
                  bar: {groupWidth: 25},
                  backgroundColor:'#F7F5F5',
                  vAxis:{minValue:0,maxValue:2,gridlines:{count:2},format: "#,###'%'"}
                  }
            );
      }
    google.setOnLoadCallback(drawBarVisualization);
    
    
    google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Week', 'Scheduled', 'Unscheduled'],
          ['Last Week',  <?php echo $lastWeekAvgSc ?>,     <?php echo (100-$lastWeekAvgSc) ?>],
          ['Next Week',  <?php echo $nextWeekAvgSc ?>,      <?php echo (100-$nextWeekAvgSc) ?>]
        ]);

        var formatter = new google.visualization.NumberFormat({suffix: '%',fractionDigits: 0});
        formatter.format(data,1); // Apply formatter to second column
        formatter.format(data,2); // Apply formatter to third column
        
        var options = {
          title: '',
          hAxis: {title: ''},
          colors: ['#FEAF00','#1560AC'],
          isStacked: true,
          legend: 'none',
          bar: {groupWidth: 60},
          backgroundColor:'#F7F5F5',
          vAxis:{minValue:0,maxValue:2,gridlines:{count:2},format: "#,###'%'"}
        };
        
        var chart = new google.visualization.ColumnChart(document.getElementById('pie-visualization'));
        chart.draw(data, options);
      }
      
    </script>
    <script>
    
    google.load("visualization", "1", {
    packages: ["corechart"]
});
    
google.setOnLoadCallback(drawChart);

function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Task');
    data.addColumn('number', 'Hours per Day');
    data.addRows([
        ['A', roundNumber(11 * Math.random(), 2)],
        ['B', roundNumber(2 * Math.random(), 2)],
        ['C', roundNumber(2 * Math.random(), 2)],
        ['D', roundNumber(2 * Math.random(), 2)],
        ['E', roundNumber(7 * Math.random(), 2)]
        ]);
    var options = {
        width: 450,
        height: 350,
        colors: ['#ECD078', '#FEAF00', '#C02942', '#542437', '#53777A'],
        legend: {
            position: 'none'
        },
        animation: {
            duration: 800,
            easing: 'in'
        }
    };
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);

    google.visualization.events.addListener(chart, 'onmouseover', function(e) {
        if (e['row'] === 1) {
            hide_tooltip()
        }
    });

    google.visualization.events.addListener(chart, 'onmouseout', show_tooltip);

    function getTooltip() {
        var iframe = document.getElementById('chart_div').getElementsByTagName('iframe')[0];
        var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
        return innerDoc.getElementsByTagName('svg')[0].lastChild;
    }

    function hide_tooltip() {
        var tooltip = getTooltip();
        tooltip.style.display = 'none';
    }

    function show_tooltip() {
        var tooltip = getTooltip();
        tooltip.style.display = 'block';
    }
}

function roundNumber(num, dec) {
    var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
    return result;
}
</script>

<!-- Script for submit form -->
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".select_action").change(function(){ 
            jQuery("#scheduleFrm").submit();
        });
    });
    
    //load the cliders after 2.8 seconds of page load.
      setTimeout(show_scheduling,2300);
      function show_scheduling(){
           jQuery(".schedule_box").slideDown();
      }
</script>
    
<style>
#chart_div{
    left: 0;
    position: absolute;
    top: 20px;
    z-index: 1; 
}
#chart_div iframe{
    position: relative;
    z-index: 1;
}
#chart_div:after{
    background: #fff;
    border-radius: 50%;
    -moz-border-radius: 50%;
    content: '';
    display: block;
    left: 180px; 
    padding: 47px;
    position: absolute;
    top: 104px;
    z-index: 2;
}
.dshbrd-right .graybg { margin-left: 0px !important; }
.lstwek-rprt{ padding-bottom: 0px !important;}
.obsrvatn{ padding-bottom: 0px !important; padding-top: 0px !important; }
.charimgarea{ padding-bottom: 0px !important; padding-top: 0px !important; margin-top: -20px;}
.scdlunscdl {padding-bottom: 10px !important; padding-top:13px;}
.lstwek-rprt h4 {padding:0 0 0 30px;}
.schedule_box{ display: none;}
</style>

<form name="scheduleFrm" id="scheduleFrm" method="POST" action="<?php echo SITE_URL ?>users/welcome">
<section class="top_hdngnew">
  <section class="heading_lt">
    <h3>Schedule<span>Balance</span></h3>
    <section class = "schedule_box">
    <p>
      <i>Last Updated: </i>
         <?php
               if($date != ""){
                   $date = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$date);
                   echo date('H:ia, M. d, Y',strtotime($date));
               }else{
                   echo 'N/A';
               }
         ?>
    </p>
    <ul class=scdlunscdl>
         <li class=scduld><span></span>Unscheduled</li>
         <li class=unscduld><span></span>Scheduled</li>
     </ul>
    </section>
  </section>
    <span class="schdl_blnc schedule_box">
        <select class="select_action select_action_new" name="data[Schedule][day_hrs]">
            <option value="all">All</option>
            <option value="work" <?php if(isset($_SESSION["Schedule"]["day_hrs"]) AND $_SESSION["Schedule"]["day_hrs"] == "work"){?> selected="selected" <?php } ?>>Work Hours</option>
        </select>
        <select class="select_action select_action_new" name="data[Schedule][week]">
                    <option value="next">Next Week</option>
                    <option value="prev" <?php if(isset($_SESSION["Schedule"]["week"]) AND $_SESSION["Schedule"]["week"] == "prev"){?> selected="selected" <?php } ?>>Previous Week</option>
                </select>
    </span>
  
</section>
<section class="schedule_box">
<!--Last Week Report Starts-->
<section class=lstwek-rprt>
     <h4>Weekly</h4>
     
     <ul class=obsrvatn>
         <li class=charimgarea>
            <div id="pie-visualization"></div>
     </ul>
</section>
<!--Last Week Report End-->
<!--Next Week Report Starts-->
<section class="lstwek-rprt lstwek-rprt_new">
     <h4>Daily</h4>
     <section style="float: left; width: 100%;">
    
     <ul class=obsrvatn>
         <li class=charimgarea>
            <div id="bar-visualization" style="width:205px; height: 205px;"></div>
         </li>
         
     </ul>
</section>
</section>
</form>
<!--Next Week Report End-->