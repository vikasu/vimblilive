<?php
/*
	PlugoBrowser v1.1
	Url: http://www.plugobrowser.com
	Copyright (c) 2012 Plugo s.r.o.
*/

require 'config.php';

$pathSplit = $plugoBrowser->splitPath();

// Include plugin
require_once('data/template.php');