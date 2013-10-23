<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

session_start();
$_SESSION['is_authenticated'] = TRUE;
if (!isset($_SESSION['is_authenticated']) || !$_SESSION['is_authenticated'])
{
  header('HTTP/1.1 401 Unauthorized');
  echo 'You are not logged!!';
  exit;
}

function __autoload($class)
{
  $dir = dirname(__FILE__);
  if (file_exists($dir . '/classes/' . $class . '.php')) require_once $dir . '/classes/' . $class . '.php';
}

$plugoBrowser = new PlugoBrowser();