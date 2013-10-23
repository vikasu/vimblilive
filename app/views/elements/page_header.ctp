<header>
	<a href="#" title="" class="logo">Vimbli</a>
	<div class="right_hdr">
		<div style="width:400px; float:right">
			<div class="logo_btn" style="float:right">
				<?php
					$userLoginAppSession = $this->Session->read('userAppLoginSession');
					if(!empty($userLoginAppSession)){
				?>
					<input type="button" onclick="javascript:location.href='/users/myprofile'" style="width: 91px;" class="button" value="My Profile"><div class="buttonEnding"></div>
				<?php }else{ ?>
				<input type="button" onclick="javascript:location.href='/users/login'" style="width: 75px;" class="button" value="Login"><div class="buttonEnding"></div>
				<?php } ?>
			</div>
			&nbsp;
			<?php
				$userLoginAppSession = $this->Session->read('userAppLoginSession');
				if(empty($userLoginAppSession)){
			?>
			<div class="logo_btn" style="float:right">
				<input type="button" onclick="javascript:location.href='/users/signup'" style="width: 75px;" class="button" value="Signup"><div class="buttonEnding"></div>
			</div>
			<?php } ?>			
		</div>
		<div class="clear"></div>
		<ul class="nav">

		    <?php $urlarry = explode('/',$_SERVER["REQUEST_URI"]);
		    	  if(isset($urlarry[2])){}else{$urlarry[2]='home';}
		    ?>
			<?php foreach($headerPageDetails as $headerPageDetails){?>
				<li>
					<a <?php if($urlarry[2]==$headerPageDetails['Cmspage']['page_title']){?> class="active" <?php }?>   href="/pages/<?php echo $headerPageDetails['Cmspage']['page_title'];?>" title="<?php echo $headerPageDetails['Cmspage']['content_type'];?>">
						<?php echo ucfirst($headerPageDetails['Cmspage']['content_type']);?>
					</a>
				</li>
			<?php }?>
		</ul>
	</div>
	<div class="clear"></div>
</header>

