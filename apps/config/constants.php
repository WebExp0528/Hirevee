<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('MAX_BLOG_LINE_NUM',			7);
define('QUESTION_READY_TIME',		30);
define('QUESTION_ANSWER_TIME',		180);
define('MAX_EMPLOYEE_NUM',			100);

// By KHC
define('UPLOAD_BLOG_PATH', 				FCPATH.'template/upload/blog_attach/');
define('UPLOAD_IMAGE_PATH', 		FCPATH.'template/upload/logo_client/');
define('UPLOAD_USER_IMAGE_PATH', 	FCPATH.'template/upload/logo_recruiter/');
define('UPLOAD_USER_BANNER_IMAGE_PATH', 	FCPATH.'template/upload/banner_recruiter/');
define('UPLOAD_USER_OPENING_VIDEO', 	FCPATH.'video/');
define('UPLOAD_CLIENT_INTERVIEW_VIDEO', 	FCPATH.'video/');

define('USER_ADMIN_LEVEL', 			3);
define('USER_RECRUITER_LEVEL', 		0);
define('USER_DEFAULT_LEVEL', 		0);

define('NAV_PER_PAGE_NUM', 			10);
define('DEFAULT_QUESTION_NUM', 		3);
define('DEFAULT_STAFF_MONEY', 		19.8);

/* End of file constants.php */
/* Location: ./application/config/constants.php */