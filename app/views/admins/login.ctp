<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<?php echo $javascript->link('admins/login.js');?>

<?php  echo $this->Form->create('Admin',array('action'=>'login/', 'id'=>'loginform', 'name'=>'loginform')); ?>
<div id="adminWrapper">
	<table width="42%" cellspacing="0" cellpadding="0" border="0" align="center">
        <tr class="signin_title">
            <td align="left" colspan="2">
				<img src="/img/lock_icon.gif" alt="Lock Icon" />
				&nbsp;
				<h2>Sign in</h2>
			</td>
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
              		<?php echo $this->Form->input('Admin.email', array('label' => false,'div'=>false,'value' => '', 'size' => '20','style'=>"width:234px;"));?>
              </td>
            </tr>
            <tr>
              <td align="left" colspan="2">Password:</td>
            </tr>
            <tr>
              <td align="left" colspan="2">
                 <?php echo $form->input('Admin.password', array('label' => false,'div'=>false, 'value' => '','style'=>"width:234px;",'size' => '20'));?>
              	<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              	</td>
              
            </tr>
            <tr>
              <td align="left" colspan="2">
              <?php echo $this->Form->checkbox('rememberme'); echo "Remember Me";?>
				&nbsp;&nbsp;&nbsp;
              	<span class="sigin_link"><a href="/admins/forgotpassword/">Forgot Password</a></span>
              </td>
            </tr>
           
            
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="10" /></td>
            </tr>
            <tr>
              <td align="left" width="25%"><input type="submit" value="Sign In" class="button" style="width:60px;"/><div class="buttonEnding"></div></td>
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





