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
        <td class="tableTd"><b>Mannager Id</b></td>
        <td class="tableTd"><b>Name</b></td>
        <td class="tableTd"><b>Email</b></td>
        <td class="tableTd"><b>Primary Name</b></td>
        <td class="tableTd"><b>Primary Email</b></td>
         <td class="tableTd"><b>Secondary Name</b></td>
        <td class="tableTd"><b>Secondary Email</b></td>
        <td class="tableTd"><b>Calendar Path</b></td>
        <td class="tableTd"><b>Address</b></td>
        <td class="tableTd"><b>City</b></td>
        <td class="tableTd"><b>State</b></td>
        <td class="tableTd"><b>Country</b></td>
        <td class="tableTd"><b>Zip</b></td>
        <td class="tableTd"><b>Fax</b></td>
        <td class="tableTd"><b>Birthdate</b></td>
        <td class="tableTd"><b>Image</b></td>
        <td class="tableTd"><b>User Type</b></td>
        <td class="tableTd"><b>Group Payment Status</b></td>
        <td class="tableTd"><b>Individual Payment Status</b></td>
        <td class="tableTd"><b>Is Sponsor</b></td>
        <td class="tableTd"><b>StatuSubscription plan Id</b></td>
        <td class="tableTd"><b>No Of User</b></td>
        <td class="tableTd"><b>Role</b></td>
        <td class="tableTd"><b>Status</b></td>
        <td class="tableTd"><b>Created</b></td>
        <td class="tableTd"><b>Modified</b></td>
        <td class="tableTd"><b>Last Accessed</b></td>
         <td class="tableTd"><b>Exclude Keywords</b></td>
        <td class="tableTd"><b>Timezone</b></td>
        <td class="tableTd"><b>Timezone Diff</b></td>
        <td class="tableTd"><b>DST</b></td>
        <td class="tableTd"><b>Dormant USer</b></td>
    </tr>
    <?php foreach($rows as $row):
        if(empty($row['User']['name'])){
            $row['User']['name'] = 'N/A';
        }
        if(empty($row['User']['email'])){
            $row['User']['email'] = 'N/A';
        }
        if(empty($row['User']['primaryname'])){
            $row['User']['primaryname'] = 'N/A';
        }
        if(empty($row['User']['primaryemail'])){
            $row['User']['primaryemail'] = 'N/A';
        }
        if(empty($row['User']['calendar_path'])){
            $row['User']['calendar_path'] = 'N/A';
        }
        if(empty($row['User']['manager_id'])){
            $row['User']['manager_id'] = 'N/A';
        }
        if(empty($row['User']['primaryname'])){
            $row['User']['primaryname'] = 'N/A';
        }
        if(empty($row['User']['primaryemail'])){
            $row['User']['primaryemail'] = 'N/A';
        }
        if(empty($row['User']['secondaryname'])){
            $row['User']['secondaryname'] = 'N/A';
        }
        if(empty($row['User']['secondaryemail'])){
            $row['User']['secondaryemail'] = 'N/A';
        }
        if(empty($row['User']['address'])){
            $row['User']['address'] = 'N/A';
        }
        if(empty($row['User']['city'])){
            $row['User']['city'] = 'N/A';
        }
        if(empty($row['User']['state'])){
            $row['User']['state'] = 'N/A';
        }
        if(empty($row['User']['zip'])){
            $row['User']['zip'] = 'N/A';
        }
        if(empty($row['User']['country'])){
            $row['User']['country'] = 'N/A';
        }
        if(empty($row['User']['fax'])){
            $row['User']['fax'] = 'N/A';
        }
        if(empty($row['User']['image'])){
            $row['User']['image'] = 'N/A';
        }
        if(empty($row['SubscriptionPlan']['id'])){
            $row['SubscriptionPlan']['id'] = 'N/A';
        }
        
        
        // check condition on Dates
        if($row['User']['birthdate'] == 0000-00-00){
             $row['User']['birthdate'] = 'N/A';
        }else{
                $row['User']['birthdate'] = date('d M,Y',strtotime($row['User']['birthdate']));;   
        }
        if(!empty($row['User']['created'])){
             $row['User']['created'] = 'N/A';
        }else{
                $row['User']['created'] = date('d M,Y',strtotime($row['User']['created']));;   
        }
         if(!empty($row['User']['modified'])){
             $row['User']['modified'] = 'N/A';
         }else{
                $row['User']['modified'] = date('d M,Y',strtotime($row['User']['modified']));;   
        }
        if($row['User']['last_accessed'] == 0000-00-00){
             $row['User']['last_accessed'] = 'N/A';
         }else{
                $row['User']['last_accessed'] = date('d M,Y',strtotime($row['User']['last_accessed']));;   
        }
        if(empty($row['User']['group_payment_status'])){
            $row['User']['group_payment_status'] = 'N/A';
        }
        if($row['User']['status'] == 1){
            $row['User']['status'] = 'Active';
        }else{
            $row['User']['status'] = 'Deactive';
        }

     /*    $accessLevels = '';
         if($row['User']['individual_payment_status'] == 1){
             $accessLevels = $accessLevels.'Ind, ';
         }
         if($row['User']['group_payment_status'] == 1){
            $accessLevels = $accessLevels.'Grp, ';
         }
         if(!empty($row['SponsorManager'])){
            $accessLevels = $accessLevels.'Sp, ';
        }
        $access = substr($accessLevels,0,strlen($accessLevels)-2);       */                                  
                                                
                                         
        echo '<tr>';
        echo '<td class="tableTdContent">'.$row['User']['id'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['manager_id'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['name'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['email'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['primaryname'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['primaryemail'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['secondaryname'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['secondaryemail'].'</td>';
         echo '<td class="tableTdContent">'.$row['User']['calendar_path'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['address'].'</td>';
         echo '<td class="tableTdContent">'.$row['User']['city'].'</td>';
        
        echo '<td class="tableTdContent">'.$row['User']['state'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['country'].'</td>';
       
        echo '<td class="tableTdContent">'.$row['User']['zip'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['fax'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['birthdate'].'</td>';
         echo '<td class="tableTdContent">'.$row['User']['image'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['user_type'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['group_payment_status'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['individual_payment_status'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['is_sponsor'].'</td>';
        echo '<td class="tableTdContent">'.$row['SubscriptionPlan']['id'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['no_of_users'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['role'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['status'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['created'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['modified'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['last_accessed'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['exclude_keywords'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['timezone'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['timezone_diff'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['dst'].'</td>';
        echo '<td class="tableTdContent">'.$row['User']['dormant_user'].'</td>';
        echo '</tr>';
        echo '</tr>';
    endforeach;
    ?>
</table>