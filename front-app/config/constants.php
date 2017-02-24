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
define('FRONTEND_URL',              	'http://192.168.2.5/maxpins/');
define('FRONTEND_VIEW_URL',             'http://192.168.2.5/maxpins/front-app/views/');
define('SITENAME',                      'MaxPins');
define('CDN_URL',                       'http://accomodation.totalwealthconce.netdna-cdn.com/');
define('CDN_PROPERTY_SMALL_IMG',        CDN_URL.'upload/property/small/');
define('CDN_PROPERTY_THUMB_IMG',        CDN_URL.'upload/property/thumb/');
define('CDN_PROPERTY_BIG_IMG',          CDN_URL.'upload/property/big/');
define('CDN_PROPERTY_BANNER_IMG',       CDN_URL.'upload/property_type/banner/');


define('CDN_PROVINCE_BIG_IMG',          CDN_URL.'upload/province/banner/');
define('CDN_PROVINCE_LIST_IMG',         CDN_URL.'upload/province/listing/');

define('CDN_CITY_THUMB_IMG',            CDN_URL.'upload/city/thumb/');
define('CDN_CITY_IMG',                  CDN_URL.'upload/city/');

define('FILE_UPLOAD_URL',               CDN_URL.'upload/');

define('CDN_TEAM_IMG',            FILE_UPLOAD_URL.'team/');
define('CDN_TEAM_THUMB_IMG',      FILE_UPLOAD_URL.'team/thumb/');

define('CDN_CSS_PATH',                  CDN_URL.'css/styles.css');
define('CDN_JS_PATH',                   CDN_URL.'js/custom-script.js');
define('CDN_IMAGE_PATH',                CDN_URL.'images/');

define('LOGO_IMAGE',                    CDN_URL.'logo.png');

define('ORIGINAL_SITE_URL',             'http://192.168.2.5/maxpins/');
define('BACKEND_URL',            	'http://192.168.2.5/maxpins/admin/');
define('BACKEND_URL_FOR_MAIL',          'http://192.168.2.5/maxpins/warp/');
define('SERVER_ABSOLUTE_PATH', 		'/var/www/html/maxpins/upload/');
define('FILE_UPLOAD_ABSOLUTE_PATH',     '/var/www/html/maxpins/upload/');

define('CDN_BANNER_IMG',                FILE_UPLOAD_URL.'banner/');
define('CDN_BANNER_THUMB_IMG',          FILE_UPLOAD_URL.'banner/thumb/');
define('FRONT_CSS_PATH',          	'http://192.168.2.5/maxpins/css/');
define('FRONT_JS_PATH',           	'http://192.168.2.5/maxpins/js/');
define('FRONT_IMAGE_PATH',        	'http://192.168.2.5/maxpins/images/');
define('RECORD_LIMIT_SEARCH_PAGE',      20);
define('SALES_RECORD_LIMIT_SEARCH_PAGE',20);
define('PAGE_NUMBER_SHOW',              5);
define('FAVOURITE_PER_PAGE_LIMIT',      15);

define('CURRENT_URL','http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//define('AJAX_CURRENT_URL',$_SERVER['HTTP_REFERER']);
date_default_timezone_set('America/Denver');
$d= date("Y-m-d");
define('DEFAULT_CHECK_IN_DATE', date("d/m/Y",strtotime($d)));
define('DEFAULT_CHECK_OUT_DATE', date('d/m/Y', strtotime(date("d-m-Y", strtotime($d)) . " +4 day")));

define('DEFAULT_FORM_CHECK_IN_DATE', date("d-m-Y",strtotime($d)));
define('DEFAULT_FORM_CHECK_OUT_DATE', date('d-m-Y', strtotime(date("d-m-Y", strtotime($d)) . " +4 day")));

//API key for library inInfo to track country
define('INFODB_APIKEY',                  '8ed7dffa2131e8a77996a6561c6f55bb5ab7b5708723fc63e4e644a226d7eaa9'); 

define('AUTHNET_MODE','sandbox');
define('AUTHNET_LOGIN', '5J5h6bG7');
define('AUTHNET_TRANSKEY', '673EarC8j7L786xd');

define('TABLE_PREFIX','mx_');

define('ADMINUSER', TABLE_PREFIX.'adminuser');
define('AGENTUSER', TABLE_PREFIX.'agentuser');

define('BANNERMASTER', TABLE_PREFIX.'bannermaster');

define('CITYMASTER', TABLE_PREFIX.'citymaster');
define('CMS', TABLE_PREFIX.'cms');
define('CONTACTUS', TABLE_PREFIX.'contact_us');
define('STATE', TABLE_PREFIX.'state');
define('COUNTRY', TABLE_PREFIX.'country');
define('CURRENCYMASTER', TABLE_PREFIX.'currency_master');
define('SHIPPINGMETHOD', TABLE_PREFIX.'shipping_method_master');
define('SHIPPINGPRICE', TABLE_PREFIX.'shipping_price');

define('SITESETTINGS', TABLE_PREFIX.'sitesettings');

define('WHOLESALER', TABLE_PREFIX.'wholesalers');
define('PRODUCTS', TABLE_PREFIX.'products');
define('CATEGORY', TABLE_PREFIX.'category');
define('PRODUCT_IMAGES', TABLE_PREFIX.'product_images');
define('WHOLESALER_PRODUCT', TABLE_PREFIX.'wholesaler_product ');
define('EMAIL_TEMPLATE', TABLE_PREFIX.'email_template');
define('CART', TABLE_PREFIX.'cart');

define('ORDERS', TABLE_PREFIX.'order_master');
define('ORDER_DETAILS', TABLE_PREFIX.'order_details');

define('PRODUCT_TYPE', TABLE_PREFIX.'product_type');

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