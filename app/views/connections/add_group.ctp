<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#addConForm").validationEngine();
});
</script>
<style>
	.signuplogin_new .basic-details .textarea, .signuplogin_new .textbox span{
		width: 100%;
	}
</style>

<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin signuplogin_new">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Connection', array('controller' => 'connections','action' => 'add_group/'.base64_encode(@$this->data['ConnectionGroup']['id']),'id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Add<span>Connection Group</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
                                  <ul>
                                      <li><div class=textbox><span><?php echo $this->Form->input('ConnectionGroup.title',array('placeholder'=>'Title of group','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Basic Details End-->
                          <!--Note & Strength Check Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
                              <section class=bscdtl-lft>
                                  <ul>
                                      <li>
				      <span style="padding-left:10px;">Description:</span><br>
				      <?php echo $this->Form->input('ConnectionGroup.description',array('type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false,'style'=>'margin-top:5px')); ?></li>
				  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Note & Strength Check End-->
                          <!--Add Connection Button-->
                          <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Save  Group',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section>
			  
			  <?php echo $this->Form->end(); ?>
			  
                      </section>
                 </section>
             </section>
             <section class=whiteboxbot>
                 <section class=whiteboxbot-right></section>
             </section>
         </section>
         <!--Flexible WhiteBox With Shadows End-->
    </section>
<!--Center Align Inner Content Section End-->