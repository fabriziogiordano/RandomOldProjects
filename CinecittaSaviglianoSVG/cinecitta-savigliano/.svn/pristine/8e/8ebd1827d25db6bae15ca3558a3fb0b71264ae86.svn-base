<?php
if($_SERVER['SERVER_NAME'] == 'cinecittasavigliano.loc'){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}
else{
	#error_reporting(E_WARNING);
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors', 0);
}

/*Se iphone o android redireziona*/
//echo $_SERVER['HTTP_USER_AGENT'];

if ($_SERVER["REQUEST_URI"] != '/api')
{
	if((empty($_COOKIE['device']) && preg_match('/android|ip(hone|od)/i', $_SERVER['HTTP_USER_AGENT'])) || (!empty($_COOKIE['device']) && $_COOKIE['device'] == 'iphone'))
	{
		if(empty($_COOKIE['device']))
		{
			setcookie('device', 'iphone', time()+3600, '/'); // , '.cinecittasavigliano.loc');
			header('Location: http://www.cinecittasavigliano.it/iphone');
		}
		else
		{
			setcookie('device', 'iphone', time()+3600, '/');
		}
	}
	/*Se altro mobile*/
	elseif((empty($_COOKIE['device']) && preg_match('/avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|iris|kindle|lge|maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $_SERVER['HTTP_USER_AGENT'])) || (!empty($_COOKIE['device']) && $_COOKIE['device'] == 'mobile'))
	{
		if(empty($_COOKIE['device']))
		{
			setcookie('device', 'mobile', time()+3600, '/'); // , '.cinecittasavigliano.loc');
			header('Location: http://www.cinecittasavigliano.it/mobile');
		}
		else
		{
			setcookie('device', 'mobile', time()+3600, '/');
		}
	}
	/*setta il cookie a desktop*/
	else
	{
		setcookie('device', 'desktop', time()+3600, '/'); // , '.cinecittasavigliano.loc');
	}
} //close api

$system_folder = 'system';
$application_folder = 'application';

/*
|---------------------------------------------------------------
| SET THE SERVER PATH
|---------------------------------------------------------------
|
| Let's attempt to determine the full-server path to the "system"
| folder in order to reduce the possibility of path problems.
| Note: We only attempt this if the user hasn't specified a
| full server path.
|
*/
if (strpos($system_folder, '/') === FALSE)
{
	if (function_exists('realpath') AND @realpath(dirname(__FILE__)) !== FALSE)
	{
		$system_folder = realpath(dirname(__FILE__)).'/'.$system_folder;
	}
}
else
{
	// Swap directory separators to Unix style for consistency
	$system_folder = str_replace("\\", "/", $system_folder);
}

/*
|---------------------------------------------------------------
| DEFINE APPLICATION CONSTANTS
|---------------------------------------------------------------
|
| EXT		- The file extension.  Typically ".php"
| SELF		- The name of THIS file (typically "index.php")
| FCPATH	- The full server path to THIS file
| BASEPATH	- The full server path to the "system" folder
| APPPATH	- The full server path to the "application" folder
|
*/
define('EXT', '.php');
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('FCPATH', str_replace(SELF, '', __FILE__));
define('BASEPATH', $system_folder.'/');

if (is_dir($application_folder))
{
	define('APPPATH', $application_folder.'/');
}
else
{
	if ($application_folder == '')
	{
		$application_folder = 'application';
	}

	define('APPPATH', BASEPATH.$application_folder.'/');
}

/*
|---------------------------------------------------------------
| LOAD THE FRONT CONTROLLER
|---------------------------------------------------------------
|
| And away we go...
|
*/
require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;

/* End of file index.php */
/* Location: ./index.php */