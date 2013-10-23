<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery("#importConnections").validationEngine();
        
        jQuery(".source").click(function(){
                jQuery(".source").css('font-weight','normal');
                jQuery(this).css('font-weight','bold');
                jQuery("#source").attr('value',jQuery(this).attr("id"));
        });
        
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
                      <!--SignUp Heading-->
                      <?php echo $this->element("message/errors");?>
                      <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                      
                      <div class="signup-hdng loginhdn"><h3 class=bebas>import  <span>connections</span></h3></div>
                      <!--SignUp Form Fields-->
                      <?php echo $this->Form->create("Connection",array("controller"=>'connections',"action"=>'import_connections',"method"=>"POST",'id'=>'importConnections')); ?>
                      <ul class=form-fields>
                        
                        <li><span class="source" id="gmail">Gmail</span><span class="source" id="yahoo" style="margin-left:20px;">Yahoo</span></li>
                        
                          <li><div class=textbox><span><?php echo $this->Form->input('Connection.email',array('placeholder'=>'Enter your email Address','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=textbox><span><?php echo $this->Form->input('Connection.password',array('placeholder'=>'Password','label'=>false,'div'=>false,'id'=>'password','class'=>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=signuplogin-btn><?php echo $this->Form->submit('Import',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></li>
                      </ul>
                      
                      <?php if(!empty($allContacts)){ ?>
                      <table width='100%' border='1' style="border-collapse: collapse;">
                        <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                        </tr>
                        
                        <?php foreach($allContacts as $contacts){ ?>
                        <tr>
                                <td><?php echo $contacts['Connection']['name']; ?></td>
                                <td><?php echo $contacts['Connection']['email']; ?></td>
                                <td><?php echo $contacts['Connection']['phone']; ?></td>
                        </tr>
                        <?php } ?>
                        
                      </table>
                      <?php } ?>
                      
                      <?php echo $this->Form->input('Connection.source',array('type'=>'hidden','value'=>'','id'=>'source')); ?>
                      
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