<ul class="wrap_tab_content">
  <li>
      <!--Sub Menu Content Starts-->
      <section class="innerexpand">
        <?php echo $this->element("message/errors");?>
        <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>

           <ul class="missin-flds missionview biolist">
               <?php /* Bio Section starts  */
                echo $this->Form->create('', array('url'=>array('controller' => 'users','action' => 'manage_profile'),'enctype'=>'multipart/form-data')); ?>
               <li><label>Name:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.name',array('placeholder'=>'Your name here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>Group Logo:</label>
                    <?php echo $form->input('User.file', array('type' => 'file', 'label' => 'Upload file', "label" => false)); ?></li>
                
                
                <li><label>Email:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <!--<li><label>Password:</label>
                    <div class=textbox><span><?php //echo $this->Form->input('User.pwd',array('type'=>'password','id'=>'password','placeholder'=>'A 8+ character password you can remember','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                -->
                <li><label>Address:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.address',array('placeholder'=>'Your address here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>City:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.city',array('placeholder'=>'Your city here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>State:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.state',array('placeholder'=>'Your state here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                
                <li><label>Country:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.country',array('placeholder'=>'Your country here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>Zip:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.zip',array('placeholder'=>'Your zip here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>Fax:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.fax',array('placeholder'=>'Your fax here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                
                <li><label>Birthdate:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.birthdate',array('placeholder'=>'Your birthdate','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li>
                    <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
            </ul>
      </section>
      <!--Sub Menu Content End-->
  </li>
</ul>