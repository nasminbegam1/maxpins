<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('settings/index');
	}
	
	public function listing(){
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$cms_info = $this->get_pagi_list($start);
		echo json_encode($cms_info);
		exit;
	}
	
	public function get_pagi_list($start){
		
		$cms_info	= $this->model_basic->getValues_conditions(SITESETTINGS, array('sitesettings_id', 'sitesettings_lebel', 'sitesettings_value'), '', '', 'sitesettings_id', 'ASC');
		
		//pr($cms_info);

			
		$config['base_url']	= ADMIN_URL.'#settings/listing/';
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
		
		$data = $this->model_basic->getFromWhereSelect(SITESETTINGS, '', ' 1=1 LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		return $result;
	}
	
	public function edit(){
		$this->data = array();
		$this->load->view('settings/edit');
	}
	
	public function get_details(){
		$sitesettings_id	= $this->input->post('settingId');
		
		$data_info	= array();
		
		
		if(isset($sitesettings_id) && $sitesettings_id > 0)
		{
			$setting_info	= $this->model_basic->getValues_conditions(SITESETTINGS, '', '', "sitesettings_id ='".$sitesettings_id."'");
			
			$data_info	= $setting_info[0];
			
		}
		echo json_encode($data_info);
		exit();
		
	}
	
	public function edit_settings_action(){
		
		$sitesettings_id		= $this->input->post(trim(addslashes('sitesettings_id')));
		$sitesettings_value		= $this->input->post(trim(addslashes('sitesettings_value')));
		
		$updateArr = array(
					'sitesettings_value'		=> $sitesettings_value
				    );
		
		$idArr = array('sitesettings_id' => $sitesettings_id);
		
		$response	= $this->model_basic->updateIntoTable(SITESETTINGS, $idArr, $updateArr);
		echo json_encode(array('code'=>1,'msg'=>'settings is updated successfully'));
		
		exit;
	}
	
	
	
}