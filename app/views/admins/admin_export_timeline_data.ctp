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
    <tr id="titles">
        <td class="tableTd"><b>Id</b></td>
        <td class="tableTd"><b>User Id</b></td>
        <td class="tableTd"><b>Model Name</b></td>
        <td class="tableTd"><b>Entity Id</b></td>
        <td class="tableTd"><b>Title</b></td>
          <td class="tableTd"><b>Start Date</b></td>
        <td class="tableTd"><b>End Date</b></td>
        <td class="tableTd"><b>Rating</b></td>
          <td class="tableTd"><b>Created</b></td>
        <td class="tableTd"><b>Is Read</b></td>
        <td class="tableTd"><b>Is Delete</b></td>
        <td class="tableTd"><b>Status</b></td>
    </tr>
    <?php foreach($rows as $row):
        if($reflection['Timeline']['model_name'] == "CalendarEvent"){
	    $type = "Calendar";
	}elseif($reflection['Timeline']['model_name'] == "ImportEmail"){
	    $type = "Email";
	}elseif($reflection['Timeline']['model_name'] == "UserReflection"){
	    $type = "Reflection";
	}else{
	    $type = "Activity";
	}
        if(empty($row['Timeline']['user_id'])){
            $row['Timeline']['user_id'] = 'N/A';
        }
        if(empty($row['Timeline']['title'])){
            $row['Timeline']['title'] = 'N/A';
        }
        if(empty($row['Timeline']['entity_id'])){
            $row['Timeline']['entity_id'] = 'N/A';
        }
        if(empty($row['Timeline']['rating'])){
            $row['Timeline']['rating'] = 'N/A';
        }
        if(empty($row['Timeline']['description'])){
            $row['Timeline']['description'] = 'N/A';
        }
         if($row['Timeline']['start_date'] == 0000-00-00){
             $row['Timeline']['start_date'] = 'N/A';
         }else{
                $row['Timeline']['start_date'] = date('d M,Y',strtotime($row['Timeline']['start_date']));;   
        }
        if($row['Timeline']['end_date'] == 0000-00-00){
             $row['Timeline']['end_date'] = 'N/A';
         }else{
                $row['User']['end_date'] = date('d M,Y',strtotime($row['Timeline']['end_date']));;   
        }
        if(empty($row['Timeline']['created'])){
             $row['Timeline']['created'] = 'N/A';
         }else{
                $row['Timeline']['created'] = date('d M,Y',strtotime($row['Timeline']['created']));;   
        }
        if($row['Timeline']['status'] == 1){
            $row['Timeline']['status'] = 'Active';
        }else{
            $row['Timeline']['status'] = 'Deactive';
        }
        echo '<tr>';
        echo '<td class="tableTdContent">'.$row['Timeline']['id'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['user_id'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['model_name'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['entity_id'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['title'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['start_date'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['end_date'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['status'].'</td>';   
        echo '<td class="tableTdContent">'.$row['Timeline']['created'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['is_read'].'</td>';
         echo '<td class="tableTdContent">'.$row['Timeline']['is_delete'].'</td>';
        echo '<td class="tableTdContent">'.$row['Timeline']['status'].'</td>';
        echo '</tr>';
    endforeach;
    ?>
</table>
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