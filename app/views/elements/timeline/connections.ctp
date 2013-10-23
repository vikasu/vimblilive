<ul class=manag-actvty>
     <?php //pr($conLists); exit;
     if(empty($conLists)){ ?>
          <li style="text-align:center;">No connection found.</li> 
     <?php } else { 
          //pr($conLists); exit; ?>
      <input id="connection-group" type="hidden" name="data[ConGroupRelation][group_id]" value="">
         
      <?php   
     foreach($conLists as $connection) { ?>
     <li>
         <section class="mng-actvty">
          <?php if($connection['Connection']['name'] != ''){
               echo $html->link($connection['Connection']['name'],array('controller'=>'connections','action'=>'connection_detail',base64_encode($connection['Connection']['id'])));
               //echo $connection['Connection']['name'];
          } else {
               echo 'N/A';
          }
          ?>
         </div></section>
         <section class="mng-time"><?php
                     $contactEmail = '';
                    if(!empty($connection['ConnectionEmail'])) {
                    
                     foreach($connection['ConnectionEmail'] as $email):
                             $contactEmail = $contactEmail.$email['email'].', ';
                     endforeach;
                     echo substr($contactEmail,0,strlen($contactEmail)-2);
                    } else {
                         echo 'N/A';
                    }
                ?></section>
         <section class="mng-rtng">
               <?php $contactNum = '';
                    if(!empty($connection['ConnectionPhone'])){
                     
                     foreach($connection['ConnectionPhone'] as $phone):
                             $contactNum = $contactNum.$phone['phone'].', ';
                     endforeach;
                     echo substr($contactNum,0,strlen($contactNum)-2);
               } else {
                    echo 'N/A';
               }
               ?>
         </section>
      </li>
     <?php } } ?>
 </ul>