<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		
	}
	
	
	public function index()
	{
		$this->data = array();
		$this->templatelayout->get_header();
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_footer();
		$this->elements['middle']	= 'dashboard';			
		$this->elements_data['middle'] 	= $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function index_page(){
		$this->load->view('index');
	}
	
	public function getFeatureProductImage(){
		$respons['code'] = 0;
		$respons['data'] = array();$respons['product_name'] = array();
		$product_id = $this->model_basic->getFromWhereSelect('mx_products','product_id,product_slug',"is_featured='Yes'" );
		
		if(is_array($product_id)){
			foreach($product_id as $pr_id)
			{
				$image_name = $this->model_basic->getFromWhereSelect('mx_product_images','image_name',"product_id='".$pr_id['product_id']."' AND image_status='Active' ORDER BY image_id ASC LIMIT 1" );
				$product_name 			= $pr_id['product_slug'];
				if(is_array($image_name)){
					
					
					$img_name 		= $image_name[0]['image_name'];
					
					
				}else{
					$img_name = '';
				}
				if($image_name!=''){
					$respons['code'] 	= 1;
					$respons['data'][] 	= $img_name;
					$respons['product_name'][$img_name] = $product_name;
				}
			}
		}
		
		echo json_encode($respons);
	}
	
	public function dashboard(){
		$this->load->view('index');
	}
	
		

	public function login(){
		//pr($this->nsession->all_userdata(),0);
		$this->load->view('login');
	}
	
	public function loginCheck(){
		//pr($this->nsession->all_userdata());
		if($this->nsession->userdata('WHOLESALER_ID')=='' && $this->nsession->userdata('ADMINORDERFLUG')==''  ){
			echo '0';
		}else{
			echo '1';
		}
		exit;
	}
	
	public function checkAdmin(){
		//pr($this->nsession->all_userdata());
		if($this->nsession->userdata('ADMINORDERFLUG')=='true'  ){
			echo '1';
		}else{
			echo '';
		}
		exit;
	}
	
	public function logout(){
		
		$this->nsession->set_userdata('WHOLESALER_ID','');
		$this->nsession->set_userdata('WHOLESALER_NAME','');
		$this->nsession->set_userdata('WHOLESALER_EMAIL','');
		echo "1";
		exit;
	}
	
	
	public function loginAction(){
		$email 		= strip_tags(mysql_real_escape_string(trim($this->input->post('email'))));
		$password  	= strip_tags(mysql_real_escape_string(trim($this->input->post('password'))));
		$data 		= $this->model_basic->getValues_conditions(WHOLESALER,'','','wholesaler_email="'.$email.'" and wholesaler_password="'.$password.'" and wholesaler_status = "Active" ');
		
		$respons=array();
		if(is_array($data)){
			$data  = $data[0]; 
			$this->nsession->set_userdata('WHOLESALER_ID',$data['wholesaler_id']);
			$this->nsession->set_userdata('WHOLESALER_NAME',$data['wholesaler_name']);
			$this->nsession->set_userdata('WHOLESALER_EMAIL',$data['wholesaler_email']);
			$respons['code']	 = 1;
			$respons['msg'] 	 = "";
		}else{
			$respons['code']	 = 0;
			$respons['msg'] 	 = "Login failed: email id password mismatched";
		}
		
		echo json_encode($respons);
		exit;
	}
	
	
	
	public function signup(){
		$this->load->view('signup');
	}
	
	public function signupsuccess(){
		$this->load->view('signup_success');
	}
	
	public function getCountry()
	{
		$data['country']		= $this->model_basic->getValues_conditions(COUNTRY,'','','' );
		$data['state'] 			= $this->getState();
		$data['shipping_method']	= $this->getShippingMethod();
		echo json_encode($data);
		exit;
	}

	public function getState(){
		return $this->model_basic->getValues_conditions(STATE,'','','' );
		exit;
	}
	
	public function getShippingMethod(){
		return $this->model_basic->getValues_conditions(SHIPPINGMETHOD,'','', "method_status = 'Active'" );
		exit;
	}
	public function getProductType(){
		$search_product_type = $this->nsession->userdata('SEARCH_PRODUCTTYPE');
		$search_product_type_arr = explode(",",$search_product_type) ;
		$data = $this->model_basic->getValues_conditions(PRODUCT_TYPE,array('id','type_name'),'','status="Active"','type_name','ASC' );
		$result = array();
		if(is_array($data)){
			foreach($data as $d){
				$d['checked']= '';
			  if(in_array($d['id'],$search_product_type_arr)){
				$d['checked']= 'true';
			  }
			  $result[] = $d;
			}
			
		}
		echo json_encode($result);
		exit;
	}
	public function getCategory(){
		$search_category = $this->nsession->userdata('SEARCH_CATEGORY');
		$search_category_arr = explode(",",$search_category) ;
		$data = $this->model_basic->getValues_conditions(CATEGORY,array('category_id','category_name'),'','category_status="Active"','category_name','ASC' );
		$result = array();
		if(is_array($data)){
			foreach($data as $d){
				$d['checked']= '';
			  if(in_array($d['category_id'],$search_category_arr)){
				$d['checked']= 'true';
			  }
			  $result[] = $d;
			}
			
		}
		echo json_encode($result);
		exit;
	}
	
	public function getCmsContent(){
		$cms_slug =$this->uri->segment(3,0);
		$data = $this->model_basic->getValues_conditions(CMS,array('cms_content','cms_title','cms_meta_title','cms_meta_key','cms_meta_desc','cms_slug'),'','cms_slug="'.$cms_slug.'"' );
		if(is_array($data)){
			$data = $data[0];
			$respons['code'] = 1;
			$respons['data'] = $data;
		}else{
			$respons['code'] = 0;
			$respons['data'] = array();
		}
		echo json_encode($respons);
	}
	
	public function signupAction(){
		$respons = array();
		extract($_POST);
		$email = strip_tags(addslashes(trim($email)));
		$data  = $this->model_basic->getValues_conditions(WHOLESALER,'','','wholesaler_email="'.$email.'"');
		if(!is_array($data)){
			
			$insert_arr = array(
					    'wholesaler_name'			=> strip_tags(addslashes(trim($name))),
					    'wholesaler_password'		=> strip_tags(addslashes(trim($password))),
					    'wholesaler_customer_id'		=> strip_tags(addslashes(trim($wholesaler_customer_id))),
					    'wholesaler_billing_address'	=> strip_tags(addslashes(trim($b_address))),
					    'wholesaler_billing_city'		=> strip_tags(addslashes(trim($b_city))),
					    //'wholesaler_billing_state'		=> strip_tags(addslashes(trim($b_state))),
					    'wholesaler_billing_country'	=> trim($b_country),
					    'wholesaler_billing_zip'		=> strip_tags(addslashes(trim($b_zip))),
					    'wholesaler_shipping_address'	=> strip_tags(addslashes(trim($s_address))),
					    'wholesaler_shipping_city'		=> strip_tags(addslashes(trim($s_city))),
					    //'wholesaler_shipping_state'		=> strip_tags(addslashes(trim($s_state))),
					    'wholesaler_shipping_country'	=> strip_tags(addslashes(trim($s_country))),
					    'wholesaler_shipping_zip'		=> strip_tags(addslashes(trim($s_zip))),
					    'wholesaler_email'			=> strip_tags(addslashes(trim($email))),
					    'wholesaler_phone'			=> strip_tags(addslashes(trim($phone))),
					    'wholesaler_contact'		=> strip_tags(addslashes(trim($contact))),
					    'wholesaler_contact'		=> strip_tags(addslashes(trim($contact))),
					    'shipping_method'			=> strip_tags(addslashes(trim($shipping_method))),
					    'wholesaler_status'			=> 'Inactive',
					    'added_on'				=> date('Y-m-d H:i:s')
					    );
			
			if($b_country==1){
				$insert_arr['wholesaler_billing_state'] = strip_tags(addslashes(trim($b_state)));
			}else{
				$insert_arr['wholesaler_billing_state'] = strip_tags(addslashes(trim($b_text_state)));
			}
			
			if($s_country==1){
				$insert_arr['wholesaler_shipping_state'] = strip_tags(addslashes(trim($s_state)));
			}else{
				$insert_arr['wholesaler_shipping_state'] = strip_tags(addslashes(trim($s_text_state)));
			}
			
			$insert_id = $this->model_basic->insertIntoTable(WHOLESALER,$insert_arr);
			
			$template = $this->model_basic->getValues_conditions(EMAIL_TEMPLATE,'','','template_id="1"');
			$siteSetting = $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'','sitesettings_id IN(6) ');
			
			$mail_config['to'] 		= $insert_arr['wholesaler_email'];
			$mail_config['from'] 		= $template[0]['response_email'];
			$mail_config['from_name'] 	= $siteSetting[0]['sitesettings_value'];
			$mail_config['subject'] 	= $template[0]['email_subject'];
			$mail_config['message'] 	=  $template[0]['email_content'];
			$mail_config['message'] 	= str_replace(
							array('{{USER}}'),				
							array($insert_arr['wholesaler_name'],
							      ),
							$mail_config['message']
							);
			
			$rec = send_html_email($mail_config);
			
			
			$mail_config['to'] 		=  $template[0]['response_email'];
			$mail_config['from'] 		= $insert_arr['wholesaler_email'];
			$mail_config['from_name'] 	= $siteSetting[0]['sitesettings_value'];
			$mail_config['subject'] 	= "New application from ".$insert_arr['wholesaler_name'];
			$mail_config['message'] 	=  "Hello Admin, <br/><br/> A new application has been received from ".$insert_arr['wholesaler_name'].".  Please log in to activate this wholesaler in the system.";
			$mail_config['message'] 	.= "<br/><br/>Wholesaler Name: ".$insert_arr['wholesaler_name'];
			$mail_config['message'] 	.= "<br/>Email Address: ".$insert_arr['wholesaler_email'];
			
			$rec = send_html_email($mail_config);
			
			$respons['code'] = 1;
			$respons['msg']	 =  ORIGINAL_SITE_URL."#/verification/".md5($insert_arr['wholesaler_email']);
			
		}else{
			$respons['code'] = 0;
			$respons['msg']	 = "Your Email ID already exists. Please choose another.";
			
		}
		echo json_encode($respons);
		exit;
	}

	public function verification(){
		$this->load->view('verification');
	}
	public function verifyAction(){
		$respons = array();
		$code  = $this->uri->segment(3,0);
		if($code){
			$data 		= $this->model_basic->getValues_conditions(WHOLESALER,'','','md5(wholesaler_email)="'.$code.'"' );
			if(is_array($data)){
				if($data[0]['wholesaler_status']=='Inative'){
					$update_arr = array(
							    'wholesaler_status'=>'Active'
							    );
					$this->model_basic->updateIntoTable(WHOLESALER,array('wholesaler_id'=>$data[0]['wholesaler_id']), $update_arr);
					$respons['code'] = 1;
				}else if($data[0]['wholesaler_status']=='Active'){
					$respons['code'] = 2;
				}
				
			}else{
				$respons['code'] = 0;
				
			}
			
			
		}else{
			$respons['code'] = 0;
		}
		
		echo json_encode($respons);
		exit;
	}

	
	public function page_not_found(){
		$this->load->view('page_not_found');
	}
}