
<style>
.basic-details .textarea {
    height: 80px;
    width: 294px;
}
li {
    list-style: none outside none;
    padding: 2px;
}
#today_star { margin-left: 10px;  width: 112px !important;}
#tomorrow_star { margin-left: 10px; width: 187px !important; }
.starForAns{width: 189px !important; margin-bottom:0px;}
.textbox span input { margin: 16px 8px 0 !important;}
.calInput { background:url("../img/cal_icon.png") no-repeat 115px 2px !important; }
.noBground { background:none !important; height:auto !important; padding-left:0px;}
.noBground input { margin-left:4px !important; border:1px solid red; }

.refQuestion { font-weight:normal !important;  margin-left: 10px;}
.blurDiv { opacity: 0.4; }
#loaderDiv { display: none; position: absolute; top: 500px; left: 600px; 
}

</style>
<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
     
         <section class="whitebox signuplogin" style="width:720px;">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
		      <div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Reflection', array('controller' => 'reflections','action' => 'add_reflection','id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Inactive<span>Account</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class="basic-details mediadetails">
                              <!--Left Panel Starts-->
                                  <section class=bscdtl-lft>
                                             <center><ul>
						    
                                                    <li style="margin-bottom:10px;">
						<div class="refQuestion" style="font-size:15px;"><?php echo $_SESSION['Auth']['User']['name'] ?>, your account is not active.</div>
						</li>
						<li style="margin-bottom:-10px;">
						<div class="refQuestion" style="font-size:15px;">Vimbli will retain inactive accounts for 12 months.</div>
						</li>
						<li style="margin-bottom:-10px; margin-top:10px;">
						<div class="refQuestion" style="font-size:15px;">If you don't activate the account</div>
                                                </li>
                                                <li style="margin-bottom:-10px; margin-top:10px;">
						<div class="refQuestion" style="font-size:15px;">before the 12 months expires your data</div>
                                                </li>
                                                <li style="margin-bottom:10px; margin-top:10px;">
						<div class="refQuestion" style="font-size:15px;">will be deleted.</div>
                                                </li>
                                                <li style="margin-bottom:10px; margin-top:10px;">
						<div class="refQuestion" style="font-size:15px;">Your data will be deleted on <?php echo date('M. d, Y',strtotime($acDelDate)); ?></div>
                                                </li>
                                                
                                            </ul></center>
				<div style="clear:both;"></div><br>
                                <center><div>
				<?php echo $this->Html->link($this->Html->image('activate_now.png', array('alt'=>"Activate Now", 'title'=>"Active",'class'=>'acivate_now') ),array('controller'=>'payments','action'=>'subscription_plans',base64_encode($_SESSION['Auth']['User']['id'])),array('escape'=>false,'class'=>''), false);?>
				&nbsp;&nbsp<?php echo $this->Html->link($this->Html->image('delete_now.png', array('alt'=>"Activate Now", 'title'=>"Active",'class'=>'acivate_now') ),array('controller'=>'users','action'=>'delete_user/'.base64_encode($_SESSION['Auth']['User']['id'])),array('escape'=>false,'class'=>''), false);?>
				</div></center>
                              <br>
                              
                         
                        </section> 
                         </section> 
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
<script>
	jQuery(document).ready(function(){
		//alert("hiihi");  
	jQuery(".activate_now").click(function(){
	    jQuery(".signup-pane").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
	});  
	});
</script>