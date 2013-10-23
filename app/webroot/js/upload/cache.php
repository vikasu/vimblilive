<?php
$_GET['src'] = '/../../../upload' . $_GET['src'];
define('PLUGOBROWSER_CACHE_PATH', '../../../upload/plugobrowser_cache/');
require '/srv/www/htdocs/beta/app/webroot/js/tiny_mce/plugins/plugobrowser/thumb.php';