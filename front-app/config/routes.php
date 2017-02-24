<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


/******************************************** For Province *************************************/
$route['western-australia']               = 'province/index';
$route['northern-territory']              = 'province/index';
$route['queensland']                      = 'province/index';
$route['south-australia']                 = 'province/index';
$route['new-south-wales']                 = 'province/index';
$route['victoria']                        = 'province/index';
$route['tasmania']                        = 'province/index';
$route['australian-capital-territory']    = 'province/index';
/******************************************** For Province *************************************/

/******************************************** For City *************************************/

$route['new-south-wales/(:any)']                 = 'city/index/$1';
$route['western-australia/(:any)']               = 'city/index/$1';
$route['northern-territory/(:any)']              = 'city/index/$1';
$route['queensland/(:any)']                      = 'city/index/$1';
$route['south-australia/(:any)']                 = 'city/index/$1';
$route['new-south-wales/(:any)']                 = 'city/index/$1';
$route['victoria/(:any)']                        = 'city/index/$1';
$route['tasmania/(:any)']                        = 'city/index/$1';
$route['australian-capital-territory/(:any)']    = 'city/index/$1';

/******************************************** For City *************************************/

/******************************************** For Property Type *************************************/
$route['hostel']                  = 'property_type/index';
$route['hostel/(:any)']           = 'property_type/index';
$route['working-hostel/(:any)']   = 'property_type/index';
$route['working-hostel']          = 'property_type/index';
$route['hotel/(:any)']            = 'property_type/index';
$route['hotel']                   = 'property_type/index';
$route['camping/(:any)']          = 'property_type/index';
$route['camping']                 = 'property_type/index';
/******************************************** For Property Type *************************************/

$route['about-us']                              = 'cms_page/index';
$route['about-us/(:any)']                       = 'cms_page/index';
$route['contact-us']                            = 'cms_page/index';
$route['contact-us/(:any)']                     = 'cms_page/index';
$route['press']                                 = 'cms_page/index';
$route['press/(:any)']                          = 'cms_page/index';
$route['agents-and-affiliates']                 = 'cms_page/index';
$route['agents-and-affiliates/(:any)']          = 'cms_page/index';
$route['terms-and-conditions']                  = 'cms_page/index';
$route['terms-and-conditions/(:any)']           = 'cms_page/index';
$route['privacy-policy']                        = 'cms_page/index';
$route['privacy-policy/(:any)']                 = 'cms_page/index';
$route['management']                            = 'management/index';
$route['management/(:any)']                     = 'management/index';
$route['groups']                                = 'cms_page/index';
$route['groups/(:any)']                         = 'cms_page/index';
$route['guides-and-info']                       = 'cms_page/index';
$route['guides-and-info/(:any)']                = 'cms_page/index';

//$route['property-rent/(:any)']                = 'property/details/$1';
$route['property/(:any)/(:any)/(:any)/(:any)']  = 'property/details/$1/$2/$3/$4';
$route['preview-property/(:any)/(:any)/(:any)/(:any)']  = 'property/preview/$1/$2/$3/$4';
$route['review/(:any)']                         = 'review/index/$1';

$route['listing/hostels']           = 'listing/index/hostels';
$route['listing/working-hostels']   = 'listing/index/working-hostels';
$route['listing/hotels']            = 'listing/index/hotels';
$route['listing/camping']           = 'listing/index/camping';


$route['default_controller']                    = "home";
$route['404_override']                          = 'error';
//$route['404_override']                          = 'home/get404';
$route['page-not-found']                        = 'error/index';


/* End of file routes.php */
/* Location: ./application/config/routes.php */