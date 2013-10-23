<?php 
    echo $this->Html->script('jquery-1.7.2.min.js');
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
?>

<script type="text/javascript">
       jQuery(document).ready(function(){      
	    jQuery("#form").validationEngine();
       });      
</script>

 <script>
function showRadioChk(id){		
	if (id == 0) {		
		jQuery("#chkdiv1").addClass("hideDiv");
	}
	if (id == 1) {		
		jQuery("#chkdiv1").removeClass("hideDiv");		
	}
}
</script>
 
 <style>
  .name{background:#def3ca; margin:3px; width:80px;display:none; float:left; text-align:center; }
  </style>

<style type="">
ul.main-form{
	width:100%;
}
.showDiv{display:block;}
.hideDiv{display:none;}
</style>
<?php
        $breadcrumbList=array(
                            '0'=>array(
                                    'name'=>'Manage Reflections',  
                                    'controller' => 'reflections',
                                    'action' => 'reflections'
                                    ),
                                'Reflection Detail'
                                );
            echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
	?>
<div class="left">
    
    
	    <?php echo $this->Session->flash(); ?>
		 <div class="widgetbox">
            	<h3><span>Reflection Detail</span></h3>
				<?php echo $this->Session->flash(); ?>
				<div class="content">
				    
				    <?php echo $this->element("message/errors");?>
				    
					<div class="form_default">
						<table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
							<tr>
                                                                <td width="180px">Title  :</td>
                                                                <td><?php echo $refInfo['UserReflection']['title']; ?></td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Added By  :</td>
                                                                <td><?php echo $refInfo['User']['name']; ?></td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Rating Today  :</td>
                                                                <td><?php echo $refInfo['UserReflection']['rating_tomorrow']; ?></td>
                                                        </tr>
							
							<tr>
                                                                <td width="180px">Rating Tomorrow  :</td>
                                                                <td><?php echo $refInfo['UserReflection']['rating_today']; ?></td>
                                                        </tr>
							
							<tr>
                                                                <td width="180px">Description  :</td>
                                                                <td><?php echo $refInfo['UserReflection']['description']; ?></td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Reflection Questions  :</td>
                                                                <td>
								<?php
								    if(!empty($refInfo['ReflectionQuestion']))
								    {	$cnt = 0;
									foreach($refInfo['ReflectionQuestion'] as $question){
									    $cnt=$cnt+1;
									    echo $cnt.'. '.$question['question'].'<br>';
									}
								    } else {
									echo 'No questions found for this reflection.';
								    }
								?>
								</td>
                                                        </tr>
						</table>
					</div><!-- form_default -->
	
				
				</div><!-- content -->
		 </div><!-- widgetbox -->
</div><!-- left -->