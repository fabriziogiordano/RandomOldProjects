<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$active_group = 'default';
$active_record = TRUE;

if($_SERVER['SERVER_NAME'] == 'cinecittasavigliano.loc')
{
	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'root';
	$db['default']['password'] = 'root';
	$db['default']['database'] = 'cinecittasavigliano';
}
elseif($_SERVER['SERVER_NAME'] == 'jiffycal.com')
{
	$db['default']['hostname'] = 'localhost';
	$db['default']['username'] = 'jiffycal';
	$db['default']['password'] = 'sempreio';
	$db['default']['database'] = 'jiffycal';
}
else
{
	$db['default']['hostname'] = '62.149.150.120';
	$db['default']['username'] = 'Sql370303';
	$db['default']['password'] = '5162325e';
	$db['default']['database'] = 'Sql370303_1';
}



$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';