<style type="">
ul.main-form{
	width:100%;
}	
</style>
<?php
        $breadcrumbList=array(
                        '0'=>array(
                            'name'=>'Manage User',  
                            'controller' => 'users',
                            'action' => 'index'
				),
	        	'View User'
			);
        echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
	?>
<div class="left">
	    <?php //echo $this->Session->flash(); ?>
		 <div class="widgetbox">
            	<h3><span>View User Details</span></h3>
				<?php echo $this->Session->flash(); ?>
				<div class="content">					
					
					<div class="form_default">
						<table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
							
							
                                                        <tr>
                                                                <td width="200px">Prename :</td>
                                                                <td>
                                                                    <?php echo @$this->data['Customer']['prename']; ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Surname :</td>
                                                                <td>
                                                                    <?php echo @$this->data['Customer']['surname']; ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Email :</td>
                                                                <td>
                                                                    <?php echo @$this->data['Customer']['email']; ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Email Other :</td>
                                                                <td>
                                                                    <?php echo @$this->data['Customer']['email_second']; ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Date of Birth(MM-DD-YYYY) :</td>
                                                                <td>
                                                                    <?php echo date(FRONT_DATE_FORMAT,strtotime($this->data['Customer']['birthdate']));   ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Gender :</td>
                                                                <td>
                                                                   <?php if(@$this->data['Customer']['gender']=='M') echo 'Male'; else echo 'Female';  ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Street :</td>
                                                                <td>
                                                                    <?php echo @$this->data['Customer']['street_and_number'];  ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Town :</td>
                                                                <td>
                                                                    <?php echo @$this->data['Customer']['town'];  ?>
                                                                </td>
                                                        </tr>
							
							<tr>
                                                                <td width="200px">Country :</td>
                                                                <td>
                                                                    <?php echo $this->data['Country']['name_pritable'];  ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="200px">Zip :</td>
                                                                <td>
                                                                    <?php echo @$this->data['Customer']['zip'];  ?>
                                                                </td>
                                                        </tr>
							
							
						</table>
						
					</div><!-- form_default -->
	
					
				
				</div><!-- content -->
		 </div><!-- widgetbox -->
</div><!-- left -->