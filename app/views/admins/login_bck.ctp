<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  


<script type="text/javascript">
// validate signup form on keyup and submit

     $(document).ready(function($) {
       $("#loginform").validate({
         rules: { 
 	         "data[Admin][email]": {
					required: true,
					email: true
					//remote: "emails.php"
				},
				"data[Admin][password]": {
					required: true,
					minlength: 6
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

<?php 
	echo $session->flash();
?>

<div class="users form">
<?php  echo $form->create('Admin',array('action'=>'login/', 'id'=>'loginform', 'name'=>'loginform')); ?>
	<fieldset>
		<legend><?php __('Admin Login'); ?></legend>
	<?php
		//echo $this->Form->input('email');
		echo $form->input('Admin.email', array('label' => '', 'value' => '', 'size' => '20'));
		echo "<div class='clear'></div>";
		//echo $this->Form->input('password');
		echo $form->input('Admin.password', array('label' => '', 'value' => '', 'size' => '20'));

		echo '<div style=float:left> Remember Me'.$this->Form->checkbox('rememberme').'&nbsp;&nbsp;&nbsp;&nbsp;<a href="/admins/forgotpassword">Forgot Password</a></div>';
		
		//echo $form->input("Admin.date1", array('class' => '', 'div' => false, 'label' => '', 'size' => '15','type' => 'text','error' => false,'readonly'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>

</div>





