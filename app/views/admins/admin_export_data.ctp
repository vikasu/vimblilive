   <style>
        .lefts { margin-left:30px;}
	
   </style>
 <?php 
	  $breadcrumbList=array( 'Export Data' );
	  echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?><br>
<h2 style="margin-left:15px">Export Data</h2>
<div class="left">
	    <div class="dataTables_wrapper" id="example_wrapper">
        <ul style="list-style: none">
      <!--   <form id="export_data" action="<?php //echo SITE_URL.'settings/export_data/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" > -->
                            <li class="left" style="margin-left:15px;">
                                
                            </li>
                             <li class="lefts">
                                    <div style="float:left;width:150px;"><label id="label" styl>User Data</label></div>
                                    <div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
                                    <a href="<?php echo SITE_URL ?>admin/admins/export_user_data" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                                </li>
                            
                          <!--  <li>
                                <?php //echo $this->Form->checkbox('Export.data1',array('value'=>'all_data','id'=>'password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                <label>All Data</label>
                            </li>-->
                             <li class="lefts">
                              
                                <div style="float:left;width:150px;"><label id="label">Missions Info</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>admin/admins/export_mission_data" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                            </li>
                             <li class="lefts">
                              
                                <div style="float:left;width:150px;"><label id="label">Schedule Balances</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>admin/admins/export_scheduleBalances_data"" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                            </li>
			    <li class="lefts">
                              
                                <div style="float:left;width:150px;"><label id="label">Timeline</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>admin/admins/export_timeline_data" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                            </li>
                            <li class="lefts">
                              
                                <div style="float:left;width:150px;"><label id="label">Reflection</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>admin/admins/export_reflections_data" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                            </li>
                             <li class="lefts">
                     <!--         
                                <div style="float:left;width:100px;"><label id="label">Attachment</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
			<!--	<a href="<?php //echo SITE_URL ?>homes/download" class="a"><img src="<?php //echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                             </li> -->
                            
                        </ul>
` <!-- </form>  -->
	    </div>
</div>