<?php
class PlugoBrowser
{
  private $demo = FALSE;
  protected $settings = array();
  protected $isWindows = FALSE;
  protected static $imgExts = array('bmp', 'gif', 'jpg', 'jpeg', 'png', 'svg');
  public static $extIcos = array('avi', 'bmp', 'doc', 'docx', 'gif', 'jpg', 'jpeg', 'pdf', 'png', 'ppt', 'rar', 'svg', 'txt', 'xls', 'xlsx', 'zip');
  
  public function __construct()
  {
    $this->isWindows = (bool) stristr(php_uname('s'), 'Windows');
	  $this->initSettings();
	}
	
	public function initSettings()
	{
	  $settings = CommonLib::parseIniFile(dirname(__FILE__) . '/../config.ini');
	  $this->settings = isset($settings['plugobrowser']) ? $settings['plugobrowser'] : array();
	  $this->settings['upload_dir_abs'] = $this->getRealPath(str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)) . '/../' . $this->settings['upload_dir']);
	  if (substr($this->settings['upload_dir'], -1) != '/') $this->settings['upload_dir'] .= '/';
	  if (substr($this->settings['upload_dir_abs'], -1) != '/') $this->settings['upload_dir_abs'] .= '/';
	  
	  $timezone = explode('|', $this->settings['timezone']);
	  if (isset($timezone[1]) && $timezone[1]) date_default_timezone_set($timezone[1]);
	  
    $this->settings['forbidden_extensions_permanent'] = 'php,php3,php4,php5,htaccess,exe,bat';
	}
	
	public function doTest()
	{
	  $errs = array();
	  
	  $config = dirname(__FILE__) . '/../config.ini';
	  if (!@is_file($config)) $errs[] = 'config_not_exist';
	  elseif (substr(decoct(@fileperms($config)), 2) < ($this->isWindows ? 666 : 777)) $errs[] = 'config_not_writable';

    if (isset($errs[0])) return $errs;
    
    if ($this->settings['upload_dir'] == '*') $errs[] = '';
    else
    {
  	  if (!@is_dir($this->settings['upload_dir_abs'])) $errs[] = 'upload_dir_not_exist';
	    elseif (substr(decoct(@fileperms($this->settings['upload_dir_abs'])), 2) < ($this->isWindows ? 755 : 777)) $errs[] = 'upload_dir_not_writable';
	    elseif (!@is_file($this->settings['upload_dir_abs'] . '/cache.php'))
  	  {
	      file_put_contents(
		  	  $this->settings['upload_dir_abs'] . '/cache.php',
			    '<?php' . "\n"
				  . '$_GET[\'src\'] = \'/' . substr($this->settings['upload_dir'], 0, -1) . '\' . $_GET[\'src\'];' . "\n"
  				. 'define(\'PLUGOBROWSER_CACHE_PATH\', \'' . $this->settings['upload_dir'] . 'plugobrowser_cache/\');' . "\n"
          . 'require \'' . realpath(str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)) . '/../thumb.php') . '\';'
		  	);
  		}
  	}
		
		if (isset($errs[0])) return $errs;
	  
	  $cacheDir = $this->settings['upload_dir_abs'] . '/plugobrowser_cache';
	  if (!@is_dir($cacheDir))
		{
		  umask(0000);
		  @mkdir($cacheDir, 0777);
		}
	  elseif (substr(decoct(@fileperms($cacheDir)), 2) < ($this->isWindows ? 666 : 777))
	  {
		  umask(0000);
		  @chmod($cacheDir, 0777);
		}
	  
	  return $errs;
	}
	
	public function getSettings($property = NULL)
	{
	  if (!$property)
		{
		  $tmp = $this->settings;
		  unset($tmp['upload_dir_abs']);
		  return $tmp;
		}
	  return isset($this->settings[$property]) ? $this->settings[$property] : FALSE;
	}
	
	public function isWindows()
	{
	  return $this->isWindows;
	}
	
	public function saveSettings($settings)
	{
	  if ($this->demo) unset($settings['upload_dir'], $settings['upload_dir_abs']);
	  $tmp = $this->settings;
	  $props = array_keys($tmp);

	  for($i = 0; isset($props[$i]); $i++)
	  {
		  if (isset($settings[$props[$i]]))
			{
			  if ($props[$i] == 'timezone')
			  {
			    $timezoneList = CommonLib::getTimezoneList();
			    foreach($timezoneList as $offset => $citys)
			    {
					  if (is_array($citys))
					  {
						  foreach($citys as $city)
						  {
						    if ($city == $settings[$props[$i]])
						    {
						      $tmp[$props[$i]] = $settings[$props[$i]] . '|' . CommonLib::getPhpTimezone($offset);
							    break(2);
							  }
							}
						}
						elseif ($citys == $settings[$props[$i]])
						{
						  $tmp[$props[$i]] = $settings[$props[$i]] . '|' . CommonLib::getPhpTimezone($offset);
						  break;
						}
					}
				}
			  else $tmp[$props[$i]] = $settings[$props[$i]];
			}
		}
		
		return CommonLib::writeIniFile(array('plugobrowser' => $tmp), dirname(__FILE__) . '/../config.ini', TRUE);
	}
	
	public function readDir($path = NULL, $onlyImg = FALSE)
	{
	  if ($this->isWindows) $path = iconv('utf-8', 'cp1250//IGNORE', $path);
	  
	  $data = FileSystem::dir_content($this->settings['upload_dir_abs'] . $path);
	  if (!is_array($data)) $data = array(array(), array());

		$tmp = $data[1];
		$data[1] = array();
		foreach($tmp as $file)
		{
			if (!preg_match('/\.part~$/', $file)) $data[1][] = $file;
		}
	  
	  if ($this->settings['extensions_read_restrict'])
	  {
	    $forbiddenExts = explode(',', mb_strtolower($this->settings['forbidden_extensions_permanent'], 'UTF-8'));
	    if (!$this->settings['extensions_switch']) $forbiddenExts = array_merge(
		    $forbiddenExts,
		    explode(',', mb_strtolower($this->settings['forbidden_extensions'], 'UTF-8'))
		  );
		  else $allowedExts = explode(',', mb_strtolower($this->settings['allowed_extensions'], 'UTF-8'));
		  
		  $tmp = $data[1];
		  $data[1] = array();
		  
		  foreach($tmp as $file)
		  {
			  $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
			  
			  if (
		      !in_array($ext, $forbiddenExts)
		      && (!$this->settings['extensions_switch'] || in_array($ext, $allowedExts))
		    ) $data[1][] = $file;
			}
		}
	  
	  if ($onlyImg)
	  {
		  $tmp = $data[1];
		  $data[1] = array();
		  
		  foreach($tmp as $file)
		  {
			  if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), self::$imgExts)) $data[1][] = $file;
			}
		}
		elseif ($path == '/')
		{
		  $forbidden = array_keys($data[0], 'plugobrowser_cache');
		  foreach($forbidden as $curForbidden)
		  {
			  unset($data[0][$curForbidden]);
			}
			
		  $forbidden = array_keys($data[1], 'cache.php');
		  foreach($forbidden as $curForbidden)
		  {
			  unset($data[1][$curForbidden]);
			}
		}
		
		setlocale(LC_COLLATE, 'cs_CZ.utf8');
		uasort($data[0], 'strcoll');
		uasort($data[1], 'strcoll');
		
		return $data;
	}
	
	public function readDirTreeUntil($path)
	{
	  $path = explode('/', $path);
	  $r = array();
	  setlocale(LC_COLLATE, 'cs_CZ.utf8');	  	  
	  
	  for($i = 0; isset($path[$i]); $i++)
	  {
	    $curPath = implode('/', array_slice($path, 0, $i));
		  if ($data = FileSystem::dir_content($this->settings['upload_dir_abs'] . ($this->isWindows ? iconv('utf-8', 'cp1250//IGNORE', $curPath) : $curPath), TRUE, FALSE))
			{
			  if (!$curPath) $curPath = '/';
			  
			  if ($curPath == '/')
			  {
			    $forbidden = array_keys($data[0], 'plugobrowser_cache');
		      foreach($forbidden as $curForbidden)
		      {
    			  unset($data[0][$curForbidden]);
		    	}
		    }
		    
		    if ($this->isWindows)
		    {
				  foreach($data[0] as $i2 => $val)
				  {
					  $data[0][$i2] = iconv('cp1250', 'utf-8', $val);
					}
				}
				
		    uasort($data[0], 'strcoll');								
		    
		    if (isset($data[0][0])) $r[$this->isWindows ? iconv('cp1250', 'utf-8', $curPath) : $curPath] = $data[0];
			}
		  else break;
		}
		
		return $r;
	}
	
	public function splitPath($path = NULL)
	{
	  $r = array(basename($this->settings['upload_dir_abs']));
		$path = explode('/', $path);
		if (isset($path[0]) && $path[0])
		{
		  foreach($path as $level)
		  {
		    if (!$level) break;
			  array_push($r, $level);
			}
		}
		
		return $r;
	}
	
	public function getRelativeUploadDir()
	{
	  $fullPath = explode('/', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)));
	  $uploadPath = explode('/', $this->settings['upload_dir_abs']);
	  
    foreach($fullPath as $level => $dir)
    {
      if (isset($uploadPath[$level]))
      {
        if ($dir === $uploadPath[$level])
        {
          unset($uploadPath[$level]);
          unset($fullPath[$level]);
        }
        else break;
      }
    }
    
    for($i = 0; $i < count($fullPath) - 1; $i++)
    {
      array_unshift($uploadPath, '..');
    }
    
    $r = implode('/', $uploadPath);
    return $r;
	}
	
	public function removeFile($path)
	{
	  $path = $this->settings['upload_dir_abs'] . ($this->isWindows ? iconv('utf-8', 'cp1250//IGNORE', $path) : $path);
	  
	  return is_file($path) ? FileSystem::unlink($path) : TRUE;
	}
	
	public function removeDir($path)
	{
	  $path = $this->settings['upload_dir_abs'] . ($this->isWindows ? iconv('utf-8', 'cp1250//IGNORE', $path) : $path);
	  
	  return is_dir($path) ? FileSystem::rmdir($path) : TRUE;
	}
	
	public function getExistingPathPart($path)
	{
	  $pathConv = explode('/', $this->isWindows ? iconv('utf-8', 'cp1250//IGNORE', $path) : $path);
	  
	  for ($i = count($pathConv); $i > 0; $i--)
	  {
		  if (is_dir($this->settings['upload_dir_abs'] . implode('/', array_slice($pathConv, 0, $i))))
			{
			  $r = implode('/', array_slice(explode('/', $path), 0, $i));
			  if ($r == '.') $r = '/';
			  return $r;
			}
		}
		
		return '/';
	}
	
	public function getFileInfo($path)
	{
	  $absPath = $this->settings['upload_dir_abs'] . $path;
		$absPathConv =  $this->settings['upload_dir_abs'] . ($this->isWindows ? iconv('utf-8', 'cp1250//IGNORE', $path) : $path);
	  
	  if (is_file($absPathConv))
		{
		  $pInfo = pathinfo($absPath);
		  $pInfo['extension'] = strtolower($pInfo['extension']);
		  $ico = isset($pInfo['extension']) ? strtolower(str_replace('jpeg', 'jpg', $pInfo['extension'])) : NULL;
	    if (!in_array($ico, self::$extIcos)) $ico = 'generic';
	  
		  $r = array(
		    'relativePath' => $path,
		    'path' => $absPath,
	      'baseName' => $pInfo['basename'],
	      'fileName' => $pInfo['filename'],
	      'extension' => isset($pInfo['extension']) ? $pInfo['extension'] : NULL,
  		  'size' => StrLib::convert_filesize(filesize($absPathConv)),
		    'modified' => date($this->settings['datetime_format'], filemtime($absPathConv)),
		    'icon' => $ico
		  );
		  
		  if (isset($pInfo['extension']) && in_array($pInfo['extension'], self::$imgExts))
			{
			  if ($pInfo['extension'] == 'svg')
			  {
			    if (class_exists('Imagick'))
			    {
			      $im = new Imagick();
						$im->readImage($absPathConv);
						
			      $r['width'] = $im->getImageWidth();
			      $r['height'] = $im->getImageHeight();
			      
						$im->clear();
		        $im->destroy();
			    }
				}
				else
				{
			    $dimms = getimagesize($absPathConv);
			    $r['width'] = $dimms[0];
			    $r['height'] = $dimms[1];
			  }
			}
		}
		else
		{
		  $dirInfo = FileSystem::dir_info($absPathConv);
		  $mTime = @filemtime($absPathConv . '/.');
		  
		  $r = array(
		    'relativePath' => $path,
  		  'path' => $absPath,
	  	  'modified' => $mTime ? date($this->settings['datetime_format'], $mTime) : '-',
	  	  'size' => StrLib::convert_filesize($dirInfo[2])
		  );
		}
		
		return $r;	  
	}
	
	public function sendJson($data)
	{
	  header('Content-type: application/json');
	  echo json_encode($data);
	  exit;
	}
	
	public function getDirTreeOptions()
	{
	  $html = '<option value="/">' . htmlspecialchars(basename($this->settings['upload_dir_abs'])) . '</option>' . "\n";
	  return $this->getDirTreeOptions_level(NULL, $html);
	}
	
	protected function getDirTreeOptions_level($path = NULL, &$html = NULL)
	{
	  $data = FileSystem::dir_content($this->settings['upload_dir_abs'] . $path, TRUE, FALSE);
	  
	  setlocale(LC_COLLATE, 'cs_CZ.utf8');
		uasort($data[0], 'strcoll');
	  
		$forbidden = array_keys($data[0], 'plugobrowser_cache');
		foreach($forbidden as $curForbidden)
		{
		  unset($data[0][$curForbidden]);
		}
	  
	  $levels = $path ? count(explode('/', $path)) + 1 : 1;
	  if ($path) $pathConv = StrLib::toUTF8($path);
	  
	  foreach($data[0] as $dir)
	  {
	    $dirConv = StrLib::toUTF8($dir);
	    
		  $html .= '<option value="' . ($path ? $pathConv . '/' : NULL) . $dirConv . '">' . str_repeat('&nbsp; &nbsp;', $levels) . htmlspecialchars($dirConv) . '</option>' . "\n";
			$this->getDirTreeOptions_level(($path ? $path . '/' : NULL) . $dir, $html);
		}
	  
	  return $html;
	}
	
	public function createDir($name, $parent = NULL)
	{
	  $reservedChars = array('<', '>', ':', '"', '\\', '|', '?', '*');
	  $parent = str_replace($reservedChars, '', $parent);
	  
	  if ($parent == '/') $parent = NULL;
	  elseif ($parent && $this->isWindows) $parent = iconv('utf-8', 'cp1250//IGNORE', $parent);
	  
	  if (!is_dir($this->settings['upload_dir_abs'] . $parent) && $parent)
	  {
		  $exploded = explode('/', $parent);
		  $levelCount = count($exploded);
		  for ($i = 0; $i < $levelCount; $i++)
		  {
		    $curLevel = $this->settings['upload_dir_abs'] . implode('/', array_slice($exploded, 0, $i + 1));
			  if (!is_dir($curLevel))
			  {
				  umask(0000);
					@mkdir($curLevel, 0777);
				}
			}
		}
		
		if (is_dir($this->settings['upload_dir_abs'] . $parent))
		{
		  $reservedChars[] = '/';
		
  		$name = str_replace($reservedChars, '', $name);
  		if ($this->isWindows) $name = iconv('utf-8', 'cp1250//IGNORE', $name);
	  	$path = $this->settings['upload_dir_abs'] . $parent . ($parent ? '/' : NULL) . $name;
	  	if (!is_dir($path))
	  	{
  		  umask(0000);
				$r = @mkdir($path, 0777);
	    }
			
		  return array($r, $parent ? StrLib::toUTF8($parent) : '/');
		}
		else return array(FALSE);
	}
	
	public function rename($path, $prevName, $newName)
	{
	  $path = $path == '/' ? NULL : $path . '/';
	  if ($this->isWindows)
		{
		  $path = iconv('utf-8', 'cp1250//IGNORE', $path);
		  $prevName = iconv('utf-8', 'cp1250//IGNORE', $prevName);
		  $newName = iconv('utf-8', 'cp1250//IGNORE', $newName);
		}
		
		if ($prevName == $newName) return 'true';
		else
		{
		  $reservedChars = array('<', '>', ':', '"', '\\', '|', '?', '*');
      $newName = str_replace($reservedChars, '', $newName);
    
  		if (file_exists($this->settings['upload_dir_abs'] . $path . $prevName))
	  	{
		    if (!file_exists($this->settings['upload_dir_abs'] . $path . $newName))
		    {
		      if (@rename($this->settings['upload_dir_abs'] . $path . $prevName, $this->settings['upload_dir_abs'] . $path . $newName)) return 'true';
  		    else return 'error';
	  	  }
		  	else return 'target_exists';
  		}
	  	else return 'not_exists';
	  }
	}
	
	public function handleUpload($name, $path, $chunk, $chunks, $contentType)
	{
    $maxFileAge = 5 * 3600;
    
    $reservedChars = array('<', '>', ':', '"', '\\', '|', '?', '*');
    $path = str_replace($reservedChars, '', $path);
    
    if ($path == '/') $path = NULL;
	  elseif ($path && $this->isWindows) $path = iconv('utf-8', 'cp1250//IGNORE', $path);

    $absPath = $this->settings['upload_dir_abs'] . ($path ? $path . '/' : NULL);
    
    $reservedChars[] = '/';
  	$name = str_replace($reservedChars, '_', $name);
  	if ($this->isWindows) $name = iconv('utf-8', 'cp1250//IGNORE', $name);
  	$pInfo = pathinfo($name);
  	
  	$forbiddenExts = explode(',', mb_strtolower($this->settings['forbidden_extensions_permanent'], 'UTF-8'));
		if (!$this->settings['extensions_switch']) $forbiddenExts = array_merge(
		  $forbiddenExts,
		  explode(',', mb_strtolower($this->settings['forbidden_extensions'], 'UTF-8'))
		);
		else $allowedExts = explode(',', mb_strtolower($this->settings['allowed_extensions'], 'UTF-8'));
  	
  	$ext = strtolower($pInfo['extension']);
		if (
		  in_array($ext, $forbiddenExts)
		  || ($this->settings['extensions_switch'] && !in_array($ext, $allowedExts))
		) return array(FALSE, 104, 'You are trying to upload file with forbidden extension');
    
	  if (!is_dir($absPath) && $path)
	  {
		  $exploded = explode('/', $path);
		  $levelCount = count($exploded);
		  for ($i = 0; $i < $levelCount; $i++)
		  {
		    $curLevel = $this->settings['upload_dir_abs'] . implode('/', array_slice($exploded, 0, $i + 1));
			  if (!is_dir($curLevel))
			  {
				  umask(0000);
				  mkdir($curLevel, 0777);
				}
			}
		}
		
		if (is_dir($absPath))
		{  		
  		// Make sure the fileName is unique but only if chunking is disabled
			if ($chunks < 2 && file_exists($absPath . $name))
			{				
				$count = 1;
				for ($i = 1; $i < 100; $i++)
				{
				  if (!file_exists($absPath . $pInfo['filename'] . '_' . $i . '.' . $pInfo['extension'])) break;
				}
				
				$name = $pInfo['filename'] . '_' . $i . '.' . $pInfo['extension'];
			}
			
			$finalPath = $absPath . $name;
			$tmpPath = "{$finalPath}.part~";
			
			// Remove old temp files
			if (is_dir($absPath) && ($dir = opendir($absPath)))
			{			  
			  while (($file = readdir($dir)) !== false)
				{
				  $tmpFilePath = $absPath . $file;

          // Remove temp file if it is older than the max age and is not the current file
					if (preg_match('/\.part~$/', $file) && (filemtime($tmpFilePath) < time() - $maxFileAge) && ($tmpFilePath != $tmpPath)) FileSystem::unlink($tmpFilePath);
        }

        closedir($dir);
			}
			else return array(FALSE, 100, 'Failed to open temp directory');
		}
		
		// Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
		if (strpos($contentType, 'multipart') !== false)
    {
      if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name']))
	    {
        // Open temp file
        $out = @fopen($tmpPath, $chunk == 0 ? 'wb' : 'ab');
        if ($out)
		    {
          // Read binary input stream and append it to temp file
          $in = @fopen($_FILES['file']['tmp_name'], 'rb');

          if ($in)
		    	{
			      while ($buff = fread($in, 4096))
						{
						  fwrite($out, $buff);
						}
          }
			    else return array(FALSE, 101, 'Failed to open input stream');
			
    			fclose($in);
		    	fclose($out);
    			@unlink($_FILES['file']['tmp_name']);
		    }
    		else return array(FALSE, 102, 'Failed to open output stream');
	    }
	    else return array(FALSE, 103, 'Failed to move uploaded file');
    }
    else
    {
      // Open temp file
      $out = @fopen($tmpPath, $chunk == 0 ? 'wb' : 'ab');
      if ($out)
	    {
        // Read binary input stream and append it to temp file
        $in = @fopen('php://input', 'rb');

        if ($in)
		    {
    		  while ($buff = fread($in, 4096))
					{
					  fwrite($out, $buff);
					}
		    }
		    else return array(FALSE, 101, 'Failed to open input stream');
		
   	  	fclose($in);
    		fclose($out);
	    }
	    else return array(FALSE, 102, 'Failed to open output stream');
    }

    // Check if file has been uploaded, trip the temp .part~ suffix off
    if (!$chunks || $chunk == $chunks - 1)
		{
		  $ext = strtolower(pathinfo($finalPath, PATHINFO_EXTENSION));
		  if (
			  ($w = $this->settings['max_image_width'])
				&& ($h = $this->settings['max_image_height'])
				&& in_array($ext, self::$imgExts)
			)
		  {
		    $imEnabled = class_exists('Imagick');
		    if ($imEnabled)
		    {
			    $img = new Imagick();
				  $img->readImage($tmpPath);
				  
				  $tmp = $img->coalesceImages();
	        $tmp->nextImage();
	    
	        $origW = $tmp->getImageWidth();
          $origH = $tmp->getImageHeight();
				}
				else
				{
	        $mimeTypes = array(
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif'
          );
          $mime = isset($mimeTypes[$ext]) ? $mimeTypes[$ext] : NULL;
	  
  	      switch ($mime)
	  	    {
		  	    case('image/jpeg'):
    			  	$img = imagecreatefromjpeg($tmpPath);
    			  	break;
				
  	    		case('image/gif'):
	  		   	  $img = imagecreatefromgif($tmpPath);
	  		   	  break;
			
    		  	case('image/png'):
		    	  	if ($img = imagecreatefrompng($tmpPath))
			        {
				        imagealphablending($img, true);
      			    imagesavealpha($img, true);
	      		  }
	      		  break;
			    }
			    
			    if ($img)
			    {
  			    $origW = imagesx($img);
            $origH = imagesy($img);
          }
				}
				
				if ($img)
				{
				  $newRatio = $w / $h;
			
    			if ($origW > $w || $origH > $h)
  		  	{
			      if ($origW > round($origH * $newRatio, 0))
  			  	{
	      			$ratio = $origW / $origH;
      		    $h = round($w / $ratio, 0);
  		  	  }
			      elseif ($origW < round($origH * $newRatio, 0))
			  	  {
		          $ratio = $origH / $origW;
  	      	  $w = round($h / $ratio, 0);
    		    }
    		    
    		    if ($imEnabled)
    		    {
			        $img = $img->coalesceImages();
              do {
			          $img->resizeImage($w, $h, Imagick::FILTER_LANCZOS, 1);
              } while ($img->nextImage());
              $img = $img->deconstructImages();		    
        
				 		  $img->stripImage();
		          $img->writeImages($tmpPath, TRUE);
						}
						else
						{
						  $tmp = imagecreatetruecolor($w, $h);
	  	        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $w, $h, $origW, $origH);
	  	        imagedestroy($img);
	  	        $img = $tmp;
	  	  
						  switch ($mime)
  		        {
							  case('image/jpeg'):
								  @imagejpeg($img, $tmpPath, 80);
									break;
	  			      
  			        case('image/gif'):
			  	        @imagegif($img, $tmpPath);
		  		        break;
	 		
  			        case('image/png'):
				          @imagepng($img, $tmpPath, 80);
									break;
							}
						}
				  }
				  
				  if ($imEnabled)
				  {
					  $img->clear();
		        $img->destroy();
					}
					else imagedestroy($img);
	      }
			}
			
			rename($tmpPath, $finalPath);
		}
    
    return array(TRUE);
	}
	
	protected function getRealPath($path)
	{
    $path = str_replace(array('/', '\\'), '/', $path);
    $parts = array_filter(explode('/', $path), 'strlen');
    $absolutes = array();
    foreach ($parts as $part)
		{
      if ('.' == $part) continue;
      if ('..' == $part) array_pop($absolutes);
      else $absolutes[] = $part;
    }

    return ($this->isWindows ? NULL : '/') . implode('/', $absolutes);
  }
  
  public function getAccessiblePaths()
  {
	  $base = substr($_SERVER['SCRIPT_FILENAME'], 0, -mb_strlen($_SERVER['SCRIPT_NAME'], 'UTF-8'));
		$paths = array();
		
		$base = $this->getRealPath($base);
		$pluginBase = explode(
		  '/',
			preg_replace(
			  '~^([A-Z]):~e', "strtolower('$1').':'",
			  str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__))
			)
		);
		array_pop($pluginBase);
		
		$this->getAccessiblePaths_level($base, $pluginBase, $paths);
		
		return $paths;
	}
	
	protected function getAccessiblePaths_level($path = NULL, $baseArr, &$paths = NULL)
	{
	  $baseCount = count($baseArr);
	  
	  $pathExploded = explode('/', $path);
	  if ($path) $pathConv = StrLib::toUTF8($path);
	  
	  $data = FileSystem::dir_content($path, TRUE, FALSE);
	  
		$forbidden = array_keys($data[0], 'plugobrowser_cache');
		foreach($forbidden as $curForbidden)
		{
		  unset($data[0][$curForbidden]);
		}
		
		setlocale(LC_COLLATE, 'cs_CZ.utf8');
		uasort($data[0], 'strcoll');
	  
	  foreach($data[0] as $dir)
	  {
	    $curPath = ($path ? $path . '/' : NULL) . $dir;
	    
			$curPathExploded = $pathExploded;
	    $curPathExploded[] = $dir;
	    
	    foreach($curPathExploded as $level => $part)
	    {
			  if (isset($baseArr[$level]) && $part == $baseArr[$level]) unset($curPathExploded[$level]);
			  else break;
			}
			
			if ($baseCount - $level)
			{
			  for($i = 0; $i < $baseCount - $level; $i++)
			  {
				  array_unshift($curPathExploded, '..');
				}
			}
	    
	    if (substr(decoct(@fileperms($curPath)), 2) >= ($this->isWindows ? 755 : 777))
			{
			  $paths[StrLib::toUTF8(implode('/', $curPathExploded))] = ($path ? $pathConv . '/' : NULL) . StrLib::toUTF8($dir);
			}
			$this->getAccessiblePaths_level($curPath, $baseArr, $paths);
		}
	}
}