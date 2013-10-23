<section id="header">
	<a href="#" class="logo">Multiauction.com</a>
        <section class="top_right">
            	<!-- <section class="search_widget">
                    <input type="text" name="textfield" class="search_input" />                	
                    <span class="gray_grnd search_button"><input type="submit" name="button" value=" " /></span>
		</section> -->
                
		<section class="search_widget" style="background:none;border:none;">
                   Lan: <?php echo $html->link('English','/users/setLanguage/eng',array('alt'=>'Sign In','style'=>'color:#0088CC;','class'=>'')); ?>
		   <?php echo $html->link('French','/users/setLanguage/fre',array('alt'=>'Sign In','style'=>'color:#0088CC;','class'=>'')); ?>
            	</section>
		
                <!--Right Links Start-->
                <section class="right-links">
				<?php
				if($this->Session->read('Auth.User.id')=='')
				echo $html->link('Sign In','/users/login',array('alt'=>'Sign In','style'=>'color:black;','class'=>'red_color'));
				else
				echo $html->link('Sign Out','/users/logout',array('alt'=>'Sign Out','style'=>'color:black;','class'=>'red_color'));		
				?>
				<a href="#"><?php echo __('Help us'); ?></a>
				<a href="#">Contact Us</a></section>
                <!--Right Links Closaed-->
                
                <section class="">
			<div id="google_translate_element"></div>
			<script type="text/javascript">
				function googleTranslateElementInit() {
				  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
			</script>
			<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </section>
                
        </section>
</section>