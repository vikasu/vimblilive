<header>
	<a href="#" title="" class="logo">Vimbli</a>
	<div class="right_hdr">
	<?php 
		
		$urlarry = explode('/',$_SERVER["REQUEST_URI"]);
		//pr($urlarry);
		
		$userLoginAppSession = $this->Session->read('userAppLoginSession');
		$msgData = $this->requestAction("/commons/countUnreadMsgById/$userLoginAppSession[0]");
		if(isset($userLoginAppSession) && !empty($userLoginAppSession)){?>
		<div style="float:right;">
			<span class="welocmediv">
				<b>Welcome <?php echo ucfirst($userLoginAppSession[1]);?></b>
			</span>
			
			<div class="logo_btn">
    			<input type="button" value="Logout" class="button" style="width:75px;" onclick="javascript:location.href='/users/logout'"/><div class="buttonEnding"></div>
			</div>
		</div>
		
		<div class="clear"></div>
		
		<ul class="nav">
			<li>
				<a title="My Profile" href="/users/myprofile" <?php if($urlarry[2]=='myprofile'){?>class="active" <?php }?> >
					My Profile					
				</a>
			</li>
			
			<li>
				<a title="Change Password" href="/users/changepassword" <?php if($urlarry[2]=='changepassword'){?>class="active" <?php }?> >
					Change Password					
				</a>
			</li>
			
			<li>
				<a title="Message" href="/users/message" <?php if($urlarry[2]=='message' || $urlarry[2]=='showmessage' || $urlarry[2]=='replymessage'){?>class="active" <?php }?> >
					Messages(<?php echo count($msgData); ?>)	
								
				</a>
			</li>
			
			 <li>
				<a title="Connectivity" href="/users/connections" <?php if($urlarry[2]=='connections' || $urlarry[2]=='editconnections'){?>class="active" <?php }?>>
					Connectivity
				</a>
			</li> 
			
			<li>
				<a title="Time Goal" title="Time Goal" href="/users/timegoal" <?php if($urlarry[2]=='timegoal'){?>class="active" <?php }?>>
					Time Goal
				</a>
			</li>			
			
		</ul><?php }?>
	</div>
	<div class="clear"></div>
</header>