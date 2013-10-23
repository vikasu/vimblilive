<?php  echo $this->Form->create('Admin',array('action'=>'login/', 'id'=>'loginform', 'name'=>'loginform')); ?>
<div id="adminWrapper">
	<table width="42%" cellspacing="0" cellpadding="0" border="0" align="center">
    	<!-- <tr>
        	<td colspan="2"><img src="/img/spacer.gif" alt="" width="1" height="80" /></td>
        </tr> -->
        <tr class="signin_title">
            <td align="left"><h2>Sign in</h2></td>
            <td align="right" valign="middle"><img src="/img/lock_icon.gif" alt="Lock Icon" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="15" /></td>
            </tr>
            <tr>
              <td width="70%" align="left">Email:</td>
              <td width="30%">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">
              		<?php echo $this->Form->input('Admin.email', array('label' => false,'div'=>false,'value' => '', 'size' => '20','style'=>"width:234px;"));?>
              		<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              </td>
              <td align="left" class="sigin_link"><!-- <a href="#">Forgot Username</a> --></td>
            </tr>
            <tr>
              <td align="left">Password:</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="left">
                 <?php echo $form->input('Admin.password', array('label' => false,'div'=>false, 'value' => '','style'=>"width:234px;",'size' => '20'));?>
              	<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              	</td>
              <td align="left" class="sigin_link"><a href="#">Forgot Password</a></td>
            </tr>
            <tr>
              <td align="left">
              <?php echo $this->Form->checkbox('rememberme'); echo "Remember Me";?>
                 
              </td>
            </tr>
           
            
            <tr>
              <td colspan="2" align="left"><img src="images/spacer.gif" alt="" width="1" height="10" /></td>
            </tr>
            <tr>
              <td align="left"><input type="submit" value="Sign In" class="button" style="width:60px;"/><div class="buttonEnding"></div></td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="left">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
	</table>
</div>
<?php echo $this->Form->end();?>