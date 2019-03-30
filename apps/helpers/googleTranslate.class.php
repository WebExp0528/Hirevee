<?php
//http://code.google.com/p/google-translate-php-wrapper/source/browse/trunk/googleTranslate.class.php?r=13
/**
 * GoogleTranslateWrapper Main Class
 *
 * @category GoogleTranslateWrapper
 * @package GoogleTranslateWrapper
 * @author Sameer Borate
 * @link http://www.codediesel.com
 * @copyright 2011 Sameer Borate
 * @version 1.0.3
 */

class GoogleTranslateWrapper {
	/**
	 * URL of Google translate
	 * @var string
	 */
	// private $_googleTranslateUrl = 'http://ajax.googleapis.com/ajax/services/language/translate';
	private $_googleTranslateUrl = 'https://www.googleapis.com/language/translate/v2';
	
	/**
	 * URL of Google language detection
	 * @var string
	 */
	private $_googleDetectUrl = 'http://ajax.googleapis.com/ajax/services/language/detect';
	
	/**
	 * Language to translate from
	 * @var string
	 */
	private $_fromLang = '';
	
	/**
	 * Language to translate to
	 * @var string
	 */
	private $_toLang = '';
	
	private $_format = 'html'; //or text
	

	/**
	 * API version
	 * @var string
	 */
	private $_version = '2.0';
	
	/**
	 * Text to translate
	 * @var string
	 */
	private $_text = '';
	
	/**
	 * Site url using the code
	 * @var string
	 */
	private $_siteUrl = '';
	
	/**
	 * Google API key
	 * @var string
	 */
	private $_apiKey = '';
	
	/**
	 * Host IP address
	 * @var string
	 */
	private $_ip = '';
	
	/**
	 * POST fields
	 * @var string
	 */
	private $_postFields;
	
	/**
	 * Translated Text
	 * @var string
	 */
	private $_translatedText;
	
	/**
	 * Service Error
	 * @var string
	 */
	private $_serviceError = "";
	
	/**
	 * Translation success
	 * @var boolean
	 */
	private $_success = false;
	
	/**
	 * Translation character limit.
	 * Currently the limit set by Google is 5000
	 * @var integer
	 */
	private $_stringLimit = 5000;
	
	/**
	 * Chunk array
	 * @var array
	 */
	private $_chunks = 0;
	
	/**
	 * Current data chunk
	 * @var string
	 */
	private $_currentChunk = 0;
	
	/**
	 * Total chunks
	 * @var integer
	 */
	private $_totalChunks = 0;
	
	/**
	 * Detected source language
	 * @var string
	 */
	private $_detectedSourceLanguage = "";
	
	/**
	 * Cache directory to cache translation
	 * @var string
	 */
	var $_cache_directory = './cache/';
	
	/**
	 * Enable or disable cache
	 * @var bool
	 */
	private $_enable_cache = true;
	const DETECT = 1;
	const TRANSLATE = 2;
	/**
	 * Build a POST url to query Google
	 *
	 */
	private function _composeUrl($type) {
		if ($type == self::TRANSLATE) {
			$fields = array ('q' => $this->_text, 'source' => $this->_fromLang, 'target' => $this->_toLang, 'format' => $this->_format, 'userIp' => $this->_ip )

			;
		} elseif ($type == self::DETECT) {
			$fields = array ('q' => $this->_text, 'source' => $this->_fromLang, 'target' => $this->_toLang, 'format' => $this->_format, 'userIp' => $this->_ip )

			;
		}
		
		if ($this->_apiKey != "")
			$fields ['key'] = $this->_apiKey;
		
		$this->_postFields = http_build_query ( $fields, "&" );
	}
	/**
	 * Reset variables to be used for next query
	 *
	 */
	private function _reset() {
		$this->_fromLang = '';
		$this->_toLang = '';
		$this->_text = '';
		$this->_translatedText = '';
		$this->_postFields = '';
		$this->_serviceError = '';
		$this->_chunks = 0;
		$this->_currentChunk = 0;
		$this->_totalChunks = 0;
		$this->_detectedSourceLanguage = "";
	}
	
	/**
	 * Convert JSON response to an array.
	 *
	 * json_decode function is only available in PHP version 5.2.0 and above.
	 * So we use the PEAR package to decode JSON if the json_decode function
	 * is not available.
	 *
	 * @param string POST fields
	 * @return string response
	 */
	private function _decodeJSON($contents) {
		if (! function_exists ( 'json_decode' )) {
			require_once 'JSON.php';
			$json_handle = new Services_JSON ( SERVICES_JSON_LOOSE_TYPE );
			return $json_handle->decode ( $contents );
		} else {
			return json_decode ( $contents, true );
		}
	}
	
	/**
	 * Process the built query using cURL and POST
	 *
	 * @param string POST fields
	 * @return string response
	 */
	private function _remoteQuery($query) {
		if (! function_exists ( 'curl_init' )) {
			return "";
		}
		
		/* Setup CURL and its options*/
		$ch = curl_init ();
		
		curl_setopt ( $ch, CURLOPT_URL, $this->_googleTranslateUrl );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, array ('X-HTTP-Method-Override: GET' ) );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 15 );
		curl_setopt ( $ch, CURLOPT_REFERER, $_SERVER ['SERVER_NAME'] );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $query );
		
	dumpr($_SERVER ['SERVER_NAME']);
		
		$response = curl_exec ( $ch );
		
	dumpr($response);
		
		curl_close ( $ch );
		return $response;
	}
	
	/**
	 * Process the built query using cURL and GET
	 *
	 * @param string GET fields
	 * @return string response
	 */
	private function _remoteQueryDetect($query) {
		if (! function_exists ( 'curl_init' )) {
			return "";
		}
		
		$ch = curl_init ();
		$url = $this->_googleDetectUrl . "?" . $query;
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_REFERER, $this->_siteUrl );
		
		$response = curl_exec ( $ch );
		return $response;
	}
	
	/**
	 * Self test the class
	 *
	 * @return boolean
	 */
	public function selfTest() {
		if (! function_exists ( 'curl_init' )) {
			echo "cURL not installed.";
		} else {
			$temp = $this->_enable_cache;
			$this->_enable_cache = false;
			$testText = $this->translate ( "hello", "fr", "en" );
			echo ($testText == "bonjour") ? "Translation test Ok." : "Translation test Failed.";
			$this->_enable_cache = $temp;
		}
	}
	
	/**
	 * Check if the last translation was a success
	 *
	 * @return boolean
	 */
	public function isSuccess() {
		return $this->_success;
	}
	
	/**
	 * Get the last generated service error
	 *
	 * @return String
	 */
	public function getLastError() {
		return $this->_serviceError;
	}
	
	/**
	 * Get the detected source language, if the source is not provided
	 * during query
	 *
	 * @return String
	 */
	public function getDetectedSource() {
		return $this->_detectedSourceLanguage;
	}
	
	/**
	 * Set credentials (optional) when accessing Google translation services
	 *
	 * @param string $apiKey your google api key
	 */
	public function setCredentials($apiKey, $ip, $format = 'html') {
		$this->_apiKey = $apiKey;
		$this->_ip = $ip;
		$this->_format = $format;
	}
	
	/**
	 * Set Referrer header
	 *
	 * @param string $siteUrl your website url
	 */
	public function setReferrer($siteUrl) {
		$this->_siteUrl = $siteUrl;
	}
	
	/**
	 * Set cache status
	 *
	 * @param bool
	 */
	public function cacheEnabled($cache) {
		if ($cache == true || $cache == false) {
			$this->_enable_cache = $cache;
		}
	}
	
	/**
	 * Translate the given text
	 * @param string $text text to translate
	 * @param string $to language to translate to
	 * @param string $from optional language to translate from
	 * @return boolean | string
	 */
	public function translate($text = '', $to, $from = '') {
		$this->_success = false;
		
		if ($text == '' || $to == '') {
			return false;
		} else {
			
			if ($this->_chunks == 0) {
				$this->_chunks = str_split ( $text, $this->_stringLimit );
				$this->_totalChunks = count ( $this->_chunks );
				$this->_currentChunk = 0;
				
				$this->_text = $this->_chunks [$this->_currentChunk];
				$this->_toLang = $to;
				$this->_fromLang = $from;
			} else {
				$this->_text = $text;
				$this->_toLang = $to;
				$this->_fromLang = $from;
			}
		
		}
		
		$string_signature = md5 ( $to . $this->_text );
	//dumpr($to . $this->_text);
		if ($this->_enable_cache == true && file_exists ( $this->_cache_directory . $string_signature )) {
			if (is_dir ( $this->_cache_directory )) {
				$handle = fopen ( $this->_cache_directory . $string_signature, "r" );
				$contents = '';
				while ( ! feof ( $handle ) ) {
					$contents .= fread ( $handle, 8192 );
				}
				fclose ( $handle );
				
				$this->_currentChunk ++;
				
				if ($this->_currentChunk >= $this->_totalChunks) {
					$this->_success = true;
					return $contents;
				} else {
					return $this->translate ( $this->_chunks [$this->_currentChunk], $to, $from );
				}
			
			} else {
				exit ( $this->_cache_directory . " Cache directory does not exist" );
			}
		}
		
		$this->_composeUrl ( self::TRANSLATE );
		if ($this->_text != '' && $this->_postFields != '') {
	dumpr($this->_postFields);
		$contents = $this->_remoteQuery ( 'q=I+am+a+student.&source=en&target=ch&key=AIzaSyBXrB8ArcOP8PKUIzu7ibIxoitHmgZ6xHM' );
		//$contents = $this->_remoteQuery ( $this->_postFields );
	dumpr($contents);
			$json = $this->_decodeJSON ( $contents );
	dumpr($json);
			if (is_array ( $json )) {
				$this->_translatedText .= $json ['data'] ['translations'] [0] ['translatedText'];
				
				if (isset ( $json ['data'] ['translations'] [0] ['detectedSourceLanguage'] )) {
					$this->_detectedSourceLanguage = $json ['data'] ['translations'] [0] ['detectedSourceLanguage'];
				}
				
				if ($this->_enable_cache == true) {
					if (is_dir ( $this->_cache_directory )) {
						$handle = fopen ( $this->_cache_directory . $string_signature, "w" );
						fwrite ( $handle, $this->_translatedText );
						fclose ( $handle );
					} else {
						exit ( $this->_cache_directory . "Cache directory does not exist" );
					}
				}
				
				$this->_currentChunk ++;
				
				if ($this->_currentChunk >= $this->_totalChunks) {
					$this->_success = true;
					return $this->_translatedText;
				} else {
					return $this->translate ( $this->_chunks [$this->_currentChunk], $to, $from );
				}
			
			} else {
				$this->_reset ();
				$this->_serviceError = $json ['responseDetails'];
				$this->_success = false;
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * Detect the language of the given text
	 * @param string $text text language to detect
	 * @return boolean | string
	 */
	public function detectLanguage($text) {
		
		if ($text == '') {
			return false;
		} else {
			/* Keep the text length to 1000 characters. Google behaves
* inconsistently for more characters.
*/
			$this->_text = substr ( $text, 0, 1000 );
		}
		
		$this->_composeUrl ( self::DETECT );
		
		if ($this->_text != '' && $this->_postFields != '') {
			$contents = $this->_remoteQueryDetect ( $this->_postFields );
			$json = $this->_decodeJSON ( $contents );
			
			if ($json ['responseStatus'] == 200) {
				$this->_reset ();
				return $json ['responseData'];
			} else {
				$this->_serviceError = $json ['responseData'];
				return false;
			}
		} else {
			return false;
		}
	
	}

}

?>