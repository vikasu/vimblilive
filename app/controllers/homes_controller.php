<?php
/*
* HomesController class
* PHP versions 5.2.12
* @filesource
* @author	Sandeep 
* @date		Nov. 19, 2012
* @link       http://www.smartdatainc.net/
* @version 1.0.0 
* - Initial release
*/
App::import('Sanitize');
class HomesController extends AppController
{
    var $name = 'Homes';
    //var $helpers = array('Common','Validation','Thumbnail','Ajax','Barcode');
    var $components = array('Common','Email');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','download');
	
    }
    
    /*
	Function Name: index
	params: NULL
	Created BY:Sandeep
	Created ON : Nov. 19, 2012
	Description : homepage
    */
    function index() { //echo'hdxere'; exit;
	$this->layout = '';
	$this->loadModel('CarouselDetail');
	$this->loadModel('ContentRow');
	$path = $this->CarouselDetail->find('all',array('conditions'=>array('CarouselDetail.status'=>1)));
	$contentRow = $this->ContentRow->find('all',array('conditions'=>array('ContentRow.status'=>1)));
	//prx($path);die;
	$this->set('contentRow',$contentRow);
        $this->set('links',$path);
    }

     /*
	Function Name: download
	params: NULL
	Created BY:Vikash Uniyal
	Created ON : 10 Aug 2013
	Description : for downloading attachment as zip file
    */
   
    function download() {
	$this->autoRender = false;
	$this->loadModel('User');
	$current_user_info = $this->User->find('first',array(
						       'conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id']),
						       'fields'=>array('User.email','User.name')
						       ));
	$srcfile = array();
	$destfile = array();
	$cnt = 0;
	//Fetch files of user
	$this->loadModel('UserReflection');
	$refData = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],'UserReflection.file_name <>'=>''),'fields'=>array('UserReflection.id','UserReflection.file_name'),'recursive'=>0));
	foreach($refData as $ref){
	    $srcfile[$cnt] = "../webroot/files/reflections/".$ref['UserReflection']['file_name'];
	    $cnt++;
	}
	
	$this->loadModel('StrengthValue');
	$strData = $this->StrengthValue->find('all',array('conditions'=>array('StrengthValue.user_id'=>$_SESSION['Auth']['User']['id'],'StrengthValue.attachment <>'=>''),'fields'=>array('StrengthValue.id','StrengthValue.attachment'),'recursive'=>0));
	foreach($strData as $str){
	    $srcfile[$cnt] = "../webroot/files/strength/".$str['StrengthValue']['attachment'];
	    $cnt++;
	}
	
	//pr($srcfile); 
	//pr($strData); die;
	if(!empty($srcfile)){
	App::import('Folder','Utility');
        App::import('File', 'Utility');
	
	//$srcfile[0] = "../webroot/files/cam_img/1.jpg";
	//$srcfile[1] = "../webroot/files/cam_img/2.jpg";
	if(is_dir("./Downloads/attachment-".$_SESSION['Auth']['User']['id'])){
	    $dir = "./Downloads/attachment-".$_SESSION['Auth']['User']['id'];
	    
	    $objects = scandir($dir);
	    foreach ($objects as $object) {
	      if ($object != "." && $object != "..") {
		if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
	      }
	    }
	    reset($objects);
	    rmdir($dir);
	    
	    unlink('./Downloads/Attachment'.$_SESSION['Auth']['User']['id'].'.zip');
	    //echo 'Found'; die;
	}else{
	    //echo 'Not found'; die;
	}
	
	for($i=0;$i<$cnt;$i++){
	    $expNames = explode('/',$srcfile[$i]);
	    
	    $destfile[$i]="../webroot/Downloads/attachment-".$_SESSION['Auth']['User']['id']."/".end($expNames);
	    mkdir(dirname($destfile[$i]),0777,true);
    
	    $folder_name = "../webroot/Downloads/attachment-".$_SESSION['Auth']['User']['id'];
	    chmod($folder_name,0777);
	    copy($srcfile[$i],$destfile[$i]);
	}
	
	$directoryToZip="./Downloads/attachment-".$_SESSION['Auth']['User']['id']; // This will zip all the file(s) in this present working directory
	$outputDir="./Downloads/"; //Replace "/" with the name of the desired output directory.
	$zipName="Attachment".$_SESSION['Auth']['User']['id'].".zip"; //Save file with specified name
	
	include_once("CreateZipFile.inc.php");
	$createZipFile=new CreateZipFile;
	$createZipFile->zipDirectory($directoryToZip,$outputDir);
	$fd=fopen('./Downloads/'.$zipName, "wb");
	$out=fwrite($fd,$createZipFile->getZippedfile());
	fclose($fd);
	//$createZipFile->forceDownload($zipName);
	$path = 'http://vimbli.com/homes/export_data_after_login/'.$zipName;
	$this->Email->from = INFO_EMAIL;
	//$this->Email->to = "sdd.sdei@gmail.com";
	$this->Email->to = $current_user_info['User']['email'];
	$template = $this->Common->getEmailTemplate(24);
	$this->Email->sendAs= 'html';
	$this->Email->subject = $template['EmailTemplate']['subject'];
	$description = $template['EmailTemplate']['description'];
	$description = str_replace('{NAME}',$current_user_info['User']['name'],$description);
	$description = str_replace('{FILENAME}',$filename,$description);
	$description = str_replace('{LINK}',$path,$description);
	$this->set('data',$description);
	$this->Email->template='commanEmailTemplate';
	$this->Email->send();
	$this->Session->setFlash('Vimbli is preparing your export. When complete we will send you a link to the email.','default',array('class'=>'flash_success'));
	$this->redirect($this->referer());
	}else{
	    $this->Session->setFlash('No attachement found', 'default', array('class' => 'flash_success'));
	    $this->redirect(array('controller'=>'settings','action'=>'index'));
	}
	
   }
   
   /** 
	@function : export_data_after_login 
	@description : Download Export data file only after user is login otherwise not
	@params : NULL
	@Created by : Sunny chauhan
	@Modify : NULL
	@Created Date : Aug. 06, 2013
	*/
	
	public function export_data_after_login($zipName){
		$this->autoRender = false;
		if($_SESSION){
			$this->redirect('http://vimbli.com/Downloads'.DS.$zipName);
		}
	}
	
	
}
?>