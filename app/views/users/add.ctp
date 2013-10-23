<?php 
include(WWW_ROOT.'js'.DS.'fckeditor'.DS.'fckeditor.php');
 ?>

<?php
$oFCKeditor = new FCKeditor('data[User][fckeditor]','fckeditor') ;
$oFCKeditor->BasePath	= '/js/fckeditor/';
$oFCKeditor->Width		= '70%' ;
$oFCKeditor->Height		= '300' ;
$oFCKeditor->Value		= '<p>This is some <strong>sample text</strong>. You are using <a href="http://www.fckeditor.net/">FCKeditor</a>.</p>' ;
$oFCKeditor->Create() ;	
?>


<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('gmail_token');
		echo $this->Form->input('join_date');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('country');
		echo $this->Form->input('user_type');
		echo $this->Form->input('user_status');
		echo $this->Form->input('remember_date');
		echo $this->Form->input('unique_device_id');
		
	
	?>
	
	<textarea name="data[Content][content]" rows="5" cols="25" id="ContentBody" ></textarea>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>