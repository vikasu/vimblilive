<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<?php echo $javascript->link('users/changepass.js');?>
<?php  echo $this->Form->create('User',array('action'=>'changepassword/', 'id'=>'changepassform', 'name'=>'changepassform')); ?>
<div id="adminWrapper">
	<table width="42%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tr class="signin_title">
            <td align="left" colspan="2">
				<!-- <img src="/img/lock_icon.gif" alt="Lock Icon" /> -->
				&nbsp;
				<span class="spnclass">Change Password</span>
			</td>
        </tr>
        
        <tr>
          <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="15" /></td>
            </tr>
            
            <tr>
              <td align="left" colspan="2">Old Password:</td>
            </tr>
            <tr>
              <td align="left" colspan="2">
                 <?php echo $form->input('User.oldpassword', array('label' => false,'div'=>false, 'value' => '','class'=>"inpttextarealogin",'type'=>'password','size' => '20'));?>
              </td>
              
            </tr>
            
            
            <tr>
              <td align="left" colspan="2">New Password:</td>
            </tr>
            <tr>
              <td align="left" colspan="2">
              	 <?php  echo $this->Form->input('User.id',array('type'=>'hidden')); ?>	
                 <?php echo $form->input('User.newpassword', array('label' => false,'div'=>false, 'value' => '','class'=>"inpttextarealogin",'type'=>'password','size' => '20'));?>
              </td>
              
            </tr>

            <tr>
              <td align="left" colspan="2">Confirm Password:</td>
            </tr>
            <tr>
              <td align="left" colspan="2">
                 <?php echo $form->input('User.connewpassword', array('label' => false,'div'=>false, 'value' => '','class'=>"inpttextarealogin",'type'=>'password','size' => '20'));?>
              </td>
              
            </tr>
            
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="10" /></td>
            </tr>
            <tr>
              <td align="left" width="25%">
                <div>
    				<input type="submit" value="Change Password" class="button" style="width:150px;"/><div class="buttonEnding"></div>
				</div>
              <td align="left" width="75%">        	

			  </td>
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

<div class="clear"></div>