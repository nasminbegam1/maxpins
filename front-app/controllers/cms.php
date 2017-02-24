<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		
	}

	
	
	public function details(){
		$this->load->view('cms/details');	
	}
	
	public function cms_details(){
		$cms_slug = $this->uri->segment(3,0);
		$data = $this->model_basic->getValues_conditions(CMS,'','','cms_status="1" and cms_slug = "'.$cms_slug.'"' );
		$respons = array();
		if(is_array($data)){
			$respons['code'] = 1;
			$respons['data'] = $data[0];
			
		}else{
			$respons['code'] = 0;
			$respons['data'] = array();
		}
		
		echo json_encode($respons);
		
	}
}