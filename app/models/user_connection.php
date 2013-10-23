<?php
    // app/models/UserGroupUser.php
    class UserConnection extends AppModel {
        var $name = 'UserConnection';
	var $belongsTo = array('User', 'Connection');
	var $errMsg = array();
	
	

}
?>