<?php
class BreadcrumbDivHelper extends AppHelper{
	var $helpers = array('Form', 'Html');

	function showBreadcrumb($breadcrumbList=null){ 
		//$this->Html->addCrumb('Dashboard','home');
		//$this->Html->addCrumb('Manage Groups');
		 
		echo '<div class="breadcrumbs">';
			echo $this->Html->link('Dashboard',array('controller'=>'admins','action'=>'dashboard'));
			if(!empty($breadcrumbList))
			{ 
			   foreach($breadcrumbList as $breadcrumb)
			   {
				if(is_array($breadcrumb))
				{
				    $name=$breadcrumb['name'];
				    $controller=$breadcrumb['controller'];
				    $action = $breadcrumb['action']; 
				    echo $this->Html->link($name,array('controller'=>$controller,'action'=>$action));
				}
				else
				{ 
				    echo $breadcrumb;
				}
			   }
			}
		echo '</div>';
	}	
}
?>