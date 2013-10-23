<!DOCTYPE html>
<html>
    <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="Pragma" content="no-cache">
	    <title>
		   <?php echo $pageTitle; ?>
	    </title>
	   
	    <?php echo $this->Html->css('style'); ?>
	    <!--[if lt IE 9]>
	    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <?php //echo $this->html->Script('prototype');  ?>

	    <![endif]-->
    </head>
    <body>
	    <!--main wrapper starts-->
		<section id="main-wrapper">
		    
			<!--Wrapper Start-->
			    <section id="wrapper">
		 
				    <!--header section starts-->
					    <?php
						echo $this->element('homepage/thirdpartypro_header'); 
					    ?>
		
				    <!--header section ends--> 
				    <!--Banner Start-->
					    <section id="banner">
							<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
								 
								<tr>
									<td>
										<span style="text-align:justify;padding:10px;"><?php __($page_info['Page']['content']); ?></span>
									</td>									
								</tr>
								 
									
								
							</table>
						
                                                
                                                         
                                            </section>    
				    <!--Banner Closed-->
        
			    </section>
			<!--Wrapper Closed-->
			
			<!--Content Start-->			
				<?php
					//echo $this->element('homepage/thirdpartypro_content'); 
				?> 			
			<!--Content Closed-->
			
			
		</section>
	    <!--main wrapper ends-->
	    
	    <!--footer wrapper starts-->
	    	    <?php
			    echo $this->element('homepage/thirdpartypro_footer'); 
		    ?>
    	    <!--footer wrapper close-->
    </body>
<?php echo $this->Html->script('jquery-1.7.2.min.js');?>    
<script type="text/javascript">
	$(document).ready(function(){
		//$('ul li a').click(function(){
		//	if(jQuery('ul').hasClass('menu')){
		//		alert('ok');	
		//	}
		//});
		
	});
</script>
</html>