<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wholesaler extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('wholesaler/index');
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		
		$wholesaler_name_email  = addslashes(trim($this->input->post('wholesaler_name_email')));
		$order_field		= trim($this->nsession->userdata('ORDER_FIELD'));
		$order_type		= trim($this->nsession->userdata('ORDER_TYPE'));
		if($order_field=='' &&  $order_type==''){
			$order_field 	= 'wholesaler_name'; 
			$order_type 	= 'true';
		}
		if($order_type=='true'){
			$order_type ="ASC";
		}elseif($order_type=='false'){
			$order_type ="DESC";
		}
		//echo $order_type;
		$wholesaler_info = $this->get_pagi_list($start, $wholesaler_name_email,$order_field,$order_type);
		echo json_encode($wholesaler_info);
		exit;
	}
	public function setOrder(){
		$order_field		= trim($this->input->post('order_field'));
		$order_type		= trim($this->input->post('order_type'));
		$this->nsession->set_userdata('ORDER_FIELD',$order_field);
		$this->nsession->set_userdata('ORDER_TYPE',$order_type);
	}
	
	function get_pagi_list($start, $wholesaler_name_email = '',$order_field='',$order_type=''){
		
		$condition = ' 1 = 1 and ';
		if($wholesaler_name_email)
		{
			$condition = " wholesaler_name LIKE '%".$wholesaler_name_email."%' OR wholesaler_email LIKE '%".$wholesaler_name_email."%'";
		}
		$condition = rtrim($condition," and ");
		
		$wholesaler_info	= $this->model_basic->getValues_conditions(WHOLESALER, array('wholesaler_id', 'wholesaler_name', 'wholesaler_email', 'wholesaler_status'), '', $condition, $order_field, $order_type);
		
			
		$config['base_url']	= ADMIN_URL.'#wholesaler/listing/';
		$config['per_page']	= 40;
		$config['num_links'] 	= 10;
		$config['use_page_numbers'] = true;
		//$config['page_query_string'] = true;
		//$config['query_string_segment'] = 'wholesaler_name_email';
		if(is_array($wholesaler_info)){
			$config['total_rows'] = count($wholesaler_info);	
		}else{
			$config['total_rows'] = 0;	
		}
		if($start!=0 and $start!='' ){
			$start = ($start-1)*$config['per_page'];
		}else{
			$start = 0;
		}
		if($order_field!='' && $order_type!=''){
			$condition .=' Order By '.$order_field.' '.$order_type.' ';
		}
		
		$data = $this->model_basic->getFromWhereSelect(WHOLESALER, "REPLACE(wholesaler_name, '\\\', '') as wholesaler_name,wholesaler_email, wholesaler_status, wholesaler_id", $condition . ' LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		return $result;
	}
	
	public function edit()
	{
		$this->data = array();
		$this->load->view('wholesaler/edit');
	}
	
	public function get_details()
	{
		$wholesaler_id	= $this->uri->segment(3,0);
		
		$data_info	= array();
		
		$arr_country	= $this->model_basic->getValues_conditions(COUNTRY, '', '', "country_status = 'Active'");
		$arr_shipping	= $this->model_basic->getValues_conditions(SHIPPINGMETHOD, '', '', "method_status = 'Active'");
		
		if(isset($wholesaler_id) && $wholesaler_id > 0)
		{
			$ws_info	= $this->model_basic->getValues_conditions(WHOLESALER, '', '', "wholesaler_id = '".$wholesaler_id ."'");
			
			$data_info[0]	= $ws_info[0];
			$data_info[1]	= $arr_country;
			$data_info[2]	= $arr_shipping;
		}
		else
		{
			$data_info[0]	= $arr_country;
			$data_info[1]	= $arr_shipping;
		}
		
		echo json_encode($data_info);
		exit();
		
	}
	
	public function update_wholesaler()
	{
		$wholesaler_id			= $this->input->post(trim(addslashes('wholesaler_id')));
		$ws_info			= $this->model_basic->getValues_conditions(WHOLESALER, '', '', "wholesaler_id = '".$wholesaler_id ."'");
		
		$wholesaler_name		= $this->input->post(trim(addslashes('wholesaler_name')));
		$billing_address		= $this->input->post(trim(addslashes('billing_address')));
		$billing_city			= $this->input->post(trim(addslashes('billing_city')));
		$billing_state			= $this->input->post(trim(addslashes('billing_state')));
		$billing_country		= $this->input->post(trim(addslashes('billing_country')));
		$billing_zip			= $this->input->post(trim(addslashes('billing_zip')));
		$billing_phone			= $this->input->post(trim(addslashes('wholesaler_phone')));
		$wholesaler_email		= $this->input->post(trim(addslashes('wholesaler_email')));
		$shipping_address		= $this->input->post(trim(addslashes('shipping_address')));
		$shipping_city			= $this->input->post(trim(addslashes('shipping_city')));
		$shipping_state			= $this->input->post(trim(addslashes('shipping_state')));
		$shipping_country		= $this->input->post(trim(addslashes('shipping_country')));
		$shipping_zip			= $this->input->post(trim(addslashes('shipping_zip')));
		
		$wholesaler_phone		= $this->input->post(trim(addslashes('wholesaler_phone')));
		$wholesaler_email		= $this->input->post(trim(addslashes('wholesaler_email')));
		$wholesaler_password		= $this->input->post(trim(addslashes('wholesaler_password')));
		
		
		$wholesaler_contact		= $this->input->post(trim(addslashes('wholesaler_contact')));
		$shipping_method		= $this->input->post(trim(addslashes('shipping_method')));
		$wholesaler_note		= $this->input->post(trim(addslashes('wholesaler_note')));
		$wholesaler_customer_id		= $this->input->post(trim(addslashes('wholesaler_customer_id')));
		
		$wholesaler_status		= $this->input->post(trim(addslashes('wholesaler_status')));
		
		$updateArr = array(
					'wholesaler_name'		=> $wholesaler_name,
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
					'shipping_method'		=> $shipping_method,
					'wholesaler_note'		=> $wholesaler_note,
					'wholesaler_customer_id'	=> $wholesaler_customer_id,
					'wholesaler_status'		=> $wholesaler_status
				    );
		if($wholesaler_password != ''){
		$updateArr['wholesaler_password'] = $wholesaler_password;
		}
		
		$idArr = array('wholesaler_id' => $wholesaler_id);
		if($updateArr['wholesaler_status']=='Active'){
			$updateArr['approve_status'] = 1;
		}
		if($updateArr['wholesaler_status']=='Active' && $ws_info[0]['wholesaler_status']=='Inactive' ){
			$template = $this->model_basic->getValues_conditions(EMAIL_TEMPLATE,'','','template_id="4"');
			$siteSetting = $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'','sitesettings_id IN(6) ');
			$wholesaler_info = $this->model_basic->getValues_conditions(WHOLESALER,'','','wholesaler_id="'.$wholesaler_id.'"');
			
			$mail_config['to'] 		= $wholesaler_email;
			$mail_config['from'] 		= $template[0]['response_email'];
			$mail_config['from_name'] 	= $siteSetting[0]['sitesettings_value'];
			$mail_config['subject'] 	= $template[0]['email_subject'];
			$mail_config['message'] 	=  $template[0]['email_content'];
			$mail_config['message'] 	= str_replace(
							array('{{USER}}', '{{NEW_PASSWORD}}'),				
							array($wholesaler_info[0]['wholesaler_name'],$wholesaler_info[0]['wholesaler_password']
							      ),
							$mail_config['message']
							);
			
			$rec = send_html_email($mail_config);
		}
		$response	= $this->model_basic->updateIntoTable(WHOLESALER, $idArr, $updateArr);
		
		echo  $response;
		exit;
	}
	
	public function add_wholesaler()
	{
		$this->data = array();
		
		$this->data['arr_country']	= $this->model_basic->getValues_conditions(COUNTRY, '', '', "country_status = 'Active'");
		$this->data['arr_shipping']	= $this->model_basic->getValues_conditions(SHIPPINGMETHOD, '', '', "");
		
		$this->load->view('wholesaler/add', $this->data);
	}
	
	public function do_add_wholesaler()
	{
		$wholesaler_id			= $this->input->post(trim(addslashes('wholesaler_id')));
		$wholesaler_name		= $this->input->post(trim(addslashes('wholesaler_name')));
		$billing_address		= $this->input->post(trim(addslashes('billing_address')));
		$billing_city			= $this->input->post(trim(addslashes('billing_city')));
		$billing_state			= $this->input->post(trim(addslashes('billing_state')));
		$billing_country		= $this->input->post(trim(addslashes('billing_country')));
		$billing_zip			= $this->input->post(trim(addslashes('billing_zip')));
		$billing_phone			= $this->input->post(trim(addslashes('wholesaler_phone')));
		$wholesaler_email		= $this->input->post(trim(addslashes('wholesaler_email')));
		$shipping_address		= $this->input->post(trim(addslashes('shipping_address')));
		$shipping_city			= $this->input->post(trim(addslashes('shipping_city')));
		$shipping_state			= $this->input->post(trim(addslashes('shipping_state')));
		$shipping_country		= $this->input->post(trim(addslashes('shipping_country')));
		$shipping_zip			= $this->input->post(trim(addslashes('shipping_zip')));
		
		$wholesaler_phone		= $this->input->post(trim(addslashes('wholesaler_phone')));
		$wholesaler_email		= $this->input->post(trim(addslashes('wholesaler_email')));
		
		$wholesaler_contact		= $this->input->post(trim(addslashes('wholesaler_contact')));
		$shipping_method		= $this->input->post(trim(addslashes('shipping_method')));
		$wholesaler_note		= $this->input->post(trim(addslashes('wholesaler_note')));
		$wholesaler_customer_id		= $this->input->post(trim(addslashes('wholesaler_customer_id')));
		
		$wholesaler_status		= $this->input->post(trim(addslashes('wholesaler_status')));
		
		$insertArr = array(
					'wholesaler_name'		=> $wholesaler_name,
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
					'shipping_method'		=> $shipping_method,
					'wholesaler_note'		=> $wholesaler_note,
					'wholesaler_customer_id'	=> $wholesaler_customer_id,
					'wholesaler_status'		=> $wholesaler_status
				    );
		
		$response	= $this->model_basic->insertIntoTable(WHOLESALER, $insertArr);
		
		echo  $response;
		exit;
	}
	
	public function delete()
	{
		$wholesaler_id	= $this->input->post('wsId');
		$ws_info	= $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT, '', '', "wholesaler_id = '".$wholesaler_id ."'");
		if(is_array($ws_info)){
			echo 0;
			exit;
		}else{
			$this->model_basic->deleteData(WHOLESALER, "wholesaler_id = '".$wholesaler_id ."'");
			$this->listing();
			exit;
		}
	}
	
	public function import(){
 
		$file 			= FILE_UPLOAD_ABSOLUTE_PATH . 'wholesaler/Customer.xls';
		//load the excel library
		$this->load->library('excel');
		//read file from path
		$objPHPExcel 		= PHPExcel_IOFactory::load($file);
		//get only the Cell Collection
		$cell_collection 	= $objPHPExcel->getActiveSheet()->getCellCollection();
		
		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
		    $column 		= $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		    $row 		= $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value 	= $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		    //header will/should be in row 1 only. of course this can be modified to suit your need.
		    if ($row == 1) {
			$header[$row][$column] = $data_value;
		    } else {
			$arr_data[$row][$column] = $data_value;
		    }
		}
		
		//send the data in an array format
		$data['header'] 	= $header;
		$data['value']	 	= $arr_data;
		$values_array		= array_values($data['value']);
		pr($data['header'], 0);
		pr($values_array, 0);
		
		if(is_array($values_array) && count($values_array) > 0){
			for($i=0; $i<count($values_array); $i++){
				$RetailerID	= $values_array[$i]['A'];
				$Name		= $values_array[$i]['B'];
				$Address	= $values_array[$i]['C'];
				$City		= $values_array[$i]['D'];
				$State		= $values_array[$i]['E'];
				$Zip		= $values_array[$i]['F'];
				$Contact	= $values_array[$i]['G'];
				$Phone		= $values_array[$i]['H'];
				if(array_key_exists("I",$values_array[$i])){
					$Email		= $values_array[$i]['I'];
				}else{
					$Email		= 'norm@maxpins.com';	
				}
				
				
				$Country	= 1;
				
				if(empty($Email)){
					$Email		= 'norm@maxpins.com';
				}
				
				$insertArr = array(
					'wholesaler_name'		=> addslashes(strip_tags(trim($Name))),
					'wholesaler_billing_address'	=> addslashes(strip_tags(trim($Address))),
					'wholesaler_billing_city'	=> addslashes(strip_tags(trim($City))),
					'wholesaler_billing_state'	=> addslashes(strip_tags(trim($State))),
					'wholesaler_billing_country'	=> $Country,
					'wholesaler_billing_zip'	=> addslashes(strip_tags(trim($Zip))),
					'wholesaler_shipping_address'	=> addslashes(strip_tags(trim($Address))),
					'wholesaler_shipping_city'	=> addslashes(strip_tags(trim($City))),
					'wholesaler_shipping_state'	=> addslashes(strip_tags(trim($State))),
					'wholesaler_shipping_country'	=> $Country,
					'wholesaler_shipping_zip'	=> addslashes(strip_tags(trim($Zip))),
					'wholesaler_phone'		=> addslashes(strip_tags(trim($Phone))),
					'wholesaler_email'		=> addslashes(strip_tags(trim($Email))), 
					'wholesaler_contact'		=> addslashes(strip_tags(trim($Contact))),
					'shipping_method'		=> '',
					'wholesaler_note'		=> '',
					'wholesaler_customer_id'	=> addslashes(strip_tags(trim($RetailerID))),
					'wholesaler_status'		=> 'Inactive'
				    );
		
				$response	= $this->model_basic->insertIntoTable(WHOLESALER, $insertArr);
				
				echo  $response;
				echo '<br><br>';
			}
		}
	}
	
	public function send_password(){
		$wholesaler_id			= $this->input->post('wid');
		$response['code']	 	= 0;
		$response['msg']	 	= 'There is no record with this email address.';
		
		$whereArr	= array(
					'wholesaler_id' => $wholesaler_id
				);
		$wholesaler 	= $this->model_basic->getValues_conditions(WHOLESALER,'','','wholesaler_id="'.$wholesaler_id.'"');
		
		
		if(is_array($wholesaler) && count($wholesaler) > 0){
			$rand 		= substr(md5(uniqid(rand(), true)),0,6);
			$template 	= $this->model_basic->getValues_conditions(EMAIL_TEMPLATE,'','','template_id="3"');
			
			$siteSetting 	= $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'','sitesettings_id IN(6) ');
			
			$mail_config['to'] 		= $wholesaler[0]['wholesaler_email'];
			$mail_config['from'] 		= $template[0]['response_email'];
			$mail_config['from_name'] 	= $siteSetting[0]['sitesettings_value'];
			$mail_config['subject'] 	= $template[0]['email_subject'];
			$mail_config['message'] 	= $template[0]['email_content'];
			$mail_config['message'] 	= str_replace(
									array('{{NEW_PASSWORD}}','{{URL}}','{{USER}}'),			
									array($rand, ORIGINAL_SITE_URL, stripslashes($wholesaler[0]['wholesaler_name'])),
									$mail_config['message']
							);
			
			$rec = send_html_email($mail_config);
			
			$updateArr = array(
					   'wholesaler_password' => $rand
					   );
			
			$idArr	  = array(
					  'wholesaler_id' => $wholesaler_id
					  );
			
			$this->model_basic->updateIntoTable(WHOLESALER, $idArr, $updateArr);
			
			$response['code']	= 1;
			$response['msg']	= 'The new password has been sent to your given email address. Please check your inbox or spam'; 
		}
		echo json_encode($response);
		exit;
	}
	
}