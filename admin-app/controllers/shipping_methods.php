<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping_methods extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('shipping_methods/index');
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$shipping_method_info = $this->get_pagi_list($start);
		
		echo json_encode($shipping_method_info);
		exit;
	}
	
	function get_pagi_list($start)
	{
		$shipping_method_info	= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, array('id', 'method_name', 'method_status'), '', '', 'id', 'DESC');
		
		$config['base_url']		= ADMIN_URL.'#shipping_methods/listing/';
		$config['per_page']		= RECORD_PER_PAGE;
		$config['use_page_numbers'] 	= true;
		
		if(is_array($shipping_method_info)){
			$config['total_rows'] = count($shipping_method_info);	
		}else{
			$config['total_rows'] = 0;	
		}
		
		if($start!=0 and $start!='' ){
			$start = ($start-1)*$config['per_page'];
		}else{
			$start = 0;
		}
		
		$data = $this->model_basic->getFromWhereSelect(SHIPPING_METHOD_MASTER, '', ' 1=1 LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		return $result;
	}
	
	public function edit()
	{
		$this->data = array();
		$this->load->view('shipping_methods/edit');
	}
	
	public function get_details()
	{
		$method_id		= $this->uri->segment(3,0);
		
		$data_info		= array();
		$data_info['code'] 	= 0;
		$data_info['data'] 	= array();
		
		$method_details	= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, '', '', "id = $method_id");
		$price_details	= $this->model_basic->getValues_conditions(SHIPPING_PRICE, '', '', "shipping_method_id = $method_id",'id','ASC');
		
		if(is_array($method_details) && count($method_details) > 0)
		{
			$data_info['code'] 	= 1;
			$data_info['data']	= $method_details[0];
			$data_info['data']['prices'] = $price_details;
		}
		
		echo json_encode($data_info);
		exit();
		
	}
	
	public function do_edit_method()
	{
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Unable to update';
		
		$id 			= $this->input->post('id');
		$method_name 		= addslashes(trim($this->input->post('method_name')));
		$method_status 		= addslashes(trim($this->input->post('method_status')));
		$lower_qty 		= $this->input->post('lower_qty');
		$higher_qty 		= $this->input->post('higher_qty');
		$price 			= $this->input->post('price');
		
		$update_arr 	= array(
					'method_name'		=> html_entity_decode($method_name, ENT_QUOTES, 'UTF-8'),
					'method_status'		=> html_entity_decode($method_status, ENT_QUOTES, 'UTF-8')
					);
		
		$idArr = array('id' => $id);
		
		if($this->model_basic->updateIntoTable(SHIPPING_METHOD_MASTER, $idArr, $update_arr))
		{
			$response['code']	 = 1;
			$response['msg'] 	 = 'Shipping Method is updated successfully';
		}
		
		//delete old price		
		$this->model_basic->deleteData(SHIPPING_PRICE, 'shipping_method_id='.$id);
		
		if(is_array($lower_qty) && count($lower_qty)){
			foreach($lower_qty as $key=>$val){				
				$recordSet = array(
					"shipping_method_id"    => $id,
					"lower_qty" 		=> $val,
					"higher_qty" 		=> isset($higher_qty[$key])?$higher_qty[$key]:0,
					"price" 		=> isset($price[$key])?$price[$key]:0,
				);
				$insertPrice = $this->model_basic->insertIntoTable(SHIPPING_PRICE, $recordSet);
				if ($insertPrice) $response['msg'] 	 = 'Shipping Method is updated successfully';
				
			}
		}else{
			$recordSet = array(
					"shipping_method_id"    => $id,
					"lower_qty" 		=> 0,
					"higher_qty" 		=> 0,
					"price" 		=> 0,
				);
			$insertPrice = $this->model_basic->insertIntoTable(SHIPPING_PRICE, $recordSet);
			if ($insertPrice) $response['msg'] 	 = 'Shipping Method is updated successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
	
	public function add()
	{
		$this->data = array();
		$this->load->view('shipping_methods/add');
	}
	
	public function do_add_method()
	{
		$response		= array();
		
		$response['code']	= 0;
		$response['msg'] 	= 'Unable to insert';
		
		$method_name 		= addslashes(trim($this->input->post('method_name')));
		$method_status		= addslashes(trim($this->input->post('method_status')));		
		
		$insertArr 		= array(
						'method_name'		=> $method_name,
						'method_status'		=> $method_status,
						'added_on'		=> date("Y-m-d h:i:s")
						);
		
		$lower_qty = $this->input->post('lower_qty');
		$higher_qty = $this->input->post('higher_qty');
		$price = $this->input->post('price');
		
		
		
		if($insert_id = $this->model_basic->insertIntoTable(SHIPPING_METHOD_MASTER, $insertArr))
		{
			if(is_array($lower_qty) && count($lower_qty)){
			foreach($lower_qty as $key=>$val){				
				$recordSet = array(
					"shipping_method_id"    => $insert_id,
					"lower_qty" 		=> $val,
					"higher_qty" 		=> isset($higher_qty[$key])?$higher_qty[$key]:0,
					"price" 		=> isset($price[$key])?$price[$key]:0,
				);
				$this->model_basic->insertIntoTable(SHIPPING_PRICE, $recordSet);
			}
			}//count
		
			$response['code']	= 1;
			$response['msg'] 	= 'Shipping method is added successfully';
		}
		
		echo json_encode($response);
		exit;
	}
	
	public function delete()
	{
		$return_value		= '';
		$shipping_method_id	= $this->input->post('sId');
		$whereArr		= array('shipping_method' => $shipping_method_id);
		$i_check		= $this->model_basic->checkRowExists(WHOLESALER, $whereArr);
		if($i_check)
		{
			$delete_master_where	= " id = '".$shipping_method_id."'";
			$this->model_basic->deleteData(SHIPPING_METHOD_MASTER, $delete_master_where);
			
			$delete_price_where	= " shipping_method_id = '".$shipping_method_id."'";
			$this->model_basic->deleteData(SHIPPING_METHOD_MASTER, $delete_master_where);
			
			$return_value = 1;
		}
		else
		{
			$return_value = 0;
		}
		echo $return_value;
		exit;
	}
	
}