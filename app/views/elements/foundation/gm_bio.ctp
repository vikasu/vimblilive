<style>
  .biolist li label {
    padding-top: 18px;
    width: 176px;
}
 .biolist li label.file_upload {
  
  padding-top:8px;
 }
</style>
<?php //echo $_SESSION['Auth']['User']['image'];?>
<ul>
  <li>
      <!--Sub Menu Content Starts-->
      <section class="innerexpand">
        <?php echo $this->element("message/errors");?>
        <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>

           <ul class="missin-flds missionview biolist">
               <?php /* Bio Section starts  */
                echo $this->Form->create('', array('url'=>array('controller' => 'users','action' => 'manage_profile'),'enctype'=>'multipart/form-data')); ?>
               <li><label>Group Name:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.name',array('placeholder'=>'Your Group name here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label class="file_upload">Group Logo:</label>
                   <div id="image"><?php echo $form->input('User.file', array('type' => 'file', 'label' => 'Upload file', "label" => false));?></div>
                  <?php if(!empty($loginUserInfo['User']['image'])){ ?>
                       <img src="<?php echo SITE_URL ?>files/user/medium/<?php echo $loginUserInfo['User']['image'];?>" width="50px" height="50px" alt="Delete" id="upload"/>
                       <a href="javascript:void(0)" id="upload_image">Upload Image</a>                
                 <?php  }else{ ?>
                              <div style="float: left; border:1px solid #cccc; margin-top: 9px;margin-right: 20px">No Image Found</div>
                               <div style=""><a href="javascript:void(0)" id="upload_image">Upload Image</a></div>    
                 <?php } ?>
                </li>
                <li style="margin-left:190px;">Image: JPG or PNG, 210x140p</li>
                
                <li><label>Email:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <!--for pramary contact name and email-->
                <li><label>Primary Contact Name:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.primaryname',array('placeholder'=>'Your Primary Contact Name','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
                <li><label>Primary Email:</label>
                          <?php if($_SESSION['Auth']['User']['primaryemail']==""){ ?>
                            
                                    <div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Your Primary email, me@demo.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                              <?php   }else{ ?>
                                        <div class=textbox><span><?php echo $this->Form->input('User.primaryemail',array('placeholder'=>'Your Primary email, me@demo.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                  <?php } ?>
                <!--for secondary contact name and email-->
                 <li><label>Secondary Contact Name:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.secondaryname',array('placeholder'=>'Your Secondary Contact Name','div'=>false,'label'=>false,'error'=>false)); ?></span></div></li>
                
                <li><label>Secondary Email:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.secondaryemail',array('placeholder'=>'Your Secondary email, me@demo.com','div'=>false,'label'=>false,'error'=>false)); ?></span></div></li>
                
                <li><label>Address:</label>
                    <div class=textbox><span><?php echo $this->Form->input('User.address',array('placeholder'=>'Address - Street, City, State, Zip, Country','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                
               
                    <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
            </ul>
      </section>
      <!--Sub Menu Content End-->
  </li>
</ul>
<script>
  jQuery(document).ready(function(){
    //alert('hii');die;
    jQuery('#upload_image').click(function(){
      jQuery(this).hide('fast');
      jQuery('#image').show();
      
      //alert('hiihi');  
    })
  })
</script>