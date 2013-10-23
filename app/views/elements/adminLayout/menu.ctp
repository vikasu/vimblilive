<?php 
if(isset($currentmenu)){
	switch($currentmenu){
		case "DESHBOARD" :
			$m1 = 'class="current"';
			break;
		case "ADMIN MANAGEMENT" :
			$m2 = 'class="current"';
			break;
		case  "USER" :
			$m3 = 'class="current"';
			break;
	}
}
?>
<div class="tabmenu">
        <ul>
            <li <?php if(isset($m1)){ echo $m1;} ?>>
			<?php echo $html->link('<span>Dashboard</span>','/admin/admins/dashboard',array('escape' => false,'class'=>'dashboard'));?>
            </li>
            <li <?php if(isset($m2)){ echo $m2;} ?>>
                <?php echo $html->link("<span>Admin Management</span>","javascript::void();",array('escape' => false,'class'=>'elements'));?>
		<ul class="subnav" style="visibility: hidden; display: block;">
		    <li><?php echo $html->link('<span>Manage Admin Staff</span>','/admin/admins/index',array('escape' => false,'class'=>''));?></li>
		    <li><?php //echo $html->link('<span>Edit Account</span>','/admin/admins/edit_account',array('escape' => false,'class'=>''));?></li>
		    <li><?php echo $html->link('<span>Change Password</span>','/admin/admins/change_password',array('escape' => false,'class'=>''));?></li>
		</ul>
            </li>
	    <li <?php if(isset($m3)){ echo $m3;} ?>>
                <?php echo $html->link('<span>Users</span>',"javascript::void();",array('escape' => false,'class'=>'users'));?>
		<ul class="subnav" style="visibility: hidden; display: block;">
		    <li><?php echo $html->link('<span>Manage Users</span>','/admin/users',array('escape' => false,'class'=>''));?></li>
		</ul>
	    </li>
            <li>
               <?php echo $html->link('<span>Subscription</span>','javascript::void();',array('escape' => false,'class'=>'reports'));?>
	       <ul class="subnav" style="visibility: hidden; display: block;">
		    <li><?php echo $html->link('<span>Manage Promotional Codes</span>','/admin/payments/index',array('escape' => false,'class'=>''));?></li>
		    <li><?php echo $html->link('<span>Manage Subscription Plans</span>','/admin/payments/subscription',array('escape' => false,'class'=>''));?></li>
		    <li><?php echo $html->link('<span>View Transaction</span>','/admin/payments/transaction',array('escape' => false,'class'=>''));?></li>
		</ul>
            </li>
            
	    
        </ul>

</div><!-- tabmenu -->