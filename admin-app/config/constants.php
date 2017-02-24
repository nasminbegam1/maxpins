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
//define('FRONTEND_URL',              	'http://192.168.2.5/travel/');
define('ADMIN_URL',              	'http://192.168.2.5/maxpins/admin/');
define('FRONTEND_VIEW_URL',             'http://192.168.2.5/maxpins/admin-app/views/');
define('SITENAME',                      'Maxpins');

define('ORIGINAL_SITE_URL',             'http://192.168.2.5/maxpins/');
define('BACKEND_URL',            	'http://192.168.2.5/maxpins/admin/');
define('BACKEND_URL_FOR_MAIL',          'http://192.168.2.5/maxpins/warp/');
define('SERVER_ABSOLUTE_PATH', 		'/var/www/html/maxpins/upload/');
define('FILE_UPLOAD_ABSOLUTE_PATH',     '/var/www/html/maxpins/upload/');
define('FILE_ABSOLUTE_PATH',            '/var/www/html/maxpins/');

define('FRONT_CSS_PATH',          	'http://192.168.2.5/maxpins/css/');
define('FRONT_JS_PATH',           	'http://192.168.2.5/maxpins/js/');
define('FRONT_IMAGE_PATH',        	'http://192.168.2.5/maxpins/images/');
define('RECORD_LIMIT_SEARCH_PAGE',      20);
define('RECORD_PER_PAGE',               20);
define('PAGE_NUMBER_SHOW',              5);
define('FAVOURITE_PER_PAGE_LIMIT',      15);

define('CURRENT_URL','http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//define('AJAX_CURRENT_URL',$_SERVER['HTTP_REFERER']);


define("CLIENT_ID",                 "32452862270-8mf144im945h3mpa7gabskhihj0pbf1j.apps.googleusercontent.com");
define("EMAIL",                     "32452862270-8mf144im945h3mpa7gabskhihj0pbf1j@developer.gserviceaccount.com");
define("ACCOUNT_ID"          ,       "ga:103502866");
define("P12_FILE_PATH"      ,        SERVER_ABSOLUTE_PATH."admin/API Project-f74a62ba2cb8.p12");


$d= date("Y-m-d");
define('DEFAULT_CHECK_IN_DATE', date("d/m/Y",strtotime($d)));
define('DEFAULT_CHECK_OUT_DATE', date('d/m/Y', strtotime(date("d-m-Y", strtotime($d)) . " +4 day")));

define('DEFAULT_FORM_CHECK_IN_DATE', date("d-m-Y",strtotime($d)));
define('DEFAULT_FORM_CHECK_OUT_DATE', date('d-m-Y', strtotime(date("d-m-Y", strtotime($d)) . " +4 day")));

//API key for library inInfo to track country
define('INFODB_APIKEY',                  '8ed7dffa2131e8a77996a6561c6f55bb5ab7b5708723fc63e4e644a226d7eaa9'); 

define('TABLE_PREFIX','mx_');

define('ADMINUSER', TABLE_PREFIX.'adminuser');
define('AGENTUSER', TABLE_PREFIX.'agentuser');

define('CMS', TABLE_PREFIX.'cms');
define('COUNTRY', TABLE_PREFIX.'country');
define('CURRENCYMASTER', TABLE_PREFIX.'currency_master');
define('SHIPPINGMETHOD', TABLE_PREFIX.'shipping_method_master');

define('SITESETTINGS', TABLE_PREFIX.'sitesettings');

define('WHOLESALER', TABLE_PREFIX.'wholesalers');
define('PRODUCTS', TABLE_PREFIX.'products');
define('CATEGORY', TABLE_PREFIX.'category');
define('PRODUCT_IMAGES', TABLE_PREFIX.'product_images');
define('WHOLESALER_PRODUCT', TABLE_PREFIX.'wholesaler_product');
define('EMAIL_TEMPLATE', TABLE_PREFIX.'email_template');

define('ORDER_MASTER', TABLE_PREFIX.'order_master');
define('ORDER_DETAILS', TABLE_PREFIX.'order_details');

define('TEMP_ORDER_MASTER', TABLE_PREFIX.'tmp_order_master');
define('TEMP_ORDER_DETAILS', TABLE_PREFIX.'tmp_order_details');

define('SHIPPING_METHOD_MASTER', TABLE_PREFIX.'shipping_method_master');
define('SHIPPING_PRICE', TABLE_PREFIX.'shipping_price');

define('PRODUCT_TYPE', TABLE_PREFIX.'product_type');


/* PAYPAL INFO */
define('PAYMENT_MODE', 'sandbox');
define('BUSINESS_EMAIL_ID', 'deykalyan777@gmail.com');
define('PAYPAL_URL',  'https://www.sandbox.paypal.com/cgi-bin/webscr');
//define('LIVE_URL', 'https://www.paypal.com/cgi-bin/webscr');

define('EMAIL_FROM', 'norm@maxpins.com');
define('EMAIL_FROM_NAME', 'Maxpins Team');



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
 
/**************************** Paypal Live Information **********************/ 
define('Paypal_Version', '93');
define('API_Button_Source', 'AngellEYE_PHPClass');
define('Path_To_Cert_Key_PEM', '/path/to/cert/pem.txt');
define('API_Mode', 'Signature'); 
/************************************************** Paypal Information Ends *****************************************/