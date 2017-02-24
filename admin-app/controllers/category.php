<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('category/index');
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$category_info = $this->get_pagi_list($start);
		echo json_encode($category_info);
		exit;
	}
	
	function get_pagi_list($start){
		
		$category_info	= $this->model_basic->getValues_conditions(CATEGORY, array('category_id', 'category_name', 'category_status'), '', '', 'category_id', 'DESC');
		
		//pr($cms_info);

			
		$config['base_url']	= ADMIN_URL.'#category/listing/';
		$config['per_page']	= RECORD_PER_PAGE;
		$config['use_page_numbers'] = true;
		if(is_array($category_info)){
			$config['total_rows'] = count($category_info);	
		}else{
			$config['total_rows'] = 0;	
		}
		if($start!=0 and $start!='' ){
			$start = ($start-1)*$config['per_page'];
		}else{
			$start = 0;
		}
		
		$data = $this->model_basic->getFromWhereSelect(CATEGORY, '', ' 1=1 LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		return $result;
	}
	
	public function edit()
	{
		$this->data = array();
		$this->load->view('category/edit');
	}
	
	public function get_details()
	{
		$category_id		= $this->uri->segment(3,0);
		
		$data_info		= array();
		$data_info['code'] 	= 0;
		$data_info['data'] 	= array();
		
		$category_details	= $this->model_basic->getValues_conditions(CATEGORY, '', '', "category_id = $category_id");
		if(is_array($category_details) && count($category_details) > 0)
		{
			$data_info['code'] 	= 1;
			$data_info['data']	= $category_details[0];
		}
		
		echo json_encode($data_info);
		exit();
		
	}
	
	public function do_edit_category()
	{
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Category name must be unique';
		
		$category_id 		= $this->input->post('category_id');
		$category_name 		= addslashes(trim($this->input->post('category_name')));
		$category_description 	= addslashes(trim($this->input->post('category_description')));
		$category_status 	= trim($this->input->post('category_status'));
		
		$this->form_validation->set_rules('category_name','Category Name','required|trim|callback_is_name_exists');
		
		if($this->form_validation->run() == true)
		{
			$category_slug	= create_slug($category_name);
		
			$update_arr 	= array(
						'category_name'		=> $category_name,
						'category_slug'		=> $category_slug,
						'category_description'	=> $category_description,
						'category_status'	=> $category_status
						);
			
			$idArr = array('category_id' => $category_id);
			
			$this->model_basic->updateIntoTable(CATEGORY, $idArr, $update_arr);
			
			$response['code']	 = 1;
			$response['msg'] 	 = 'Category is updated successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
	
	public function add()
	{
		$this->data = array();
		$this->load->view('category/add');
	}
	
	public function do_add_category()
	{
		
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Category name must be unique';
		
		$category_name 		= addslashes(trim($this->input->post('category_name')));
		$category_description 	= addslashes(trim($this->input->post('category_description')));
		$category_status 	= trim($this->input->post('category_status'));
		
		$this->form_validation->set_rules('category_name','Category Name','required|trim|callback_is_name_exists');
		
		if($this->form_validation->run() == true)
		{
			$category_slug	= create_slug($category_name);
		
			$insertArr 		= array(
							'category_name'		=> $category_name,
							'category_slug'		=> $category_slug,
							'category_description'	=> $category_description,
							'category_status'	=> $category_status
							);
			
			$this->model_basic->insertIntoTable(CATEGORY, $insertArr);
			
			$response['code']	= 1;
			$response['msg'] 	= 'Category is added successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
	function is_name_exists()
	{
	    $category_id	= $this->input->get_post('category_id');
	    $category_name	= strip_tags(addslashes(trim($this->input->get_post('category_name'))));
	    
	    $whereArr	= array();
	    if($category_id > 0){
		    $whereArr	= array(
					'category_name' 	=> $category_name,
					'category_id != '	=> $category_id						
					);
	    }else{			
		    $whereArr	= array( 'category_name' => $category_name );
	    }
	    $bool 	= $this->model_basic->checkRowExists(CATEGORY, $whereArr );	
	    if($bool == 0){
		    $this->form_validation->set_message('is_name_exists', 'The %s already exists');
		    return FALSE;
	    }else{
		    return TRUE;
	    }
	}
	
	
	public function delete()
	{
		$category_id	= $this->input->post('cId');
		
		$condition	= "find_in_set('".$category_id."', category_id)";
		$arr_cat_prod	= $this->model_basic->getValues_conditions(PRODUCTS, '', '', $condition);
		if(is_array($arr_cat_prod) && count($arr_cat_prod) > 0)
		{
			$return_value = 0;
		}
		else
		{
			$this->model_basic->deleteData(CATEGORY, 'category_id = "'.$category_id.'"');
			$return_value = 1;
		}
		echo $return_value;
		exit;
	}
	
}