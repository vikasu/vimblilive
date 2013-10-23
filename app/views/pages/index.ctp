<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<?php 
 	echo $javascript->link('users/contactus.js');
?>
<?php //echo phpinfo();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
  //echo $javascript->link('documents/index.js');
?>
<?php 
      if($session->check('Message.flash')) { echo $session->flash(); }
  ?> 
  
<?php if($isContactus=='no'){echo $pageContent;} 
      if($isContactus=='yes')
      {
?>          
<div style="float: right; width:470px;">
<?php echo $form->create("User", array('class' => '',"action" => "submit_contact/", 'name' => 'contactus', 'id' =>'contactus')); 
		
	$sessionval = $this->Session->read("contactusval");
	if(!empty($sessionval))
	{
		$s_name = $sessionval['Contactus']['sender_name']!=''?$sessionval['Contactus']['sender_name']:'';
		$s_email = $sessionval['Contactus']['sender_email'] !=''?$sessionval['Contactus']['sender_email']:'';
		$s_subject = $sessionval['Contactus']['subject']!=''?$sessionval['Contactus']['subject']:'' ;
		$query = $sessionval['Contactus']['query']!=''?$sessionval['Contactus']['query']:'';
		$ver_code_val = $sessionval['Contactus']['ver_code']!=''?$sessionval['Contactus']['ver_code']:''; 
	}
	else
	{
		$s_name='';$s_email='';$s_subject='';$query='';$ver_code_val='';
	}	
?>            
            <table cellspacing="0" cellpadding="0" width="100%">
                <tbody>
                    <?php if ($session->check('Message.flash')) { ?>
                    <tr>
                        <td colspan="2" align="center"><?php echo $session->flash(); ?></td>
                    </tr>  
                     <?php } ?>
                    <tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>    
                        <td align="left" valign="top" width="10%">Name<span style="color: red;"><sup>*</sup></span> :</td>
                        <td width="70%">
                            <span class="inpt">
                                <span>       
                                    <?php echo $form->input("Contactus.sender_name", array('class' => 'inpt', 'div' => false, 'label' => '', 'size' => '25','type' => 'text','value'=>$s_name))?>
                                </span>
                                <span class="inpt_rtspan"></span> 
                            </span>    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">Email<span style="color: red;"><sup>*</sup></span> :</td>
                        <td>
                            <span class="inpt">
                                <span>                               
                                    <?php echo $form->input("Contactus.sender_email", array('class' => 'inpt', 'div' => false, 'label' => '', 'size' => '25','type' => 'text','value'=>$s_email,'error' => false));?>  
                                </span>
                                <span class="inpt_rtspan"></span> 
                            </span>                            
                        </td>
                    </tr>
                    <tr>
                    <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">Subject<span style="color: red;"><sup>*</sup></span> :</td>
                        <td>
                            <span class="inpt">
                                <span>                               
                                    <?php echo $form->select("Contactus.subject",$this->requestAction("/commons/subjectType"),$s_subject, array('class' => 'inpt','div' => false, 'label' => '','empty'=>'select' ))?>  
                                </span>
                                <span class="inpt_rtspan"></span> 
                            </span>                             
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td align="left" valign="top">Message :</td>
                        <td>
				            <!-- <span style="display:inline-block; background-image:url('/img/txt-area-bg.jpg'); height:117px; width:279px;"> -->	
                            <?php echo $this->Form->input("Contactus.query", array('class' => 'inpttextarea', 'type' => 'textarea', 'div' => false,'value'=>$query,'cols'=>'17','size' => '25','label' => '','escape' => false)); ?>                            
                       		<!-- </span>-->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <!-- <tr>
                        <td align="left" valign="top">May we call you (if necessary) :</td>
                        <td> 
                              <?php //echo $this->Form->radio("User.callyou", array('Yes' => ' Yes', 'No' => ' No'), array('default' => 'Yes','legend' => false,'separator' => '&nbsp;&nbsp;')); ?>
                        </td>                    
                    <tr> -->
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    
                        <?php $capchVal = $this->Session->read("ver_code"); ?>
                        <?php echo $this->Form->input("Contactus.capchaval", array('type'=>'hidden','value'=>$capchVal)); ?>
                    	<?php echo $this->Form->input("Contactus.to_user_id", array('type'=>'hidden','value'=>1)); ?>	
                    <tr>
                        <td>&nbsp;</td>
                        <td><?php echo $html->image("captcha/".$captcha_src,array( "height"=>"50","width"=>"202")); ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <span class="inpt">
                                <span>				
                                    <?php echo $form->input('Contactus.ver_code', array('class' => 'inpt','size' => '25','value'=>$ver_code_val,'label' => false,'div' => false));?>
	 		        			</span>
                                <span class="inpt_rtspan"></span> 
                            </span>                            
                        </td>
                    </tr>                    
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>                    
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                        
                        	<input type="submit" class="button" value="Submit"><div class="buttonEnding"></div></td>
                    </tr>
                </tbody>
            </table>
<?php echo $form->end(); ?>
        </p></div><div style="float: left; width:430px;"><?php echo $pageContent;?></div>
<?php }elseif( $isIndex == "yes")
    { ?>
<?php  if ($session->check('Message.flash')) { ?>  
    <div  align="center" width="100%"><?php echo $session->flash(); ?></div>
<?php }} else{?>
			<div align="center">
				<img alt="Error page" src="/img/pagenotfound.jpg">
			</div>	
<?php }?>
<div class="clear"></div>
