<STYLE type="text/css">
    .tableTd {
                border-width: 0.5pt;
                border: solid;
    }
    .tableTdContent{
                border-width: 0.5pt;
                border: solid;
    }
    #titles{
            font-weight: bolder;
    }
</STYLE>
<table>
    <tr>
        <td></td>
    </tr>
    <tr id="titles">
          <td class="tableTd"><b>User Id</b></td>
        <td class="tableTd"><b>Day</b></td>
         <td class="tableTd"><b>Start Time</b></td>
        <td class="tableTd"><b>End Time</b></td>
    </tr>
    
    <?php
    
    //pr($rows); die;
    $arrDay = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
    foreach($rows as $row):
       // pr($row);
        if(empty($row['ScheduleBalance']['user_id'])){
            $row['ScheduleBalance']['user_id'] = 'N/A';
        }
        if(empty($row['ScheduleBalance']['day'])){
            $row['ScheduleBalance']['day'] = 'N/A';
        }
        if(empty($row['ScheduleBalance']['start'])){
            $row['ScheduleBalance']['start'] = 'N/A';
        }
        if(empty($row['ScheduleBalance']['end'])){
            $row['ScheduleBalance']['end'] = 'N/A';
        }
        for($i=0; $i<=6; $i++){
            //$shInfo = $this->requestAction(
            //        array('controller' => 'admins', 'action' => 'admin_request'),
            //            array('pass' => array($row['ScheduleBalance']['user_id'],$arrDay[$i]))
            //);
            $shInfo = $this->requestAction('admin/admins/request/'.$arrDay[$i].'/'.$row['ScheduleBalance']['user_id']);
            $start = ($shInfo['ScheduleBalance']['start'] != ''?$shInfo['ScheduleBalance']['start']:'00:00:00');
            $end = ($shInfo['ScheduleBalance']['end'] != ''?$shInfo['ScheduleBalance']['end']:'00:00:00');
            echo '<tr>';
                echo '<td class="tableTdContent">'.$row['ScheduleBalance']['user_id'].'</td>';
                echo '<td class="tableTdContent">'.$arrDay[$i].'</td>';
                 echo '<td class="tableTdContent">'.$start.'</td>';
                 echo '<td class="tableTdContent">'.$end.'</td>';
            echo '</tr>';
        }
    endforeach;
    ?>
</table>