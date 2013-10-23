<?php 
class PhotopathHelper extends Helper {

    var $helpers = array('Html');
    var $cacheDir = 'cache';
  	
    
    
    function getInstituteLogo($imageName=null) {
     if($imageName != '') {
        if(file_exists(WWW_ROOT . INSTITUTE_LOGO . $imageName)) {
         return '../'.INSTITUTE_LOGO . $imageName;
        } else {
          return '../'.INSTITUTE_LOGO . 'no-image.gif';
        }
      } else {
        return '../'.INSTITUTE_LOGO . 'no-image.gif';
      }
    }
    
    
    
}