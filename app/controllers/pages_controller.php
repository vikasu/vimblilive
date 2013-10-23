<?php
/*
* PagesController class
* PHP versions 5.2.12
* @filesource
* @author 	Vikas Uniyal 
* @date 	Nov. 19, 2012
* @link       http://www.smartdatainc.net/
* @version 1.0.0 
*   - Initial release
*/
class PagesController extends AppController
{
 	var $name='Pages';
	var $helpers = array('Javascript','Html','Common','Validation','Thumbnail','Ajax','Session','Teaser','BreadcrumbDiv');
	var $components = array('Email','Cookie','Auth','AuthExtension');
	var $paginate =  array('limit'=>10);
	
        function beforeFilter()
	{            
            parent::beforeFilter(); 
            $this->Auth->allow('');
	    $this->layout='admin';
        }
	
	/*
	Function Name: admin_index
	Params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : for Static Pages Listing - Admin Panel 
	*/
	function admin_index()
	{
	    $this->set('pagetitle',"Manage Pages");
	    $this->paginate=array('order'=>'Page.name ASC');
	    $lists = $this->paginate('Page');
	    $this->set('list', $lists);
	    
	    if((isset($this->data["Page"]["setStatus"])))
	    {
		$status = ife($_POST['active'],1,0);
		$record = $this->data["Page"]["Record"];
		$CheckedList=$_POST['box1'];
		$controller= $this->params['controller'];
		$action='index'; 
		$prefix='admin';
		$model='Page';
		$relation=null;
		
		switch($status)
		{ 
		   case '1': 
			$this->setStatus('1',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
		   break;
		   case '0':
			$this->setStatus('0',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
		   break; 
		}
	    }
	}
	
	/*
	Function Name: admin_add
	Params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : To add new Static Page - Admin Panel 
	*/
	function admin_add()
	{
	    $this->set('pagetitle',"Add Page");	
	    $this->loadModel('User');
	    $userlists = array();
	    $userlists = array_merge($userlists,array('0'=>'Admin'));
	    $allClientLists = $this->User->find('list',array('conditions'=>array('User.user_type_id'=>1),'fields'=>array('id','fname')));
            $userlists = array_merge($userlists,$allClientLists);
	    $this->set('userlists',$userlists);
	    
	    if(!empty($this->data))
	    {
		if($this->Page->save($this->data))
		{
		    $this->Session->setFlash('The Page has been created','message/green');
		    $this->redirect(array('action' => 'index'));
		}
		else
		{
		    $this->Session->setFlash('The Page could not be saved. Please, try again.','message/yellow');
		}
	    }
	}
	
	
	/*
	Function Name: admin_edit
	Params: id(id of the static page to be edited)
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : To edit Static Page - Admin Panel 
	*/
	function admin_edit($id=null)
	{
	    $id = base64_decode($id);
	    $this->set('pagetitle',"Edit Page");	
	    
	    $this->Page->id = $id;
	    if($id)
	    {
		$count=$this->Page->find('count',array('conditions' => array('Page.id' => $id))); 
                if($count >0)
		{
		    if(!empty($this->data))
		    {
			$this->data['Page']['name']=$this->Page->field('name');
			if($this->Page->save($this->data))
			{ 		
			    $this->Session->setFlash('The Page has been saved','message/green');
			    $this->redirect(array('action' => 'index'));
			}
			else
			{
			    $this->Session->setFlash('The Page could not be saved. Please, try again.','message/yellow');
			}
		    }
		    if(empty($this->data))
		    {
			$this->data = $this->Page->read(null, $id);
		    }
		}
		else
		{
		    $this->Session->setFlash('Invalid Page', 'message/yellow');
		    $this->redirect(array('action' => 'index'));
		}
	    } 
	}
	
	
	function display($name = NULL) {
		$this->layout = "inner_pages";
		
		$page_contents = $this->Page->find('first',array('conditions' => array('Page.name'=>$name)));
		$this->set('page_contents',$page_contents);
		
		$this->set('pagetitle',$page_contents['Page']['title']);
	}
	
	
	/*
	Function Name: admin_displayRating
	Created BY:Sunny Chauhan
	Created ON : Oct. 11, 2013
	Description : To display rating image on bsis of dynamic Rating
	-->Testing Function (Yet to be implemented)<--
	*/
	 
	//function admin_displayRating($rating = null) {
	//	$this->autoRender = false;
	//	$ratingNumber = number_format((float)$rating, 1, '.', ''); 
	//	$explodeRatingNumber = explode('.',$ratingNumber); 
	//	$ratingBeforeDecimal = $explodeRatingNumber[0];
	//	$ratingAfterDecimal = $explodeRatingNumber[1];
	//	//$this->set('ratingBeforeDecimal',$ratingBeforeDecimal);
	//	//$this->set('ratingAfterDecimal',$ratingAfterDecimal);
	//	if($ratingBeforeDecimal <= 3){
	//		if($ratingBeforeDecimal == 0){
	//			if($ratingAfterDecimal == 1 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.1.png"/>';
	//			}elseif($ratingAfterDecimal == 2){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.2.png"/>';
	//			}elseif($ratingAfterDecimal == 3){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.3.png"/>';
	//			}elseif($ratingAfterDecimal == 4 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.4.png"/>';
	//			}elseif($ratingAfterDecimal == 5 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.5.png"/>';
	//			}elseif($ratingAfterDecimal == 6 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.6.png"/>';
	//			}elseif($ratingAfterDecimal == 7 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.7.png"/>';
	//			}elseif($ratingAfterDecimal == 8 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.8.png"/>';
	//			}else{
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.9.png"/>';
	//			}
	//			echo '<img src= "'.SITE_URL.'img/stars/starsempty_star.png"/>';
	//			echo '<img src= "'.SITE_URL.'img/stars/starsempty_star.png"/>';
	//		}elseif($ratingBeforeDecimal == 1){
	//			echo '<img src= "'.SITE_URL.'img/stars/starsfull_star.png"/>';
	//			if($ratingAfterDecimal == 1 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.1.png"/>';
	//			}elseif($ratingAfterDecimal == 2){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.2.png"/>';
	//			}elseif($ratingAfterDecimal == 3){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.3.png"/>';
	//			}elseif($ratingAfterDecimal == 4 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.4.png"/>';
	//			}elseif($ratingAfterDecimal == 5 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.5.png"/>';
	//			}elseif($ratingAfterDecimal == 6 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.6.png"/>';
	//			}elseif($ratingAfterDecimal == 7 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.7.png"/>';
	//			}elseif($ratingAfterDecimal == 8 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.8.png"/>';
	//			}else{
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.9.png"/>';
	//			}
	//			echo '<img src= "'.SITE_URL.'img/stars/starsempty_star.png"/>';
	//		}elseif($ratingBeforeDecimal == 2){
	//			echo '<img src= "'.SITE_URL.'img/stars/starsfull_star.png"/>';
	//			echo '<img src= "'.SITE_URL.'img/stars/starsfull_star.png"/>'; 
	//			if($ratingAfterDecimal == 1 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.1.png"/>';
	//			}elseif($ratingAfterDecimal == 2){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.2.png"/>';
	//			}elseif($ratingAfterDecimal == 3){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.3.png"/>';
	//			}elseif($ratingAfterDecimal == 4 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/starsimg/stars/stars1.4.png"/>';
	//			}elseif($ratingAfterDecimal == 5 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.5.png"/>';
	//			}elseif($ratingAfterDecimal == 6 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.6.png"/>';
	//			}elseif($ratingAfterDecimal == 7 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.7.png"/>';
	//			}elseif($ratingAfterDecimal == 8 ){
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.8.png"/>';
	//			}else{
	//				echo '<img src= "'.SITE_URL.'img/stars/stars1.9.png"/>';
	//			}
	//			
	//		}elseif($ratingBeforeDecimal == 3 && $ratingAfterDecimal == 0){
	//			echo '<img src= "'.SITE_URL.'img/stars/starsfull_star.png"/>';
	//			echo '<img src= "'.SITE_URL.'img/stars/starsfull_star.png"/>';
	//			echo '<img src= "'.SITE_URL.'img/stars/starsfull_star.png"/>'; 
	//		}
	//	}
	//}
}
?>