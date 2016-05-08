<?php
/* Sample optional targeting parameters array
$targetParamsSample = array(
'MSISDN'      => "", // OPTIONAL - Phone number with country code (ex: 16501234567)
'CARRIER'     => "", // OPTIONAL - ID of the carrier
'AGE'         => "", // OPTIONAL - Age (ex: 27)
'DOB'         => "", // OPTIONAL - Date of birth in format yyyy-mm-dd (ex: 2008-05-25)
'AREA_CODE'   => "", // OPTIONAL - Area code (ex: 650)
'POSTAL_CODE' => "", // OPTIONAL - Postal code (ex: 94123)
'GENDER'      => "", // OPTIONAL - Gender: "m" or "male"", "f" or "female"
'GEOLOCATION' => "", // OPTIONAL - Latitude and longitude (ex: 32.9014,-117.2079)
'DMA'         => "", // OPTIONAL - Designated Marketing Area code (ex: 807)
'ETHNICITY'   => "", // OPTIONAL - Ethnicity:0-African American,1-Asian,2-Hispanic,3-White,4-Other
'SEEKING'     => "", // OPTIONAL - Gender interested in: "m" or "male"", "f" or "female", "both"
'INCOME' 
 => "", // OPTIONAL - Income (ex: 50000)
'MARITAL' 
 => "", // OPTIONAL - Marital status: "single" or "married"
'EDUCATION'   => "", // OPTIONAL - Education level:0-No College,1-College Degree,2-Graduate School
'KEYWORDS'    => "", // OPTIONAL - Space delimited keywords (ex: MOVIE CATS FUNNY)
'MARKUP'      => "", // OPTIONAL - Your site markup: "xhtml" (default), "wml" or "chtml"
'ENCODING'    => "", // OPTIONAL - Your desired encoding: "utf8" (default), "sjis"
'JAVASCRIPT'  => "", // OPTIONAL - If you support javascript ads (i.e. iPhone): "yes" (default) or "no"
'TYPE'        => "", // OPTIONAL - Desired type of ad (banner is often back filled by text): "mixed" (default), "banner", "text"
'UNIQUE_ID'   => "", // OPTIONAL - Pass in a unique id for frequency capping
);
*/

class adv{
	static function getAd($partnerId, $siteId, $targetParams = null, $timeOut = 5) {
		// Required variable checking
		//$_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420+ (KHTML, like Gecko) Version/3.0 Mobile/1A543a Safari/419.3';
		if(empty($siteId) || empty($partnerId) || empty($_SERVER["HTTP_USER_AGENT"])) {
			return '';
		}

		// Configuration
		$version = "1.5";
		$language = 'php';
		$format = 'wap';
		$url = 'http://ads.admarvel.com/fam/postGetAd.php';

		// Parameters
		$params = urlencode('site_id') . "=" . urlencode($siteId);
		$params .= "&" . urlencode("partner_id") . "=" . urlencode($partnerId);
		$params .= "&" . urlencode("timeout") . "=" . urlencode($timeOut*1000);
		$params .= "&" . urlencode("version") . "=" . urlencode($version);
		$params .= "&" . urlencode("language") . "=" . urlencode($language);
		$params .= "&" . urlencode("format") . "=" . urlencode($format);
		//$params .= "&" . urlencode("testing") . "=" . urlencode("1");

		if(!empty($targetParams)) {
			$targetParamsString = adv::implode_with_keys("||", $targetParams);
			if(!empty($targetParamsString)) {
				$params .= "&" . urlencode("target_params") . "=" . urlencode($targetParamsString);
			}
		}

		// Sending phone headers
		$httpHeadersToIgnore = array("HTTP_PRAGMA","HTTP_CACHE_CONTROL","HTTP_CONNECTION","HTTP_COOKIE","HTTP_ACCEPT");
		$phoneHeaders = array();
		
		foreach($_SERVER as $name => $value) {
			if(!in_array($name, $httpHeadersToIgnore)) {
				$phoneHeaders[$name] = $value;
			}
		}

		$phoneHeadersString = adv::implode_with_keys("||", $phoneHeaders);
		if(!empty($phoneHeadersString)) {
			$params .= "&" . urlencode('phone_headers') . "=" . urlencode($phoneHeadersString);
		}

		// Get Ad
		$request = curl_init();
		curl_setopt($request, CURLOPT_URL, $url);
		curl_setopt($request, CURLOPT_HEADER, 1);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($request, CURLOPT_TIMEOUT, $timeOut);
		curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $timeOut);
		curl_setopt($request, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Connection: Close"));
		curl_setopt($request, CURLOPT_POSTFIELDS, $params);
		$ad_contents = curl_exec($request);
		$header_size =  curl_getinfo($request, CURLINFO_HEADER_SIZE);

		$header = substr($ad_contents,0,$header_size);
		$html = substr($ad_contents,$header_size,strlen($ad_contents));

		if(preg_match('/Admarvel-ErrorCode:\s*(.*)/i', $header, $matches)) {
			$admarvel_error_code = trim($matches[1]);
		}

		if(preg_match('/Admarvel-ErrorReason:\s*(.*)/i', $header, $matches)) {
			$admarvel_error_reason = trim($matches[1]);
		}

		if(!empty($admarvel_error_code) && !empty($admarvel_error_reason)) {
			$errMsg = '';

			/*
			 * COMMENT OUT FOR ERROR MSGS!!
			 *
				$errMsg .=  "\n<!--\n";
				$errMsg .=  "Admarvel Error Code: " . $admarvel_error_code . "\n";
				$errMsg .=  "Admarvel Error Reason: ". $admarvel_error_reason . "\n";
				$errMsg .=  "\n-->\n";
			 */
			return $errMsg;
		}

		$code = curl_getinfo($request, CURLINFO_HTTP_CODE);
		curl_close($request);

		if($code != 200) {
			return '';
		}

		return trim($html);
	}

	static function postMultiAd($partnerId, $siteId, $targetParams = null, $timeOut = 5) {
		// Required variable checking
		if(empty($siteId) || empty($partnerId) || empty($_SERVER["HTTP_USER_AGENT"])){
			return '';
		}

		// Configuration
		$version = "1.5";
		$language = "php";
		$format = "wap";
		$url = "http://ads.admarvel.com/fam/postGetAdMulti.php";

		// Parameters
		$params = urlencode("site_id") . "=" . urlencode($siteId);
		$params .= "&" . urlencode("partner_id") . "=" . urlencode($partnerId);
		$params .= "&" . urlencode("timeout") . "=" . urlencode($timeOut*1000);
		$params .= "&" . urlencode("version") . "=" . urlencode($version);
		$params .= "&" . urlencode("language") . "=" . urlencode($language);
		$params .= "&" . urlencode("format") . "=" . urlencode($format);
		//$params .= "&" . urlencode("testing") . "=" . urlencode("1");

		if(!empty($targetParams)) {
			$targetParamsString = adv::implode_with_keys("||", $targetParams);
			if(!empty($targetParamsString))	{
				$params .= "&" . urlencode("target_params") . "=" . urlencode($targetParamsString);
			}
		}

		// Sending phone headers
		$httpHeadersToIgnore = array("HTTP_PRAGMA","HTTP_CACHE_CONTROL","HTTP_CONNECTION","HTTP_COOKIE","HTTP_ACCEPT");
		$phoneHeaders = array();
		foreach($_SERVER as $name => $value) {
			if(!in_array($name, $httpHeadersToIgnore)){
				$phoneHeaders[$name] = $value;
			}
		}

		$phoneHeadersString = implode_with_keys("||", $phoneHeaders);
		if(!empty($phoneHeadersString)) {
			$params .= "&" . urlencode('phone_headers') . "=" . urlencode($phoneHeadersString);
		}

		// Get Ad
		$request = curl_init();
		curl_setopt($request, CURLOPT_URL, $url);
		curl_setopt($request, CURLOPT_HEADER, 1);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($request, CURLOPT_TIMEOUT, $timeOut);
		curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $timeOut);
		curl_setopt($request, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Connection: Close"));
		curl_setopt($request, CURLOPT_POSTFIELDS, $params);
		$ad_contents = curl_exec($request);
		$header_size =  curl_getinfo($request, CURLINFO_HEADER_SIZE);

		$header = substr($ad_contents,0,$header_size);
		$html = substr($ad_contents,$header_size,strlen($ad_contents));
		curl_close($request);

		return array(
		'header' => $header,
		'html' => trim($html)
		);
	}

	static function getMultiAd($result, $num) {
		$header = $result['header'];
		$html = $result['html'];

		$zero_index_number = $num - 1;
		if(preg_match('/Admarvel-ErrorCode-'.$zero_index_number.':\s*(.*)/i', $header, $matches)) {
			$admarvel_error_code = trim($matches[1]);
		}

		if(preg_match('/Admarvel-ErrorReason-'.$zero_index_number.':\s*(.*)/i', $header, $matches)) {
			$admarvel_error_reason = trim($matches[1]);
		}

		if(!empty($admarvel_error_code) && !empty($admarvel_error_reason)) {
			$errMsg = "";
			/*
			 * COMMENT OUT FOR ERROR MSGS!!
			 *
				$errMsg .=  "\n<!--\n";
				$errMsg .=  "Admarvel Error Code: " . $admarvel_error_code . "\n";
				$errMsg .=  "Admarvel Error Reason: ". $admarvel_error_reason . "\n";
				$errMsg .=  "\n-->\n";
			 */
			return $errMsg;
		}

		$admarvel_html = trim(adv::getTextBetweenTags($html, "admarvel-html-".$num));

		return $admarvel_html;
	}

	private function getTextBetweenTags($string, $tagname) {
		$pattern = "/<$tagname>(.*?)<\/$tagname>/s";
		preg_match($pattern, $string, $matches);

		return $matches[1];
	}


	private function implode_with_keys($glue, $array) {
		foreach($array as $key => $value)	{
			if(is_array($key)) continue;
			if(is_array($value)) continue;
			$ret[] = urlencode($key)."=>".urlencode($value);
		}

		return implode($glue, $ret);
	}

}