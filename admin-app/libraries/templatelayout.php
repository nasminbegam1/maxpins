<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class templatelayout {
     
     var $obj;
     var $currencyMaster = 'lp_country_currency_master';
     //var $bannerMaster   = 'hw_banner_master';
     
    
     public function __construct()
     {
        $this->obj =& get_instance();
     }


     public function get_header($header=''){
	  
	  $this->header = '';
	  $this->header['agent_id'] = $this->obj->nsession->userdata('agent_id')?$this->obj->nsession->userdata('agent_id'):0;
	  $this->obj->elements['header']='layout/header';
	  $this->obj->elements_data['header'] = $this->header;
     }
     
     
     public function get_topbar(){
	  
	  $this->topbar = '';
	  
	  $this->obj->elements['topbar']='layout/topbar';
	  $this->obj->elements_data['topbar'] = $this->topbar;
     }
     
     
     public function get_footer(){
	  
	  $this->footer = '';
	  $this->footer['social_links']=array();
	  $this->obj->db->where_in('sitesettings_id',array(9,10,15,16,1,6,18,19));
	  $query = $this->obj->db->get(SITESETTINGS);
	 
	  $record= $query->result_array();
	  //pr($record);
	  $this->footer['social_links'] = $record;
	  $this->footer['social_links']['mail_link']= $record[0]['sitesettings_value'];
	  $this->footer['site_name']= $record[1]['sitesettings_value'];
	  $this->footer['social_links']['facebook_link']= $record[2]['sitesettings_value'];
	  $this->footer['social_links']['twitter_link']= $record[3]['sitesettings_value'];
	  $this->footer['social_links']['googleplus_link']= $record[4]['sitesettings_value'];
	  $this->footer['social_links']['linkedin_link']= $record[5]['sitesettings_value'];
	  $this->footer['social_links']['myspace_link']= $record[6]['sitesettings_value'];
	  $this->footer['social_links']['pinterest_link']= $record[7]['sitesettings_value'];
	  
	  
	  $this->obj->elements['footer']='layout/footer';
	  $this->obj->elements_data['footer'] = $this->footer;
     }     
     
     
     public function get_banner_home($type=''){
	  
	  $this->banner = '';
	  $this->banner['banner_tab'] = array();
	  
	  $banner_tab = $this->obj->model_basic->getValues_conditions(PROPERTY_TYPE, array('property_type_id', 'property_type_name', 'property_type_slug'), '', "status = 'Active'", 'property_type_id', 'ASC');
	  
	  $this->banner['banner_tab']	= $banner_tab;
	  $this->banner['type']		= $type;
	  
	  $this->banner['banner_list']	= $this->obj->model_basic->getValues_conditions($this->obj->bannerMaster, array('banner_image','banner_title'), '', ' banner_status = "active" ','banner_order','ASC');
	  
	  $this->obj->elements['banner_home']='layout/banner_home';
	  $this->obj->elements_data['banner_home'] = $this->banner;
     }
     public function get_landingbanner($banner_image='',$name= '')
     {
	  $this->landingbanner = '';
	  $this->landingbanner['landing_banner_tab'] = FRONT_IMAGE_PATH.'banner-loca.jpg';
	  if($name){
	       $this->landingbanner['type_name'] = $name;
	  }else{
	       $this->landingbanner['type_name'] = 'Hostel World';
	  }
	  $this->landingbanner['landing_banner_tab'] = isFileExist($banner_image);
	  
	
	  $this->obj->elements['landingbanner']='layout/landing_banner';
	  $this->obj->elements_data['landingbanner'] = $this->landingbanner;
     }
     
     
     public function get_banner($slug = '', $location = '', $type='', $typeid='', $check_in = '', $check_out = ''){
	  
	  $this->banner = '';	  
	  $this->banner['banner_tab'] = array();	  
	  $banner_tab = $this->obj->model_basic->getValues_conditions(PROPERTY_TYPE, array('property_type_id', 'property_type_name', 'property_type_slug'), '', "status = 'Active'", 'property_type_id', 'ASC');
	  
	  $this->banner['banner_tab'] 	= $banner_tab;
	  $this->banner['slug'] 	= $slug;
	  $this->banner['location'] 	= $location;
	  $this->banner['check_in'] 	= $check_in;
	  $this->banner['check_out'] 	= $check_out;
	  $this->banner['type']		= $type;
	  $this->banner['typeid']	= $typeid;
	  
	  $this->obj->elements['banner']='layout/banner';
	  $this->obj->elements_data['banner'] = $this->banner;
     }
     
     public function get_listing_leftpanel($ptype = array() )
     {
	  
	  $this->leftpanel = '';
	  
	  $this->leftpanel['facility_list']	=	$this->obj->model_basic->getValues_conditions('hw_facilities_master', '*', '', "amenities_status='active' ", 'amenities_name', 'ASC');
	  
	  $this->leftpanel['property_list']	=	$this->obj->model_basic->getValues_conditions('hw_property_type_master', '*', '', "status='Active' ", 'property_type_name', 'ASC');
	  
	  $this->leftpanel['roomtype_list']	=	$this->obj->model_basic->getValues_conditions('hw_roomtype_master', '*', '', "roomtype_status='Active' ", 'roomtype_name', 'ASC');
	  
	  $this->leftpanel['citylist']	=	$this->obj->model_basic->getValues_conditions('hw_city_master', array('city_master_id','city_name','province_id','city_slug'), '', "status='Active' ", 'city_name', 'ASC');
	  
	  $this->leftpanel['type_selected'] = $ptype;
	  
	  $this->obj->elements['leftpanel']='layout/listing_leftpanel';
	  
	  $this->obj->elements_data['leftpanel'] = $this->leftpanel;
     }
     
     public function make_seo($title='',$desc='',$key='', $share = array())
     {
	 
	  $this->dataSeo['link'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	  
	  $this->dataSeo['page_image'] = LOGO_IMAGE;
	  
	  $seoInfo	=	$this->obj->model_basic->getValues_conditions('hw_sitesettings', array('sitesettings_name','sitesettings_value'), '', 'sitesettings_id in (2,3,4)', 'sitesettings_id', 'ASC'); 
	  if( is_array($seoInfo) && !empty($seoInfo) ){
	       foreach($seoInfo as $info){
		    $seo[$info['sitesettings_name']] =  $info['sitesettings_value'];
	       }
	       
	       $this->dataSeo['page_title'] 	= strip_tags(stripslashes($seo['default_page_title']));
	       $this->dataSeo['meta_desc'] 	= strip_tags(stripslashes($seo['default_meta_content']));
	       $this->dataSeo['meta_keyword'] 	= strip_tags(stripslashes($seo['default_meta_keywords']));
	  }
	  else{ 
		    $this->dataSeo['page_title'] = "Welcome to Hostel World";
		    $this->dataSeo['meta_desc'] = "Welcome to Hostel World";
		    $this->dataSeo['meta_keyword'] = "Welcome to Hostel World";	  
	       }
	  if($title)
	  { 
		  $this->dataSeo['page_title'] = $title;
	  }
	  
	  if($desc)
	  {
	       
		  $this->dataSeo['meta_desc'] = $desc;
	  }
	  
	  if($key)
	  {
		  $this->dataSeo['meta_keyword'] = $key;
	  }
	  
	  if(is_array($share)  && isset($share['og']))
	  {
	          if($share['og']['site_name'])
		  {
		    $this->dataSeo['page_title'] = $share['og']['site_name'];
		  }
		  if($share['og']['description'])
		  {
		    $this->dataSeo['meta_desc'] = $share['og']['description'];
		  }
		  if($share['og']['image'])
		  {
		     $this->dataSeo['page_image'] = isFileExist($share['og']['image']);
		  }

		  if($share['og']['link'])
		  {
		    $this->dataSeo['link'] = $share['og']['link'];
		  }
		  $this->dataSeo['og'] = '<meta property="og:site_name" content="Hostelmofo">
					     <meta property="og:title" content="'.$this->dataSeo['page_title'].'">
                                             <meta property="og:type" content="hostelmofo.com:listing">
                                             <meta property="og:url" content="'.$this->dataSeo['link'].'">
                                             <meta property="og:description" content="'.$this->dataSeo['meta_desc'].'">
                                             <meta property="og:image" content="'.$this->dataSeo['page_image'].'">';
	        
	  }
	  else{
		    $this->dataSeo['og'] = '<meta property="og:site_name" content="Hostelmofo">
					     <meta property="og:title" content="'.$this->dataSeo['page_title'].'">
                                             <meta property="og:type" content="hostelmofo.com:listing">
                                             <meta property="og:url" content="'.$this->dataSeo['link'].'">
                                             <meta property="og:description" content="'.$this->dataSeo['meta_desc'].'">
                                             <meta property="og:image" content="'.$this->dataSeo['page_image'].'">';
	  }
	  if(is_array($share)  && isset($share['twitter']))
	  {
	       
	       if($share['twitter']['image'])
		  {
		     $this->dataSeo['page_image'] = isFileExist($share['twitter']['image']);
		  }
	       if($share['twitter']['title'])
	       {
		     $this->dataSeo['page_title'] = $share['twitter']['title'];
	       }
	       if($share['twitter']['link'])
	       {
		     $this->dataSeo['link'] = $share['twitter']['link'];
	       }
	       $this->dataSeo['twitter'] = '<meta name="twitter:url" content="'. $this->dataSeo['link'].'">
					    <meta name="twitter:image" content="'.$this->dataSeo['page_image'].'">
					    <meta name="twitter:title" content="'.$this->dataSeo['page_title'].'">
					    <meta name="twitter:site" content="@hostelmofo">';
	  }
	  else
	  {
	     
	     $this->dataSeo['twitter'] = '<meta name="twitter:url" content="'.$this->dataSeo['link'].'">
					    <meta name="twitter:image" content="'.$this->dataSeo['page_image'].'">
					    <meta name="twitter:title" content="'.$this->dataSeo['page_title'].'">
					    <meta name="twitter:site" content="@hostelmofo">';  
	  }
	  //pr($this->dataSeo['page_image'],0);
	  $this->obj->elements['seo']='layout/seo';
	  $this->obj->elements_data['seo'] = $this->dataSeo;
     }
         
     
     public function get_breadcrumb($brdArr = array())
     {
	  
	  $this->breadcrumb = '';
	  $this->breadcrump['breadcrumb'] = $brdArr;
	 
	  $this->obj->elements['breadcrumb']='layout/breadcrumb';
	  $this->obj->elements_data['breadcrumb'] = $this->breadcrump;
	  
     }

     
      public function get_map_header($header=''){
	  
	  $this->header = '';
	   $header_tab = $this->obj->model_basic->getValues_conditions(PROPERTY_TYPE, array('property_type_id', 'property_type_name', 'property_type_slug'), '', "status = 'Active'", 'property_type_id', 'ASC');
	  
	  $this->header['header_tab'] = $header_tab;
	  
	  $curr = $this->obj->model_basic->getValues_conditions(CURRENCY_MASTER, '', '', "country_currency_status = 'active'");
	  foreach($curr as $index=>$data){
	       $this->header['currency'][ $data['currency_code'] ]= $data;
	  }
//pr($this->header['currency']);	  
	  $this->header['header_selected']	= $header;
	  $this->obj->elements['header']='layout/map_header';
	  $this->obj->elements_data['header'] = $this->header;
     }
     
     
}
?>