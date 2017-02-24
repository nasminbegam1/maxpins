<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producttype extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('producttype/index');
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$producttype_info = $this->get_pagi_list($start);
		echo json_encode($producttype_info);
		exit;
	}
	
	function get_pagi_list($start){
		
		$producttype_info	= $this->model_basic->getValues_conditions(PRODUCT_TYPE, array('id', 'type_name', 'status'), '', '', 'id', 'DESC');
		
		//pr($cms_info);

			
		$config['base_url']	= ADMIN_URL.'#producttype/listing/';
		$config['per_page']	= RECORD_PER_PAGE;
		$config['use_page_numbers'] = true;
		if(is_array($producttype_info)){
			$config['total_rows'] = count($producttype_info);	
		}else{
			$config['total_rows'] = 0;	
		}
		if($start!=0 and $start!='' ){
			$start = ($start-1)*$config['per_page'];
		}else{
			$start = 0;
		}
		
		$data = $this->model_basic->getFromWhereSelect(PRODUCT_TYPE, '', ' 1=1 LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		return $result;
	}
	
	public function edit()
	{
		$this->data = array();
		$this->load->view('producttype/edit');
	}
	
	public function get_details()
	{
		$producttype_id		= $this->uri->segment(3,0);
		
		$data_info		= array();
		$data_info['code'] 	= 0;
		$data_info['data'] 	= array();
		
		$producttype_details	= $this->model_basic->getValues_conditions(PRODUCT_TYPE, '', '', "id = $producttype_id");
		if(is_array($producttype_details) && count($producttype_details) > 0)
		{
			$data_info['code'] 	= 1;
			$data_info['data']	= $producttype_details[0];
		}
		
		echo json_encode($data_info);
		exit();
		
	}
	
	public function do_edit_producttype()
	{
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Product Type name must be unique';
		
		$producttype_id 		= $this->input->post('id');
		$producttype_name 		= addslashes(trim($this->input->post('producttype_name')));
		$producttype_status 	= trim($this->input->post('producttype_status'));
		
		$this->form_validation->set_rules('producttype_name','product type Name','required|trim|callback_is_name_exists');
		
		if($this->form_validation->run() == true)
		{
			$producttype_slug	= create_slug($producttype_name);
		
			$update_arr 	= array(
						'type_name'		=> $producttype_name,
						'type_slug'		=> $producttype_slug,
						'status'		=> $producttype_status
						);
			
			$idArr = array('id' => $producttype_id);
			
			$this->model_basic->updateIntoTable(PRODUCT_TYPE, $idArr, $update_arr);
			
			$response['code']	 = 1;
			$response['msg'] 	 = 'Product Type is updated successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
	
	public function add()
	{
		$this->data = array();
		$this->load->view('producttype/add');
	}
	
	public function do_add_producttype()
	{
		
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Product Type name must be unique';
		
		$producttype_name 		= addslashes(trim($this->input->post('producttype_name')));
		$producttype_status 	= trim($this->input->post('producttype_status'));
		
		$this->form_validation->set_rules('producttype_name','Category Name','required|trim|callback_is_name_exists');
		
		if($this->form_validation->run() == true)
		{
			$producttype_slug	= create_slug($producttype_name);
		
			$insertArr 		= array(
							'type_name'		=> $producttype_name,
							'type_slug'		=> $producttype_slug,
							'status'	=> $producttype_status
							);
			
			$this->model_basic->insertIntoTable(PRODUCT_TYPE, $insertArr);
			
			$response['code']	= 1;
			$response['msg'] 	= 'Product Type is added successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
	function is_name_exists()
	{
	    $producttype_id	= $this->input->get_post('id');
	    $producttype_name	= strip_tags(addslashes(trim($this->input->get_post('producttype_name'))));
	    
	    $whereArr	= array();
	    if($producttype_id > 0){
		    $whereArr	= array(
					'type_name' 	=> $producttype_name,
					'id != '	=> $producttype_id						
					);
	    }else{			
		    $whereArr	= array( 'type_name' => $producttype_name );
	    }
	    $bool 	= $this->model_basic->checkRowExists(PRODUCT_TYPE, $whereArr );	
	    if($bool == 0){
		    $this->form_validation->set_message('is_name_exists', 'The %s already exists');
		    return FALSE;
	    }else{
		    return TRUE;
	    }
	}
	
	
	public function delete()
	{
		$producttype_id	= $this->input->post('cId');
		
		$condition	= "find_in_set('".$producttype_id."', product_type)";
		$arr_cat_prod	= $this->model_basic->getValues_conditions(PRODUCTS, '', '', $condition);
		if(is_array($arr_cat_prod) && count($arr_cat_prod) > 0)
		{
			$return_value = 0;
		}
		else
		{
			$this->model_basic->deleteData(PRODUCT_TYPE, 'id = "'.$producttype_id.'"');
			$return_value = 1;
		}
		echo $return_value;
		exit;
	}
	
}