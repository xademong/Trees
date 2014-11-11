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

/*
|--------------------------------------------------------------------------
| Custom API Constants
|--------------------------------------------------------------------------
|
| These modes are used when working with apis
|
*/

define('USER_CREATED_SUCCESSFULLY',		0);
define('USER_CREATE_FAILED',			1);
define('USER_ALREADY_EXISTED',			2); 
define('USER_VALIDATED_SUCCESSFULLY',	0); 
define('USER_VALIDATE_FAILED',			1);
define('USER_DELETED_SUCCESSFULLY',		0);
define('USER_DELETE_FAILED',			1);
define('USER_UPDATED_SUCCESSFULLY',		0);
define('USER_UPDATE_FAILED',			0);

//define('API_KEY', 'bf45c093e542f057caee68c47787e7d6');

define('NEXMO_API_KEY', 	'16fb9b2a');
define('NEXMO_API_SECRET',	'7f90d35a');

/* End of file constants.php */
/* Location: ./application/config/constants.php */