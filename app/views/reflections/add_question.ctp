<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#addQueForm").validationEngine();
});
</script>

<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
			<?php echo $this->element("message/errors");?>
                      <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Reflection', array('controller' => 'reflections','action' => 'add_question/'.base64_encode(@$this->data['Question']['id']),'id'=>'addQueForm', 'name'=>'addQueForm')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Add<span>Question</span></h3></div>
                          <!--Note & Strength Check Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
                              <section class=bscdtl-lft>
                                  <ul>
                                      <li>
				      <span style="padding-left:10px;">Question:</span><br>
				      <?php echo $this->Form->input('Question.question',array('type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false,'style'=>'margin-top:5px')); ?></li>
					
					<div style="padding: 5px 5px 2px 7px;">Frequency:</div>
					<li class=dob>
					<div class=textbox><span>
					    <?php
					    echo $form->input('Question.frequency', array('label'=>false,'type'=>'select','options'=>array('0'=>'Random','1'=>'Always ask'),'div'=>false,'style'=>'','class'=>'','error'=>false));?>
					</span></div>
					</li>
					
					<div style="padding: 5px 5px 2px 7px;">Response Option:</div>
					<li class=dob>
					<div class=textbox><span>
					    <?php
					    echo $form->input('Question.rating_strength', array('label'=>false,'type'=>'select','options'=>array('3'=>'3 Star','5'=>'5 Star'),'div'=>false,'style'=>'','class'=>'','error'=>false));?>
					</span></div>
					</li>
				  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Note & Strength Check End-->
                          <!--Add Connection Button-->
                          <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Add',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section>
			  
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