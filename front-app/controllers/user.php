<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
 
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
	
	public function forget_password()
	{
		$this->load->view('user/forget_password');
	}
	
	public function do_forget_password()
	{
		$response['code']	 = 0;
		$response['msg']	 = 'There is no record with this email address.';
		$email	= trim($this->input->post('email'));
		$whereArr	= array(
					'wholesaler_email' => $email
					);
		
		
		$i_return	= $this->model_basic->getValues_conditions(WHOLESALER,'','', 'wholesaler_email="'.$email.'"');
		
		if(is_array($i_return) and count($i_return)>0)
		{
			$rand = substr(md5(uniqid(rand(), true)),0,6);
			
			$template = $this->model_basic->getValues_conditions(EMAIL_TEMPLATE,'','','template_id="3"');
			$siteSetting = $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'','sitesettings_id IN(6) ');
			
			$mail_config['to'] 		= $email;
			$mail_config['from'] 		= $template[0]['response_email'];
			$mail_config['from_name'] 	= $siteSetting[0]['sitesettings_value'];
			$mail_config['subject'] 	= $template[0]['email_subject'];
			$mail_config['message'] 	= $template[0]['email_content'];
			$mail_config['message'] 	= str_replace(
									array('{{USER}}','{{NEW_PASSWORD}}','{{URL}}'),				
									array($i_return[0]['wholesaler_name'],$rand, ORIGINAL_SITE_URL),
									$mail_config['message']
							);
			
			$rec = send_html_email($mail_config);
			
			$updateArr = array(
					   'wholesaler_password' => $rand
					   );
			
			$idArr	  = array(
					  'wholesaler_email' => $email
					  );
			
			$this->model_basic->updateIntoTable(WHOLESALER, $idArr, $updateArr);
			
			$response['code']	= 1;
			$response['msg']	= 'The new password has been sent to your given email address. Please check your inbox or spam'; 
		}
		echo json_encode($response);
		exit;
	}
	
	public function profile()
	{
		$this->load->view('user/profile');
	}
	
	public function get_details()
	{
		$response['code']	= 0;
		$wholesaler_id		= $this->nsession->userdata('WHOLESALER_ID');
		
		$condition		= " wholesaler_id = '".$wholesaler_id."'";
		if($wholesaler_id > 0)
		{
			$arr_wholesaler		= $this->model_basic->getValues_conditions(WHOLESALER, '', '', $condition);
			$response['code']	= 1;
			$response['data']	= $arr_wholesaler[0];
			
			$response['data']['wholesaler_billing_country_text'] = $this->model_basic->getValue_condition(COUNTRY, 'country_name', 'wholesaler_billing_country', 'id="'.$arr_wholesaler[0]['wholesaler_billing_country'].'"');
			$response['data']['wholesaler_shipping_country_text'] = $this->model_basic->getValue_condition(COUNTRY, 'country_name', 'wholesaler_shipping_country', 'id="'.$arr_wholesaler[0]['wholesaler_shipping_country'].'"');
			
			$arr_country	= $this->model_basic->getValues_conditions(COUNTRY, '', '', "country_status = 'Active'");
			$arr_shipping	= $this->model_basic->getValues_conditions(SHIPPINGMETHOD, '', '', "method_status = 'Active'");
			$arr_state	= $this->model_basic->getValues_conditions(STATE,'','','' );
			
			$response['country']	= $arr_country;
			$response['shipping']	= $arr_shipping;
			$response['state']	= $arr_state;
		}
		
		echo json_encode($response);
		exit;
	}
	
	public function do_update_profile()
	{
		
		$wholesaler_id			= $this->nsession->userdata('WHOLESALER_ID');
		$wholesaler_name		= $this->input->post(trim(addslashes('wholesaler_name')));
		$wholesaler_password		= $this->input->post(trim(addslashes('wholesaler_password')));
		$wholesaler_customer_id		= $this->input->post(trim(addslashes('wholesaler_customer_id')));
		$billing_address		= $this->input->post(trim(addslashes('billing_address')));
		$billing_city			= $this->input->post(trim(addslashes('billing_city')));
		
		$billing_country		= $this->input->post(trim(addslashes('billing_country')));
		
		if($billing_country == 1)
		{
			$billing_state		= $this->input->post(trim(addslashes('billing_state')));
		}
		else
		{
			$billing_state		= $this->input->post(trim(addslashes('billing_text_state')));
		}
		
		$billing_zip			= $this->input->post(trim(addslashes('billing_zip')));
		$billing_phone			= $this->input->post(trim(addslashes('wholesaler_phone')));
		$wholesaler_email		= $this->input->post(trim(addslashes('wholesaler_email')));
		$shipping_address		= $this->input->post(trim(addslashes('shipping_address')));
		$shipping_city			= $this->input->post(trim(addslashes('shipping_city')));
		
		$shipping_country		= $this->input->post(trim(addslashes('shipping_country')));
		
		if($shipping_country == 1)
		{
			$shipping_state		= $this->input->post(trim(addslashes('shipping_state')));
		}
		else
		{
			$shipping_state		= $this->input->post(trim(addslashes('shipping_text_state')));
		}
		
		$shipping_zip			= $this->input->post(trim(addslashes('shipping_zip')));
		
		$wholesaler_phone		= $this->input->post(trim(addslashes('wholesaler_phone')));
		$wholesaler_email		= $this->input->post(trim(addslashes('wholesaler_email')));
		
		$wholesaler_contact		= $this->input->post(trim(addslashes('wholesaler_contact')));
		$shipping_method		= $this->input->post(trim(addslashes('shipping_method')));
		
		if($wholesaler_password == '' || $wholesaler_password == 'undefined')
		{
			
			$updateArr = array(
						'wholesaler_name'		=> $wholesaler_name,
						'wholesaler_customer_id'	=> $wholesaler_customer_id,
						'wholesaler_billing_address'	=> $billing_address,
						'wholesaler_billing_city'	=> $billing_city,
						'wholesaler_billing_state'	=> $billing_state,
						'wholesaler_billing_country'	=> $billing_country,
						'wholesaler_billing_zip'	=> $billing_zip,
						'wholesaler_shipping_address'	=> $shipping_address,
						'wholesaler_shipping_city'	=> $shipping_city,
						'wholesaler_shipping_state'	=> $shipping_state,
						'wholesaler_shipping_country'	=> $shipping_country,
						'wholesaler_shipping_zip'	=> $shipping_zip,
						'wholesaler_phone'		=> $wholesaler_phone,
						'wholesaler_email'		=> $wholesaler_email, 
						'wholesaler_contact'		=> $wholesaler_contact,
						'shipping_method'		=> $shipping_method
					    );
		}
		else
		{
			$updateArr = array(
					'wholesaler_name'		=> $wholesaler_name,
					'wholesaler_password'		=> $wholesaler_password,
					'wholesaler_customer_id'	=> $wholesaler_customer_id,
					'wholesaler_billing_address'	=> $billing_address,
					'wholesaler_billing_city'	=> $billing_city,
					'wholesaler_billing_state'	=> $billing_state,
					'wholesaler_billing_country'	=> $billing_country,
					'wholesaler_billing_zip'	=> $billing_zip,
					'wholesaler_shipping_address'	=> $shipping_address,
					'wholesaler_shipping_city'	=> $shipping_city,
					'wholesaler_shipping_state'	=> $shipping_state,
					'wholesaler_shipping_country'	=> $shipping_country,
					'wholesaler_shipping_zip'	=> $shipping_zip,
					'wholesaler_phone'		=> $wholesaler_phone,
					'wholesaler_email'		=> $wholesaler_email, 
					'wholesaler_contact'		=> $wholesaler_contact,
					'shipping_method'		=> $shipping_method
				    );
		}
		
		$idArr = array('wholesaler_id' => $wholesaler_id);
		
		$i_return	= $this->model_basic->updateIntoTable(WHOLESALER, $idArr, $updateArr);
		
		$response['msg']	= 'Record successfully updated';
		
		echo json_encode($response);
		exit;
	}
	
	public function dashboard(){
		$this->load->view('index');
	}
	
		

	public function login(){
		$this->load->view('login');
	}
	
	public function logout(){
		
		$this->nsession->unset_userdata('WHOLESALER_ID');
		$this->nsession->unset_userdata('WHOLESALER_NAME');
		$this->nsession->unset_userdata('WHOLESALER_EMAIL');
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
	
	public function getCountry(){
		$data = $this->model_basic->getValues_conditions(COUNTRY,'','','' );
		echo json_encode($data);
		exit;
	}
	
	public function getCategory(){
		$data = $this->model_basic->getValues_conditions(CATEGORY,array('category_id','category_name'),'','category_status="Active"' );
		echo json_encode($data);
		exit;
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
					    'wholesaler_billing_address'	=> strip_tags(addslashes(trim($b_address))),
					    'wholesaler_billing_city'		=> strip_tags(addslashes(trim($b_city))),
					    'wholesaler_billing_state'		=> strip_tags(addslashes(trim($b_state))),
					    'wholesaler_billing_country'	=> trim($b_country),
					    'wholesaler_billing_zip'		=> strip_tags(addslashes(trim($b_zip))),
					    'wholesaler_shipping_address'	=> strip_tags(addslashes(trim($s_address))),
					    'wholesaler_shipping_city'		=> strip_tags(addslashes(trim($s_city))),
					    'wholesaler_shipping_state'		=> strip_tags(addslashes(trim($s_state))),
					    'wholesaler_shipping_country'	=> strip_tags(addslashes(trim($s_country))),
					    'wholesaler_shipping_zip'		=> strip_tags(addslashes(trim($s_zip))),
					    'wholesaler_email'			=> strip_tags(addslashes(trim($email))),
					    'wholesaler_phone'			=> strip_tags(addslashes(trim($phone))),
					    'wholesaler_contact'		=> strip_tags(addslashes(trim($contact))),
					    'wholesaler_contact'		=> strip_tags(addslashes(trim($contact))),
					    'wholesaler_status'			=> 'Inactive',
					    'added_on'				=> date('Y-m-d H:i:s')
					    );
			
			$insert_id = $this->model_basic->insertIntoTable(WHOLESALER,$insert_arr);
			
			$template = $this->model_basic->getValues_conditions(EMAIL_TEMPLATE,'','','template_id="1"');
			$siteSetting = $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'','sitesettings_id IN(6) ');
			
			$mail_config['to'] 		= $insert_arr['wholesaler_email'];
			$mail_config['from'] 		= $template[0]['response_email'];
			$mail_config['from_name'] 	= $siteSetting[0]['sitesettings_value'];
			$mail_config['subject'] 	= $template[0]['email_subject'];
			$mail_config['message'] 	=  $template[0]['email_content'];
			$mail_config['message'] 	= str_replace(
							array('{{USER}}','{{URL}}'),				
							array($insert_arr['wholesaler_name'],
							      ORIGINAL_SITE_URL."#/verification/".md5($insert_arr['wholesaler_email'])
							      ),
							$mail_config['message']
							);
			
			$rec = send_html_email($mail_config);
			
			$respons['code'] = 1;
			$respons['msg']	 =  ORIGINAL_SITE_URL."#/verification/".md5($insert_arr['wholesaler_email']);
			
		}else{
			$respons['code'] = 0;
			$respons['msg']	 = "Email id is already exists";
			
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
				$update_arr = array(
						    'wholesaler_status'=>'Active'
						    );
				$this->model_basic->updateIntoTable(WHOLESALER,array('wholesaler_id'=>$data[0]['wholesaler_id']), $update_arr);
				$respons['code'] = 1;
				
			}else{
				$respons['code'] = 0;
				
			}
			
			
		}else{
			$respons['code'] = 0;
		}
		
		echo json_encode($respons);
		exit;
	}

	
	public function products(){
		$this->load->view('products');
	}

}