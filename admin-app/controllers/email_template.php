<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_template extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('email_template/index');
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$email_template_info = $this->get_pagi_list($start);
		
		echo json_encode($email_template_info);
		exit;
	}
	
	function get_pagi_list($start)
	{
		$email_template_info	= $this->model_basic->getValues_conditions(EMAIL_TEMPLATE, array('template_id', 'template_name', 'email_subject'), '', '', 'template_id', 'DESC');
		
		$config['base_url']		= ADMIN_URL.'#email_template/listing/';
		$config['per_page']		= RECORD_PER_PAGE;
		$config['use_page_numbers'] 	= true;
		
		if(is_array($email_template_info)){
			$config['total_rows'] = count($email_template_info);	
		}else{
			$config['total_rows'] = 0;	
		}
		
		if($start!=0 and $start!='' ){
			$start = ($start-1)*$config['per_page'];
		}else{
			$start = 0;
		}
		
		$data = $this->model_basic->getFromWhereSelect(EMAIL_TEMPLATE, '', ' 1=1 LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		return $result;
	}
	
	public function edit()
	{
		$this->data = array();
		$this->load->view('email_template/edit');
	}
	
	public function get_details()
	{
		$template_id		= $this->uri->segment(3,0);
		
		$data_info		= array();
		$data_info['code'] 	= 0;
		$data_info['data'] 	= array();
		
		$template_details	= $this->model_basic->getValues_conditions(EMAIL_TEMPLATE, '', '', "template_id = $template_id");
		
		if(is_array($template_details) && count($template_details) > 0)
		{
			$data_info['code'] 	= 1;
			$data_info['data']	= $template_details[0];
		}
		
		echo json_encode($data_info);
		exit();
		
	}
	
	public function do_edit_template()
	{
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Unable to update';
		
		$template_id 		= $this->input->post('template_id');
		$template_name 		= addslashes(trim($this->input->post('template_name')));
		$response_email 	= addslashes(trim($this->input->post('response_email')));
		$email_subject 		= addslashes(trim($this->input->post('email_subject')));
		$email_content 		= addslashes(trim($this->input->post('email_content')));
		
		$update_arr 	= array(
					'template_name'		=> html_entity_decode($template_name, ENT_QUOTES, 'UTF-8'),
					'response_email'	=> html_entity_decode($response_email, ENT_QUOTES, 'UTF-8'),
					'email_subject'		=> html_entity_decode($email_subject, ENT_QUOTES, 'UTF-8'),
					'email_content'		=> html_entity_decode($email_content, ENT_QUOTES, 'UTF-8')
					);
		
		$idArr = array('template_id' => $template_id);
		
		if($this->model_basic->updateIntoTable(EMAIL_TEMPLATE, $idArr, $update_arr))
		{
			$response['code']	 = 1;
			$response['msg'] 	 = 'Email Template is updated successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
	
	public function add()
	{
		$this->data = array();
		$this->load->view('email_template/add');
	}
	
	public function do_add_template()
	{
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Unable to insert';
		
		$template_name 		= addslashes(trim($this->input->post('template_name')));
		$response_email 	= addslashes(trim($this->input->post('response_email')));
		$email_subject 		= addslashes(trim($this->input->post('email_subject')));
		$email_content 		= addslashes(trim($this->input->post('email_content')));
		
		$insertArr 		= array(
						'template_name'		=> $template_name,
						'response_email'	=> $response_email,
						'email_subject'		=> $email_subject,
						'email_content'		=> $email_content
						);
			
		if($this->model_basic->insertIntoTable(EMAIL_TEMPLATE, $insertArr))
		{
			$response['code']	= 1;
			$response['msg'] 	= 'Email Template is added successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
}