<?php

function b_check()
{
	$mobile_agent = '/(iPod|iPhone|iPad|Android|BlackBerry|IEMobile|HTC|Server_KO_SKT|SonyEricssonX1|SKT|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/';
	$iPhone_agent = '/(iPod|iPhone|iPad)/';
	$android_agent = '/(Android)/';
	
	if(preg_match($mobile_agent, $_SERVER['HTTP_USER_AGENT'])) {
		define('BROWSER_TYPE', 'M' );
		if (preg_match($android_agent, $_SERVER['HTTP_USER_AGENT']))
		  define('BROWSER_TYPE_M', 'Android' );
		elseif (preg_match($iPhone_agent, $_SERVER['HTTP_USER_AGENT']))
		  define('BROWSER_TYPE_M', 'iPhone' );
		} 
	else {
		define('BROWSER_TYPE', 'W' );
	}
}

?>