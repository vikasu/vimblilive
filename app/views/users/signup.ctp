<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript">
$(document).ready(function() {
<?php if($gotopaypal==1){ ?>
document.forms["userpay"].submit();
<?php } ?>
});
</script>
<?php echo $javascript->link('users/usersignup.js');?>


<?php  echo $this->Form->create('User',array('action'=>'signup/', 'id'=>'signupform', 'name'=>'signupform')); ?>
<div id="adminWrapper">
	<?php if($gotopaypal==0){ ?>
	<table width="42%" cellspacing="0" cellpadding="0" border="0" align="center">
        
        <tr class="signin_title">
            <!-- <td align="left" width="10%">
				<img alt="Lock Icon" src="/img/lock_icon.gif">
			</td> -->
			<td colspan="2"><h2>User Signup</h2></td>
        </tr>
        
        <tr>
          <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="15" /></td>
            </tr>
            <tr>
              <td align="left" colspan="2">Email:</td>
            </tr>
            <tr>
              <td align="left" colspan="2">
              		<?php echo $this->Form->input('User.email', array('class'=>'inpttextarealogin','label' => false,'div'=>false,'value' => '', 'size' => '20','style'=>"width:234px;"));?>
              </td>
            </tr>
            <tr>
              <td align="left" colspan="2">Password:</td>
            </tr>
            <tr>
              <td align="left" colspan="2">
                 <?php echo $form->input('User.password', array('class'=>'inpttextarealogin','label' => false,'div'=>false, 'value' => '','style'=>"width:234px;",'size' => '20'));?>
              	<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              	</td>
              
            </tr>
            <tr>
              <td align="left" colspan="2">Confirm Password:</td>
            </tr>
            <tr>
              <td align="left" colspan="2">
                 <?php echo $form->input('User.passwordconfirm', array('class'=>'inpttextarealogin','label' => false,'div'=>false, 'value' => '','style'=>"width:234px;",'size' => '20','type'=>'password'));?>
              	<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              	</td>
              
            </tr>			                  
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="10" /></td>
            </tr>
            <tr>
              <td align="left" width="25%"><input type="submit" value="Sign up" class="button" style="width:70px;"/><div class="buttonEnding"></div></td>
              <td align="left" width="75%">        	

			  </td>
            </tr>
          	  
          </table></td>
        </tr>
	</table>
	<?php } ?>
	<div style="float: left; margin-left: 170px;">
	 <?php 
		echo $session->flash();
	  ?>
	</div>
</div>
<?php echo $this->Form->end();?>

<?php if($gotopaypal==1){ ?>
<form name="userpay" id="userpay" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
	<input type="hidden" name="cmd" value="_xclick-subscriptions">
	<input type="hidden" name="rm" value="2">
	<input type="hidden" name="business" value="sunsel_1313730966_biz@smartdatainc.net">
	<input type="hidden" name="item_name" value="vimbli"> <!-- Plan name with description -->
	<input type="hidden" name="item_number" value="1">
	<input type="hidden" name="no_shipping" value="1">
	<input type="hidden" name="notify_url" value="<?php echo $paypalPageURI; ?>/paypal_ipn/process">
	<input type="hidden" name="return" value="<?php echo $paypalPageURI; ?>/paypal_ipn/process">
	<input type="hidden" name="type" value="paynow">
	<input type="hidden" name="cancel_return" value="">
	<input type="hidden" name="a3" value="<?php echo $subscriptionAmount;?>"> <!-- Deduction after 1st month -->
	<input type="hidden" name="p3" value="1">
	<input type="hidden" name="t3" value="M">
	<input type="hidden" name="src" value="1">
	<input type="hidden" name="sra" value="1">
	<input type="hidden" name="no_note" value="1">
	<input name="currency_code" value="USD" type="hidden">
	<input name="lc" value="US" type="hidden">									
	<input type="hidden" name="usr_manage" value="1">
	<input type="hidden" name="custom" value="<?php echo $subscemail.'##vimblisplit##'.$subscpass ?>">
</form>
<?php } ?>




