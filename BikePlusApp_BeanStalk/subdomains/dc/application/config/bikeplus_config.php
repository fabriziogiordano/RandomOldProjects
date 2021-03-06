<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['google_map_key']          = 'AIzaSyBFATtfUwn9atJCxlIzp_b8s9r4FCMUSj8';
$config['facebook_appid']          = '693123570705167';
$config['google_analytics_ua']     = 'UA-137286-33';
$config['google_analytics_domain'] = 'bikeplusapp.com';

switch ($_SERVER['SERVER_NAME']) {
	case 'beta.bikeplusapp.com':
		$config['language']          = 'beta';
		break;
	case 'boston.bikeplusapp.com':
		$config['language']          = 'boston';
		break;
	case 'dc.bikeplusapp.com':
		$config['language']          = 'dc';
		break;
	case 'dev.bikeplusapp.com':
		$config['language']          = 'dev';
		break;
	case 'london.bikeplusapp.com':
		$config['language']          = 'london';
		break;
	case 'milano.bikeplusapp.com':
		$config['language']          = 'milano';
		break;
	case 'nyc.bikeplusapp.com':
		$config['language']          = 'nyc';
		break;
	case 'chicago.bikeplusapp.com':
		$config['language']          = 'chicago';
		break;
	case 'bikeplusapp.com':
	case 'www.bikeplusapp.com':
	case 'dev.www.bikeplusapp.com':
		$config['language']          = 'english';
		break;
	default:
		die('No config loaded');
		break;
}