<?php
/*This function takes in a variable that you would like to contain the host name
 *the result of the function can be a prepend to every file and folder in this server 
 *except for including php files
 */
 /*
 Author: Kenneth Mangwane
 Last edit: 10/11/16
 */
session_start();
error_reporting(E_ALL);
function get_host_p()
{
	$p="";
	if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') || $_SERVER['SERVER_PORT']==443)
	{
		$p="https://".$_SERVER['HTTP_HOST'].$p.'/';
	}
	else
	{
		$p="http://".$_SERVER['HTTP_HOST'].$p.'/';
	}
	return $p;
}
function get_host()
{
	$p="";
	if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') || $_SERVER['SERVER_PORT']==443)
	{
		$p="https://".$_SERVER['HTTP_HOST'].$p.'/';
	}
	else
	{
		$p="http://".$_SERVER['HTTP_HOST'].$p.'/';
	}
	return $p;
}
function url($key)
{
	if(function_exists("links"))
	{
		$links=links();
		if(isset($links[$key]))
			return get_host().$links[$key];
		else
			return "#";
	}
	else
	{
		return get_host().$key;
	}	
	
}

/*Given the length, this function makes a random string of numbers and 
 *letters of the specified length
 */
function randomPassword($length) 
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function randomLetters($length)
{
	return randomPassword($length);
}

function makeNo($id, $length)
{
	$date=date('y');
	$alphabet = '1234567890';
	$id=$id.'';
	$length=$length-strlen($id)-2;
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return $date.implode($pass).$id;
}

/*Given a word, this function takes the word and jumbles it and then
 *it returns the jumbled up word.
 */
function jumbo($word) 
{
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($word) - 1; //put the length -1 in cache
    for ($i = 0; $i < 20; $i++) 
    {
        $n = rand(0, $alphaLength);
        $pass[] = $word[$n];
    }
    return implode($pass); //turn the array into a string
}
function mail_p($info)
{
	if(!isset($info['to']))
		return false;

	if(!isset($info['from']))
		$info['from']="system@pronerd.co.za";

	if(!isset($info['reply-to']))
		$info['reply-to']="info@pronerd.co.za";

	if(!isset($info['subject']))
		return false;

	if(!isset($info['company']))
		$info['company']="Pronerd";

	if(!isset($info['department']))
		$info['department']="Support";

	if(!isset($info['recipient-name']))
		$info['recipient-name']="user";

	if(!isset($info['sender-name']))
		$info['sender-name']="pronerd system";

	if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

	$body="
	<html>
		<head>
			<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
		</head>
		<body style='width:95%;'>
			<center>
				<div style=' width:100%; margin:30px; padding:30px; color:grey; font-size:14pt; text-align:left'>
					".$info['message']."
				<br/>
				<p><b>Visit our side <a href='https://www.pronerd.co.za'>www.pronerd.co.za</a></b></p>
				<p>The contents of this email are subject to a <a href='http://www.pronerd.co.za/privacy'>privacy statement </a></p>
				</div>
			</center>
			<br/>
			<br/>
			<br/>
			<br/>
		</body>
	</html>
	".PHP_EOL;
	$message = wordwrap( $body, 70 );
	$headers = "From:".$info['sender-name']."<".$info['from'].">" . PHP_EOL;
	$headers .= "Reply-To:".$info['sender-name']." <".$info['reply-to'].">" . PHP_EOL;
	$headers .= "MIME-Version: 1.0" . PHP_EOL;
	$headers .= "Content-type: text/html; charset=ISO-8859-1" . PHP_EOL;
	return mail($info['to'], $info['subject'], $message, $headers);

}
/*It creates the date and time in dot notation the it returns 
 *usefull for making distinction between files
 */
function date_time()
{
	$date=date('j.n.y.h.i.s');
	$time=microtime(true); //Micro seconds
	return $date.$time;
}

/*Given the name of the input field for the picture and the directory 
 *that you want to put the picture, it takes the picture and uploads it
 *then it returns the name of the picture in the directory else null
 */
function restricted_upload($file, $dir,$size_restriction)
{
	$name = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
	$increment =randomPassword(6).date_time();
	$basename = $name . $increment . 'P98213892139KLMADS.' . $extension;
	
	$target_dir = "$dir/";
	$target_file = $target_dir .$basename;
	if($_FILES[$file]['size']>$size_restriction)
	{
		echo "File too large please upload a file less than ".$size_restriction;
		return null;
	}
    if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) 
	{
		$file=$basename;
		return $file;
    }
    else
    {
    	return null;
    }
}
function upload($file, $dir)
{

	$name = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
	$increment =randomPassword(6).date_time();
	$basename = $name . $increment . 'P98213892139KLMADS.' . $extension;
	
	$target_dir = "$dir/";
	$target_file = $target_dir .$basename;

    if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) 
	{
		$file=$basename;
		return $file;
    }
    else
    {
    	return null;
    }
}
function upload_e($file, $dir, $t)
{

	$name = pathinfo($_FILES[$file]['name'], PATHINFO_FILENAME);
	$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
	$increment =randomPassword(6).date_time();
	if($t)
	{
		$increment ="_".randomPassword(3);
		$basename = $name . $increment .".". $extension;
	
	}
	else
	{
		$basename = $name . $increment . 'P98213892139KLMADS.' . $extension;
	}
	
	$target_dir = "$dir/";
	$target_file = $target_dir .$basename;

    if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) 
	{
		$file=$basename;
		return $file;
    }
    else
    {
    	return null;
    }
}

function encrypt($password)
{
	$password=hash('sha256',$password);
	$dummy="nbvffdsthtcdsfsaDvbkj";
	$password=hash('sha256',$password.$dummy);
	$password=hash('sha256', $password);
	return hash('sha256', $password);
}


/*Classes */


class array_to_js 
{
	var $js_arrays;
	function error ($message, $stop = true) 
	{
	    echo "<b>array_to_js</b> - FATAL ERROR: ".$message;
	    if ($stop) exit;
	}
	function add_array($myarray, $outputvarname, $level = 0) 
	{
	    if (isset($this->js_arrays[$outputvarname]))
	        $this->error('This Array has been added more than once: "'.$outputvarname.'"');
	    for ($i=0; $i<$level; $i++) $pre .= '    ';
	    $this->js_arrays[$outputvarname] .= $pre.$outputvarname.' = new Object();'."\n";
	    foreach ($myarray as $key => $value) 
	    {
	        if (!is_int($key))
	            $key = '"'.addslashes($key).'"';
	        if (is_array($value))
	            $this->add_array($value, $outputvarname.'['.$key.']', $level+1);
	        else {
	            $this->js_arrays[$outputvarname] .= $pre.'    '.$outputvarname.'['.$key.']'.' = ';

	            if (is_int($value) or is_float($value))
	                $this->js_arrays[$outputvarname] .= $value;
	            elseif (is_bool($value))
	                $this->js_arrays[$outputvarname] .= $value ? "true" : "false";
	            elseif (is_string($value))
	                $this->js_arrays[$outputvarname] .= '"'.addslashes($value).'"';
	            else
	                $this->error('Unknown Datatype for "'.$outputvarname.'['.$key.']"');
	            $this->js_arrays[$outputvarname] .= ";\n";
	        }
	    }
	}
	function output_all($scripttag = true) 
	{
	    if ($scripttag) $outputstring = '<script language="JavaScript" type="text/javascript">'."\n";
	    foreach ($this->js_arrays as $array)
	        $outputstring .= $array;
	    if ($scripttag) $outputstring .= '</script>'."\n";

	    return $outputstring;
	}
}

class FacebookChat 
{
	public $ua 			= "Firefox/3.5.3 (lzyc)";
	public $cookiefile		= "cookie.txt";
	public $logged		= 0;
	
	private $email;
	private $password;
	private $attempt 	= 0;
	private $html;
	
	private $uid;
	private $channel;
	private $post_form_id;
	
	function __construct($email = NULL, $password = NULL)
	{
		
		if(!extension_loaded('curl'))	die("Install curl\r\n");
		if(!extension_loaded('json'))	die("Install json\r\n");
		if(version_compare(PHP_VERSION, '5.3', '<')) die("Update php to 5.3\r\n");
		
		$this->email	= $email;
		$this->password = $password;
		
		$this->resetcookie();
	}


	public function login()
	{
		
		
		$data = array
					(
					"charset_test" 	=> "%E2%82%AC%2C%C2%B4%2C%E2%82%AC%2C%C2%B4%2C%E6%B0%B4%2C%D0%94%2C%D0%84",
					"locale" 		=> "en_US",
					"non_com_login"	=> "",
					"persistent"		=> "1",
					"email" 		=> urlencode($this->email),
					"pass" 		=> urlencode($this->password),
					"charset_test"	=> "%E2%82%AC%2C%C2%B4%2C%E2%82%AC%2C%C2%B4%2C%E6%B0%B4%2C%D0%94%2C%D0%84",
					"lsd"			=> "str7a"
					);
					
		$this->html = $this->postreq("http://www.facebook.com/login.php?login_attempt=1", $data, 1);
					
			
			preg_match("/<title>(.+?)<\/title>/", $this->html, $out);

			if(preg_match("/Home/", $out[1])){
							preg_match("/c_user=(.+?);/", $this->html, $out);
							$this->uid = $out[1];
					
							#preg_match("/channel(\d+)/", $this->html, $out);
							#$this->channel = $out[1];
		
							preg_match("/name=\"post_form_id\" value=\"(.+?)\"/", $this->html, $out);
							$this->post_form_id = $out[1];
		
						goto a;
				
			} else {

				$this->attempt++;
					if($this->attempt > 3){
						goto b;
					}
				$this->login();
			}
			
			a: {
				$this->logged = 1;
				return true;
			}
			
			b: return false;
	}
	
	public function buddylist()
	{
		
		if(!$this->logged) die("Are you logged?");
					
		$buddies = $this->postreq("http://www.facebook.com/ajax/chat/buddy_list.php" , array(
					"user"					=> $this->uid,
					"popped_out"			=> "false",
					"force_render"			=> "true",
					"buddy_list"			=> "1",
					"notifications"			=> "0",
					"post_form_id"			=> $this->post_form_id,
					"fb_dtsg"				=> "90rZa",
					"post_form_id_source"	=> "AsyncRequest",
					"__a"					=> "1"
				));

		
			$buddies = $this->json($buddies);
			
			if(!$buddies['payload']['buddy_list']['userInfos']) die("Error\r\n");
							
			function delenableVC(&$val)
			{
				unset($val['enableVC']);
			}
			
			array_walk($buddies['payload']['buddy_list']['userInfos'], 'delenableVC');
			
			return $buddies['payload']['buddy_list']['userInfos'];

	}
	
	public function sendmsg($msg, $friend)
	{
					
		$data = array(
					"msg_text"		=> $msg,
					"msg_id"		=> rand(99999, 999999),
					"to"			=> $friend,
					"client_time"	=> time(),
					"post_form_id"	=> $this->post_form_id
				);
		
		print $this->postreq("http://www.facebook.com/ajax/chat/send.php", $data);
		
	}
	
	
	private function resetcookie()
	{
		$f = fopen($this->cookiefile, "wb");
		fclose($f);	
			
		return $f;
	}
	
	
	private function postreq($url, $postdata, $header = 0)
	{
		$ch = curl_init($url);
		
		$opt = 	curl_setopt_array ($ch, array (
					CURLOPT_REFERER			=> "http://www.facebook.com",
					CURLOPT_HEADER			=> $header,
					CURLOPT_FOLLOWLOCATION	=> 1,
					CURLOPT_RETURNTRANSFER	=> 1,
					CURLOPT_POST			=> 1,
					CURLOPT_POSTFIELDS		=> $this->postdata($postdata),
					CURLOPT_USERAGENT		=> $this->ua,
					CURLOPT_COOKIEFILE		=> $this->cookiefile,
					CURLOPT_COOKIEJAR		=> $this->cookiefile,
					CURLOPT_SSL_VERIFYPEER	=> 0,
					CURLOPT_SSL_VERIFYHOST	=> 0
				));

		$html = curl_exec($ch);
		curl_close($ch);
			
		return $html;
	}
	
	private function json($json)
	{
		return json_decode(substr($json, 9, strlen($json)), true);
	}
	
	private function postdata($array)
	{
		$final = NULL;
		foreach($array as $key => $val) $final .= $key."=".$val."&";
		return rtrim($final, "&");
	
	}
}

//advanced upload class
class auc 
{
	public $errors = array(); //array used to store any errors that occur.
	public $upload_dir = ''; //the upload_dir being used by the script
	public $make_safe = false; //default don't modify the file name to safe version
	public $max_file_size = 1048576; //Max File Size in Bytes, 1MB
	public $overwrite = false; //default don't overwrite files that already exsist
	public $check_file_type = false; //don't check for file type by default but can check for allowed and denied files.
	public $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif', 'image/tiff'); //array of allowed mime types used when check_file_type is set to allowed
	public $denied_mime_types = array('application/x-php', 'text/html'); //array of denied mime types used when check_file_type is set to denied
	
	/**
	 * Check if the upload dir is valid, if it is not valid attempt to make the dir, if dir is succesfully created chmod it to 0777. 
	 * If any elments fail return false else set upload_dir and return true.
	 * @param string $dir
	 * @param boolean $mkdir
	 * @return true or false
	 */
	public function upload_dir($dir, $mkdir = false) {
		$errors =& $this->errors;
		$status = true;
		
		if (!is_dir($dir)) {
			if ($mkdir) {
				if (!mkdir($dir)) {
					$status = false;
				} else {
					if (!chmod($dir, 0777)) $status = false;
				}
			} else {
				$status = false;
			}
		}
		
		if ($status) {
			$this->upload_dir = $dir;
			return true;
		} else {
			$errors['general'][] = 'Upload Dir is Not Valid and/or a dir could not be created/chmod.';
			return false;
		}
	}
	
	/**
	 * check that the upload dir is valid and that it is writeable
	 *
	 * @param string $dir
	 * @return true or false
	 */
	public function check_dir($dir) {
		if (!is_dir($dir) || !is_writable($dir)) return false;
		
		return true;
	}
	

	/**
	 * make the uploaded file name safe
	 *
	 * @param string $file_name
	 * @return safe file name
	 */
	public function make_safe($file_name) {
		return str_replace(' ', '_', $file_name);
	}
		
	/**
	 * Check the Attemted Uploads for errors etc if everything goes good move the file, to the upload_dir.
	 *
	 * @param array $object
	 * @return unknown
	 */
	public function upload($object) {
		$errors =& $this->errors;
		
		if (empty($errors['general'])) {
			if (empty($this->upload_dir)) $this->upload_dir = dirname(__FILE__).'/'; //if no default upload_dir has been specified used the current dir.
					
			if ($this->check_dir($this->upload_dir)) {
				$files = $_FILES[$object];
				$count = count($files['name']) - 1;
				
				echo '<pre>';
				var_dump($files);
				echo '</pre>';
				
				for ($current = 0; $current <= $count; $current++) {
					$error = '';
					try {
						//check for $_FILES Errors
						switch ($files['error'][$current]) {
							case 0 : break;
							case 1 : $error = $files['name'][$current].' exceeds the upload_max_filesize directive in php.ini'; break;
							case 2 : $error = $files['name'][$current].' exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; break;
							case 3 : $error = $files['name'][$current].' was only partially uploaded'; break;
							case 4 : $error = 'No file was uploaded'; break;
							case 6 : $error = 'Missing a temporary folder'; break;
							case 7 : $error = 'Failed to write '.$files['name'][$current].' to disk'; break;
							case 8 : $error = $files['name'][$current].' stopped by extension'; break;
							default : $error = 'Unidentified Error, caused by '.$files['name'][$current]; break;
						}
						if ($error) 
							throw new TrigerErrorException($error, $files['name'][$current]);
						
						//check that the file is not empty
						if ($files['size'][$current] <= 0)
							throw new TrigerErrorException($files['name'][$current].' is empty', $files['name'][$current]);
						
						//check that the file does not exceed the defined max_file_size
						if ($this->max_file_size) {
							if ($files['size'][$current] >= $this->max_file_size) 
								throw new TrigerErrorException($files['name'][$current].' exceeds defined max_file_size', $files['name'][$current]);
						}
						
						if ($this->check_file_type == 'allowed' && !in_array($files['type'][$current], $this->allowed_mime_types)) {
							throw new TrigerErrorException($files['name'][$current].' is not an allowed type', $files['name'][$current]);
						} elseif ($this->check_file_type == 'denied' && in_array($files['type'][$current], $this->denied_mime_types)) {
							throw new TrigerErrorException($files['name'][$current].' is a denied type', $files['name'][$current]);
						}
						
						//if make_safe is true call make safe function		
						if ($this->make_safe)
							$files['name'][$current] = $this->make_safe($files['name'][$current]);
						
						//if overwrite is false and the file exists error
						if (!$this->overwrite && file_exists($this->upload_dir.$files['name'][$current]))
							throw new TrigerErrorException($files['name'][$current].' already exsists', $files['name'][$current]);
							
						//move the uploaded file, error if anything goes wrong.
						if (!move_uploaded_file($files['tmp_name'][$current], $this->upload_dir.$files['name'][$current]))
							throw new TrigerErrorException($files['name'][$current].' could not be moved', $files['name'][$current]);
					} catch (TrigerErrorException $e) {
						$errors[$files['name'][$current]][] = $e->Message();
					}
				}
				
				if (empty($errors)) {
					//return true if there where no errors
					return true;
				} else {
					//return the errors array if there where any errros
					return $errors;
				}
			} else {
				//return false as dir is not valid
				$errors['general'][] = "The Specified Dir is Not Valid or is Not Writeable";
				return false;
			}
		}
	}	
}

/**
 * Handle the Exceptions trigered by errors within upload code.
 *
 */
class TrigerErrorException extends Exception 
{
	protected $file = "";
	public function __construct($message, $file = "", $code = 0) 
	{
		$this->file = $file;
   		parent::__construct($message, $code);
	}

	public function Message() 
	{
		return "{$this->message}";
	}
}

class aFiles
{
	/**
	 * Default path to an entity
	 * @var string
	 * @access private
	 */
	private $path	= false;
	
	/**
	 * Constructor which allows to chose the path of the entity used for following actions
	 * @param string $path
	 */
	public function __construct($path = false)
	{
		$this->path = $path;
	}
	
	/**
	 * Methods which allows to chose the path of the entity used for following actions
	 * @param string $path
	 */
	public function set_path($path = false)
	{
		$this->path = $path;
	}
	
	/**
	 * Return the path of the entity used by default
	 * @return string
	 */
	public function get_path()
	{
		return $this->path;
	}
	
	/**
	 * Return the type of an entity
	 * @param string $path
	 * @return string
	 */
	public function type($path = null)
	{
		$this->test_var($path, $this->path);
		
		if (is_dir($path))
			return 'dir';
			
		else if (is_file($path))
			return 'file';
		
		else
			return false;
	}
	
	/**
	 * Return the list of all entity included in the path
	 * @param string $path
	 * @param boolean $withroot
	 * @return array
	 */
	public function ls($path = null, $withroot = true)
	{
		$this->test_var($path, $this->path);
		
		if (!is_dir($path))
			return false;
			
		if ($handle = opendir($path))
		{
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != '..' && $file != '.' && $file != '')
				{
					if ($withroot)
						$infos[] = $path.'/'.$file;
						
					else
						$infos[] = $file;
				}
			}
			
			closedir($handle);
			
			$infos = array_map(array($this, 'format_path'), $infos);
			
			return $infos;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Return the list of directories included in the path
	 * @param string $path
	 * @param boolean $withroot
	 * @return array
	 */
	public function lsd($path = null, $withroot = true)
	{
		$this->test_var($path, $this->path);
		
		if (!is_dir($path))
			return false;
		
		$infos = array();
		
		if ($handle = opendir($path))
		{
			while (false !== ($file = readdir($handle)))
			{
				if (is_dir($path.'/'.$file)) 
				{
					if ($file != '..' && $file != '.' && $file != '')
					{
						if ($withroot)
							$infos[] = $path.'/'.$file;
							
						else
							$infos[] = $file;
					}
				}
			}
			
			$infos = array_map(array($this, 'format_path'), $infos);
			closedir($handle);
			
			return $infos;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Return infos of all entity included in the path
	 * @param string $path
	 * @param boolean $withroot
	 * @return array
	 */
	public function ll($path = null, $withroot = true)
	{
		$this->test_var($path, $this->path);
		
		if (!is_dir($path))
			return false;
			
		if ($handle = opendir($path))
		{
			while (false !== ($file = readdir($handle))) 
			{
				if ($file != '..' && $file != '.' && $file != '')
				{
					if ($withroot)
					{
						$temp = $this->format_path($path.'/'.$file);
						$infos[$temp] = $this->infos($temp);
					}
					else
					{
						$temp = $this->format_path($file);
						$infos[$temp] = $this->infos($path.'/'.$file);
					}
				}
			}
			
			closedir($handle);
			
			return $infos;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Return infos of all directories included in the path
	 * @param string $path
	 * @param boolean $withroot
	 * @return array
	 */
	public function lld($path = null, $withroot = true)
	{
		$this->test_var($path, $this->path);
		
		if (!is_dir($path))
			return false;
			
		if ($handle = opendir($path))
		{
			while (false !== ($file = readdir($handle))) 
			{
				if (is_dir($path.'/'.$file))
				{
					if ($file != '..' && $file != '.' && $file != '')
					{
						if ($withroot)
						{
							$temp = $this->format_path($path.'/'.$file);
							$infos[$temp] = $this->infos($temp);
						}
						else
						{
							$temp = $this->format_path($file);
							$infos[$temp] = $this->infos($path.'/'.$file);
						}
					}
				}
			}
			
			closedir($handle);
			
			return $infos;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Create a file with or without content
	 * @param string $content
	 * @param string $path
	 * @return boolean
	 */
	public function mkfile($content = '', $path = null)
	{
		$this->test_var($path, $this->path);
		
		if ($handle = fopen($path, 'w+'))
		{
			if (strlen($content) != 0)
				fwrite($handle, $content);
				
			fclose($handle);
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Read the content of a file 
	 * @param string $path
	 * @param boolean $byline
	 * @param int $length
	 * @return string/array
	 */
	public function read_file($path = null, $byline = false, $length = 1024)
	{
		$this->test_var($path, $this->path);
		
		if (!is_file($path))
			return false;
		
		if ($byline)
		{
			if ($handle = fopen($path, 'r'))
			{
				while (!feof($handle)) 
					$lines[] = fgets($handle, $length);
				
				fclose($handle);
				
				return $lines;
			}
			else
				return false;
		}
		else
		{
			return file_get_contents($path);
		}
	}
	
	/**
	 * Create a directory with/without chmod
	 * @param string $path
	 * @param int $chmod
	 * @return boolean
	 */
	public function mkdir($path = null, $chmod = null)
	{
		$this->test_var($path, $this->path);
		
		if (@mkdir($path))
		{
			if (!is_null($chmod))
				chmod($path, $chmod);
				
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Move a file or a directory
	 * @param string $path
	 * @param string $where
	 * @return boolean
	 */
	public function mv($path, $where)
	{	
		if (!is_dir($where))
			return false;
		
		if (is_dir($path))
		{
			$tree = $this->tree($path);
			$this->cp($path, $where);
			$this->rm($tree);
		}
		else if (is_file($path))
		{
			$this->cp($path, $where);
			$this->rm($path);
		}
		
		return true;
	}
	
	/**
	 * Remove files or/and directories
	 * @param string $path
	 * @return boolean
	 */
	public function rm($path = null)
	{
		$this->test_var($path, $this->path);
		
		if (!is_array($path))
			$path = array($path);
		
		foreach ($path as $file)
		{
			if (is_dir($file))
			{
				$tree = $this->tree($file);
				rsort($tree);
				
				foreach ($tree as $f)
				{
					if (is_dir($f))
						rmdir($f);

					else if (is_file($f))
						unlink($f);
				}
			}
			else if (is_file($file))
			{
				unlink($file);
			}
			else
			{
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Copy files or/and directories
	 * @param string $path
	 * @param string $where
	 * @return boolean
	 */
	public function cp($path, $where)
	{	
		if (!is_dir($where))
			return false;
			
		if (!is_array($path))
			$path = array($path);
			
		foreach($path as $file)
		{
			if (is_file($file))
				copy($file, $where.'/'.$file);
				
			else if (is_dir($file))
			{
				$files = $this->tree($file);
				$this->mkdir($where.'/'.$file);
				
				foreach ($files as $f)
				{
					if (is_file($f))
						copy($f, $where.'/'.$f);
					else if (is_dir($f))
						$this->mkdir($where.'/'.$f);
				}
			}
		}
		
		return true;
	}
	
	/**
	 * Return the mod of a file/directory
	 * Credits goes to Ambriel_Angel (www dot ambriels dot net)
	 * @param string $path
	 * @return int
	 */
	public function mod($path) 
	{
		$this->test_var($path, $this->path);
		
		// Initialisation
		$val	= 0;
		$perms	= fileperms($path);
		
		// Owner; User
		$val += (($perms & 0x0100) ? 0x0100 : 0x0000);		// Read
		$val += (($perms & 0x0080) ? 0x0080 : 0x0000);		// Write
		$val += (($perms & 0x0040) ? 0x0040 : 0x0000);		// Execute

		// Group
		$val += (($perms & 0x0020) ? 0x0020 : 0x0000);		// Read
		$val += (($perms & 0x0010) ? 0x0010 : 0x0000);		// Write
		$val += (($perms & 0x0008) ? 0x0008 : 0x0000);		// Execute

		// Global; World
		$val += (($perms & 0x0004) ? 0x0004 : 0x0000);		// Read
		$val += (($perms & 0x0002) ? 0x0002 : 0x0000);		// Write
		$val += (($perms & 0x0001) ? 0x0001 : 0x0000);		//	Execute

		// Misc
		$val += (($perms & 0x40000) ? 0x40000 : 0x0000);	// temporary file (01000000)
		$val += (($perms & 0x80000) ? 0x80000 : 0x0000); 	// compressed file (02000000)
		$val += (($perms & 0x100000) ? 0x100000 : 0x0000);	// sparse file (04000000)
		$val += (($perms & 0x0800) ? 0x0800 : 0x0000);		// Hidden file (setuid bit) (04000)
		$val += (($perms & 0x0400) ? 0x0400 : 0x0000);		// System file (setgid bit) (02000)
		$val += (($perms & 0x0200) ? 0x0200 : 0x0000);		// Archive bit (sticky bit) (01000)

		return decoct($val);
	}
	
	/**
	 * Return infos concerning the entity
	 * @param string $path
	 * @param boolean $withroot
	 * @param boolean $content
	 * @param boolean $byline
	 * @param int $length
	 * @return array
	 */
	public function infos($path = null, $withroot = true, $content = true, $byline = false, $length = 1024)
	{
		$this->test_var($path, $this->path);
		
		if (is_dir($path))
		{
			if ($handle = opendir($path))
			{
				$infos['type']			= 'dir';
				$infos['path_infos']	= pathinfo($path);
				$infos['atime']			= fileatime($path);
				$infos['ctime']			= filectime($path);
				$infos['mtime']			= filemtime($path);
				$infos['chmod']			= $this->mod($path);
				$infos['owner_id']		= fileowner($path);
				$infos['owner_infos']	= posix_getpwuid($infos['owner_id']);
				$infos['group_id']		= filegroup($path);
				$infos['group_infos']	= posix_getgrgid($infos['group_id']);
				$infos['dir_count']		= 0;
				$infos['files_count']	= 0;
				$infos['size']			= $this->filesize($path);
				$infos['files']			= array();
				$infos['directories']	= array();
				
				while (false !== ($file = readdir($handle)))
				{
					if (is_dir($path.'/'.$file)) 
					{
						if ($file != '..' && $file != '.' && $file != '')
						{
							$infos['dir_count']++;
							if ($withroot)
								$infos['directories'][] = $path.'/'.$file;
							else
								$infos['directories'][] = $file;
						}
					}
					else if (is_file($path.'/'.$file))
					{
						$infos['files_count']++;
						
						if ($withroot)
							$infos['files'][] = $path.'/'.$file;
						else
							$infos['files'][] = $file;
					}
				}
				
				$infos['files']			= array_map(array($this, 'format_path'), $infos['files']);
				$infos['directories']	= array_map(array($this, 'format_path'), $infos['directories']);
				
				$this->sort_results($infos['directories']);
				$this->sort_results($infos['files']);
				
				closedir($handle);
				
				return $infos;
			}
			else
			{
				return false;
			}
		}
		else if (is_file($path))
		{
			if ($handle = fopen($path, 'r')) 
			{
				$infos['type']			= 'file';
				$infos['path_infos']	= pathinfo($path);
				$infos['atime']			= fileatime($path);
				$infos['ctime']			= filectime($path);
				$infos['mtime']			= filemtime($path);
				$infos['chmod']			= $this->mod($path);
				$infos['owner_id']		= fileowner($path);
				$infos['owner_infos']	= posix_getpwuid($infos['owner_id']);
				$infos['group_id']		= filegroup($path);
				$infos['group_infos']	= posix_getgrgid($infos['group_id']);
				$infos['lines_count']	= 0;
				$infos['size']			= $this->filesize($path);
				$infos['md5']			= md5_file($path);
				$infos['sha1']			= sha1_file($path);
				
				if ($content)
					$infos['content']		= $byline === true ? array() : file_get_contents($path);
				
				while (!feof($handle)) 
				{
					if ($byline && $content)
						$infos['content'][] = fgets($handle, $length);
					else
						fgets($handle, $length);
					
					$infos['lines_count']++;
				}
				
				fclose($handle);
				
				return $infos;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Return tree of a directory
	 * @param string $path
	 * @param boolean $expand2files
	 * @return array
	 */
	public function tree($path = null, $expand2files = true)
	{
		$this->test_var($path, $this->path);
		
		$directories = $this->lsd($path);
		
		for ($x = 0; $x < count($directories); $x++)
		{
			if (!is_dir($directories[$x]))
				continue;
				
			if ($handle = opendir($directories[$x]))
			{
				while (false !== ($file = readdir($handle)))
				{
					if (is_dir($directories[$x]."/".$file)) 
					{
						if ($file != '..' && $file != '.' && $file != '')
						{
							$directories[] = $directories[$x]."/".$file;
						}
					}
				}
				closedir($handle);
			}
			else
			{
				$directories[] = false;
			}
		}
		
		$directories[]	= $path;
		$directories	= array_map(array($this, 'format_path'), $directories);
			
		if ($expand2files)
		{		 
			foreach ($directories as $dir)
			{	
				$expanded_directories[] = $dir;
				
				if ($handle = opendir($dir))
				{
					while (false !== ($file = readdir($handle)))
						if (is_file($dir.'/'.$file))
							$expanded_directories[] = $dir.'/'.$file;
				}
				else
				{
					$expanded_directories[] = false;
				}
			}
			
			$expanded_directories = array_map(array($this, 'format_path'), $expanded_directories);
			
			$this->sort_results($expanded_directories);
		}
		else
		{
			$this->sort_results($directories);
		}
		
		return $expand2files === true ? $expanded_directories : $directories;
	}
	
	/**
	 * Return the size of an entity
	 * @param string $path
	 * @return int
	 */
	public function filesize($path = null)
	{
		$this->test_var($path, $this->path);
		
		if (is_file($path))
			return filesize($path);
		else
		{
			$tree = $this->tree($path);
			$size = 0;
			
			foreach ($tree as $file)
				if (is_file($file))
					$size += filesize($file);
					
			return $size;
		}
	}
	
	/**
	 * Serialize and creates a file with the serial
	 * @param anything $var
	 * @param string $path
	 * @return boolean
	 */
	public function serialize($var, $path = null)
	{
		$this->test_var($path, $this->path);
		
		if($this->mkfile(serialize($var), $path))
			return true;
		else
			return false;
	}
	
	/**
	 * Unserialize a file
	 * @param string $path
	 * @return array
	 */
	public function unserialize($path = null)
	{
		$this->test_var($path, $this->path);
		
		if(is_file($path))
			return unserialize($this->read_file($path));
		else
			return false;
	}
	
	/**
	 * Parse a ini file
	 * @param string $path
	 * @return array
	 */
	public function parse_ini($path = null, $whithsection = true)
	{
		$this->test_var($path, $this->path);
		
		if(is_file($path))
			return parse_ini_file($path, $whithsection);
		else
			return false;
	}
	
	/**
	 * Make ini file
	 * @param array $content
	 * @param string $path
	 * @return boolean
	 */
	public function mkini($content, $path = null)
	{
		$this->test_var($path, $this->path);
		
		$out = '';
		
		if (!is_array($content))
			return false;
		
		foreach ($content as $key => $ini)
		{
			if (is_array($ini))
			{
				$out .= "\n[".$key."]\n\n";
				
				foreach ($ini as $var => $value)
				{
					$out .= $var." \t\t= ".$this->quote_ini($value)."\n";
				}
			}
			else
			{
				$out .= $key." \t\t= ".$this->quote_ini($ini)."\n";
			}
		}
		
		return $this->mkfile($out, $path);
	}
	
	/* Private section									 
	------------------------------------------------- */	

	/**
	 * Set a variable to $default parameter if it's null
	 * @param anything $var
	 * @param anything $default
	 */
	private function test_var(&$var, $default)
	{
		if (is_null($var) || strlen(trim($var)) === 0)
			$var = $default;
	}
	
	/**
	 * Replace '//' by '/' in paths
	 * @param string $path
	 * @return string
	 */
	private function format_path($path)
	{
		return preg_replace('#\/{2,}#', '/', $path);
	}
	
	/**
	 * Quote ini var if needed
	 * @param anything $var
	 * @return anything
	 */
	private function quote_ini($var)
	{
		return is_string($var) === true ? '"'.str_replace('"', '\"', $var).'"' : $var;
	}
	
	/**
	 * Sort results
	 * @param array $array
	 * @return array
	 */
	private function sort_results(&$array)
	{
		if (is_array($array))
			array_multisort(array_map('strtolower', $array), SORT_STRING, SORT_ASC, $array);
	}
}


class barcode 
{
	var $file;
	var $into;

	var $cd_barras = array(
						0=>"00110",
						1=>"10001",
						2=>"01001",
						3=>"11000",
						4=>"00101",
						5=>"10100",
						6=>"01100",
						7=>"00011",
						8=>"10010",
						9=>"01010"
					);
	function barcode($value,$into=1, $filename = 'barcode.gif') { 
	  $lower = 1 ; $hight = 50;          
	  $this->into = $into;
          $this->file = $filename;
	  for($count1=9;$count1>=0;$count1--){ 
		for($count2=9;$count2>=0;$count2--){   
		  $count = ($count1 * 10) + $count2 ; 
		  $text = "" ; 
		  for($i=1;$i<6;$i++){ 
			$text .=  substr($this->cd_barras[$count1],($i-1),1) . substr($this->cd_barras[$count2],($i-1),1); 
		  } 
		  $this->cd_barras[$count] = $text; 
	   } 
	  } 
	
		  //$img 		= imagecreate($lower*95+300,$hight+30);
		  $img 		= imagecreate(395,73);    
		  $cl_black = imagecolorallocate($img, 0, 0, 0); 
		  $cl_white = imagecolorallocate($img, 255, 255, 255); 
	
             
		   
		  imagefilledrectangle($img, 0, 0, $lower*95+1000, $hight+30, $cl_white); 
		   

		  imagefilledrectangle($img, 1,5,1,65,$cl_black); 
		  imagefilledrectangle($img, 2,5,2,65,$cl_white); 
		  imagefilledrectangle($img, 3,5,3,65,$cl_black); 
		  imagefilledrectangle($img, 4,5,4,65,$cl_white); 

	$thin = 1 ; 
	if(substr_count(strtoupper($_SERVER['SERVER_SOFTWARE']),"WIN32")){
	
 		$wide = 3;
	} else {
			$wide = 2.72;
	   }
	$pos   = 5 ; 
	$text = $value ; 
	if((strlen($text) % 2) <> 0){ 
		$text = "0" . $text; 
	} 

	while (strlen($text) > 0) { 
	  $i = round($this->barra_left($text,2)); 
	  $text = $this->barra_right($text,strlen($text)-2); 
	   
	  $f = $this->cd_barras[$i]; 
	   
	  for($i=1;$i<11;$i+=2){ 
		if (substr($f,($i-1),1) == "0") { 
		  $f1 = $thin ; 
		}else{ 
		  $f1 = $wide ; 
		} 
	
   
	  imagefilledrectangle($img, $pos,5,$pos-1+$f1,65,$cl_black)  ; 
	  $pos = $pos + $f1 ;   
	   
	  if (substr($f,$i,1) == "0") { 
		  $f2 = $thin ; 
		}else{ 
		  $f2 = $wide ; 
		} 
	

	  imagefilledrectangle($img, $pos,5,$pos-1+$f2,65,$cl_white)  ; 
	  $pos = $pos + $f2 ;   
	  } 
	} 
	

	imagefilledrectangle($img, $pos,5,$pos-1+$wide,65,$cl_black); 
	$pos=$pos+$wide; 
	
	imagefilledrectangle($img, $pos,5,$pos-1+$thin,65,$cl_white); 
	$pos=$pos+$thin; 
	
	
	imagefilledrectangle($img, $pos,5,$pos-1+$thin,65,$cl_black); 
	$pos=$pos+$thin; 
	
	$this->put_img($img);
	} 
	
	function barra_left($input,$comp){ 
		return substr($input,0,$comp); 
	} 
	
	function barra_right($input,$comp){ 
		return substr($input,strlen($input)-$comp,$comp); 
	} 

	function put_img($image,$file='test.gif'){
		if($this->into){
			imagegif($image,$this->file);
		} else {
					header("Content-type: image/gif");
					imagegif($image);
			   }
		imagedestroy($image);
	}
}

/**
 * PHPMailer - PHP email creation and transport class.
 * @package PHPMailer
 */
class PHPMailer
{
    /**
     * The PHPMailer Version number.
     * @var string
     */
    public $Version = '5.2.16';

    /**
     * Email priority.
     * Options: null (default), 1 = High, 3 = Normal, 5 = low.
     * When null, the header is not set at all.
     * @var integer
     */
    public $Priority = null;

    /**
     * The character set of the message.
     * @var string
     */
    public $CharSet = 'iso-8859-1';

    /**
     * The MIME Content-type of the message.
     * @var string
     */
    public $ContentType = 'text/plain';

    /**
     * The message encoding.
     * Options: "8bit", "7bit", "binary", "base64", and "quoted-printable".
     * @var string
     */
    public $Encoding = '8bit';

    /**
     * Holds the most recent mailer error message.
     * @var string
     */
    public $ErrorInfo = '';

    /**
     * The From email address for the message.
     * @var string
     */
    public $From = 'root@localhost';

    /**
     * The From name of the message.
     * @var string
     */
    public $FromName = 'Root User';

    /**
     * The Sender email (Return-Path) of the message.
     * If not empty, will be sent via -f to sendmail or as 'MAIL FROM' in smtp mode.
     * @var string
     */
    public $Sender = '';

    /**
     * The Return-Path of the message.
     * If empty, it will be set to either From or Sender.
     * @var string
     * @deprecated Email senders should never set a return-path header;
     * it's the receiver's job (RFC5321 section 4.4), so this no longer does anything.
     * @link https://tools.ietf.org/html/rfc5321#section-4.4 RFC5321 reference
     */
    public $ReturnPath = '';

    /**
     * The Subject of the message.
     * @var string
     */
    public $Subject = '';

    /**
     * An HTML or plain text message body.
     * If HTML then call isHTML(true).
     * @var string
     */
    public $Body = '';

    /**
     * The plain-text message body.
     * This body can be read by mail clients that do not have HTML email
     * capability such as mutt & Eudora.
     * Clients that can read HTML will view the normal Body.
     * @var string
     */
    public $AltBody = '';

    /**
     * An iCal message part body.
     * Only supported in simple alt or alt_inline message types
     * To generate iCal events, use the bundled extras/EasyPeasyICS.php class or iCalcreator
     * @link http://sprain.ch/blog/downloads/php-class-easypeasyics-create-ical-files-with-php/
     * @link http://kigkonsult.se/iCalcreator/
     * @var string
     */
    public $Ical = '';

    /**
     * The complete compiled MIME message body.
     * @access protected
     * @var string
     */
    protected $MIMEBody = '';

    /**
     * The complete compiled MIME message headers.
     * @var string
     * @access protected
     */
    protected $MIMEHeader = '';

    /**
     * Extra headers that createHeader() doesn't fold in.
     * @var string
     * @access protected
     */
    protected $mailHeader = '';

    /**
     * Word-wrap the message body to this number of chars.
     * Set to 0 to not wrap. A useful value here is 78, for RFC2822 section 2.1.1 compliance.
     * @var integer
     */
    public $WordWrap = 0;

    /**
     * Which method to use to send mail.
     * Options: "mail", "sendmail", or "smtp".
     * @var string
     */
    public $Mailer = 'mail';

    /**
     * The path to the sendmail program.
     * @var string
     */
    public $Sendmail = '/usr/sbin/sendmail';

    /**
     * Whether mail() uses a fully sendmail-compatible MTA.
     * One which supports sendmail's "-oi -f" options.
     * @var boolean
     */
    public $UseSendmailOptions = true;

    /**
     * Path to PHPMailer plugins.
     * Useful if the SMTP class is not in the PHP include path.
     * @var string
     * @deprecated Should not be needed now there is an autoloader.
     */
    public $PluginDir = '';

    /**
     * The email address that a reading confirmation should be sent to, also known as read receipt.
     * @var string
     */
    public $ConfirmReadingTo = '';

    /**
     * The hostname to use in the Message-ID header and as default HELO string.
     * If empty, PHPMailer attempts to find one with, in order,
     * $_SERVER['SERVER_NAME'], gethostname(), php_uname('n'), or the value
     * 'localhost.localdomain'.
     * @var string
     */
    public $Hostname = '';

    /**
     * An ID to be used in the Message-ID header.
     * If empty, a unique id will be generated.
     * You can set your own, but it must be in the format "<id@domain>",
     * as defined in RFC5322 section 3.6.4 or it will be ignored.
     * @see https://tools.ietf.org/html/rfc5322#section-3.6.4
     * @var string
     */
    public $MessageID = '';

    /**
     * The message Date to be used in the Date header.
     * If empty, the current date will be added.
     * @var string
     */
    public $MessageDate = '';

    /**
     * SMTP hosts.
     * Either a single hostname or multiple semicolon-delimited hostnames.
     * You can also specify a different port
     * for each host by using this format: [hostname:port]
     * (e.g. "smtp1.example.com:25;smtp2.example.com").
     * You can also specify encryption type, for example:
     * (e.g. "tls://smtp1.example.com:587;ssl://smtp2.example.com:465").
     * Hosts will be tried in order.
     * @var string
     */
    public $Host = 'localhost';

    /**
     * The default SMTP server port.
     * @var integer
     * @TODO Why is this needed when the SMTP class takes care of it?
     */
    public $Port = 25;

    /**
     * The SMTP HELO of the message.
     * Default is $Hostname. If $Hostname is empty, PHPMailer attempts to find
     * one with the same method described above for $Hostname.
     * @var string
     * @see PHPMailer::$Hostname
     */
    public $Helo = '';

    /**
     * What kind of encryption to use on the SMTP connection.
     * Options: '', 'ssl' or 'tls'
     * @var string
     */
    public $SMTPSecure = '';

    /**
     * Whether to enable TLS encryption automatically if a server supports it,
     * even if `SMTPSecure` is not set to 'tls'.
     * Be aware that in PHP >= 5.6 this requires that the server's certificates are valid.
     * @var boolean
     */
    public $SMTPAutoTLS = true;

    /**
     * Whether to use SMTP authentication.
     * Uses the Username and Password properties.
     * @var boolean
     * @see PHPMailer::$Username
     * @see PHPMailer::$Password
     */
    public $SMTPAuth = false;

    /**
     * Options array passed to stream_context_create when connecting via SMTP.
     * @var array
     */
    public $SMTPOptions = array();

    /**
     * SMTP username.
     * @var string
     */
    public $Username = '';

    /**
     * SMTP password.
     * @var string
     */
    public $Password = '';

    /**
     * SMTP auth type.
     * Options are CRAM-MD5, LOGIN, PLAIN, NTLM, XOAUTH2, attempted in that order if not specified
     * @var string
     */
    public $AuthType = '';

    /**
     * SMTP realm.
     * Used for NTLM auth
     * @var string
     */
    public $Realm = '';

    /**
     * SMTP workstation.
     * Used for NTLM auth
     * @var string
     */
    public $Workstation = '';

    /**
     * The SMTP server timeout in seconds.
     * Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2
     * @var integer
     */
    public $Timeout = 300;

    /**
     * SMTP class debug output mode.
     * Debug output level.
     * Options:
     * * `0` No output
     * * `1` Commands
     * * `2` Data and commands
     * * `3` As 2 plus connection status
     * * `4` Low-level data output
     * @var integer
     * @see SMTP::$do_debug
     */
    public $SMTPDebug = 0;

    /**
     * How to handle debug output.
     * Options:
     * * `echo` Output plain-text as-is, appropriate for CLI
     * * `html` Output escaped, line breaks converted to `<br>`, appropriate for browser output
     * * `error_log` Output to error log as configured in php.ini
     *
     * Alternatively, you can provide a callable expecting two params: a message string and the debug level:
     * <code>
     * $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";};
     * </code>
     * @var string|callable
     * @see SMTP::$Debugoutput
     */
    public $Debugoutput = 'echo';

    /**
     * Whether to keep SMTP connection open after each message.
     * If this is set to true then to close the connection
     * requires an explicit call to smtpClose().
     * @var boolean
     */
    public $SMTPKeepAlive = false;

    /**
     * Whether to split multiple to addresses into multiple messages
     * or send them all in one message.
     * Only supported in `mail` and `sendmail` transports, not in SMTP.
     * @var boolean
     */
    public $SingleTo = false;

    /**
     * Storage for addresses when SingleTo is enabled.
     * @var array
     * @TODO This should really not be public
     */
    public $SingleToArray = array();

    /**
     * Whether to generate VERP addresses on send.
     * Only applicable when sending via SMTP.
     * @link https://en.wikipedia.org/wiki/Variable_envelope_return_path
     * @link http://www.postfix.org/VERP_README.html Postfix VERP info
     * @var boolean
     */
    public $do_verp = false;

    /**
     * Whether to allow sending messages with an empty body.
     * @var boolean
     */
    public $AllowEmpty = false;

    /**
     * The default line ending.
     * @note The default remains "\n". We force CRLF where we know
     *        it must be used via self::CRLF.
     * @var string
     */
    public $LE = "\n";

    /**
     * DKIM selector.
     * @var string
     */
    public $DKIM_selector = '';

    /**
     * DKIM Identity.
     * Usually the email address used as the source of the email.
     * @var string
     */
    public $DKIM_identity = '';

    /**
     * DKIM passphrase.
     * Used if your key is encrypted.
     * @var string
     */
    public $DKIM_passphrase = '';

    /**
     * DKIM signing domain name.
     * @example 'example.com'
     * @var string
     */
    public $DKIM_domain = '';

    /**
     * DKIM private key file path.
     * @var string
     */
    public $DKIM_private = '';

    /**
     * Callback Action function name.
     *
     * The function that handles the result of the send email action.
     * It is called out by send() for each email sent.
     *
     * Value can be any php callable: http://www.php.net/is_callable
     *
     * Parameters:
     *   boolean $result        result of the send action
     *   string  $to            email address of the recipient
     *   string  $cc            cc email addresses
     *   string  $bcc           bcc email addresses
     *   string  $subject       the subject
     *   string  $body          the email body
     *   string  $from          email address of sender
     * @var string
     */
    public $action_function = '';

    /**
     * What to put in the X-Mailer header.
     * Options: An empty string for PHPMailer default, whitespace for none, or a string to use
     * @var string
     */
    public $XMailer = '';

    /**
     * Which validator to use by default when validating email addresses.
     * May be a callable to inject your own validator, but there are several built-in validators.
     * @see PHPMailer::validateAddress()
     * @var string|callable
     * @static
     */
    public static $validator = 'auto';

    /**
     * An instance of the SMTP sender class.
     * @var SMTP
     * @access protected
     */
    protected $smtp = null;

    /**
     * The array of 'to' names and addresses.
     * @var array
     * @access protected
     */
    protected $to = array();

    /**
     * The array of 'cc' names and addresses.
     * @var array
     * @access protected
     */
    protected $cc = array();

    /**
     * The array of 'bcc' names and addresses.
     * @var array
     * @access protected
     */
    protected $bcc = array();

    /**
     * The array of reply-to names and addresses.
     * @var array
     * @access protected
     */
    protected $ReplyTo = array();

    /**
     * An array of all kinds of addresses.
     * Includes all of $to, $cc, $bcc
     * @var array
     * @access protected
     * @see PHPMailer::$to @see PHPMailer::$cc @see PHPMailer::$bcc
     */
    protected $all_recipients = array();

    /**
     * An array of names and addresses queued for validation.
     * In send(), valid and non duplicate entries are moved to $all_recipients
     * and one of $to, $cc, or $bcc.
     * This array is used only for addresses with IDN.
     * @var array
     * @access protected
     * @see PHPMailer::$to @see PHPMailer::$cc @see PHPMailer::$bcc
     * @see PHPMailer::$all_recipients
     */
    protected $RecipientsQueue = array();

    /**
     * An array of reply-to names and addresses queued for validation.
     * In send(), valid and non duplicate entries are moved to $ReplyTo.
     * This array is used only for addresses with IDN.
     * @var array
     * @access protected
     * @see PHPMailer::$ReplyTo
     */
    protected $ReplyToQueue = array();

    /**
     * The array of attachments.
     * @var array
     * @access protected
     */
    protected $attachment = array();

    /**
     * The array of custom headers.
     * @var array
     * @access protected
     */
    protected $CustomHeader = array();

    /**
     * The most recent Message-ID (including angular brackets).
     * @var string
     * @access protected
     */
    protected $lastMessageID = '';

    /**
     * The message's MIME type.
     * @var string
     * @access protected
     */
    protected $message_type = '';

    /**
     * The array of MIME boundary strings.
     * @var array
     * @access protected
     */
    protected $boundary = array();

    /**
     * The array of available languages.
     * @var array
     * @access protected
     */
    protected $language = array();

    /**
     * The number of errors encountered.
     * @var integer
     * @access protected
     */
    protected $error_count = 0;

    /**
     * The S/MIME certificate file path.
     * @var string
     * @access protected
     */
    protected $sign_cert_file = '';

    /**
     * The S/MIME key file path.
     * @var string
     * @access protected
     */
    protected $sign_key_file = '';

    /**
     * The optional S/MIME extra certificates ("CA Chain") file path.
     * @var string
     * @access protected
     */
    protected $sign_extracerts_file = '';

    /**
     * The S/MIME password for the key.
     * Used only if the key is encrypted.
     * @var string
     * @access protected
     */
    protected $sign_key_pass = '';

    /**
     * Whether to throw exceptions for errors.
     * @var boolean
     * @access protected
     */
    protected $exceptions = false;

    /**
     * Unique ID used for message ID and boundaries.
     * @var string
     * @access protected
     */
    protected $uniqueid = '';

    /**
     * Error severity: message only, continue processing.
     */
    const STOP_MESSAGE = 0;

    /**
     * Error severity: message, likely ok to continue processing.
     */
    const STOP_CONTINUE = 1;

    /**
     * Error severity: message, plus full stop, critical error reached.
     */
    const STOP_CRITICAL = 2;

    /**
     * SMTP RFC standard line ending.
     */
    const CRLF = "\r\n";

    /**
     * The maximum line length allowed by RFC 2822 section 2.1.1
     * @var integer
     */
    const MAX_LINE_LENGTH = 998;

    /**
     * Constructor.
     * @param boolean $exceptions Should we throw external exceptions?
     */
    public function __construct($exceptions = null)
    {
        if ($exceptions !== null) {
            $this->exceptions = (boolean)$exceptions;
        }
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        //Close any open SMTP connection nicely
        $this->smtpClose();
    }

    /**
     * Call mail() in a safe_mode-aware fashion.
     * Also, unless sendmail_path points to sendmail (or something that
     * claims to be sendmail), don't pass params (not a perfect fix,
     * but it will do)
     * @param string $to To
     * @param string $subject Subject
     * @param string $body Message Body
     * @param string $header Additional Header(s)
     * @param string $params Params
     * @access private
     * @return boolean
     */
    private function mailPassthru($to, $subject, $body, $header, $params)
    {
        //Check overloading of mail function to avoid double-encoding
        if (ini_get('mbstring.func_overload') & 1) {
            $subject = $this->secureHeader($subject);
        } else {
            $subject = $this->encodeHeader($this->secureHeader($subject));
        }

        //Can't use additional_parameters in safe_mode
        //@link http://php.net/manual/en/function.mail.php
        if (ini_get('safe_mode') or !$this->UseSendmailOptions or is_null($params)) {
            $result = @mail($to, $subject, $body, $header);
        } else {
            $result = @mail($to, $subject, $body, $header, $params);
        }
        return $result;
    }
    /**
     * Output debugging info via user-defined method.
     * Only generates output if SMTP debug output is enabled (@see SMTP::$do_debug).
     * @see PHPMailer::$Debugoutput
     * @see PHPMailer::$SMTPDebug
     * @param string $str
     */
    protected function edebug($str)
    {
        if ($this->SMTPDebug <= 0) {
            return;
        }
        //Avoid clash with built-in function names
        if (!in_array($this->Debugoutput, array('error_log', 'html', 'echo')) and is_callable($this->Debugoutput)) {
            call_user_func($this->Debugoutput, $str, $this->SMTPDebug);
            return;
        }
        switch ($this->Debugoutput) {
            case 'error_log':
                //Don't output, just log
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking, HTML-safe output
                echo htmlentities(
                    preg_replace('/[\r\n]+/', '', $str),
                    ENT_QUOTES,
                    'UTF-8'
                )
                . "<br>\n";
                break;
            case 'echo':
            default:
                //Normalize line breaks
                $str = preg_replace('/\r\n?/ms', "\n", $str);
                echo gmdate('Y-m-d H:i:s') . "\t" . str_replace(
                    "\n",
                    "\n                   \t                  ",
                    trim($str)
                ) . "\n";
        }
    }

    /**
     * Sets message type to HTML or plain.
     * @param boolean $isHtml True for HTML mode.
     * @return void
     */
    public function isHTML($isHtml = true)
    {
        if ($isHtml) {
            $this->ContentType = 'text/html';
        } else {
            $this->ContentType = 'text/plain';
        }
    }

    /**
     * Send messages using SMTP.
     * @return void
     */
    public function isSMTP()
    {
        $this->Mailer = 'smtp';
    }

    /**
     * Send messages using PHP's mail() function.
     * @return void
     */
    public function isMail()
    {
        $this->Mailer = 'mail';
    }

    /**
     * Send messages using $Sendmail.
     * @return void
     */
    public function isSendmail()
    {
        $ini_sendmail_path = ini_get('sendmail_path');

        if (!stristr($ini_sendmail_path, 'sendmail')) {
            $this->Sendmail = '/usr/sbin/sendmail';
        } else {
            $this->Sendmail = $ini_sendmail_path;
        }
        $this->Mailer = 'sendmail';
    }

    /**
     * Send messages using qmail.
     * @return void
     */
    public function isQmail()
    {
        $ini_sendmail_path = ini_get('sendmail_path');

        if (!stristr($ini_sendmail_path, 'qmail')) {
            $this->Sendmail = '/var/qmail/bin/qmail-inject';
        } else {
            $this->Sendmail = $ini_sendmail_path;
        }
        $this->Mailer = 'qmail';
    }

    /**
     * Add a "To" address.
     * @param string $address The email address to send to
     * @param string $name
     * @return boolean true on success, false if address already used or invalid in some way
     */
    public function addAddress($address, $name = '')
    {
        return $this->addOrEnqueueAnAddress('to', $address, $name);
    }

    /**
     * Add a "CC" address.
     * @note: This function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address The email address to send to
     * @param string $name
     * @return boolean true on success, false if address already used or invalid in some way
     */
    public function addCC($address, $name = '')
    {
        return $this->addOrEnqueueAnAddress('cc', $address, $name);
    }

    /**
     * Add a "BCC" address.
     * @note: This function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address The email address to send to
     * @param string $name
     * @return boolean true on success, false if address already used or invalid in some way
     */
    public function addBCC($address, $name = '')
    {
        return $this->addOrEnqueueAnAddress('bcc', $address, $name);
    }

    /**
     * Add a "Reply-To" address.
     * @param string $address The email address to reply to
     * @param string $name
     * @return boolean true on success, false if address already used or invalid in some way
     */
    public function addReplyTo($address, $name = '')
    {
        return $this->addOrEnqueueAnAddress('Reply-To', $address, $name);
    }

    /**
     * Add an address to one of the recipient arrays or to the ReplyTo array. Because PHPMailer
     * can't validate addresses with an IDN without knowing the PHPMailer::$CharSet (that can still
     * be modified after calling this function), addition of such addresses is delayed until send().
     * Addresses that have been added already return false, but do not throw exceptions.
     * @param string $kind One of 'to', 'cc', 'bcc', or 'ReplyTo'
     * @param string $address The email address to send, resp. to reply to
     * @param string $name
     * @throws phpmailerException
     * @return boolean true on success, false if address already used or invalid in some way
     * @access protected
     */
    protected function addOrEnqueueAnAddress($kind, $address, $name)
    {
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        if (($pos = strrpos($address, '@')) === false) {
            // At-sign is misssing.
            $error_message = $this->lang('invalid_address') . " (addAnAddress $kind): $address";
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new phpmailerException($error_message);
            }
            return false;
        }
        $params = array($kind, $address, $name);
        // Enqueue addresses with IDN until we know the PHPMailer::$CharSet.
        if ($this->has8bitChars(substr($address, ++$pos)) and $this->idnSupported()) {
            if ($kind != 'Reply-To') {
                if (!array_key_exists($address, $this->RecipientsQueue)) {
                    $this->RecipientsQueue[$address] = $params;
                    return true;
                }
            } else {
                if (!array_key_exists($address, $this->ReplyToQueue)) {
                    $this->ReplyToQueue[$address] = $params;
                    return true;
                }
            }
            return false;
        }
        // Immediately add standard addresses without IDN.
        return call_user_func_array(array($this, 'addAnAddress'), $params);
    }

    /**
     * Add an address to one of the recipient arrays or to the ReplyTo array.
     * Addresses that have been added already return false, but do not throw exceptions.
     * @param string $kind One of 'to', 'cc', 'bcc', or 'ReplyTo'
     * @param string $address The email address to send, resp. to reply to
     * @param string $name
     * @throws phpmailerException
     * @return boolean true on success, false if address already used or invalid in some way
     * @access protected
     */
    protected function addAnAddress($kind, $address, $name = '')
    {
        if (!in_array($kind, array('to', 'cc', 'bcc', 'Reply-To'))) {
            $error_message = $this->lang('Invalid recipient kind: ') . $kind;
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new phpmailerException($error_message);
            }
            return false;
        }
        if (!$this->validateAddress($address)) {
            $error_message = $this->lang('invalid_address') . " (addAnAddress $kind): $address";
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new phpmailerException($error_message);
            }
            return false;
        }
        if ($kind != 'Reply-To') {
            if (!array_key_exists(strtolower($address), $this->all_recipients)) {
                array_push($this->$kind, array($address, $name));
                $this->all_recipients[strtolower($address)] = true;
                return true;
            }
        } else {
            if (!array_key_exists(strtolower($address), $this->ReplyTo)) {
                $this->ReplyTo[strtolower($address)] = array($address, $name);
                return true;
            }
        }
        return false;
    }

    /**
     * Parse and validate a string containing one or more RFC822-style comma-separated email addresses
     * of the form "display name <address>" into an array of name/address pairs.
     * Uses the imap_rfc822_parse_adrlist function if the IMAP extension is available.
     * Note that quotes in the name part are removed.
     * @param string $addrstr The address list string
     * @param bool $useimap Whether to use the IMAP extension to parse the list
     * @return array
     * @link http://www.andrew.cmu.edu/user/agreen1/testing/mrbs/web/Mail/RFC822.php A more careful implementation
     */
    public function parseAddresses($addrstr, $useimap = true)
    {
        $addresses = array();
        if ($useimap and function_exists('imap_rfc822_parse_adrlist')) {
            //Use this built-in parser if it's available
            $list = imap_rfc822_parse_adrlist($addrstr, '');
            foreach ($list as $address) {
                if ($address->host != '.SYNTAX-ERROR.') {
                    if ($this->validateAddress($address->mailbox . '@' . $address->host)) {
                        $addresses[] = array(
                            'name' => (property_exists($address, 'personal') ? $address->personal : ''),
                            'address' => $address->mailbox . '@' . $address->host
                        );
                    }
                }
            }
        } else {
            //Use this simpler parser
            $list = explode(',', $addrstr);
            foreach ($list as $address) {
                $address = trim($address);
                //Is there a separate name part?
                if (strpos($address, '<') === false) {
                    //No separate name, just use the whole thing
                    if ($this->validateAddress($address)) {
                        $addresses[] = array(
                            'name' => '',
                            'address' => $address
                        );
                    }
                } else {
                    list($name, $email) = explode('<', $address);
                    $email = trim(str_replace('>', '', $email));
                    if ($this->validateAddress($email)) {
                        $addresses[] = array(
                            'name' => trim(str_replace(array('"', "'"), '', $name)),
                            'address' => $email
                        );
                    }
                }
            }
        }
        return $addresses;
    }

    /**
     * Set the From and FromName properties.
     * @param string $address
     * @param string $name
     * @param boolean $auto Whether to also set the Sender address, defaults to true
     * @throws phpmailerException
     * @return boolean
     */
    public function setFrom($address, $name = '', $auto = true)
    {
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        // Don't validate now addresses with IDN. Will be done in send().
        if (($pos = strrpos($address, '@')) === false or
            (!$this->has8bitChars(substr($address, ++$pos)) or !$this->idnSupported()) and
            !$this->validateAddress($address)) {
            $error_message = $this->lang('invalid_address') . " (setFrom) $address";
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new phpmailerException($error_message);
            }
            return false;
        }
        $this->From = $address;
        $this->FromName = $name;
        if ($auto) {
            if (empty($this->Sender)) {
                $this->Sender = $address;
            }
        }
        return true;
    }

    /**
     * Return the Message-ID header of the last email.
     * Technically this is the value from the last time the headers were created,
     * but it's also the message ID of the last sent message except in
     * pathological cases.
     * @return string
     */
    public function getLastMessageID()
    {
        return $this->lastMessageID;
    }

    /**
     * Check that a string looks like an email address.
     * @param string $address The email address to check
     * @param string|callable $patternselect A selector for the validation pattern to use :
     * * `auto` Pick best pattern automatically;
     * * `pcre8` Use the squiloople.com pattern, requires PCRE > 8.0, PHP >= 5.3.2, 5.2.14;
     * * `pcre` Use old PCRE implementation;
     * * `php` Use PHP built-in FILTER_VALIDATE_EMAIL;
     * * `html5` Use the pattern given by the HTML5 spec for 'email' type form input elements.
     * * `noregex` Don't use a regex: super fast, really dumb.
     * Alternatively you may pass in a callable to inject your own validator, for example:
     * PHPMailer::validateAddress('user@example.com', function($address) {
     *     return (strpos($address, '@') !== false);
     * });
     * You can also set the PHPMailer::$validator static to a callable, allowing built-in methods to use your validator.
     * @return boolean
     * @static
     * @access public
     */
    public static function validateAddress($address, $patternselect = null)
    {
        if (is_null($patternselect)) {
            $patternselect = self::$validator;
        }
        if (is_callable($patternselect)) {
            return call_user_func($patternselect, $address);
        }
        //Reject line breaks in addresses; it's valid RFC5322, but not RFC5321
        if (strpos($address, "\n") !== false or strpos($address, "\r") !== false) {
            return false;
        }
        if (!$patternselect or $patternselect == 'auto') {
            //Check this constant first so it works when extension_loaded() is disabled by safe mode
            //Constant was added in PHP 5.2.4
            if (defined('PCRE_VERSION')) {
                //This pattern can get stuck in a recursive loop in PCRE <= 8.0.2
                if (version_compare(PCRE_VERSION, '8.0.3') >= 0) {
                    $patternselect = 'pcre8';
                } else {
                    $patternselect = 'pcre';
                }
            } elseif (function_exists('extension_loaded') and extension_loaded('pcre')) {
                //Fall back to older PCRE
                $patternselect = 'pcre';
            } else {
                //Filter_var appeared in PHP 5.2.0 and does not require the PCRE extension
                if (version_compare(PHP_VERSION, '5.2.0') >= 0) {
                    $patternselect = 'php';
                } else {
                    $patternselect = 'noregex';
                }
            }
        }
        switch ($patternselect) {
            case 'pcre8':
                /**
                 * Uses the same RFC5322 regex on which FILTER_VALIDATE_EMAIL is based, but allows dotless domains.
                 * @link http://squiloople.com/2009/12/20/email-address-validation/
                 * @copyright 2009-2010 Michael Rushton
                 * Feel free to use and redistribute this code. But please keep this copyright notice.
                 */
                return (boolean)preg_match(
                    '/^(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){255,})(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){65,}@)' .
                    '((?>(?>(?>((?>(?>(?>\x0D\x0A)?[\t ])+|(?>[\t ]*\x0D\x0A)?[\t ]+)?)(\((?>(?2)' .
                    '(?>[\x01-\x08\x0B\x0C\x0E-\'*-\[\]-\x7F]|\\\[\x00-\x7F]|(?3)))*(?2)\)))+(?2))|(?2))?)' .
                    '([!#-\'*+\/-9=?^-~-]+|"(?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\x7F]))*' .
                    '(?2)")(?>(?1)\.(?1)(?4))*(?1)@(?!(?1)[a-z0-9-]{64,})(?1)(?>([a-z0-9](?>[a-z0-9-]*[a-z0-9])?)' .
                    '(?>(?1)\.(?!(?1)[a-z0-9-]{64,})(?1)(?5)){0,126}|\[(?:(?>IPv6:(?>([a-f0-9]{1,4})(?>:(?6)){7}' .
                    '|(?!(?:.*[a-f0-9][:\]]){8,})((?6)(?>:(?6)){0,6})?::(?7)?))|(?>(?>IPv6:(?>(?6)(?>:(?6)){5}:' .
                    '|(?!(?:.*[a-f0-9]:){6,})(?8)?::(?>((?6)(?>:(?6)){0,4}):)?))?(25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(?>\.(?9)){3}))\])(?1)$/isD',
                    $address
                );
            case 'pcre':
                //An older regex that doesn't need a recent PCRE
                return (boolean)preg_match(
                    '/^(?!(?>"?(?>\\\[ -~]|[^"])"?){255,})(?!(?>"?(?>\\\[ -~]|[^"])"?){65,}@)(?>' .
                    '[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*")' .
                    '(?>\.(?>[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*"))*' .
                    '@(?>(?![a-z0-9-]{64,})(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)(?>\.(?![a-z0-9-]{64,})' .
                    '(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)){0,126}|\[(?:(?>IPv6:(?>(?>[a-f0-9]{1,4})(?>:' .
                    '[a-f0-9]{1,4}){7}|(?!(?:.*[a-f0-9][:\]]){8,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?' .
                    '::(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?))|(?>(?>IPv6:(?>[a-f0-9]{1,4}(?>:' .
                    '[a-f0-9]{1,4}){5}:|(?!(?:.*[a-f0-9]:){6,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4})?' .
                    '::(?>(?:[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4}):)?))?(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}' .
                    '|[1-9]?[0-9])(?>\.(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}))\])$/isD',
                    $address
                );
            case 'html5':
                /**
                 * This is the pattern used in the HTML5 spec for validation of 'email' type form input elements.
                 * @link http://www.whatwg.org/specs/web-apps/current-work/#e-mail-state-(type=email)
                 */
                return (boolean)preg_match(
                    '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}' .
                    '[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/sD',
                    $address
                );
            case 'noregex':
                //No PCRE! Do something _very_ approximate!
                //Check the address is 3 chars or longer and contains an @ that's not the first or last char
                return (strlen($address) >= 3
                    and strpos($address, '@') >= 1
                    and strpos($address, '@') != strlen($address) - 1);
            case 'php':
            default:
                return (boolean)filter_var($address, FILTER_VALIDATE_EMAIL);
        }
    }

    /**
     * Tells whether IDNs (Internationalized Domain Names) are supported or not. This requires the
     * "intl" and "mbstring" PHP extensions.
     * @return bool "true" if required functions for IDN support are present
     */
    public function idnSupported()
    {
        // @TODO: Write our own "idn_to_ascii" function for PHP <= 5.2.
        return function_exists('idn_to_ascii') and function_exists('mb_convert_encoding');
    }

    /**
     * Converts IDN in given email address to its ASCII form, also known as punycode, if possible.
     * Important: Address must be passed in same encoding as currently set in PHPMailer::$CharSet.
     * This function silently returns unmodified address if:
     * - No conversion is necessary (i.e. domain name is not an IDN, or is already in ASCII form)
     * - Conversion to punycode is impossible (e.g. required PHP functions are not available)
     *   or fails for any reason (e.g. domain has characters not allowed in an IDN)
     * @see PHPMailer::$CharSet
     * @param string $address The email address to convert
     * @return string The encoded address in ASCII form
     */
    public function punyencodeAddress($address)
    {
        // Verify we have required functions, CharSet, and at-sign.
        if ($this->idnSupported() and
            !empty($this->CharSet) and
            ($pos = strrpos($address, '@')) !== false) {
            $domain = substr($address, ++$pos);
            // Verify CharSet string is a valid one, and domain properly encoded in this CharSet.
            if ($this->has8bitChars($domain) and @mb_check_encoding($domain, $this->CharSet)) {
                $domain = mb_convert_encoding($domain, 'UTF-8', $this->CharSet);
                if (($punycode = defined('INTL_IDNA_VARIANT_UTS46') ?
                    idn_to_ascii($domain, 0, INTL_IDNA_VARIANT_UTS46) :
                    idn_to_ascii($domain)) !== false) {
                    return substr($address, 0, $pos) . $punycode;
                }
            }
        }
        return $address;
    }

    /**
     * Create a message and send it.
     * Uses the sending method specified by $Mailer.
     * @throws phpmailerException
     * @return boolean false on error - See the ErrorInfo property for details of the error.
     */
    public function send()
    {
        try {
            if (!$this->preSend()) {
                return false;
            }
            return $this->postSend();
        } catch (phpmailerException $exc) {
            $this->mailHeader = '';
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
    }

    /**
     * Prepare a message for sending.
     * @throws phpmailerException
     * @return boolean
     */
    public function preSend()
    {
        try {
            $this->error_count = 0; // Reset errors
            $this->mailHeader = '';

            // Dequeue recipient and Reply-To addresses with IDN
            foreach (array_merge($this->RecipientsQueue, $this->ReplyToQueue) as $params) {
                $params[1] = $this->punyencodeAddress($params[1]);
                call_user_func_array(array($this, 'addAnAddress'), $params);
            }
            if ((count($this->to) + count($this->cc) + count($this->bcc)) < 1) {
                throw new phpmailerException($this->lang('provide_address'), self::STOP_CRITICAL);
            }

            // Validate From, Sender, and ConfirmReadingTo addresses
            foreach (array('From', 'Sender', 'ConfirmReadingTo') as $address_kind) {
                $this->$address_kind = trim($this->$address_kind);
                if (empty($this->$address_kind)) {
                    continue;
                }
                $this->$address_kind = $this->punyencodeAddress($this->$address_kind);
                if (!$this->validateAddress($this->$address_kind)) {
                    $error_message = $this->lang('invalid_address') . ' (punyEncode) ' . $this->$address_kind;
                    $this->setError($error_message);
                    $this->edebug($error_message);
                    if ($this->exceptions) {
                        throw new phpmailerException($error_message);
                    }
                    return false;
                }
            }

            // Set whether the message is multipart/alternative
            if ($this->alternativeExists()) {
                $this->ContentType = 'multipart/alternative';
            }

            $this->setMessageType();
            // Refuse to send an empty message unless we are specifically allowing it
            if (!$this->AllowEmpty and empty($this->Body)) {
                throw new phpmailerException($this->lang('empty_message'), self::STOP_CRITICAL);
            }

            // Create body before headers in case body makes changes to headers (e.g. altering transfer encoding)
            $this->MIMEHeader = '';
            $this->MIMEBody = $this->createBody();
            // createBody may have added some headers, so retain them
            $tempheaders = $this->MIMEHeader;
            $this->MIMEHeader = $this->createHeader();
            $this->MIMEHeader .= $tempheaders;

            // To capture the complete message when using mail(), create
            // an extra header list which createHeader() doesn't fold in
            if ($this->Mailer == 'mail') {
                if (count($this->to) > 0) {
                    $this->mailHeader .= $this->addrAppend('To', $this->to);
                } else {
                    $this->mailHeader .= $this->headerLine('To', 'undisclosed-recipients:;');
                }
                $this->mailHeader .= $this->headerLine(
                    'Subject',
                    $this->encodeHeader($this->secureHeader(trim($this->Subject)))
                );
            }

            // Sign with DKIM if enabled
            if (!empty($this->DKIM_domain)
                && !empty($this->DKIM_private)
                && !empty($this->DKIM_selector)
                && file_exists($this->DKIM_private)) {
                $header_dkim = $this->DKIM_Add(
                    $this->MIMEHeader . $this->mailHeader,
                    $this->encodeHeader($this->secureHeader($this->Subject)),
                    $this->MIMEBody
                );
                $this->MIMEHeader = rtrim($this->MIMEHeader, "\r\n ") . self::CRLF .
                    str_replace("\r\n", "\n", $header_dkim) . self::CRLF;
            }
            return true;
        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
    }

    /**
     * Actually send a message.
     * Send the email via the selected mechanism
     * @throws phpmailerException
     * @return boolean
     */
    public function postSend()
    {
        try {
            // Choose the mailer and send through it
            switch ($this->Mailer) {
                case 'sendmail':
                case 'qmail':
                    return $this->sendmailSend($this->MIMEHeader, $this->MIMEBody);
                case 'smtp':
                    return $this->smtpSend($this->MIMEHeader, $this->MIMEBody);
                case 'mail':
                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
                default:
                    $sendMethod = $this->Mailer.'Send';
                    if (method_exists($this, $sendMethod)) {
                        return $this->$sendMethod($this->MIMEHeader, $this->MIMEBody);
                    }

                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
            }
        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
        }
        return false;
    }

    /**
     * Send mail using the $Sendmail program.
     * @param string $header The message headers
     * @param string $body The message body
     * @see PHPMailer::$Sendmail
     * @throws phpmailerException
     * @access protected
     * @return boolean
     */
    protected function sendmailSend($header, $body)
    {
        if ($this->Sender != '') {
            if ($this->Mailer == 'qmail') {
                $sendmail = sprintf('%s -f%s', escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
            } else {
                $sendmail = sprintf('%s -oi -f%s -t', escapeshellcmd($this->Sendmail), escapeshellarg($this->Sender));
            }
        } else {
            if ($this->Mailer == 'qmail') {
                $sendmail = sprintf('%s', escapeshellcmd($this->Sendmail));
            } else {
                $sendmail = sprintf('%s -oi -t', escapeshellcmd($this->Sendmail));
            }
        }
        if ($this->SingleTo) {
            foreach ($this->SingleToArray as $toAddr) {
                if (!@$mail = popen($sendmail, 'w')) {
                    throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
                }
                fputs($mail, 'To: ' . $toAddr . "\n");
                fputs($mail, $header);
                fputs($mail, $body);
                $result = pclose($mail);
                $this->doCallback(
                    ($result == 0),
                    array($toAddr),
                    $this->cc,
                    $this->bcc,
                    $this->Subject,
                    $body,
                    $this->From
                );
                if ($result != 0) {
                    throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
                }
            }
        } else {
            if (!@$mail = popen($sendmail, 'w')) {
                throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            }
            fputs($mail, $header);
            fputs($mail, $body);
            $result = pclose($mail);
            $this->doCallback(
                ($result == 0),
                $this->to,
                $this->cc,
                $this->bcc,
                $this->Subject,
                $body,
                $this->From
            );
            if ($result != 0) {
                throw new phpmailerException($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            }
        }
        return true;
    }

    /**
     * Send mail using the PHP mail() function.
     * @param string $header The message headers
     * @param string $body The message body
     * @link http://www.php.net/manual/en/book.mail.php
     * @throws phpmailerException
     * @access protected
     * @return boolean
     */
    protected function mailSend($header, $body)
    {
        $toArr = array();
        foreach ($this->to as $toaddr) {
            $toArr[] = $this->addrFormat($toaddr);
        }
        $to = implode(', ', $toArr);

        $params = null;
        //This sets the SMTP envelope sender which gets turned into a return-path header by the receiver
        if (!empty($this->Sender)) {
            $params = sprintf('-f%s', $this->Sender);
        }
        if ($this->Sender != '' and !ini_get('safe_mode')) {
            $old_from = ini_get('sendmail_from');
            ini_set('sendmail_from', $this->Sender);
        }
        $result = false;
        if ($this->SingleTo and count($toArr) > 1) {
            foreach ($toArr as $toAddr) {
                $result = $this->mailPassthru($toAddr, $this->Subject, $body, $header, $params);
                $this->doCallback($result, array($toAddr), $this->cc, $this->bcc, $this->Subject, $body, $this->From);
            }
        } else {
            $result = $this->mailPassthru($to, $this->Subject, $body, $header, $params);
            $this->doCallback($result, $this->to, $this->cc, $this->bcc, $this->Subject, $body, $this->From);
        }
        if (isset($old_from)) {
            ini_set('sendmail_from', $old_from);
        }
        if (!$result) {
            throw new phpmailerException($this->lang('instantiate'), self::STOP_CRITICAL);
        }
        return true;
    }

    /**
     * Get an instance to use for SMTP operations.
     * Override this function to load your own SMTP implementation
     * @return SMTP
     */
    public function getSMTPInstance()
    {
        if (!is_object($this->smtp)) {
            $this->smtp = new SMTP;
        }
        return $this->smtp;
    }

    /**
     * Send mail via SMTP.
     * Returns false if there is a bad MAIL FROM, RCPT, or DATA input.
     * Uses the PHPMailerSMTP class by default.
     * @see PHPMailer::getSMTPInstance() to use a different class.
     * @param string $header The message headers
     * @param string $body The message body
     * @throws phpmailerException
     * @uses SMTP
     * @access protected
     * @return boolean
     */
    protected function smtpSend($header, $body)
    {
        $bad_rcpt = array();
        if (!$this->smtpConnect($this->SMTPOptions)) {
            throw new phpmailerException($this->lang('smtp_connect_failed'), self::STOP_CRITICAL);
        }
        if ('' == $this->Sender) {
            $smtp_from = $this->From;
        } else {
            $smtp_from = $this->Sender;
        }
        if (!$this->smtp->mail($smtp_from)) {
            $this->setError($this->lang('from_failed') . $smtp_from . ' : ' . implode(',', $this->smtp->getError()));
            throw new phpmailerException($this->ErrorInfo, self::STOP_CRITICAL);
        }

        // Attempt to send to all recipients
        foreach (array($this->to, $this->cc, $this->bcc) as $togroup) {
            foreach ($togroup as $to) {
                if (!$this->smtp->recipient($to[0])) {
                    $error = $this->smtp->getError();
                    $bad_rcpt[] = array('to' => $to[0], 'error' => $error['detail']);
                    $isSent = false;
                } else {
                    $isSent = true;
                }
                $this->doCallback($isSent, array($to[0]), array(), array(), $this->Subject, $body, $this->From);
            }
        }

        // Only send the DATA command if we have viable recipients
        if ((count($this->all_recipients) > count($bad_rcpt)) and !$this->smtp->data($header . $body)) {
            throw new phpmailerException($this->lang('data_not_accepted'), self::STOP_CRITICAL);
        }
        if ($this->SMTPKeepAlive) {
            $this->smtp->reset();
        } else {
            $this->smtp->quit();
            $this->smtp->close();
        }
        //Create error message for any bad addresses
        if (count($bad_rcpt) > 0) {
            $errstr = '';
            foreach ($bad_rcpt as $bad) {
                $errstr .= $bad['to'] . ': ' . $bad['error'];
            }
            throw new phpmailerException(
                $this->lang('recipients_failed') . $errstr,
                self::STOP_CONTINUE
            );
        }
        return true;
    }

    /**
     * Initiate a connection to an SMTP server.
     * Returns false if the operation failed.
     * @param array $options An array of options compatible with stream_context_create()
     * @uses SMTP
     * @access public
     * @throws phpmailerException
     * @return boolean
     */
    public function smtpConnect($options = null)
    {
        if (is_null($this->smtp)) {
            $this->smtp = $this->getSMTPInstance();
        }

        //If no options are provided, use whatever is set in the instance
        if (is_null($options)) {
            $options = $this->SMTPOptions;
        }

        // Already connected?
        if ($this->smtp->connected()) {
            return true;
        }

        $this->smtp->setTimeout($this->Timeout);
        $this->smtp->setDebugLevel($this->SMTPDebug);
        $this->smtp->setDebugOutput($this->Debugoutput);
        $this->smtp->setVerp($this->do_verp);
        $hosts = explode(';', $this->Host);
        $lastexception = null;

        foreach ($hosts as $hostentry) {
            $hostinfo = array();
            if (!preg_match('/^((ssl|tls):\/\/)*([a-zA-Z0-9\.-]*):?([0-9]*)$/', trim($hostentry), $hostinfo)) {
                // Not a valid host entry
                continue;
            }
            // $hostinfo[2]: optional ssl or tls prefix
            // $hostinfo[3]: the hostname
            // $hostinfo[4]: optional port number
            // The host string prefix can temporarily override the current setting for SMTPSecure
            // If it's not specified, the default value is used
            $prefix = '';
            $secure = $this->SMTPSecure;
            $tls = ($this->SMTPSecure == 'tls');
            if ('ssl' == $hostinfo[2] or ('' == $hostinfo[2] and 'ssl' == $this->SMTPSecure)) {
                $prefix = 'ssl://';
                $tls = false; // Can't have SSL and TLS at the same time
                $secure = 'ssl';
            } elseif ($hostinfo[2] == 'tls') {
                $tls = true;
                // tls doesn't use a prefix
                $secure = 'tls';
            }
            //Do we need the OpenSSL extension?
            $sslext = defined('OPENSSL_ALGO_SHA1');
            if ('tls' === $secure or 'ssl' === $secure) {
                //Check for an OpenSSL constant rather than using extension_loaded, which is sometimes disabled
                if (!$sslext) {
                    throw new phpmailerException($this->lang('extension_missing').'openssl', self::STOP_CRITICAL);
                }
            }
            $host = $hostinfo[3];
            $port = $this->Port;
            $tport = (integer)$hostinfo[4];
            if ($tport > 0 and $tport < 65536) {
                $port = $tport;
            }
            if ($this->smtp->connect($prefix . $host, $port, $this->Timeout, $options)) {
                try {
                    if ($this->Helo) {
                        $hello = $this->Helo;
                    } else {
                        $hello = $this->serverHostname();
                    }
                    $this->smtp->hello($hello);
                    //Automatically enable TLS encryption if:
                    // * it's not disabled
                    // * we have openssl extension
                    // * we are not already using SSL
                    // * the server offers STARTTLS
                    if ($this->SMTPAutoTLS and $sslext and $secure != 'ssl' and $this->smtp->getServerExt('STARTTLS')) {
                        $tls = true;
                    }
                    if ($tls) {
                        if (!$this->smtp->startTLS()) {
                            throw new phpmailerException($this->lang('connect_host'));
                        }
                        // We must resend EHLO after TLS negotiation
                        $this->smtp->hello($hello);
                    }
                    if ($this->SMTPAuth) {
                        if (!$this->smtp->authenticate(
                            $this->Username,
                            $this->Password,
                            $this->AuthType,
                            $this->Realm,
                            $this->Workstation
                        )
                        ) {
                            throw new phpmailerException($this->lang('authenticate'));
                        }
                    }
                    return true;
                } catch (phpmailerException $exc) {
                    $lastexception = $exc;
                    $this->edebug($exc->getMessage());
                    // We must have connected, but then failed TLS or Auth, so close connection nicely
                    $this->smtp->quit();
                }
            }
        }
        // If we get here, all connection attempts have failed, so close connection hard
        $this->smtp->close();
        // As we've caught all exceptions, just report whatever the last one was
        if ($this->exceptions and !is_null($lastexception)) {
            throw $lastexception;
        }
        return false;
    }

    /**
     * Close the active SMTP session if one exists.
     * @return void
     */
    public function smtpClose()
    {
        if (is_a($this->smtp, 'SMTP')) {
            if ($this->smtp->connected()) {
                $this->smtp->quit();
                $this->smtp->close();
            }
        }
    }

    /**
     * Set the language for error messages.
     * Returns false if it cannot load the language file.
     * The default language is English.
     * @param string $langcode ISO 639-1 2-character language code (e.g. French is "fr")
     * @param string $lang_path Path to the language file directory, with trailing separator (slash)
     * @return boolean
     * @access public
     */
    public function setLanguage($langcode = 'en', $lang_path = '')
    {
        // Backwards compatibility for renamed language codes
        $renamed_langcodes = array(
            'br' => 'pt_br',
            'cz' => 'cs',
            'dk' => 'da',
            'no' => 'nb',
            'se' => 'sv',
        );

        if (isset($renamed_langcodes[$langcode])) {
            $langcode = $renamed_langcodes[$langcode];
        }

        // Define full set of translatable strings in English
        $PHPMAILER_LANG = array(
            'authenticate' => 'SMTP Error: Could not authenticate.',
            'connect_host' => 'SMTP Error: Could not connect to SMTP host.',
            'data_not_accepted' => 'SMTP Error: data not accepted.',
            'empty_message' => 'Message body empty',
            'encoding' => 'Unknown encoding: ',
            'execute' => 'Could not execute: ',
            'file_access' => 'Could not access file: ',
            'file_open' => 'File Error: Could not open file: ',
            'from_failed' => 'The following From address failed: ',
            'instantiate' => 'Could not instantiate mail function.',
            'invalid_address' => 'Invalid address: ',
            'mailer_not_supported' => ' mailer is not supported.',
            'provide_address' => 'You must provide at least one recipient email address.',
            'recipients_failed' => 'SMTP Error: The following recipients failed: ',
            'signing' => 'Signing Error: ',
            'smtp_connect_failed' => 'SMTP connect() failed.',
            'smtp_error' => 'SMTP server error: ',
            'variable_set' => 'Cannot set or reset variable: ',
            'extension_missing' => 'Extension missing: '
        );
        if (empty($lang_path)) {
            // Calculate an absolute path so it can work if CWD is not here
            $lang_path = dirname(__FILE__). DIRECTORY_SEPARATOR . 'language'. DIRECTORY_SEPARATOR;
        }
        //Validate $langcode
        if (!preg_match('/^[a-z]{2}(?:_[a-zA-Z]{2})?$/', $langcode)) {
            $langcode = 'en';
        }
        $foundlang = true;
        $lang_file = $lang_path . 'phpmailer.lang-' . $langcode . '.php';
        // There is no English translation file
        if ($langcode != 'en') {
            // Make sure language file path is readable
            if (!is_readable($lang_file)) {
                $foundlang = false;
            } else {
                // Overwrite language-specific strings.
                // This way we'll never have missing translation keys.
                $foundlang = include $lang_file;
            }
        }
        $this->language = $PHPMAILER_LANG;
        return (boolean)$foundlang; // Returns false if language not found
    }

    /**
     * Get the array of strings for the current language.
     * @return array
     */
    public function getTranslations()
    {
        return $this->language;
    }

    /**
     * Create recipient headers.
     * @access public
     * @param string $type
     * @param array $addr An array of recipient,
     * where each recipient is a 2-element indexed array with element 0 containing an address
     * and element 1 containing a name, like:
     * array(array('joe@example.com', 'Joe User'), array('zoe@example.com', 'Zoe User'))
     * @return string
     */
    public function addrAppend($type, $addr)
    {
        $addresses = array();
        foreach ($addr as $address) {
            $addresses[] = $this->addrFormat($address);
        }
        return $type . ': ' . implode(', ', $addresses) . $this->LE;
    }

    /**
     * Format an address for use in a message header.
     * @access public
     * @param array $addr A 2-element indexed array, element 0 containing an address, element 1 containing a name
     *      like array('joe@example.com', 'Joe User')
     * @return string
     */
    public function addrFormat($addr)
    {
        if (empty($addr[1])) { // No name provided
            return $this->secureHeader($addr[0]);
        } else {
            return $this->encodeHeader($this->secureHeader($addr[1]), 'phrase') . ' <' . $this->secureHeader(
                $addr[0]
            ) . '>';
        }
    }

    /**
     * Word-wrap message.
     * For use with mailers that do not automatically perform wrapping
     * and for quoted-printable encoded messages.
     * Original written by philippe.
     * @param string $message The message to wrap
     * @param integer $length The line length to wrap to
     * @param boolean $qp_mode Whether to run in Quoted-Printable mode
     * @access public
     * @return string
     */
    public function wrapText($message, $length, $qp_mode = false)
    {
        if ($qp_mode) {
            $soft_break = sprintf(' =%s', $this->LE);
        } else {
            $soft_break = $this->LE;
        }
        // If utf-8 encoding is used, we will need to make sure we don't
        // split multibyte characters when we wrap
        $is_utf8 = (strtolower($this->CharSet) == 'utf-8');
        $lelen = strlen($this->LE);
        $crlflen = strlen(self::CRLF);

        $message = $this->fixEOL($message);
        //Remove a trailing line break
        if (substr($message, -$lelen) == $this->LE) {
            $message = substr($message, 0, -$lelen);
        }

        //Split message into lines
        $lines = explode($this->LE, $message);
        //Message will be rebuilt in here
        $message = '';
        foreach ($lines as $line) {
            $words = explode(' ', $line);
            $buf = '';
            $firstword = true;
            foreach ($words as $word) {
                if ($qp_mode and (strlen($word) > $length)) {
                    $space_left = $length - strlen($buf) - $crlflen;
                    if (!$firstword) {
                        if ($space_left > 20) {
                            $len = $space_left;
                            if ($is_utf8) {
                                $len = $this->utf8CharBoundary($word, $len);
                            } elseif (substr($word, $len - 1, 1) == '=') {
                                $len--;
                            } elseif (substr($word, $len - 2, 1) == '=') {
                                $len -= 2;
                            }
                            $part = substr($word, 0, $len);
                            $word = substr($word, $len);
                            $buf .= ' ' . $part;
                            $message .= $buf . sprintf('=%s', self::CRLF);
                        } else {
                            $message .= $buf . $soft_break;
                        }
                        $buf = '';
                    }
                    while (strlen($word) > 0) {
                        if ($length <= 0) {
                            break;
                        }
                        $len = $length;
                        if ($is_utf8) {
                            $len = $this->utf8CharBoundary($word, $len);
                        } elseif (substr($word, $len - 1, 1) == '=') {
                            $len--;
                        } elseif (substr($word, $len - 2, 1) == '=') {
                            $len -= 2;
                        }
                        $part = substr($word, 0, $len);
                        $word = substr($word, $len);

                        if (strlen($word) > 0) {
                            $message .= $part . sprintf('=%s', self::CRLF);
                        } else {
                            $buf = $part;
                        }
                    }
                } else {
                    $buf_o = $buf;
                    if (!$firstword) {
                        $buf .= ' ';
                    }
                    $buf .= $word;

                    if (strlen($buf) > $length and $buf_o != '') {
                        $message .= $buf_o . $soft_break;
                        $buf = $word;
                    }
                }
                $firstword = false;
            }
            $message .= $buf . self::CRLF;
        }

        return $message;
    }

    /**
     * Find the last character boundary prior to $maxLength in a utf-8
     * quoted-printable encoded string.
     * Original written by Colin Brown.
     * @access public
     * @param string $encodedText utf-8 QP text
     * @param integer $maxLength Find the last character boundary prior to this length
     * @return integer
     */
    public function utf8CharBoundary($encodedText, $maxLength)
    {
        $foundSplitPos = false;
        $lookBack = 3;
        while (!$foundSplitPos) {
            $lastChunk = substr($encodedText, $maxLength - $lookBack, $lookBack);
            $encodedCharPos = strpos($lastChunk, '=');
            if (false !== $encodedCharPos) {
                // Found start of encoded character byte within $lookBack block.
                // Check the encoded byte value (the 2 chars after the '=')
                $hex = substr($encodedText, $maxLength - $lookBack + $encodedCharPos + 1, 2);
                $dec = hexdec($hex);
                if ($dec < 128) {
                    // Single byte character.
                    // If the encoded char was found at pos 0, it will fit
                    // otherwise reduce maxLength to start of the encoded char
                    if ($encodedCharPos > 0) {
                        $maxLength = $maxLength - ($lookBack - $encodedCharPos);
                    }
                    $foundSplitPos = true;
                } elseif ($dec >= 192) {
                    // First byte of a multi byte character
                    // Reduce maxLength to split at start of character
                    $maxLength = $maxLength - ($lookBack - $encodedCharPos);
                    $foundSplitPos = true;
                } elseif ($dec < 192) {
                    // Middle byte of a multi byte character, look further back
                    $lookBack += 3;
                }
            } else {
                // No encoded character found
                $foundSplitPos = true;
            }
        }
        return $maxLength;
    }

    /**
     * Apply word wrapping to the message body.
     * Wraps the message body to the number of chars set in the WordWrap property.
     * You should only do this to plain-text bodies as wrapping HTML tags may break them.
     * This is called automatically by createBody(), so you don't need to call it yourself.
     * @access public
     * @return void
     */
    public function setWordWrap()
    {
        if ($this->WordWrap < 1) {
            return;
        }

        switch ($this->message_type) {
            case 'alt':
            case 'alt_inline':
            case 'alt_attach':
            case 'alt_inline_attach':
                $this->AltBody = $this->wrapText($this->AltBody, $this->WordWrap);
                break;
            default:
                $this->Body = $this->wrapText($this->Body, $this->WordWrap);
                break;
        }
    }

    /**
     * Assemble message headers.
     * @access public
     * @return string The assembled headers
     */
    public function createHeader()
    {
        $result = '';

        if ($this->MessageDate == '') {
            $this->MessageDate = self::rfcDate();
        }
        $result .= $this->headerLine('Date', $this->MessageDate);

        // To be created automatically by mail()
        if ($this->SingleTo) {
            if ($this->Mailer != 'mail') {
                foreach ($this->to as $toaddr) {
                    $this->SingleToArray[] = $this->addrFormat($toaddr);
                }
            }
        } else {
            if (count($this->to) > 0) {
                if ($this->Mailer != 'mail') {
                    $result .= $this->addrAppend('To', $this->to);
                }
            } elseif (count($this->cc) == 0) {
                $result .= $this->headerLine('To', 'undisclosed-recipients:;');
            }
        }

        $result .= $this->addrAppend('From', array(array(trim($this->From), $this->FromName)));

        // sendmail and mail() extract Cc from the header before sending
        if (count($this->cc) > 0) {
            $result .= $this->addrAppend('Cc', $this->cc);
        }

        // sendmail and mail() extract Bcc from the header before sending
        if ((
                $this->Mailer == 'sendmail' or $this->Mailer == 'qmail' or $this->Mailer == 'mail'
            )
            and count($this->bcc) > 0
        ) {
            $result .= $this->addrAppend('Bcc', $this->bcc);
        }

        if (count($this->ReplyTo) > 0) {
            $result .= $this->addrAppend('Reply-To', $this->ReplyTo);
        }

        // mail() sets the subject itself
        if ($this->Mailer != 'mail') {
            $result .= $this->headerLine('Subject', $this->encodeHeader($this->secureHeader($this->Subject)));
        }

        // Only allow a custom message ID if it conforms to RFC 5322 section 3.6.4
        // https://tools.ietf.org/html/rfc5322#section-3.6.4
        if ('' != $this->MessageID and preg_match('/^<.*@.*>$/', $this->MessageID)) {
            $this->lastMessageID = $this->MessageID;
        } else {
            $this->lastMessageID = sprintf('<%s@%s>', $this->uniqueid, $this->serverHostname());
        }
        $result .= $this->headerLine('Message-ID', $this->lastMessageID);
        if (!is_null($this->Priority)) {
            $result .= $this->headerLine('X-Priority', $this->Priority);
        }
        if ($this->XMailer == '') {
            $result .= $this->headerLine(
                'X-Mailer',
                'PHPMailer ' . $this->Version . ' (https://github.com/PHPMailer/PHPMailer)'
            );
        } else {
            $myXmailer = trim($this->XMailer);
            if ($myXmailer) {
                $result .= $this->headerLine('X-Mailer', $myXmailer);
            }
        }

        if ($this->ConfirmReadingTo != '') {
            $result .= $this->headerLine('Disposition-Notification-To', '<' . $this->ConfirmReadingTo . '>');
        }

        // Add custom headers
        foreach ($this->CustomHeader as $header) {
            $result .= $this->headerLine(
                trim($header[0]),
                $this->encodeHeader(trim($header[1]))
            );
        }
        if (!$this->sign_key_file) {
            $result .= $this->headerLine('MIME-Version', '1.0');
            $result .= $this->getMailMIME();
        }

        return $result;
    }

    /**
     * Get the message MIME type headers.
     * @access public
     * @return string
     */
    public function getMailMIME()
    {
        $result = '';
        $ismultipart = true;
        switch ($this->message_type) {
            case 'inline':
                $result .= $this->headerLine('Content-Type', 'multipart/related;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'attach':
            case 'inline_attach':
            case 'alt_attach':
            case 'alt_inline_attach':
                $result .= $this->headerLine('Content-Type', 'multipart/mixed;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            case 'alt':
            case 'alt_inline':
                $result .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $result .= $this->textLine("\tboundary=\"" . $this->boundary[1] . '"');
                break;
            default:
                // Catches case 'plain': and case '':
                $result .= $this->textLine('Content-Type: ' . $this->ContentType . '; charset=' . $this->CharSet);
                $ismultipart = false;
                break;
        }
        // RFC1341 part 5 says 7bit is assumed if not specified
        if ($this->Encoding != '7bit') {
            // RFC 2045 section 6.4 says multipart MIME parts may only use 7bit, 8bit or binary CTE
            if ($ismultipart) {
                if ($this->Encoding == '8bit') {
                    $result .= $this->headerLine('Content-Transfer-Encoding', '8bit');
                }
                // The only remaining alternatives are quoted-printable and base64, which are both 7bit compatible
            } else {
                $result .= $this->headerLine('Content-Transfer-Encoding', $this->Encoding);
            }
        }

        if ($this->Mailer != 'mail') {
            $result .= $this->LE;
        }

        return $result;
    }

    /**
     * Returns the whole MIME message.
     * Includes complete headers and body.
     * Only valid post preSend().
     * @see PHPMailer::preSend()
     * @access public
     * @return string
     */
    public function getSentMIMEMessage()
    {
        return rtrim($this->MIMEHeader . $this->mailHeader, "\n\r") . self::CRLF . self::CRLF . $this->MIMEBody;
    }

    /**
     * Assemble the message body.
     * Returns an empty string on failure.
     * @access public
     * @throws phpmailerException
     * @return string The assembled message body
     */
    public function createBody()
    {
        $body = '';
        //Create unique IDs and preset boundaries
        $this->uniqueid = md5(uniqid(time()));
        $this->boundary[1] = 'b1_' . $this->uniqueid;
        $this->boundary[2] = 'b2_' . $this->uniqueid;
        $this->boundary[3] = 'b3_' . $this->uniqueid;

        if ($this->sign_key_file) {
            $body .= $this->getMailMIME() . $this->LE;
        }

        $this->setWordWrap();

        $bodyEncoding = $this->Encoding;
        $bodyCharSet = $this->CharSet;
        //Can we do a 7-bit downgrade?
        if ($bodyEncoding == '8bit' and !$this->has8bitChars($this->Body)) {
            $bodyEncoding = '7bit';
            //All ISO 8859, Windows codepage and UTF-8 charsets are ascii compatible up to 7-bit
            $bodyCharSet = 'us-ascii';
        }
        //If lines are too long, and we're not already using an encoding that will shorten them,
        //change to quoted-printable transfer encoding for the body part only
        if ('base64' != $this->Encoding and self::hasLineLongerThanMax($this->Body)) {
            $bodyEncoding = 'quoted-printable';
        }

        $altBodyEncoding = $this->Encoding;
        $altBodyCharSet = $this->CharSet;
        //Can we do a 7-bit downgrade?
        if ($altBodyEncoding == '8bit' and !$this->has8bitChars($this->AltBody)) {
            $altBodyEncoding = '7bit';
            //All ISO 8859, Windows codepage and UTF-8 charsets are ascii compatible up to 7-bit
            $altBodyCharSet = 'us-ascii';
        }
        //If lines are too long, and we're not already using an encoding that will shorten them,
        //change to quoted-printable transfer encoding for the alt body part only
        if ('base64' != $altBodyEncoding and self::hasLineLongerThanMax($this->AltBody)) {
            $altBodyEncoding = 'quoted-printable';
        }
        //Use this as a preamble in all multipart message types
        $mimepre = "This is a multi-part message in MIME format." . $this->LE . $this->LE;
        switch ($this->message_type) {
            case 'inline':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[1]);
                break;
            case 'attach':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'inline_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[1], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                if (!empty($this->Ical)) {
                    $body .= $this->getBoundary($this->boundary[1], '', 'text/calendar; method=REQUEST', '');
                    $body .= $this->encodeString($this->Ical, $this->Encoding);
                    $body .= $this->LE . $this->LE;
                }
                $body .= $this->endBoundary($this->boundary[1]);
                break;
            case 'alt_inline':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->endBoundary($this->boundary[1]);
                break;
            case 'alt_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            case 'alt_inline_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1]);
                $body .= $this->headerLine('Content-Type', 'multipart/alternative;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[2] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[2], $altBodyCharSet, 'text/plain', $altBodyEncoding);
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->textLine('--' . $this->boundary[2]);
                $body .= $this->headerLine('Content-Type', 'multipart/related;');
                $body .= $this->textLine("\tboundary=\"" . $this->boundary[3] . '"');
                $body .= $this->LE;
                $body .= $this->getBoundary($this->boundary[3], $bodyCharSet, 'text/html', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= $this->LE . $this->LE;
                $body .= $this->attachAll('inline', $this->boundary[3]);
                $body .= $this->LE;
                $body .= $this->endBoundary($this->boundary[2]);
                $body .= $this->LE;
                $body .= $this->attachAll('attachment', $this->boundary[1]);
                break;
            default:
                // Catch case 'plain' and case '', applies to simple `text/plain` and `text/html` body content types
                //Reset the `Encoding` property in case we changed it for line length reasons
                $this->Encoding = $bodyEncoding;
                $body .= $this->encodeString($this->Body, $this->Encoding);
                break;
        }

        if ($this->isError()) {
            $body = '';
        } elseif ($this->sign_key_file) {
            try {
                if (!defined('PKCS7_TEXT')) {
                    throw new phpmailerException($this->lang('extension_missing') . 'openssl');
                }
                // @TODO would be nice to use php://temp streams here, but need to wrap for PHP < 5.1
                $file = tempnam(sys_get_temp_dir(), 'mail');
                if (false === file_put_contents($file, $body)) {
                    throw new phpmailerException($this->lang('signing') . ' Could not write temp file');
                }
                $signed = tempnam(sys_get_temp_dir(), 'signed');
                //Workaround for PHP bug https://bugs.php.net/bug.php?id=69197
                if (empty($this->sign_extracerts_file)) {
                    $sign = @openssl_pkcs7_sign(
                        $file,
                        $signed,
                        'file://' . realpath($this->sign_cert_file),
                        array('file://' . realpath($this->sign_key_file), $this->sign_key_pass),
                        null
                    );
                } else {
                    $sign = @openssl_pkcs7_sign(
                        $file,
                        $signed,
                        'file://' . realpath($this->sign_cert_file),
                        array('file://' . realpath($this->sign_key_file), $this->sign_key_pass),
                        null,
                        PKCS7_DETACHED,
                        $this->sign_extracerts_file
                    );
                }
                if ($sign) {
                    @unlink($file);
                    $body = file_get_contents($signed);
                    @unlink($signed);
                    //The message returned by openssl contains both headers and body, so need to split them up
                    $parts = explode("\n\n", $body, 2);
                    $this->MIMEHeader .= $parts[0] . $this->LE . $this->LE;
                    $body = $parts[1];
                } else {
                    @unlink($file);
                    @unlink($signed);
                    throw new phpmailerException($this->lang('signing') . openssl_error_string());
                }
            } catch (phpmailerException $exc) {
                $body = '';
                if ($this->exceptions) {
                    throw $exc;
                }
            }
        }
        return $body;
    }

    /**
     * Return the start of a message boundary.
     * @access protected
     * @param string $boundary
     * @param string $charSet
     * @param string $contentType
     * @param string $encoding
     * @return string
     */
    protected function getBoundary($boundary, $charSet, $contentType, $encoding)
    {
        $result = '';
        if ($charSet == '') {
            $charSet = $this->CharSet;
        }
        if ($contentType == '') {
            $contentType = $this->ContentType;
        }
        if ($encoding == '') {
            $encoding = $this->Encoding;
        }
        $result .= $this->textLine('--' . $boundary);
        $result .= sprintf('Content-Type: %s; charset=%s', $contentType, $charSet);
        $result .= $this->LE;
        // RFC1341 part 5 says 7bit is assumed if not specified
        if ($encoding != '7bit') {
            $result .= $this->headerLine('Content-Transfer-Encoding', $encoding);
        }
        $result .= $this->LE;

        return $result;
    }

    /**
     * Return the end of a message boundary.
     * @access protected
     * @param string $boundary
     * @return string
     */
    protected function endBoundary($boundary)
    {
        return $this->LE . '--' . $boundary . '--' . $this->LE;
    }

    /**
     * Set the message type.
     * PHPMailer only supports some preset message types, not arbitrary MIME structures.
     * @access protected
     * @return void
     */
    protected function setMessageType()
    {
        $type = array();
        if ($this->alternativeExists()) {
            $type[] = 'alt';
        }
        if ($this->inlineImageExists()) {
            $type[] = 'inline';
        }
        if ($this->attachmentExists()) {
            $type[] = 'attach';
        }
        $this->message_type = implode('_', $type);
        if ($this->message_type == '') {
            //The 'plain' message_type refers to the message having a single body element, not that it is plain-text
            $this->message_type = 'plain';
        }
    }

    /**
     * Format a header line.
     * @access public
     * @param string $name
     * @param string $value
     * @return string
     */
    public function headerLine($name, $value)
    {
        return $name . ': ' . $value . $this->LE;
    }

    /**
     * Return a formatted mail line.
     * @access public
     * @param string $value
     * @return string
     */
    public function textLine($value)
    {
        return $value . $this->LE;
    }

    /**
     * Add an attachment from a path on the filesystem.
     * Returns false if the file could not be found or read.
     * @param string $path Path to the attachment.
     * @param string $name Overrides the attachment name.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File extension (MIME) type.
     * @param string $disposition Disposition to use
     * @throws phpmailerException
     * @return boolean
     */
    public function addAttachment($path, $name = '', $encoding = 'base64', $type = '', $disposition = 'attachment')
    {
        try {
            if (!@is_file($path)) {
                throw new phpmailerException($this->lang('file_access') . $path, self::STOP_CONTINUE);
            }

            // If a MIME type is not specified, try to work it out from the file name
            if ($type == '') {
                $type = self::filenameToType($path);
            }

            $filename = basename($path);
            if ($name == '') {
                $name = $filename;
            }

            $this->attachment[] = array(
                0 => $path,
                1 => $filename,
                2 => $name,
                3 => $encoding,
                4 => $type,
                5 => false, // isStringAttachment
                6 => $disposition,
                7 => 0
            );

        } catch (phpmailerException $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
        return true;
    }

    /**
     * Return the array of attachments.
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachment;
    }

    /**
     * Attach all file, string, and binary attachments to the message.
     * Returns an empty string on failure.
     * @access protected
     * @param string $disposition_type
     * @param string $boundary
     * @return string
     */
    protected function attachAll($disposition_type, $boundary)
    {
        // Return text of body
        $mime = array();
        $cidUniq = array();
        $incl = array();

        // Add all attachments
        foreach ($this->attachment as $attachment) {
            // Check if it is a valid disposition_filter
            if ($attachment[6] == $disposition_type) {
                // Check for string attachment
                $string = '';
                $path = '';
                $bString = $attachment[5];
                if ($bString) {
                    $string = $attachment[0];
                } else {
                    $path = $attachment[0];
                }

                $inclhash = md5(serialize($attachment));
                if (in_array($inclhash, $incl)) {
                    continue;
                }
                $incl[] = $inclhash;
                $name = $attachment[2];
                $encoding = $attachment[3];
                $type = $attachment[4];
                $disposition = $attachment[6];
                $cid = $attachment[7];
                if ($disposition == 'inline' && array_key_exists($cid, $cidUniq)) {
                    continue;
                }
                $cidUniq[$cid] = true;

                $mime[] = sprintf('--%s%s', $boundary, $this->LE);
                //Only include a filename property if we have one
                if (!empty($name)) {
                    $mime[] = sprintf(
                        'Content-Type: %s; name="%s"%s',
                        $type,
                        $this->encodeHeader($this->secureHeader($name)),
                        $this->LE
                    );
                } else {
                    $mime[] = sprintf(
                        'Content-Type: %s%s',
                        $type,
                        $this->LE
                    );
                }
                // RFC1341 part 5 says 7bit is assumed if not specified
                if ($encoding != '7bit') {
                    $mime[] = sprintf('Content-Transfer-Encoding: %s%s', $encoding, $this->LE);
                }

                if ($disposition == 'inline') {
                    $mime[] = sprintf('Content-ID: <%s>%s', $cid, $this->LE);
                }

                // If a filename contains any of these chars, it should be quoted,
                // but not otherwise: RFC2183 & RFC2045 5.1
                // Fixes a warning in IETF's msglint MIME checker
                // Allow for bypassing the Content-Disposition header totally
                if (!(empty($disposition))) {
                    $encoded_name = $this->encodeHeader($this->secureHeader($name));
                    if (preg_match('/[ \(\)<>@,;:\\"\/\[\]\?=]/', $encoded_name)) {
                        $mime[] = sprintf(
                            'Content-Disposition: %s; filename="%s"%s',
                            $disposition,
                            $encoded_name,
                            $this->LE . $this->LE
                        );
                    } else {
                        if (!empty($encoded_name)) {
                            $mime[] = sprintf(
                                'Content-Disposition: %s; filename=%s%s',
                                $disposition,
                                $encoded_name,
                                $this->LE . $this->LE
                            );
                        } else {
                            $mime[] = sprintf(
                                'Content-Disposition: %s%s',
                                $disposition,
                                $this->LE . $this->LE
                            );
                        }
                    }
                } else {
                    $mime[] = $this->LE;
                }

                // Encode as string attachment
                if ($bString) {
                    $mime[] = $this->encodeString($string, $encoding);
                    if ($this->isError()) {
                        return '';
                    }
                    $mime[] = $this->LE . $this->LE;
                } else {
                    $mime[] = $this->encodeFile($path, $encoding);
                    if ($this->isError()) {
                        return '';
                    }
                    $mime[] = $this->LE . $this->LE;
                }
            }
        }

        $mime[] = sprintf('--%s--%s', $boundary, $this->LE);

        return implode('', $mime);
    }

    /**
     * Encode a file attachment in requested format.
     * Returns an empty string on failure.
     * @param string $path The full path to the file
     * @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
     * @throws phpmailerException
     * @access protected
     * @return string
     */
    protected function encodeFile($path, $encoding = 'base64')
    {
        try {
            if (!is_readable($path)) {
                throw new phpmailerException($this->lang('file_open') . $path, self::STOP_CONTINUE);
            }
            $magic_quotes = get_magic_quotes_runtime();
            if ($magic_quotes) {
                if (version_compare(PHP_VERSION, '5.3.0', '<')) {
                    set_magic_quotes_runtime(false);
                } else {
                    //Doesn't exist in PHP 5.4, but we don't need to check because
                    //get_magic_quotes_runtime always returns false in 5.4+
                    //so it will never get here
                    ini_set('magic_quotes_runtime', false);
                }
            }
            $file_buffer = file_get_contents($path);
            $file_buffer = $this->encodeString($file_buffer, $encoding);
            if ($magic_quotes) {
                if (version_compare(PHP_VERSION, '5.3.0', '<')) {
                    set_magic_quotes_runtime($magic_quotes);
                } else {
                    ini_set('magic_quotes_runtime', $magic_quotes);
                }
            }
            return $file_buffer;
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            return '';
        }
    }

    /**
     * Encode a string in requested format.
     * Returns an empty string on failure.
     * @param string $str The text to encode
     * @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
     * @access public
     * @return string
     */
    public function encodeString($str, $encoding = 'base64')
    {
        $encoded = '';
        switch (strtolower($encoding)) {
            case 'base64':
                $encoded = chunk_split(base64_encode($str), 76, $this->LE);
                break;
            case '7bit':
            case '8bit':
                $encoded = $this->fixEOL($str);
                // Make sure it ends with a line break
                if (substr($encoded, -(strlen($this->LE))) != $this->LE) {
                    $encoded .= $this->LE;
                }
                break;
            case 'binary':
                $encoded = $str;
                break;
            case 'quoted-printable':
                $encoded = $this->encodeQP($str);
                break;
            default:
                $this->setError($this->lang('encoding') . $encoding);
                break;
        }
        return $encoded;
    }

    /**
     * Encode a header string optimally.
     * Picks shortest of Q, B, quoted-printable or none.
     * @access public
     * @param string $str
     * @param string $position
     * @return string
     */
    public function encodeHeader($str, $position = 'text')
    {
        $matchcount = 0;
        switch (strtolower($position)) {
            case 'phrase':
                if (!preg_match('/[\200-\377]/', $str)) {
                    // Can't use addslashes as we don't know the value of magic_quotes_sybase
                    $encoded = addcslashes($str, "\0..\37\177\\\"");
                    if (($str == $encoded) && !preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -]/', $str)) {
                        return ($encoded);
                    } else {
                        return ("\"$encoded\"");
                    }
                }
                $matchcount = preg_match_all('/[^\040\041\043-\133\135-\176]/', $str, $matches);
                break;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                $matchcount = preg_match_all('/[()"]/', $str, $matches);
                // Intentional fall-through
            case 'text':
            default:
                $matchcount += preg_match_all('/[\000-\010\013\014\016-\037\177-\377]/', $str, $matches);
                break;
        }

        //There are no chars that need encoding
        if ($matchcount == 0) {
            return ($str);
        }

        $maxlen = 75 - 7 - strlen($this->CharSet);
        // Try to select the encoding which should produce the shortest output
        if ($matchcount > strlen($str) / 3) {
            // More than a third of the content will need encoding, so B encoding will be most efficient
            $encoding = 'B';
            if (function_exists('mb_strlen') && $this->hasMultiBytes($str)) {
                // Use a custom function which correctly encodes and wraps long
                // multibyte strings without breaking lines within a character
                $encoded = $this->base64EncodeWrapMB($str, "\n");
            } else {
                $encoded = base64_encode($str);
                $maxlen -= $maxlen % 4;
                $encoded = trim(chunk_split($encoded, $maxlen, "\n"));
            }
        } else {
            $encoding = 'Q';
            $encoded = $this->encodeQ($str, $position);
            $encoded = $this->wrapText($encoded, $maxlen, true);
            $encoded = str_replace('=' . self::CRLF, "\n", trim($encoded));
        }

        $encoded = preg_replace('/^(.*)$/m', ' =?' . $this->CharSet . "?$encoding?\\1?=", $encoded);
        $encoded = trim(str_replace("\n", $this->LE, $encoded));

        return $encoded;
    }

    /**
     * Check if a string contains multi-byte characters.
     * @access public
     * @param string $str multi-byte text to wrap encode
     * @return boolean
     */
    public function hasMultiBytes($str)
    {
        if (function_exists('mb_strlen')) {
            return (strlen($str) > mb_strlen($str, $this->CharSet));
        } else { // Assume no multibytes (we can't handle without mbstring functions anyway)
            return false;
        }
    }

    /**
     * Does a string contain any 8-bit chars (in any charset)?
     * @param string $text
     * @return boolean
     */
    public function has8bitChars($text)
    {
        return (boolean)preg_match('/[\x80-\xFF]/', $text);
    }

    /**
     * Encode and wrap long multibyte strings for mail headers
     * without breaking lines within a character.
     * Adapted from a function by paravoid
     * @link http://www.php.net/manual/en/function.mb-encode-mimeheader.php#60283
     * @access public
     * @param string $str multi-byte text to wrap encode
     * @param string $linebreak string to use as linefeed/end-of-line
     * @return string
     */
    public function base64EncodeWrapMB($str, $linebreak = null)
    {
        $start = '=?' . $this->CharSet . '?B?';
        $end = '?=';
        $encoded = '';
        if ($linebreak === null) {
            $linebreak = $this->LE;
        }

        $mb_length = mb_strlen($str, $this->CharSet);
        // Each line must have length <= 75, including $start and $end
        $length = 75 - strlen($start) - strlen($end);
        // Average multi-byte ratio
        $ratio = $mb_length / strlen($str);
        // Base64 has a 4:3 ratio
        $avgLength = floor($length * $ratio * .75);

        for ($i = 0; $i < $mb_length; $i += $offset) {
            $lookBack = 0;
            do {
                $offset = $avgLength - $lookBack;
                $chunk = mb_substr($str, $i, $offset, $this->CharSet);
                $chunk = base64_encode($chunk);
                $lookBack++;
            } while (strlen($chunk) > $length);
            $encoded .= $chunk . $linebreak;
        }

        // Chomp the last linefeed
        $encoded = substr($encoded, 0, -strlen($linebreak));
        return $encoded;
    }

    /**
     * Encode a string in quoted-printable format.
     * According to RFC2045 section 6.7.
     * @access public
     * @param string $string The text to encode
     * @param integer $line_max Number of chars allowed on a line before wrapping
     * @return string
     * @link http://www.php.net/manual/en/function.quoted-printable-decode.php#89417 Adapted from this comment
     */
    public function encodeQP($string, $line_max = 76)
    {
        // Use native function if it's available (>= PHP5.3)
        if (function_exists('quoted_printable_encode')) {
            return quoted_printable_encode($string);
        }
        // Fall back to a pure PHP implementation
        $string = str_replace(
            array('%20', '%0D%0A.', '%0D%0A', '%'),
            array(' ', "\r\n=2E", "\r\n", '='),
            rawurlencode($string)
        );
        return preg_replace('/[^\r\n]{' . ($line_max - 3) . '}[^=\r\n]{2}/', "$0=\r\n", $string);
    }

    /**
     * Backward compatibility wrapper for an old QP encoding function that was removed.
     * @see PHPMailer::encodeQP()
     * @access public
     * @param string $string
     * @param integer $line_max
     * @param boolean $space_conv
     * @return string
     * @deprecated Use encodeQP instead.
     */
    public function encodeQPphp(
        $string,
        $line_max = 76,
        /** @noinspection PhpUnusedParameterInspection */ $space_conv = false
    ) {
        return $this->encodeQP($string, $line_max);
    }

    /**
     * Encode a string using Q encoding.
     * @link http://tools.ietf.org/html/rfc2047
     * @param string $str the text to encode
     * @param string $position Where the text is going to be used, see the RFC for what that means
     * @access public
     * @return string
     */
    public function encodeQ($str, $position = 'text')
    {
        // There should not be any EOL in the string
        $pattern = '';
        $encoded = str_replace(array("\r", "\n"), '', $str);
        switch (strtolower($position)) {
            case 'phrase':
                // RFC 2047 section 5.3
                $pattern = '^A-Za-z0-9!*+\/ -';
                break;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                // RFC 2047 section 5.2
                $pattern = '\(\)"';
                // intentional fall-through
                // for this reason we build the $pattern without including delimiters and []
            case 'text':
            default:
                // RFC 2047 section 5.1
                // Replace every high ascii, control, =, ? and _ characters
                $pattern = '\000-\011\013\014\016-\037\075\077\137\177-\377' . $pattern;
                break;
        }
        $matches = array();
        if (preg_match_all("/[{$pattern}]/", $encoded, $matches)) {
            // If the string contains an '=', make sure it's the first thing we replace
            // so as to avoid double-encoding
            $eqkey = array_search('=', $matches[0]);
            if (false !== $eqkey) {
                unset($matches[0][$eqkey]);
                array_unshift($matches[0], '=');
            }
            foreach (array_unique($matches[0]) as $char) {
                $encoded = str_replace($char, '=' . sprintf('%02X', ord($char)), $encoded);
            }
        }
        // Replace every spaces to _ (more readable than =20)
        return str_replace(' ', '_', $encoded);
    }

    /**
     * Add a string or binary attachment (non-filesystem).
     * This method can be used to attach ascii or binary data,
     * such as a BLOB record from a database.
     * @param string $string String attachment data.
     * @param string $filename Name of the attachment.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File extension (MIME) type.
     * @param string $disposition Disposition to use
     * @return void
     */
    public function addStringAttachment(
        $string,
        $filename,
        $encoding = 'base64',
        $type = '',
        $disposition = 'attachment'
    ) {
        // If a MIME type is not specified, try to work it out from the file name
        if ($type == '') {
            $type = self::filenameToType($filename);
        }
        // Append to $attachment array
        $this->attachment[] = array(
            0 => $string,
            1 => $filename,
            2 => basename($filename),
            3 => $encoding,
            4 => $type,
            5 => true, // isStringAttachment
            6 => $disposition,
            7 => 0
        );
    }

    /**
     * Add an embedded (inline) attachment from a file.
     * This can include images, sounds, and just about any other document type.
     * These differ from 'regular' attachments in that they are intended to be
     * displayed inline with the message, not just attached for download.
     * This is used in HTML messages that embed the images
     * the HTML refers to using the $cid value.
     * @param string $path Path to the attachment.
     * @param string $cid Content ID of the attachment; Use this to reference
     *        the content when using an embedded image in HTML.
     * @param string $name Overrides the attachment name.
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type File MIME type.
     * @param string $disposition Disposition to use
     * @return boolean True on successfully adding an attachment
     */
    public function addEmbeddedImage($path, $cid, $name = '', $encoding = 'base64', $type = '', $disposition = 'inline')
    {
        if (!@is_file($path)) {
            $this->setError($this->lang('file_access') . $path);
            return false;
        }

        // If a MIME type is not specified, try to work it out from the file name
        if ($type == '') {
            $type = self::filenameToType($path);
        }

        $filename = basename($path);
        if ($name == '') {
            $name = $filename;
        }

        // Append to $attachment array
        $this->attachment[] = array(
            0 => $path,
            1 => $filename,
            2 => $name,
            3 => $encoding,
            4 => $type,
            5 => false, // isStringAttachment
            6 => $disposition,
            7 => $cid
        );
        return true;
    }

    /**
     * Add an embedded stringified attachment.
     * This can include images, sounds, and just about any other document type.
     * Be sure to set the $type to an image type for images:
     * JPEG images use 'image/jpeg', GIF uses 'image/gif', PNG uses 'image/png'.
     * @param string $string The attachment binary data.
     * @param string $cid Content ID of the attachment; Use this to reference
     *        the content when using an embedded image in HTML.
     * @param string $name
     * @param string $encoding File encoding (see $Encoding).
     * @param string $type MIME type.
     * @param string $disposition Disposition to use
     * @return boolean True on successfully adding an attachment
     */
    public function addStringEmbeddedImage(
        $string,
        $cid,
        $name = '',
        $encoding = 'base64',
        $type = '',
        $disposition = 'inline'
    ) {
        // If a MIME type is not specified, try to work it out from the name
        if ($type == '' and !empty($name)) {
            $type = self::filenameToType($name);
        }

        // Append to $attachment array
        $this->attachment[] = array(
            0 => $string,
            1 => $name,
            2 => $name,
            3 => $encoding,
            4 => $type,
            5 => true, // isStringAttachment
            6 => $disposition,
            7 => $cid
        );
        return true;
    }

    /**
     * Check if an inline attachment is present.
     * @access public
     * @return boolean
     */
    public function inlineImageExists()
    {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] == 'inline') {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if an attachment (non-inline) is present.
     * @return boolean
     */
    public function attachmentExists()
    {
        foreach ($this->attachment as $attachment) {
            if ($attachment[6] == 'attachment') {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if this message has an alternative body set.
     * @return boolean
     */
    public function alternativeExists()
    {
        return !empty($this->AltBody);
    }

    /**
     * Clear queued addresses of given kind.
     * @access protected
     * @param string $kind 'to', 'cc', or 'bcc'
     * @return void
     */
    public function clearQueuedAddresses($kind)
    {
        $RecipientsQueue = $this->RecipientsQueue;
        foreach ($RecipientsQueue as $address => $params) {
            if ($params[0] == $kind) {
                unset($this->RecipientsQueue[$address]);
            }
        }
    }

    /**
     * Clear all To recipients.
     * @return void
     */
    public function clearAddresses()
    {
        foreach ($this->to as $to) {
            unset($this->all_recipients[strtolower($to[0])]);
        }
        $this->to = array();
        $this->clearQueuedAddresses('to');
    }

    /**
     * Clear all CC recipients.
     * @return void
     */
    public function clearCCs()
    {
        foreach ($this->cc as $cc) {
            unset($this->all_recipients[strtolower($cc[0])]);
        }
        $this->cc = array();
        $this->clearQueuedAddresses('cc');
    }

    /**
     * Clear all BCC recipients.
     * @return void
     */
    public function clearBCCs()
    {
        foreach ($this->bcc as $bcc) {
            unset($this->all_recipients[strtolower($bcc[0])]);
        }
        $this->bcc = array();
        $this->clearQueuedAddresses('bcc');
    }

    /**
     * Clear all ReplyTo recipients.
     * @return void
     */
    public function clearReplyTos()
    {
        $this->ReplyTo = array();
        $this->ReplyToQueue = array();
    }

    /**
     * Clear all recipient types.
     * @return void
     */
    public function clearAllRecipients()
    {
        $this->to = array();
        $this->cc = array();
        $this->bcc = array();
        $this->all_recipients = array();
        $this->RecipientsQueue = array();
    }

    /**
     * Clear all filesystem, string, and binary attachments.
     * @return void
     */
    public function clearAttachments()
    {
        $this->attachment = array();
    }

    /**
     * Clear all custom headers.
     * @return void
     */
    public function clearCustomHeaders()
    {
        $this->CustomHeader = array();
    }

    /**
     * Add an error message to the error container.
     * @access protected
     * @param string $msg
     * @return void
     */
    protected function setError($msg)
    {
        $this->error_count++;
        if ($this->Mailer == 'smtp' and !is_null($this->smtp)) {
            $lasterror = $this->smtp->getError();
            if (!empty($lasterror['error'])) {
                $msg .= $this->lang('smtp_error') . $lasterror['error'];
                if (!empty($lasterror['detail'])) {
                    $msg .= ' Detail: '. $lasterror['detail'];
                }
                if (!empty($lasterror['smtp_code'])) {
                    $msg .= ' SMTP code: ' . $lasterror['smtp_code'];
                }
                if (!empty($lasterror['smtp_code_ex'])) {
                    $msg .= ' Additional SMTP info: ' . $lasterror['smtp_code_ex'];
                }
            }
        }
        $this->ErrorInfo = $msg;
    }

    /**
     * Return an RFC 822 formatted date.
     * @access public
     * @return string
     * @static
     */
    public static function rfcDate()
    {
        // Set the time zone to whatever the default is to avoid 500 errors
        // Will default to UTC if it's not set properly in php.ini
        date_default_timezone_set(@date_default_timezone_get());
        return date('D, j M Y H:i:s O');
    }

    /**
     * Get the server hostname.
     * Returns 'localhost.localdomain' if unknown.
     * @access protected
     * @return string
     */
    protected function serverHostname()
    {
        $result = 'localhost.localdomain';
        if (!empty($this->Hostname)) {
            $result = $this->Hostname;
        } elseif (isset($_SERVER) and array_key_exists('SERVER_NAME', $_SERVER) and !empty($_SERVER['SERVER_NAME'])) {
            $result = $_SERVER['SERVER_NAME'];
        } elseif (function_exists('gethostname') && gethostname() !== false) {
            $result = gethostname();
        } elseif (php_uname('n') !== false) {
            $result = php_uname('n');
        }
        return $result;
    }

    /**
     * Get an error message in the current language.
     * @access protected
     * @param string $key
     * @return string
     */
    protected function lang($key)
    {
        if (count($this->language) < 1) {
            $this->setLanguage('en'); // set the default language
        }

        if (array_key_exists($key, $this->language)) {
            if ($key == 'smtp_connect_failed') {
                //Include a link to troubleshooting docs on SMTP connection failure
                //this is by far the biggest cause of support questions
                //but it's usually not PHPMailer's fault.
                return $this->language[$key] . ' https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting';
            }
            return $this->language[$key];
        } else {
            //Return the key as a fallback
            return $key;
        }
    }

    /**
     * Check if an error occurred.
     * @access public
     * @return boolean True if an error did occur.
     */
    public function isError()
    {
        return ($this->error_count > 0);
    }

    /**
     * Ensure consistent line endings in a string.
     * Changes every end of line from CRLF, CR or LF to $this->LE.
     * @access public
     * @param string $str String to fixEOL
     * @return string
     */
    public function fixEOL($str)
    {
        // Normalise to \n
        $nstr = str_replace(array("\r\n", "\r"), "\n", $str);
        // Now convert LE as needed
        if ($this->LE !== "\n") {
            $nstr = str_replace("\n", $this->LE, $nstr);
        }
        return $nstr;
    }

    /**
     * Add a custom header.
     * $name value can be overloaded to contain
     * both header name and value (name:value)
     * @access public
     * @param string $name Custom header name
     * @param string $value Header value
     * @return void
     */
    public function addCustomHeader($name, $value = null)
    {
        if ($value === null) {
            // Value passed in as name:value
            $this->CustomHeader[] = explode(':', $name, 2);
        } else {
            $this->CustomHeader[] = array($name, $value);
        }
    }

    /**
     * Returns all custom headers.
     * @return array
     */
    public function getCustomHeaders()
    {
        return $this->CustomHeader;
    }

    /**
     * Create a message body from an HTML string.
     * Automatically inlines images and creates a plain-text version by converting the HTML,
     * overwriting any existing values in Body and AltBody.
     * $basedir is used when handling relative image paths, e.g. <img src="images/a.png">
     * will look for an image file in $basedir/images/a.png and convert it to inline.
     * If you don't want to apply these transformations to your HTML, just set Body and AltBody yourself.
     * @access public
     * @param string $message HTML message string
     * @param string $basedir base directory for relative paths to images
     * @param boolean|callable $advanced Whether to use the internal HTML to text converter
     *    or your own custom converter @see PHPMailer::html2text()
     * @return string $message The transformed message Body
     */
    public function msgHTML($message, $basedir = '', $advanced = false)
    {
        preg_match_all('/(src|background)=["\'](.*)["\']/Ui', $message, $images);
        if (array_key_exists(2, $images)) {
            foreach ($images[2] as $imgindex => $url) {
                // Convert data URIs into embedded images
                if (preg_match('#^data:(image[^;,]*)(;base64)?,#', $url, $match)) {
                    $data = substr($url, strpos($url, ','));
                    if ($match[2]) {
                        $data = base64_decode($data);
                    } else {
                        $data = rawurldecode($data);
                    }
                    $cid = md5($url) . '@phpmailer.0'; // RFC2392 S 2
                    if ($this->addStringEmbeddedImage($data, $cid, 'embed' . $imgindex, 'base64', $match[1])) {
                        $message = str_replace(
                            $images[0][$imgindex],
                            $images[1][$imgindex] . '="cid:' . $cid . '"',
                            $message
                        );
                    }
                } elseif (substr($url, 0, 4) !== 'cid:' && !preg_match('#^[a-z][a-z0-9+.-]*://#i', $url)) {
                    // Do not change urls for absolute images (thanks to corvuscorax)
                    // Do not change urls that are already inline images
                    $filename = basename($url);
                    $directory = dirname($url);
                    if ($directory == '.') {
                        $directory = '';
                    }
                    $cid = md5($url) . '@phpmailer.0'; // RFC2392 S 2
                    if (strlen($basedir) > 1 && substr($basedir, -1) != '/') {
                        $basedir .= '/';
                    }
                    if (strlen($directory) > 1 && substr($directory, -1) != '/') {
                        $directory .= '/';
                    }
                    if ($this->addEmbeddedImage(
                        $basedir . $directory . $filename,
                        $cid,
                        $filename,
                        'base64',
                        self::_mime_types((string)self::mb_pathinfo($filename, PATHINFO_EXTENSION))
                    )
                    ) {
                        $message = preg_replace(
                            '/' . $images[1][$imgindex] . '=["\']' . preg_quote($url, '/') . '["\']/Ui',
                            $images[1][$imgindex] . '="cid:' . $cid . '"',
                            $message
                        );
                    }
                }
            }
        }
        $this->isHTML(true);
        // Convert all message body line breaks to CRLF, makes quoted-printable encoding work much better
        $this->Body = $this->normalizeBreaks($message);
        $this->AltBody = $this->normalizeBreaks($this->html2text($message, $advanced));
        if (!$this->alternativeExists()) {
            $this->AltBody = 'To view this email message, open it in a program that understands HTML!' .
                self::CRLF . self::CRLF;
        }
        return $this->Body;
    }

    /**
     * Convert an HTML string into plain text.
     * This is used by msgHTML().
     * Note - older versions of this function used a bundled advanced converter
     * which was been removed for license reasons in #232.
     * Example usage:
     * <code>
     * // Use default conversion
     * $plain = $mail->html2text($html);
     * // Use your own custom converter
     * $plain = $mail->html2text($html, function($html) {
     *     $converter = new MyHtml2text($html);
     *     return $converter->get_text();
     * });
     * </code>
     * @param string $html The HTML text to convert
     * @param boolean|callable $advanced Any boolean value to use the internal converter,
     *   or provide your own callable for custom conversion.
     * @return string
     */
    public function html2text($html, $advanced = false)
    {
        if (is_callable($advanced)) {
            return call_user_func($advanced, $html);
        }
        return html_entity_decode(
            trim(strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/si', '', $html))),
            ENT_QUOTES,
            $this->CharSet
        );
    }

    /**
     * Get the MIME type for a file extension.
     * @param string $ext File extension
     * @access public
     * @return string MIME type of file.
     * @static
     */
    public static function _mime_types($ext = '')
    {
        $mimes = array(
            'xl'    => 'application/excel',
            'js'    => 'application/javascript',
            'hqx'   => 'application/mac-binhex40',
            'cpt'   => 'application/mac-compactpro',
            'bin'   => 'application/macbinary',
            'doc'   => 'application/msword',
            'word'  => 'application/msword',
            'xlsx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xltx'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
            'potx'  => 'application/vnd.openxmlformats-officedocument.presentationml.template',
            'ppsx'  => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
            'pptx'  => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'sldx'  => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
            'docx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'dotx'  => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
            'xlam'  => 'application/vnd.ms-excel.addin.macroEnabled.12',
            'xlsb'  => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
            'class' => 'application/octet-stream',
            'dll'   => 'application/octet-stream',
            'dms'   => 'application/octet-stream',
            'exe'   => 'application/octet-stream',
            'lha'   => 'application/octet-stream',
            'lzh'   => 'application/octet-stream',
            'psd'   => 'application/octet-stream',
            'sea'   => 'application/octet-stream',
            'so'    => 'application/octet-stream',
            'oda'   => 'application/oda',
            'pdf'   => 'application/pdf',
            'ai'    => 'application/postscript',
            'eps'   => 'application/postscript',
            'ps'    => 'application/postscript',
            'smi'   => 'application/smil',
            'smil'  => 'application/smil',
            'mif'   => 'application/vnd.mif',
            'xls'   => 'application/vnd.ms-excel',
            'ppt'   => 'application/vnd.ms-powerpoint',
            'wbxml' => 'application/vnd.wap.wbxml',
            'wmlc'  => 'application/vnd.wap.wmlc',
            'dcr'   => 'application/x-director',
            'dir'   => 'application/x-director',
            'dxr'   => 'application/x-director',
            'dvi'   => 'application/x-dvi',
            'gtar'  => 'application/x-gtar',
            'php3'  => 'application/x-httpd-php',
            'php4'  => 'application/x-httpd-php',
            'php'   => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps'  => 'application/x-httpd-php-source',
            'swf'   => 'application/x-shockwave-flash',
            'sit'   => 'application/x-stuffit',
            'tar'   => 'application/x-tar',
            'tgz'   => 'application/x-tar',
            'xht'   => 'application/xhtml+xml',
            'xhtml' => 'application/xhtml+xml',
            'zip'   => 'application/zip',
            'mid'   => 'audio/midi',
            'midi'  => 'audio/midi',
            'mp2'   => 'audio/mpeg',
            'mp3'   => 'audio/mpeg',
            'mpga'  => 'audio/mpeg',
            'aif'   => 'audio/x-aiff',
            'aifc'  => 'audio/x-aiff',
            'aiff'  => 'audio/x-aiff',
            'ram'   => 'audio/x-pn-realaudio',
            'rm'    => 'audio/x-pn-realaudio',
            'rpm'   => 'audio/x-pn-realaudio-plugin',
            'ra'    => 'audio/x-realaudio',
            'wav'   => 'audio/x-wav',
            'bmp'   => 'image/bmp',
            'gif'   => 'image/gif',
            'jpeg'  => 'image/jpeg',
            'jpe'   => 'image/jpeg',
            'jpg'   => 'image/jpeg',
            'png'   => 'image/png',
            'tiff'  => 'image/tiff',
            'tif'   => 'image/tiff',
            'eml'   => 'message/rfc822',
            'css'   => 'text/css',
            'html'  => 'text/html',
            'htm'   => 'text/html',
            'shtml' => 'text/html',
            'log'   => 'text/plain',
            'text'  => 'text/plain',
            'txt'   => 'text/plain',
            'rtx'   => 'text/richtext',
            'rtf'   => 'text/rtf',
            'vcf'   => 'text/vcard',
            'vcard' => 'text/vcard',
            'xml'   => 'text/xml',
            'xsl'   => 'text/xml',
            'mpeg'  => 'video/mpeg',
            'mpe'   => 'video/mpeg',
            'mpg'   => 'video/mpeg',
            'mov'   => 'video/quicktime',
            'qt'    => 'video/quicktime',
            'rv'    => 'video/vnd.rn-realvideo',
            'avi'   => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie'
        );
        if (array_key_exists(strtolower($ext), $mimes)) {
            return $mimes[strtolower($ext)];
        }
        return 'application/octet-stream';
    }

    /**
     * Map a file name to a MIME type.
     * Defaults to 'application/octet-stream', i.e.. arbitrary binary data.
     * @param string $filename A file name or full path, does not need to exist as a file
     * @return string
     * @static
     */
    public static function filenameToType($filename)
    {
        // In case the path is a URL, strip any query string before getting extension
        $qpos = strpos($filename, '?');
        if (false !== $qpos) {
            $filename = substr($filename, 0, $qpos);
        }
        $pathinfo = self::mb_pathinfo($filename);
        return self::_mime_types($pathinfo['extension']);
    }

    /**
     * Multi-byte-safe pathinfo replacement.
     * Drop-in replacement for pathinfo(), but multibyte-safe, cross-platform-safe, old-version-safe.
     * Works similarly to the one in PHP >= 5.2.0
     * @link http://www.php.net/manual/en/function.pathinfo.php#107461
     * @param string $path A filename or path, does not need to exist as a file
     * @param integer|string $options Either a PATHINFO_* constant,
     *      or a string name to return only the specified piece, allows 'filename' to work on PHP < 5.2
     * @return string|array
     * @static
     */
    public static function mb_pathinfo($path, $options = null)
    {
        $ret = array('dirname' => '', 'basename' => '', 'extension' => '', 'filename' => '');
        $pathinfo = array();
        if (preg_match('%^(.*?)[\\\\/]*(([^/\\\\]*?)(\.([^\.\\\\/]+?)|))[\\\\/\.]*$%im', $path, $pathinfo)) {
            if (array_key_exists(1, $pathinfo)) {
                $ret['dirname'] = $pathinfo[1];
            }
            if (array_key_exists(2, $pathinfo)) {
                $ret['basename'] = $pathinfo[2];
            }
            if (array_key_exists(5, $pathinfo)) {
                $ret['extension'] = $pathinfo[5];
            }
            if (array_key_exists(3, $pathinfo)) {
                $ret['filename'] = $pathinfo[3];
            }
        }
        switch ($options) {
            case PATHINFO_DIRNAME:
            case 'dirname':
                return $ret['dirname'];
            case PATHINFO_BASENAME:
            case 'basename':
                return $ret['basename'];
            case PATHINFO_EXTENSION:
            case 'extension':
                return $ret['extension'];
            case PATHINFO_FILENAME:
            case 'filename':
                return $ret['filename'];
            default:
                return $ret;
        }
    }

    /**
     * Set or reset instance properties.
     * You should avoid this function - it's more verbose, less efficient, more error-prone and
     * harder to debug than setting properties directly.
     * Usage Example:
     * `$mail->set('SMTPSecure', 'tls');`
     *   is the same as:
     * `$mail->SMTPSecure = 'tls';`
     * @access public
     * @param string $name The property name to set
     * @param mixed $value The value to set the property to
     * @return boolean
     * @TODO Should this not be using the __set() magic function?
     */
    public function set($name, $value = '')
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return true;
        } else {
            $this->setError($this->lang('variable_set') . $name);
            return false;
        }
    }

    /**
     * Strip newlines to prevent header injection.
     * @access public
     * @param string $str
     * @return string
     */
    public function secureHeader($str)
    {
        return trim(str_replace(array("\r", "\n"), '', $str));
    }

    /**
     * Normalize line breaks in a string.
     * Converts UNIX LF, Mac CR and Windows CRLF line breaks into a single line break format.
     * Defaults to CRLF (for message bodies) and preserves consecutive breaks.
     * @param string $text
     * @param string $breaktype What kind of line break to use, defaults to CRLF
     * @return string
     * @access public
     * @static
     */
    public static function normalizeBreaks($text, $breaktype = "\r\n")
    {
        return preg_replace('/(\r\n|\r|\n)/ms', $breaktype, $text);
    }

    /**
     * Set the public and private key files and password for S/MIME signing.
     * @access public
     * @param string $cert_filename
     * @param string $key_filename
     * @param string $key_pass Password for private key
     * @param string $extracerts_filename Optional path to chain certificate
     */
    public function sign($cert_filename, $key_filename, $key_pass, $extracerts_filename = '')
    {
        $this->sign_cert_file = $cert_filename;
        $this->sign_key_file = $key_filename;
        $this->sign_key_pass = $key_pass;
        $this->sign_extracerts_file = $extracerts_filename;
    }

    /**
     * Quoted-Printable-encode a DKIM header.
     * @access public
     * @param string $txt
     * @return string
     */
    public function DKIM_QP($txt)
    {
        $line = '';
        for ($i = 0; $i < strlen($txt); $i++) {
            $ord = ord($txt[$i]);
            if (((0x21 <= $ord) && ($ord <= 0x3A)) || $ord == 0x3C || ((0x3E <= $ord) && ($ord <= 0x7E))) {
                $line .= $txt[$i];
            } else {
                $line .= '=' . sprintf('%02X', $ord);
            }
        }
        return $line;
    }

    /**
     * Generate a DKIM signature.
     * @access public
     * @param string $signHeader
     * @throws phpmailerException
     * @return string The DKIM signature value
     */
    public function DKIM_Sign($signHeader)
    {
        if (!defined('PKCS7_TEXT')) {
            if ($this->exceptions) {
                throw new phpmailerException($this->lang('extension_missing') . 'openssl');
            }
            return '';
        }
        $privKeyStr = file_get_contents($this->DKIM_private);
        if ('' != $this->DKIM_passphrase) {
            $privKey = openssl_pkey_get_private($privKeyStr, $this->DKIM_passphrase);
        } else {
            $privKey = openssl_pkey_get_private($privKeyStr);
        }
        //Workaround for missing digest algorithms in old PHP & OpenSSL versions
        //@link http://stackoverflow.com/a/11117338/333340
        if (version_compare(PHP_VERSION, '5.3.0') >= 0 and
            in_array('sha256WithRSAEncryption', openssl_get_md_methods(true))) {
            if (openssl_sign($signHeader, $signature, $privKey, 'sha256WithRSAEncryption')) {
                openssl_pkey_free($privKey);
                return base64_encode($signature);
            }
        } else {
            $pinfo = openssl_pkey_get_details($privKey);
            $hash = hash('sha256', $signHeader);
            //'Magic' constant for SHA256 from RFC3447
            //@link https://tools.ietf.org/html/rfc3447#page-43
            $t = '3031300d060960864801650304020105000420' . $hash;
            $pslen = $pinfo['bits'] / 8 - (strlen($t) / 2 + 3);
            $eb = pack('H*', '0001' . str_repeat('FF', $pslen) . '00' . $t);

            if (openssl_private_encrypt($eb, $signature, $privKey, OPENSSL_NO_PADDING)) {
                openssl_pkey_free($privKey);
                return base64_encode($signature);
            }
        }
        openssl_pkey_free($privKey);
        return '';
    }

    /**
     * Generate a DKIM canonicalization header.
     * @access public
     * @param string $signHeader Header
     * @return string
     */
    public function DKIM_HeaderC($signHeader)
    {
        $signHeader = preg_replace('/\r\n\s+/', ' ', $signHeader);
        $lines = explode("\r\n", $signHeader);
        foreach ($lines as $key => $line) {
            list($heading, $value) = explode(':', $line, 2);
            $heading = strtolower($heading);
            $value = preg_replace('/\s{2,}/', ' ', $value); // Compress useless spaces
            $lines[$key] = $heading . ':' . trim($value); // Don't forget to remove WSP around the value
        }
        $signHeader = implode("\r\n", $lines);
        return $signHeader;
    }

    /**
     * Generate a DKIM canonicalization body.
     * @access public
     * @param string $body Message Body
     * @return string
     */
    public function DKIM_BodyC($body)
    {
        if ($body == '') {
            return "\r\n";
        }
        // stabilize line endings
        $body = str_replace("\r\n", "\n", $body);
        $body = str_replace("\n", "\r\n", $body);
        // END stabilize line endings
        while (substr($body, strlen($body) - 4, 4) == "\r\n\r\n") {
            $body = substr($body, 0, strlen($body) - 2);
        }
        return $body;
    }

    /**
     * Create the DKIM header and body in a new message header.
     * @access public
     * @param string $headers_line Header lines
     * @param string $subject Subject
     * @param string $body Body
     * @return string
     */
    public function DKIM_Add($headers_line, $subject, $body)
    {
        $DKIMsignatureType = 'rsa-sha256'; // Signature & hash algorithms
        $DKIMcanonicalization = 'relaxed/simple'; // Canonicalization of header/body
        $DKIMquery = 'dns/txt'; // Query method
        $DKIMtime = time(); // Signature Timestamp = seconds since 00:00:00 - Jan 1, 1970 (UTC time zone)
        $subject_header = "Subject: $subject";
        $headers = explode($this->LE, $headers_line);
        $from_header = '';
        $to_header = '';
        $date_header = '';
        $current = '';
        foreach ($headers as $header) {
            if (strpos($header, 'From:') === 0) {
                $from_header = $header;
                $current = 'from_header';
            } elseif (strpos($header, 'To:') === 0) {
                $to_header = $header;
                $current = 'to_header';
            } elseif (strpos($header, 'Date:') === 0) {
                $date_header = $header;
                $current = 'date_header';
            } else {
                if (!empty($$current) && strpos($header, ' =?') === 0) {
                    $$current .= $header;
                } else {
                    $current = '';
                }
            }
        }
        $from = str_replace('|', '=7C', $this->DKIM_QP($from_header));
        $to = str_replace('|', '=7C', $this->DKIM_QP($to_header));
        $date = str_replace('|', '=7C', $this->DKIM_QP($date_header));
        $subject = str_replace(
            '|',
            '=7C',
            $this->DKIM_QP($subject_header)
        ); // Copied header fields (dkim-quoted-printable)
        $body = $this->DKIM_BodyC($body);
        $DKIMlen = strlen($body); // Length of body
        $DKIMb64 = base64_encode(pack('H*', hash('sha256', $body))); // Base64 of packed binary SHA-256 hash of body
        if ('' == $this->DKIM_identity) {
            $ident = '';
        } else {
            $ident = ' i=' . $this->DKIM_identity . ';';
        }
        $dkimhdrs = 'DKIM-Signature: v=1; a=' .
            $DKIMsignatureType . '; q=' .
            $DKIMquery . '; l=' .
            $DKIMlen . '; s=' .
            $this->DKIM_selector .
            ";\r\n" .
            "\tt=" . $DKIMtime . '; c=' . $DKIMcanonicalization . ";\r\n" .
            "\th=From:To:Date:Subject;\r\n" .
            "\td=" . $this->DKIM_domain . ';' . $ident . "\r\n" .
            "\tz=$from\r\n" .
            "\t|$to\r\n" .
            "\t|$date\r\n" .
            "\t|$subject;\r\n" .
            "\tbh=" . $DKIMb64 . ";\r\n" .
            "\tb=";
        $toSign = $this->DKIM_HeaderC(
            $from_header . "\r\n" .
            $to_header . "\r\n" .
            $date_header . "\r\n" .
            $subject_header . "\r\n" .
            $dkimhdrs
        );
        $signed = $this->DKIM_Sign($toSign);
        return $dkimhdrs . $signed . "\r\n";
    }

    /**
     * Detect if a string contains a line longer than the maximum line length allowed.
     * @param string $str
     * @return boolean
     * @static
     */
    public static function hasLineLongerThanMax($str)
    {
        //+2 to include CRLF line break for a 1000 total
        return (boolean)preg_match('/^(.{'.(self::MAX_LINE_LENGTH + 2).',})/m', $str);
    }

    /**
     * Allows for public read access to 'to' property.
     * @note: Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     * @access public
     * @return array
     */
    public function getToAddresses()
    {
        return $this->to;
    }

    /**
     * Allows for public read access to 'cc' property.
     * @note: Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     * @access public
     * @return array
     */
    public function getCcAddresses()
    {
        return $this->cc;
    }

    /**
     * Allows for public read access to 'bcc' property.
     * @note: Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     * @access public
     * @return array
     */
    public function getBccAddresses()
    {
        return $this->bcc;
    }

    /**
     * Allows for public read access to 'ReplyTo' property.
     * @note: Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     * @access public
     * @return array
     */
    public function getReplyToAddresses()
    {
        return $this->ReplyTo;
    }

    /**
     * Allows for public read access to 'all_recipients' property.
     * @note: Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     * @access public
     * @return array
     */
    public function getAllRecipientAddresses()
    {
        return $this->all_recipients;
    }

    /**
     * Perform a callback.
     * @param boolean $isSent
     * @param array $to
     * @param array $cc
     * @param array $bcc
     * @param string $subject
     * @param string $body
     * @param string $from
     */
    protected function doCallback($isSent, $to, $cc, $bcc, $subject, $body, $from)
    {
        if (!empty($this->action_function) && is_callable($this->action_function)) {
            $params = array($isSent, $to, $cc, $bcc, $subject, $body, $from);
            call_user_func_array($this->action_function, $params);
        }
    }
}

/**
 * PHPMailer exception handler
 * @package PHPMailer
 */
class phpmailerException extends Exception
{
    /**
     * Prettify error message output
     * @return string
     */
    public function errorMessage()
    {
        $errorMsg = '<strong>' . $this->getMessage() . "</strong><br />\n";
        return $errorMsg;
    }
}

?>