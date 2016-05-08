<?php
class Token extends Controller {

	function __construct()
	{
		parent::Controller();
	}
	
	function index($i= NULL)
	{
		$tockencinema = '144448172238305|ad6ead367f30bffaf94d91bc-741865814|104772962907523|SlB_YB4xS2arml_mXSigJHcA3MQ.';
/*		
			$url = 'https://graph.facebook.com/me?access_token='.$tockencinema;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			#curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			#curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			#curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			$a = curl_exec($ch);
			curl_close($ch);
			$a = json_decode($a);
		var_dump($a);
*/

		/*
			$params = array(
				'access_token' => '144448172238305|ad6ead367f30bffaf94d91bc-741865814|104772962907523|SlB_YB4xS2arml_mXSigJHcA3MQ.',
				'message' => 'Se non avete un iPhone potete collegarvi a http://www.cinecittasavigliano.it/mobile',
				);
			$post = http_build_query($params, null, '&');
			$url = 'https://graph.facebook.com/me/feed';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			#curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			#curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			$a = curl_exec($ch);
			curl_close($ch);
			$a = json_decode($a);
		var_dump($a);
		//die;
		*/
		
			$params = array(
				'access_token' => '144448172238305|ad6ead367f30bffaf94d91bc-741865814|104772962907523|SlB_YB4xS2arml_mXSigJHcA3MQ.',
			#	'message' => 'Stiamo facendo gli ultimi aggiornamenti per il sito mobile.',
				);
			$post = http_build_query($params, null, '&');
			$url = 'https://graph.facebook.com/me/feed?'.$post;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			#curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			#curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			#curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			$a = curl_exec($ch);
			curl_close($ch);
			$a = json_decode($a,true);
		var_dump($a);
		die;
		
		/*
		$post = array(
			'access_token' => '144448172238305|ad6ead367f30bffaf94d91bc-741865814|pWxNPiRG3sXpnw1CS9rfjTERab8.',
			);
		
			$tocken = '144448172238305|ad6ead367f30bffaf94d91bc-741865814|pWxNPiRG3sXpnw1CS9rfjTERab8.';
			$url = 'https://graph.facebook.com/me/accounts?access_token='.$tocken;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			#curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			#curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			#curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			$a = curl_exec($ch);
			curl_close($ch);
			$a = json_decode($a);
		var_dump($a);
		*/
		die;
		
		144448172238305|ad6ead367f30bffaf94d91bc-741865814|pWxNPiRG3sXpnw1CS9rfjTERab8.
		144448172238305|ad6ead367f30bffaf94d91bc-741865814|pWxNPiRG3sXpnw1CS9rfjTERab8.
		
		$this->load->plugin('facebook');
		
		$facebook = new Facebook(array(
		  'appId'  => $this->config->item('fb_appid'),
		  'secret' => $this->config->item('252a0706b7f3ac38c9d155f42a6ef91e'),
		  'cookie' => true,
		));
		
		
		
		$template['session'] = $facebook->getSession();

		var_dump($template['session']);

		$template['me'] = null;
		// Session based API call.
		if ($template['session']) {
		  try {
		    $template['uid'] = $facebook->getUser();
		    $template['me'] = $facebook->api('/me');
		  } catch (FacebookApiException $e) {
		  }
		}

		// login or logout url will be needed depending on current user state.
		if ($template['me']) {
		  $template['logoutUrl'] = $facebook->getLogoutUrl();
		} else {
		  $template['loginUrl'] = $facebook->getLoginUrl();
		}
		
		$this->load->view('facebook/token',$template);
	}
}