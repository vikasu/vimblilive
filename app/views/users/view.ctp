<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Gmail Token'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['gmail_token']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Join Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['join_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['city']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['state']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['country']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['user_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['user_status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Remember Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['remember_date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unique Device Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['unique_device_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Allocate Times', true), array('controller' => 'allocate_times', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Allocate Time', true), array('controller' => 'allocate_times', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setup Communications', true), array('controller' => 'setup_communications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setup Communication', true), array('controller' => 'setup_communications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setup Connectivities', true), array('controller' => 'setup_connectivities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setup Connectivity', true), array('controller' => 'setup_connectivities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setup Datasources', true), array('controller' => 'setup_datasources', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setup Datasource', true), array('controller' => 'setup_datasources', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setup Environments', true), array('controller' => 'setup_environments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setup Environment', true), array('controller' => 'setup_environments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setup Selfcares', true), array('controller' => 'setup_selfcares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setup Selfcare', true), array('controller' => 'setup_selfcares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setup Timecares', true), array('controller' => 'setup_timecares', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setup Timecare', true), array('controller' => 'setup_timecares', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suggestions', true), array('controller' => 'suggestions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Suggestion', true), array('controller' => 'suggestions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Wrapups', true), array('controller' => 'user_wrapups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Wrapup', true), array('controller' => 'user_wrapups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Allocate Times');?></h3>
	<?php if (!empty($user['AllocateTime'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Activity Id'); ?></th>
		<th><?php __('Time Spent'); ?></th>
		<th><?php __('Rating'); ?></th>
		<th><?php __('Today Date'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['AllocateTime'] as $allocateTime):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $allocateTime['id'];?></td>
			<td><?php echo $allocateTime['user_id'];?></td>
			<td><?php echo $allocateTime['activity_id'];?></td>
			<td><?php echo $allocateTime['time_spent'];?></td>
			<td><?php echo $allocateTime['rating'];?></td>
			<td><?php echo $allocateTime['today_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'allocate_times', 'action' => 'view', $allocateTime['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'allocate_times', 'action' => 'edit', $allocateTime['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'allocate_times', 'action' => 'delete', $allocateTime['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $allocateTime['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Allocate Time', true), array('controller' => 'allocate_times', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Setup Communications');?></h3>
	<?php if (!empty($user['SetupCommunication'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Wrap Up Time'); ?></th>
		<th><?php __('Weekly Summary Day'); ?></th>
		<th><?php __('Weekly Summary Time'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['SetupCommunication'] as $setupCommunication):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setupCommunication['id'];?></td>
			<td><?php echo $setupCommunication['user_id'];?></td>
			<td><?php echo $setupCommunication['wrap_up_time'];?></td>
			<td><?php echo $setupCommunication['weekly_summary_day'];?></td>
			<td><?php echo $setupCommunication['weekly_summary_time'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setup_communications', 'action' => 'view', $setupCommunication['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setup_communications', 'action' => 'edit', $setupCommunication['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setup_communications', 'action' => 'delete', $setupCommunication['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setupCommunication['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setup Communication', true), array('controller' => 'setup_communications', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Setup Connectivities');?></h3>
	<?php if (!empty($user['SetupConnectivity'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Touches'); ?></th>
		<th><?php __('Contact Name'); ?></th>
		<th><?php __('Contact Phone'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['SetupConnectivity'] as $setupConnectivity):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setupConnectivity['id'];?></td>
			<td><?php echo $setupConnectivity['user_id'];?></td>
			<td><?php echo $setupConnectivity['touches'];?></td>
			<td><?php echo $setupConnectivity['contact_name'];?></td>
			<td><?php echo $setupConnectivity['contact_phone'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setup_connectivities', 'action' => 'view', $setupConnectivity['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setup_connectivities', 'action' => 'edit', $setupConnectivity['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setup_connectivities', 'action' => 'delete', $setupConnectivity['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setupConnectivity['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setup Connectivity', true), array('controller' => 'setup_connectivities', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Setup Datasources');?></h3>
	<?php if (!empty($user['SetupDatasource'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Ds Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['SetupDatasource'] as $setupDatasource):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setupDatasource['id'];?></td>
			<td><?php echo $setupDatasource['user_id'];?></td>
			<td><?php echo $setupDatasource['ds_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setup_datasources', 'action' => 'view', $setupDatasource['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setup_datasources', 'action' => 'edit', $setupDatasource['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setup_datasources', 'action' => 'delete', $setupDatasource['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setupDatasource['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setup Datasource', true), array('controller' => 'setup_datasources', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Setup Environments');?></h3>
	<?php if (!empty($user['SetupEnvironment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Env Id'); ?></th>
		<th><?php __('Value'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['SetupEnvironment'] as $setupEnvironment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setupEnvironment['id'];?></td>
			<td><?php echo $setupEnvironment['user_id'];?></td>
			<td><?php echo $setupEnvironment['env_id'];?></td>
			<td><?php echo $setupEnvironment['value'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setup_environments', 'action' => 'view', $setupEnvironment['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setup_environments', 'action' => 'edit', $setupEnvironment['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setup_environments', 'action' => 'delete', $setupEnvironment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setupEnvironment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setup Environment', true), array('controller' => 'setup_environments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Setup Selfcares');?></h3>
	<?php if (!empty($user['SetupSelfcare'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Avtivity Id'); ?></th>
		<th><?php __('Time Spent'); ?></th>
		<th><?php __('Keywords'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['SetupSelfcare'] as $setupSelfcare):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setupSelfcare['id'];?></td>
			<td><?php echo $setupSelfcare['user_id'];?></td>
			<td><?php echo $setupSelfcare['avtivity_id'];?></td>
			<td><?php echo $setupSelfcare['time_spent'];?></td>
			<td><?php echo $setupSelfcare['keywords'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setup_selfcares', 'action' => 'view', $setupSelfcare['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setup_selfcares', 'action' => 'edit', $setupSelfcare['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setup_selfcares', 'action' => 'delete', $setupSelfcare['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setupSelfcare['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setup Selfcare', true), array('controller' => 'setup_selfcares', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Setup Timecares');?></h3>
	<?php if (!empty($user['SetupTimecare'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Productive Time Slot'); ?></th>
		<th><?php __('Schedule Level'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['SetupTimecare'] as $setupTimecare):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $setupTimecare['id'];?></td>
			<td><?php echo $setupTimecare['user_id'];?></td>
			<td><?php echo $setupTimecare['productive_time_slot'];?></td>
			<td><?php echo $setupTimecare['schedule_level'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'setup_timecares', 'action' => 'view', $setupTimecare['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'setup_timecares', 'action' => 'edit', $setupTimecare['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'setup_timecares', 'action' => 'delete', $setupTimecare['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $setupTimecare['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Setup Timecare', true), array('controller' => 'setup_timecares', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Suggestions');?></h3>
	<?php if (!empty($user['Suggestion'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Sugg Type'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Sugg Content'); ?></th>
		<th><?php __('Sugg Status'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Suggestion'] as $suggestion):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $suggestion['id'];?></td>
			<td><?php echo $suggestion['sugg_type'];?></td>
			<td><?php echo $suggestion['user_id'];?></td>
			<td><?php echo $suggestion['sugg_content'];?></td>
			<td><?php echo $suggestion['sugg_status'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'suggestions', 'action' => 'view', $suggestion['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'suggestions', 'action' => 'edit', $suggestion['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'suggestions', 'action' => 'delete', $suggestion['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $suggestion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Suggestion', true), array('controller' => 'suggestions', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related User Wrapups');?></h3>
	<?php if (!empty($user['UserWrapup'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Today Mood'); ?></th>
		<th><?php __('Tomrr Mood'); ?></th>
		<th><?php __('Memorable Thought'); ?></th>
		<th><?php __('Today Date'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['UserWrapup'] as $userWrapup):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userWrapup['id'];?></td>
			<td><?php echo $userWrapup['user_id'];?></td>
			<td><?php echo $userWrapup['today_mood'];?></td>
			<td><?php echo $userWrapup['tomrr_mood'];?></td>
			<td><?php echo $userWrapup['memorable_thought'];?></td>
			<td><?php echo $userWrapup['today_date'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'user_wrapups', 'action' => 'view', $userWrapup['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'user_wrapups', 'action' => 'edit', $userWrapup['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'user_wrapups', 'action' => 'delete', $userWrapup['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userWrapup['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Wrapup', true), array('controller' => 'user_wrapups', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
