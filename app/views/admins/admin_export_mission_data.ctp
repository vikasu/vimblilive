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
<strong><u>MISSION</u></strong>
<table>
    <tr id="titles">
        <td class="tableTd"><b>Id</b></td>
        <td class="tableTd"><b>Shared BY GM</b></td>
        <td class="tableTd"><b>Owner</b></td>
        <td class="tableTd"><b>Edited By</b></td>
        <td class="tableTd"><b>Draft Mission Id</b></td>
        <td class="tableTd"><b>Sponsor Id</b></td>
        <td class="tableTd"><b>Title</b></td>
        <td class="tableTd"><b>Rating</b></td>
        <td class="tableTd"><b>Description</b></td>
        <td class="tableTd"><b>Start Time</b></td>
        <td class="tableTd"><b>End Time</b></td>
          <td class="tableTd"><b>Definition Of Success</b></td>
        <td class="tableTd"><b>Frequency</b></td>
        <td class="tableTd"><b>Mission Status</b></td>
        <td class="tableTd"><b>Connection Notes</b></td>
        <td class="tableTd"><b>Mission Notes</b></td>
          <td class="tableTd"><b>Shared With</b></td>
        <td class="tableTd"><b>Created</b></td>
        <td class="tableTd"><b>Modified</b></td>
         <td class="tableTd"><b>Progress Connectivity</b></td>
        <td class="tableTd"><b>Confirm</b></td>
    </tr>
    <?php foreach($rows as $row):
            if(empty($row['Mission']['shared_by_gm'])){
                $row['Mission']['shared_by_gm'] = 'N/A';
            }
            if(empty($row['Mission']['edited_by'])){
                $row['Mission']['edited_by'] = 'N/A';
            }
            if(empty($row['Mission']['title'])){
                $row['Mission']['title'] = 'N/A';
            }
            if(empty($row['Mission']['description'])){
                $row['Mission']['description'] = 'N/A';
            }
            if(empty($row['Mission']['frequency'])){
                $row['Mission']['frequency'] = 'N/A';
            }
            if(empty($row['Mission']['sponsor_id'])){
                $row['Mission']['sponsor_id'] = 'N/A';
            }
            if(empty($row['Mission']['definition_of_success'])){
                $row['Mission']['definition_of_success'] = 'N/A';
            }
            if(empty($row['Mission']['rating'])){
                $row['Mission']['rating'] = 'N/A';
            }
            if(empty($row['Mission']['definition_of_success'])){
                $row['Mission']['definition_of_success'] = 'N/A';
            }
            if(empty($row['Mission']['connection_notes'])){
                $row['Mission']['connection_notes'] = 'N/A';
            }
            if(empty($row['Mission']['mission_notes'])){
                $row['Mission']['mission_notes'] = 'N/A';
            }
            if(empty($row['Mission']['shared_with'])){
                $row['Mission']['shared_with'] = 'N/A';
            }
            if(empty($row['Mission']['progress_general'])){
                $row['Mission']['progress_general'] = 'N/A';
            }
            if(empty($row['Mission']['progress_connectivity'])){
                $row['Mission']['progress_connectivity'] = 'N/A';
            }
            // check availability of date
            if($row['Mission']['created'] == 0000-00-00){
                 $row['Mission']['created'] = 'N/A';
             }else{
                    $row['Mission']['created'] = date('d M,Y',strtotime($row['Mission']['created']));;   
            }
            if($row['Mission']['modified'] == 0000-00-00){
                 $row['Mission']['modified'] = 'N/A';
             }else{
                    $row['Mission']['modified'] = date('d M,Y',strtotime($row['Mission']['modified']));;   
            }
            if($row['Mission']['start_time'] == 0000-00-00){
                 $row['Mission']['start_time'] = 'N/A';
             }else{
                    $row['Mission']['start_time'] = date('d M,Y',strtotime($row['Mission']['start_time']));;   
            }
            if($row['Mission']['end_time'] == 0000-00-00){
                 $row['Mission']['end_time'] = 'N/A';
             }else{
                    $row['Mission']['end_time'] = date('d M,Y',strtotime($row['Mission']['end_time']));;   
            }
            
         // check availability of confirm
            if($row['Mission']['confirm'] == 1){
                $row['Mission']['confirm'] = 'confirm';
            }else{
                $row['Mission']['confirm'] = '-';
            }
            // check availability of status
            if($row['Mission']['mission_status'] == 1){
                $row['Mission']['mission_status'] = 'Active';
            }else{
                $row['Mission']['mission_status'] = 'Deactive';
            }

        echo '<tr>';
        echo '<td class="tableTdContent">'.$row['Mission']['id'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['shared_by_gm'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['owner'].'</td>';
        echo '<td class="tableTdContent">'.$row['Sponsor']['edited_by'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['draft_mission_id'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['sponsor_id'].'</td>';  
        echo '<td class="tableTdContent">'.$row['Mission']['title'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['rating'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['description'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['start_time'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['end_time'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['definition_of_success'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['frequency'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['mission_status'].'</td>';  
        echo '<td class="tableTdContent">'.$row['Mission']['connection_notes'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['mission_notes'].'</td>';
         echo '<td class="tableTdContent">'.$row['Mission']['shared_with'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['created'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['modified'].'</td>';  
        echo '<td class="tableTdContent">'.$row['Mission']['progress_connectivity'].'</td>';
        echo '<td class="tableTdContent">'.$row['Mission']['confirm'].'</td>';
        echo '</tr>';
        echo '</tr>';
    endforeach;
    ?>
</table>


<b>MISSION CONNECTIONS</b>
<table>
    <tr id="titles">
        <td class="tableTd"><b>Id</b></td>
        <td class="tableTd"><b>Misssion Id</b></td>
        <td class="tableTd"><b>Connection Id</b></td>
        <td class="tableTd"><b>Touches</b></td>
        <td class="tableTd"><b>Calculated Touches</b></td>
        <td class="tableTd"><b>Frequency</b></td>
    </tr>
    <?php foreach($cons as $row):
            if(empty($row['MissionConnection']['mission_id'])){
                $row['MissionConnection']['mission_id'] = 'N/A';
            }
            if(empty($row['MissionConnection']['connection_id'])){
                $row['MissionConnection']['connection_id'] = 'N/A';
            }
            if(empty($row['MissionConnection']['hours'])){
                $row['MissionConnection']['hours'] = 'N/A';
            }
            if(empty($row['MissionConnection']['frequency'])){
                $row['MissionConnection']['frequency'] = 'N/A';
            }
            if(empty($row['MissionConnection']['calculated_touch'])){
                $row['MissionConnection']['calculated_touch'] = 'N/A';
            }
            echo '<tr>';
            echo '<td class="tableTdContent">'.$row['MissionConnection']['id'].'</td>';
            echo '<td class="tableTdContent">'.$row['MissionConnection']['mission_id'].'</td>';
            echo '<td class="tableTdContent">'.$row['MissionConnection']['connection_id'].'</td>';
            echo '<td class="tableTdContent">'.$row['MissionConnection']['hours'].'</td>';
            echo '<td class="tableTdContent">'.$row['MissionConnection']['calculated_touch'].'</td>';
            echo '<td class="tableTdContent">'.$row['MissionConnection']['frequency'].'</td>';
            echo '</tr>';
            echo '</tr>';
        endforeach;
    ?>
</table>  
<b>MISSION Key2Success</b>
<table>
    <tr id="titles">
        <td class="tableTd"><b>Id</b></td>
        <td class="tableTd"><b>Misssion Id</b></td>
        <td class="tableTd"><b>Description</b></td>
        <td class="tableTd"><b>Expected Hours</b></td>
         <td class="tableTd"><b>Calculated Hours</b></td>
        <td class="tableTd"><b>Period</b></td>
        <td class="tableTd"><b>Start Date</b></td>
        <td class="tableTd"><b>End Date</b></td>
        <td class="tableTd"><b>Ranking</b></td>
        <td class="tableTd"><b>Sign Off Status</b></td>
         <td class="tableTd"><b>Progress K2S</b></td>
    </tr>
    <?php foreach($keys as $row):
            if(empty($row['KeyToSuccess']['mission_id'])){
                $row['KeyToSuccess']['mission_id'] = 'N/A';
            }
            if(empty($row['KeyToSuccess']['description'])){
                $row['KeyToSuccess']['description'] = 'N/A';
            }
            if(empty($row['KeyToSuccess']['expected_hrs'])){
                $row['KeyToSuccess']['expected_hrs'] = 'N/A';
            }
            if(empty($row['KeyToSuccess']['period'])){
                $row['KeyToSuccess']['period'] = 'N/A';
            }
            if(empty($row['KeyToSuccess']['ranking'])){
                $row['MissionConnection']['ranking'] = 'N/A';
            }
            if(empty($row['KeyToSuccess']['sign_off_status'])){
                $row['KeyToSuccess']['sign_off_status'] = 'N/A';
            }
            if(empty($row['KeyToSuccess']['progress_k2s'])){
                $row['KeyToSuccess']['progress_k2s'] = 'N/A';
            }
            if(empty($row['KeyToSuccess']['calculated_hrs'])){
                $row['KeyToSuccess']['calculated_hrs'] = 'N/A';
            }
             if(empty($row['KeyToSuccess']['start_date'])){
                $row['KeyToSuccess']['start_date'] = 'N/A';
            }else{
                $row['KeyToSuccess']['start_date'] = date('d M, Y',strtotime( $row['KeyToSuccess']['start_date']));
            }
            if(empty($row['KeyToSuccess']['end_date'])){
                $row['KeyToSuccess']['end_date'] = 'N/A';
            }else{
                $row['KeyToSuccess']['end_date'] = date('d M, Y',strtotime( $row['KeyToSuccess']['end_date']));
            }
            
            echo '<tr>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['id'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['mission_id'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['description'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['expected_hrs'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['calculated_hrs'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['period'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['start_date'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['end_date'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['ranking'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['sign_off_status'].'</td>';
            echo '<td class="tableTdContent">'.$row['KeyToSuccess']['progress_k2s'].'</td>';
            echo '</tr>';
            echo '</tr>';
        endforeach;
    ?>
</table>