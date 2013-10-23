<li class="space" style="padding-top:20px;"><h3 class=wrdspcn>Mission<span>Sponsorship (optional)</span></h3></li>
<ul id="padding" class="sp_listing">
	<?php if($_SESSION['sp_msz'] != ""){ ?>
	    <li class="flash_success" id="flash_success" style="width:96%"><?php echo $_SESSION['sp_msz'] ?></li>
	<?php }?>
	
	<li><b>List of possible sponsors
</b></li>
	
	<?php
	    $allsponsor = $this->requestAction('/missions/allSponsors');
	    //prx($);
	    foreach($allsponsor as $sponsor){
		//pr($sponsor);
		//pr($recentMission);die;
		
	    ?>
	<li class="space" style="">
		<span class="spn_radio">
		    <?php if($recentMission['Mission']['sponsor_id'] !='') { ?>
			<input type="radio" class="sp_invite_radio" name="data[Mission][sponsor_id]" value="<?php echo $sponsor['SponsorManager']['sponsor_id'] ?>" <?php if($sponsor['SponsorManager']['sponsor_id'] == $recentMission['Mission']['sponsor_id']){ ?> checked="checked" <?php } ?>>
		    <?php }else{ ?>
			    <input type="radio" class="sp_invite_radio" name="data[Mission][sponsor_id]" value="<?php echo $sponsor['SponsorManager']['sponsor_id'] ?>">
		    <?php } ?>
		</span>
		<span class="spn_name"><?php echo $sponsor['User']['name']?></span>
		
		<?php
			if($sponsor['SponsorManager']['sponsor_id'] == $recentMission['Mission']['sponsor_id'] ) {
			$status = $this->requestAction('/missions/sponsorStatus/'.$recentMission['Mission']['id']); ?>	
			<span class="spn <?php echo $sponsor['SponsorManager']['sponsor_id']?>" style="width: 100px"><?php echo $status?></span><span><img style ="cursor:pointer" class ="sponsordel" src="<?php echo SITE_URL?>img/icons/small/black/close.png" id="<?php echo $sponsor['SponsorManager']['id']?>"/></span>
		<?php }else{?>
			<span class="spn <?php echo $sponsor['SponsorManager']['sponsor_id']?>" style="width: 100px">invited</span><span><img style ="cursor:pointer" class ="sponsordel" src="<?php echo SITE_URL?>img/icons/small/black/close.png" id="<?php echo $sponsor['SponsorManager']['id']?>"/></span>
		<?php } ?>
	</li>
	<?php } ?>
	<li id="invite" style="padding-top:20px">Invite your sponsor if s/he is not on this list already. Discuss the sponsorship with the sponsor
			    before sending the invitation.
	</li>
	<a class="various" href="#invite_sponsor">
		<div class="blubtn-big blubtn_new current_setup_btn" id="add_key" style="float: right; margin-bottom: 15px; margin-top:-28px;">
		<input type="button" value="Invite"></div>
	</a>
		
	<li class="space"><span><?php echo $this->Form->checkbox('shared_checked',array('options'=>false));?></span> Share mission details directly with sponsor(s) in email</li>
	
	<!-- fancybox popup -->
	 <div id ="invite_sponsor" style="display: none">
		<!--SignUp Heading-->
		<?php echo $this->element("message/errors");?>
		<?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
		
		<div class=signup-hdng><h3 class=bebas>Invite<span> Sponsor</span>  </h3></div>
		<div id ="popUp">
		    Provide the information for the person
		    you want to add to your list of sponsors. The person will be
		    provided with a secure login if necessary.

		</div>
		<!--SignUp Form Fields-->
		<ul class=form-fields>
			<li class="flash_error" style="width: 70%; display: none;"><div>Enter name/email</div></li>
			<li><div class=textbox><span><?php echo $this->Form->input('User.name',array('placeholder'=>'Enter Name here - first last please :)','div'=>false,'label'=>false,'id'=>'sponsor_name')); ?></span></div></li>
			<li><div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Enter email, me@serviceprovider.com','div'=>false,'label'=>false,'id'=>'email')); ?></span></div></li>
			<div class="signuplogin-btn add_sponsor"><input class="" type="button" value="Add" id="ajax-btn"></div>
			
		</ul>
	</div>
	<!-- fancybox popup ends -->
</ul>

<!-- script starts-->
<script>

     $( "#flash_success" ).delay(3500).fadeOut( "slow");
</script>
<script>
	$(document).ready(function(){
		$('.sp_listing li:odd').addClass('sp_color');
	})
</script>
<!-- script ends-->