<div class="users form">
<?php echo $this->Form->create('Admin');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('User.id');
		echo $this->Form->input('User.name');?>

		<div class="input text">
		<label for="UserBioEmploymentStatus">Gender</label>
		
		<?php $options=array('M'=>'Male','F'=>'Female');
		$attributes=array('legend'=>false);
		echo $this->Form->radio('UserBio.gender',$options,$attributes);		//echo $this->Form->input('UserBio.gender');?>
		
		</div>		
		<?php 
		echo $this->Form->input('UserBio.city');
		echo $this->Form->input('UserBio.state');
		echo $this->Form->input('UserBio.country');
		echo $this->Form->input('UserBio.zip');
		
		//echo $this->Form->input('UserBio.relationship_status');?>

		<div class="input text">
			<label for="UserBioEmploymentStatus">Relationship Status</label>
			<?php echo $this->Form->select('UserBio.relationship_status',$this->requestAction('/commons/relationShipList'),null,array('empty'=>'select'));?>
		</div>
		
		<div class="input text">
			<label for="UserBioEmploymentStatus">Household Income</label>
			<?php echo $this->Form->select('UserBio.household_income',$this->requestAction('/commons/incomeList'),null,array('empty'=>'select'));?>
		</div>
		
		<div class="input text">
			<label for="UserBioEmploymentStatus">Highest Education</label>
			<?php echo $this->Form->select('UserBio.education_highest',$this->requestAction('/commons/educationList'),null,array('empty'=>'select'));?>
		</div>
		
		<div class="input text">
			<label for="UserBioEmploymentStatus">Employment Status</label>
			<?php echo $this->Form->select('UserBio.employment_status',$this->requestAction('/commons/employementList'),null,array('empty'=>'select'));?>
		</div>
		
		
		<?php //echo $this->Form->input('UserBio.household_income');
		
		
		//echo $this->Form->input('UserBio.education_highest');
		//echo $this->Form->input('UserBio.employment_status');?>

		<div class="input text">
			<label for="UserBioEmploymentStatus">Employemet Industry</label>
			<?php echo $this->Form->select('UserBio.employment_industry',$this->requestAction('/commons/industryList'),null,array('empty'=>'select'));?>
		</div>
		
		<div class="input text">
			<label for="UserBioEmploymentStatus">Work Type</label>
			<?php echo $this->Form->select('UserBio.work_type',$this->requestAction('/commons/workList'),null,array('empty'=>'select'));?>
		</div>
		
		
	<?php 		
		//echo $this->Form->input('UserBio.employment_industry',);
		//echo $this->Form->input('UserBio.work_type');
		echo $this->Form->input('UserBio.religion_view');
		echo $this->Form->input('UserBio.political_view');
		echo $this->Form->input('UserBio.weight_current');
		echo $this->Form->input('UserBio.living_arrangement');
	
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<!--  <div class="actions">
	<h3><?php // __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php //echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>-->