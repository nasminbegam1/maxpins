<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller'] = array
(
	'class'    => 'ClickTale_CodeIgniter',
	'function' => 'DisplayHookEntryPoint',
	'filename' => 'ClickTale_CodeIgniter.php',
	'filepath' => 'clicktale',
	'params'   => array()
);


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */