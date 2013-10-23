<?php
/*
* EmailTemplatesController class
* PHP versions 5.2.12
* @filesource
* @author 	Vikas Uniyal 
* @date 	Nov. 19, 2012
* @link   http://www.smartdatainc.net/
* @version 1.0.0 
*   - Initial release
*/
App::import('Sanitize');
class EmailTemplatesController extends AppController
{
 	var $name='EmailTemplates';
	var $helpers = array('Javascript','Html','Common','Validation','Thumbnail','Ajax','Session','Teaser','BreadcrumbDiv');
	var $components = array('Email','Cookie','Auth','AuthExtension');
	var $paginate =  array('limit'=>10);
        
        function beforeFilter() {            
            parent::beforeFilter(); 
            $this->Auth->allow('');
	    $this->layout='admin';
        }
	
	/*
	Function Name: admin_index
	Params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : for admin Email Template List 
	*/
	function admin_index()	{
	    $this->set('pagetitle',"Manage Email Templates");
	    $this->paginate=array('order'=>'EmailTemplate.title ASC');
	    $lists = $this->paginate('EmailTemplate',array('EmailTemplate.is_deleted' => '0'));
	    $this->set('list', $lists);
	    
            if((isset($this->data["EmailTemplate"]["setStatus"])))  {
		$status = ife($_POST['active'],1,0);		
		$record = $this->data["EmailTemplate"]["Record"];
		$CheckedList=$_POST['box1'];
		$controller= $this->params['controller'];
		$action='index'; 
		$prefix='admin';
		$model='EmailTemplate';
		$relation=null;
		switch($status) { 
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
	Description : for admin Add Email Template Page
	*/
	function admin_add() {
	    $this->set('pagetitle',"Add Email Template");	
	    if (!empty($this->data)) {
		if ($this->EmailTemplate->save($this->data)) {
		    $this->Session->setFlash('The Email Template has been saved','message/green');
		    $this->redirect(array('action' => 'index'));
		} else {
		    $this->Session->setFlash('The Email Template could not be saved. Please, try again.','message/yellow');
		}
	    }
	}

	/*
	Function Name: admin_edit
	Params: id(id of the email template to be edited)
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : for admin edit Email Template Page
	*/
	function admin_edit($id=null) {
	    $id = base64_decode($id);
	    $this->set('pagetitle',"Edit Email Template");	
	    $this->EmailTemplate->id = $id;
	    if($id) { 
		$count=$this->EmailTemplate->find('count',array('conditions' => array('EmailTemplate.id' => $id,'EmailTemplate.is_deleted' => '0'))); 
                if($count >0) {
		    if (!empty($this->data)) {
			$this->data['EmailTemplate']['title']=$this->EmailTemplate->field('title');
			if ($this->EmailTemplate->save($this->data)) {
			    $this->Session->setFlash('The Email Template has been saved','message/green');
			    $this->redirect(array('action' => 'index'));
			} else {
			    $this->Session->setFlash('The Email Template could not be saved. Please, try again.','message/yellow');
			}
		    }
		    if (empty($this->data)) {
			    $this->data = $this->EmailTemplate->read(null, $id);
		    }
		}
		else { 
			$this->Session->setFlash('Invalid Page', 'message/yellow');
			$this->redirect(array('action' => 'index'));
		}
	    } 
	}

	/*
	Function Name: admin_delete
	Params: id(id of the email template to be deleted)
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : for admin delete Email Template Page
	*/	
	function admin_delete($id=null)
	{
            $id = base64_decode($id);
	    $this->autoRender = false; 
            if($id) { 
                $PageCount=$this->EmailTemplate->find('count',array('conditions' => array('EmailTemplate.id' => $id)));
                if($PageCount >0) { 
                    $IsAlreadydeleted=$this->EmailTemplate->find('count',array('conditions' => array('EmailTemplate.id'=>$id,'EmailTemplate.is_deleted' =>'1')));
                    if($IsAlreadydeleted) {
                        $this->Session->setFlash('Email Template is already deleted!','message/yellow');
                        $this->redirect(array('action' => 'index'));
                    }
                    $this->EmailTemplate->id = $id;  
                    if($this->EmailTemplate->saveField('is_deleted', '1')) { 
                        $this->Session->setFlash('Email Template is deleted sucessfully.','message/green');
                        $this->redirect(array('action'=>'index'));
                    } else {
                        $this->Session->setFlash('Email Template is not deleted!','message/red');
                        $this->redirect(array('action' => 'index'));
                    }                 
                }
		else {
                        $this->Session->setFlash('Invalid Page','message/yellow');
                        $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Invalid request','message/yellow');
                $this->redirect(array('action' => 'index'));
            } 
        }
}
?>