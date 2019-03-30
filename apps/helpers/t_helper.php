<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

require_once ('googleTranslate.class.php');

if (!function_exists('t'))
{
	function t($text, $lang, $cache = true, $format = 'html')
	{
		$_ci = & get_instance();
		$apiKey = $_ci->config->config['googleTranslateAPIKey'];
		//dumpr($apiKey);
		$ip = $_ci->config->config['googleTranslateIPAddress'];
		//dumpr($ip);
		$defaultLang = $_ci->config->config['defaultLang'];
		//dumpr($defaultLang);
		//return the text if we don't need to translate
		if ($lang == $defaultLang)
			return $text;
		
		$gt = new GoogleTranslateWrapper();
		
		$gt->_cache_directory = realpath(APPPATH . "cache") . '/';
		$gt->setCredentials($apiKey, $ip, $format);
		$gt->setReferrer($_SERVER['SERVER_NAME']);
		//dumpr($cache);
		if (!$cache)
			$gt->cacheEnabled(false);
		
		$trans = $gt->translate($text, $lang, $defaultLang);
		dumpr("isSuccess" . $gt->isSuccess());
		if (!$gt->isSuccess())
			return $text;
		else
			return $trans;
	
	}
}