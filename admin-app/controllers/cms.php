<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('cms/index');
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$cms_info = $this->get_pagi_list($start);
		echo json_encode($cms_info);
		exit;
	}
	
	function get_pagi_list($start){
		
		$cms_info	= $this->model_basic->getValues_conditions(CMS, array('cms_id', 'cms_title', 'cms_status'), '', '', 'cms_title');
		$config['base_url']	= ADMIN_URL.'#cms/listing/';
		$config['per_page']	= RECORD_PER_PAGE;
		$config['use_page_numbers'] = true;
		if(is_array($cms_info)){
			$config['total_rows'] = count($cms_info);	
		}else{
			$config['total_rows'] = 0;	
		}
		if($start!=0 and $start!='' ){
			$start = ($start-1)*$config['per_page'];
		}else{
			$start = 0;
		}
		
		$data = $this->model_basic->getFromWhereSelect(CMS, '', ' 1=1 LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		return $result;
	}
	
	public function edit()
	{
		$this->data = array();
		$this->load->view('cms/edit');
	}
	
	public function get_details()
	{
		$cms_id		= $this->uri->segment(3,0);
		
		$cms_info	= $this->model_basic->getValues_conditions(CMS, array('cms_id', 'cms_title', 'cms_content', 'cms_meta_title', 'cms_meta_key', 'cms_meta_desc','featured'), '', "cms_id = $cms_id");
		echo json_encode($cms_info[0]);
		exit();
		
	}
	
	public function update_cms()
	{
		$cms_id		= $this->input->post(trim(addslashes('cms_id')));
		$cms_title	= $this->input->post(trim(addslashes('cms_title')));
		$cms_content	= $this->input->post(trim(addslashes('cms_content')));
		$cms_meta_title	= $this->input->post(trim(addslashes('cms_meta_title')));
		$cms_meta_key	= $this->input->post(trim(addslashes('cms_meta_key')));
		$cms_meta_desc	= $this->input->post(trim(addslashes('cms_meta_desc')));
		$featured	= $this->input->post('featured');
		$updateArr = array(
					'cms_content'		=> html_entity_decode($cms_content, ENT_QUOTES, 'UTF-8'),
					'cms_meta_title'	=> html_entity_decode($cms_meta_title, ENT_QUOTES, 'UTF-8'),
					'cms_meta_key'		=> html_entity_decode($cms_meta_key, ENT_QUOTES, 'UTF-8'),
					'cms_meta_desc'		=> html_entity_decode($cms_meta_desc, ENT_QUOTES, 'UTF-8'),
					'featured'		=> $featured
					
				    );
		
		$idArr = array('cms_id' => $cms_id);
		
		$response	= $this->model_basic->updateIntoTable(CMS, $idArr, $updateArr);
		
		echo  $response;
		exit;
	}
	
	public function add_cms()
	{
		$this->data = array();
		$this->load->view('cms/add');
	}
	
	public function add_cms_action(){
		//$cms_id		= $this->input->post(trim(addslashes('cms_id')));
		$cms_title	= $this->input->post(trim(addslashes('cms_title')));
		$cms_content	= $this->input->post(trim(addslashes('cms_content')));
		$cms_meta_title	= $this->input->post(trim(addslashes('cms_meta_title')));
		$cms_meta_key	= $this->input->post(trim(addslashes('cms_meta_key')));
		$cms_meta_desc	= $this->input->post(trim(addslashes('cms_meta_desc')));
		$featured	= $this->input->post('featured');
		
		$cms_slug	= create_slug($cms_title);
		$exist =  $this->model_basic->getValues_conditions(CMS, '', '', "cms_slug = '".$cms_slug."'");
		if(!is_array($exist)){
				
			
			$insertArr = array(
						'cms_title'		=> $cms_title,
						'cms_slug'		=> $cms_slug,
						'cms_content'		=> $cms_content,
						'cms_meta_title'	=> $cms_meta_title,
						'cms_meta_key'		=> $cms_meta_key,
						'cms_meta_desc'		=> $cms_meta_desc,
						'featured'		=> $featured
					    );
			$response	= $this->model_basic->insertIntoTable(CMS, $insertArr);
		}else{
			$response = 0; 
		}
		echo  $response;
		exit;
	}
	
}