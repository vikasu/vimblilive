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
        <td class="tableTd"><b>Reflection Date</b></td>
	<td class="tableTd"><b>User Id</b></td>
	<td class="tableTd"><b>Reflection</b></td>
        <td class="tableTd"><b>Question 1</b></td>
        <td class="tableTd"><b>Rating 1</b></td>
        <td class="tableTd"><b>Question 2</b></td>
        <td class="tableTd"><b>Rating 2</b></td>
        <td class="tableTd"><b>Question 3</b></td>
        <td class="tableTd"><b>Rating 3</b></td>
        <td class="tableTd"><b>Today Question</b></td>
        <td class="tableTd"><b>Rating Today</b></td>
        <td class="tableTd"><b>Tomorrow Question</b></td>
        <td class="tableTd"><b>Rating_tomorrow</b></td>
	<td class="tableTd"><b>Filename</b></td>
	 <td class="tableTd"><b>Status</b></td>
	<td class="tableTd"><b>Created</b></td>
        <td class="tableTd"><b>Modified</b></td>
	<td class="tableTd"><b>Confirm</b></td>
        <td class="tableTd"><b>Local Reflection Date</b></td>
	<td class="tableTd"><b>Attendies</b></td>
    </tr>
    <?php foreach($rows as $reflection):
				if(!empty($reflection['UserReflection']['local_reflection_date'])){
					$reflection['UserReflection']['local_reflection_date'] = date('M. d Y',strtotime($reflection['UserReflection']['local_reflection_date']));
				}else{
					$reflection['UserReflection']['local_reflection_date'] = 'N/A';
				}
				
				if(!empty($reflection['UserReflection']['created'])){
					$reflection['UserReflection']['created'] = date('M. d Y',strtotime($reflection['UserReflection']['created']));
				}else{
					$reflection['UserReflection']['created'] = 'N/A';
				}
				
				if(!empty($reflection['UserReflection']['modified'])){
					$reflection['UserReflection']['modified'] = date('M. d Y',strtotime($reflection['UserReflection']['modified']));
				}else{
					$reflection['UserReflection']['modified'] = 'N/A';
				}
				
				
				// checking condition for availability of description
				if(empty($reflection['UserReflection']['description'])){
					$reflection['UserReflection']['description'] = 'N/A';
				}
				
				// checking condition for availability of user_id
				if(empty($reflection['UserReflection']['user_id'])){
					$reflection['UserReflection']['user_id'] = 'N/A';
				}
				
				// checking condition for availability of user_id
				if(empty($reflection['UserReflection']['file_name'])){
					$reflection['UserReflection']['file_name'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['UserReflection']['rating_today'])){
					$reflection['UserReflection']['rating_today'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['UserReflection']['rating_tomorrow'])){
					$reflection['UserReflection']['rating_tomorrow'] = 'N/A';
				}
				
				// checking condition for availability of attendy
				$attendies = array();
				foreach($reflection['ReflectionAttendy'] as $ref_attendy){
					$attendies[] = $ref_attendy['attendy_display_name'];
					//$attendies[] = $act_attendy['attendy_display_name'];
				}
				
				// making all attendies array value as comma separated
				$attendies = implode(',',$attendies);
				if(empty($attendies)){
					$attendies = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_1']['question'])){
					$reflection['Question_1']['question'] = 'N/A';
				}
				if(empty($reflection['Question_1']['rating_strength'])){
					$reflection['Question_1']['rating_strength'] = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_2']['question'])){
					$reflection['Question_2']['question'] = 'N/A';
				}
				if(empty($reflection['Question_1']['rating_strength'])){
					$reflection['Question_1']['rating_strength'] = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_3']['question'])){
					$reflection['Question_3']['question'] = 'N/A';
				}
				if(empty($reflection['Question_3']['rating_strength'])){
					$reflection['Question_3']['rating_strength'] = 'N/A';
				}
				
				if($reflection['UserReflection']['confirm'] == 1){
					$reflection['UserReflection']['confirm'] = 'confirm';
				}else{
                                   $reflection['UserReflection']['confirm'] = '-';
				}
				
				if($reflection['UserReflection']['status'] == 1){
					$reflection['UserReflection']['status'] = 'Active';
				}else{
                                   $reflection['UserReflection']['status'] = 'Deactive';
				}
        echo '<tr>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['id'].'</td>';
	 echo '<td class="tableTdContent">'.$reflection['UserReflection']['local_reflection_date'].'</td>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['user_id'].'</td>';
       echo '<td class="tableTdContent">'.$reflection['UserReflection']['title'].'</td>';
        echo '<td class="tableTdContent">'.$reflection['Question_1']['question'].'</td>';
        echo '<td class="tableTdContent">'.$reflection['Question_1']['rating_strength'].'</td>';   
        echo '<td class="tableTdContent">'.$reflection['Question_2']['question'].'</td>';
        echo '<td class="tableTdContent">'.$reflection['Question_2']['rating_strength'].'</td>';
        echo '<td class="tableTdContent">'.$reflection['Question_3']['question'].'</td>';
        echo '<td class="tableTdContent">'.$reflection['Question_3']['rating_strength'].'</td>';   
        echo '<td class="tableTdContent">'."How do you feel about today?".'</td>';
        echo '<td class="tableTdContent">'.$reflection['UserReflection']['rating_today'].'</td>';
        echo '<td class="tableTdContent">'."How do you feel about tomorrow?".'</td>';
        echo '<td class="tableTdContent">'.$reflection['UserReflection']['rating_tomorrow'].'</td>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['file_name'].'</td>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['status'].'</td>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['created'].'</td>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['modified'].'</td>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['confirm'].'</td>';
	echo '<td class="tableTdContent">'.$reflection['UserReflection']['local_reflection_date'].'</td>';
        echo '<td class="tableTdContent">'.$attendies.'</td>';
        echo '</tr>';
    endforeach;
    ?>
</table>