<div class="header">
    <!-- logo -->
    <?php echo $html->link($html->image('logo.png'),'/admin/admins/dashboard',array('escape' => false,'style'=>'font-weight:bold;font-size:20px;'));?>
    <?php echo $this->element('adminLayout/menu'); ?>    
    <div class="accountinfo">
        <img src="<?php echo SITE_URL ?>img/settings.png" width="60" alt="admin" style="border:1px solid #999; background:#666;"/>
        <div class="info">
            <h3>Welcome <?php  echo ucwords($LoggedInUserinfo["Admin"]["name"]); ?></h3>
		<p>
		    <?php //echo  $this->Html->link('Settings', array('controller'=>'admins','action'=>'setting','prefix'=>'admin','plugin'=>false),array('escape'=>false,'title'=>'Logout','alt'=>'Settings'), false ); ?>
		    <?php echo  $this->Html->link('Logout', array('controller'=>'admins','action'=>'logout','prefix'=>'admin','plugin'=>false),array('escape'=>false,'title'=>'Logout','alt'=>'Logout'), false ); ?>
		</p>
        </div><!-- info -->
    </div><!-- accountinfo -->
</div><!-- header -->