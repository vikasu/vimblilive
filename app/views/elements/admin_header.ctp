  <?php //pr($_SESSION);
  		$userSession = $this->Session->read('userSession');
  ?>
  <div class="header">
    <!-- MAY EDIT THIS PART FOR LOGO IMAGE -->
    <div class="logoTop"><a href="/">
		<a href="/admins/listuser/">
			<img src="/img/flo360.png" alt="FLO360" border="0" height="70px"/>
		</a>
	</div>
    <!-- MAY EDIT THIS PART FOR LOGO IMAGE -->
    <div class="loginTop">
      <div class="content"></div>
    </div>
    
    <!-- begin mainnav -->
    <div class="admin_title">
    	Welcome <?php echo $userSession[1];?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/admins/logout">Logout</a>
    	
    </div>
    <!-- end mainnav -->
  </div>