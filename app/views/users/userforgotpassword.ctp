<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<!-- <script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
 -->

<script type="text/javascript">
// validate signup form on keyup and submit

     $(document).ready(function($) {
       $("#forgotpass").validate({
         rules: { 
 	         "data[User][email]": {
					required: true,
					email: true
					//remote: "emails.php"
				}
         },
         // the errorPlacement has to take the table layout into account
			errorPlacement: function(error, element) {
					error.appendTo( element.parent() );
			},
			// set this class to error-labels to indicate valid fields
			success: function(label) {
				// set &nbsp; as text for IE
				label.html("&nbsp;").addClass("checked");
			}
         
		  });      
      });
</script> 


<?php  echo $this->Form->create('User',array('id'=>'forgotpass', 'name'=>'forgotpass')); ?>
<div id="adminWrapper">
	<table width="42%" cellspacing="0" cellpadding="0" border="0" align="center">
    	<!-- <tr>
        	<td colspan="2"><img src="/img/spacer.gif" alt="" width="1" height="80" /></td>
        </tr> -->
        <tr class="signin_title">
            <td align="left"><h2>Forgot Password</h2></td>
            <td align="right" valign="middle"><!-- <img src="/img/lock_icon.gif" alt="Lock Icon" /> --></td>
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
              		<?php echo $this->Form->input('User.email', array('label' => false,'div'=>false,'value' => '', 'size' => '20','class'=>"inpttextarealogin"));?>
              		<!-- <input type="text" name="textfield" id="textfield" style="width:234px;" /> -->
              </td>
              <td align="left" class="sigin_link"><!-- <a href="#">Forgot Username</a> --></td>
            </tr>
			<tr>
              <td colspan="2" align="left"><img src="/img/spacer.gif" alt="" width="1" height="10" /></td>
            </tr>
            <tr>
              <td align="left">
              	<input type="submit" value="Get Password" class="button" style="width:90px;"/>
              	&nbsp;&nbsp;
             	<input type="button" value="Cancel" class="button" style="width:60px;" onclick="javascript:location.href='/users/login'"/>
              	
              </td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="left">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
	</table>
	<div style="float: left; margin-left: 130px;">
	 <?php 
		echo $session->flash();
	  ?>
	</div>
</div>
<?php echo $this->Form->end();?>

<div class="clear"></div>



