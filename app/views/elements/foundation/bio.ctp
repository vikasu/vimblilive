<?php //pr($this->data); die; ?>
<ul>
  <li>
      <!--Sub Menu Content Starts-->
      <section class="innerexpand">
           <ul class="missin-flds missionview biolist">
               <?php /* Bio Section starts  */
                echo $this->Form->create('User', array('url'=>array('controller' => 'Settings','action' => 'update_bio_info/'.base64_encode($_SESSION['Auth']['User']['id'])),'enctype'=>'multipart/form-data')); ?>
                 <?php echo $this->Form->hidden('User.id');?>
               <li><label>Name:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.name',array('placeholder'=>'Your name here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
             <!--   <li><label>Profile Image:</label>
                    <?php echo $form->input('User.file', array('type' => 'file', 'label' => 'Upload file', "label" => false)); ?></li> -->
                                                
                <li><label>Email:</label>
                    <div class=textbox ><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'id'=>'email')); ?></span></div></li>
                  
                <li><label>Back-up Email:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.secondaryemail',array('placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'id'=>'backup_email')); ?></span></div></li>
                
                <!--<li><label>Password:</label>
                    <div class=textbox><span><?php //echo $this->Form->input('User.pwd',array('type'=>'password','id'=>'password','placeholder'=>'A 8+ character password you can remember','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                -->
                <!--<li><label>Address:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.address',array('placeholder'=>'Your address here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li> -->
                
                <li><label>City:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.city',array('placeholder'=>'Your city here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>State:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.state',array('placeholder'=>'Your state here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                
                <li><label>Country:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.country',array('placeholder'=>'Your country here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>Zip:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.zip',array('placeholder'=>'Your zip here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
          <!--      <li><label>Fax:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.fax',array('placeholder'=>'Your fax here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div> -->
                    
                      <li><label>Calendar:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.calendar_path',array('type'=>'text','placeholder'=>'www.google.com/calendar
','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                    <span id="calendar_text">Vimbli defaults  to google calendar.Change if necessary.</span>
   <!-----------edited by anita----------------->          
                <li><label>Birthdate:</label>
                 <div class=textbox><span><?php echo $this->Form->input('User.birthdate',array('type'=>'text','placeholder'=>'Your birthdate','div'=>false,'label'=>false,'id'=>'dd','class' =>'validate[required]','error'=>false)); ?></span></div></li>
                <li>
                    <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'tmp','div'=>false,'label'=>false)); ?></div></li>
            </ul>
      </section>
      <!--Sub Menu Content End-->
  </li>
</ul>
<?php echo $this->Html->script('jquery');?>

<script>
$(document).ready(function(){
    $( "#dd").datepicker({ dateFormat: "yy-mm-dd" });
      //alert("hye");
    
});
</script>
<!-----------edited by anita----------------->