<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title><?php echo 'Vimbli :: '.$pagetitle ?></title>
    <?php
        echo $this->Html->css('admin'); 
	echo $this->Html->script(array('jquery-1.7.2.min','frontend.js'));
    ?>
</head>
<body>
<div style="display:block; text-align:center;">
	<div class="loginlogo">
	    <?php echo $html->image('logo-180.png'); ?>
            <!--<p style="font-size:28px;font-weight:bold;color:white;">Vimbli</p> -->
            <p style="font-size:14px;font-weight:bold;color:white;">Administrator Login</p>
        </div><!--loginlogo-->
		    
        <?php echo $this->element("message/errors");?>  
	<div style="display:block;font-weight:bold;" class="notification notifyError loginNotify"> 
            <?php echo $this->Session->flash();echo $this->Session->flash('auth');?>
        </div>
	 
	<?php echo $this->Form->create("Admin",array("controller"=>'admins',"action"=>'admin_login',"prefix"=>"admin","method"=>"POST",'id'=>'admin_login')); ?>
	<div class="loginbox">
	    <div class="loginbox_inner">
	        <div class="loginbox_content">
		    <?php echo $this->Form->input('Admin.email',array('label'=>false,'div'=>false,'id'=>'username', 'size'=>50,'class'=>'username','style'=>"background-position: 0pt -32px;",'title'=>'')); ?>
		    <?php echo $this->Form->input('Admin.password',array('label'=>false,'div'=>false,'id'=>'password','size'=>50,'class'=>'password','value'=>'','style'=>"background-position: 0pt -32px;")); ?>
		    <?php echo $this->Form->submit('Login',array('class'=>'submit','div'=>false,'label'=>false)); ?>
		</div><!--loginbox_content-->
	    </div><!--loginbox_inner-->
	</div><!--loginbox-->
    
	<div class="loginoption">
		<?php //echo $this->Html->link('Forgot Password?',array('controller'=>'users','action'=>'forgetpassword','admin' => 'true'),array('class'=>'cant'));?>
		<?php //echo $form->input('remember_me', array('label' => 'remember me on this site', 'type' => 'checkbox'));?>
	</div><!--loginoption-->
	<?php echo $this->Form->end(); ?>
	
</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>