<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  

<?php echo $javascript->link('admins/resetpassword.js');?>

<?php  echo $this->Form->create('Admin',array('method'=>'post','action'=>'/resetpassword/'.$token,'id'=>'resetpass', 'name'=>'resetpass')); ?>
<div id="adminWrapper">
	<table width="42%" cellspacing="0" cellpadding="0" border="0" align="center">
    	<!-- <tr>
        	<td colspan="2"><img src="/img/spacer.gif" alt="" width="1" height="80" /></td>
        </tr> -->
        <tr class="signin_title">
            <td align="left"><h2>Reset Password</h2></td>
            <td align="right" valign="middle"></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="15" /></td>
            </tr>
            <tr>
              <td width="70%" align="left">New Password:</td>
              <td width="30%">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">
              		<?php echo $this->Form->input('Admin.newPwd', array('label' => false,'type'=>'password','div'=>false,'value' => '', 'size' => '20','style'=>"width:234px;"));?>
              		<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              </td>
              <td align="left" class="sigin_link"><!-- <a href="#">Forgot Username</a> --></td>
            </tr>
            <tr>
              <td align="left">Re-Enter New Password:</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">
                 <?php echo $form->input('Admin.resetPwd', array('label' => false,'type'=>'password','div'=>false, 'value' => '','style'=>"width:234px;",'size' => '20'));?>
              	<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              	</td>
              
            </tr>
                       
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="10" /></td>
            </tr>
            <tr>
              <td align="left">
              	<input type="submit" value="Reset" class="button" style="width:60px;"/><div class="buttonEnding"></div>
              	&nbsp;&nbsp;
             	<input type="button" value="Cancel" class="button" style="width:60px;" onclick="javascript:location.href='/admins/login'"/><div class="buttonEnding"></div>
              </td>
              <td align="left">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
	</table>
	
	<div style="float: left; margin-left: 170px;">
	 <?php 
		echo $session->flash();
	  ?>
	</div>
	
</div>
<?php echo $this->Form->end();?>







