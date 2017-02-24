<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {
 
	var $sandbox_url	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	var $live_url		= 'https://www.paypal.com/cgi-bin/webscr';

	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic', 'model_product'));
	}

	
	public function index()
	{
		$this->data = array();
		$this->load->view('order/index');
	}
	
	public function wholesaler_list(){
		$data_info['code']	= 0;
		$data_info['data']	= array(); 
		$wholesaler_info	= $this->model_basic->getValues_conditions(WHOLESALER, array("wholesaler_id", "wholesaler_name"), "", "wholesaler_status = 'Active'", "wholesaler_name");
		if(is_array($wholesaler_info) && count($wholesaler_info) > 0){
			$data_info['code']		= 1;
			$data_info['data']		= $wholesaler_info;
		}
		echo json_encode($data_info);
	}
	public function clearSearch(){
		$this->nsession->set_userdata('SEARCH_ORDER_WHOLESALER_ID','');
		$this->nsession->set_userdata('SEARCH_ORDER_PAYMENT_STATUS','');
		$this->nsession->set_userdata('SEARCH_ORDER_SHIPMENT_STATUS','');
		$this->nsession->set_userdata('SEARCH_ORDER_START_DATE','');
		$this->nsession->set_userdata('SEARCH_ORDER_TMP_START_DATE','');
		$this->nsession->set_userdata('SEARCH_ORDER_END_DATE','');
		$this->nsession->set_userdata('SEARCH_ORDER_TMP_END_DATE','');
	}
	public function setSearchData(){
		
		$this->nsession->set_userdata('SEARCH_ORDER_WHOLESALER_ID',$this->input->post('wholesaler_name'));
		$this->nsession->set_userdata('SEARCH_ORDER_PAYMENT_STATUS',$this->input->post('payment_status'));
		$this->nsession->set_userdata('SEARCH_ORDER_SHIPMENT_STATUS',$this->input->post('shipment_status'));
		
		if($this->input->post('start_date')!=''){
			
			$start_date_array	= explode("-", $this->input->post('start_date'));
			$dd			= $start_date_array[1];
			$mm			= $start_date_array[0];
			$yy			= $start_date_array[2];
			
			$tmp_s_date	= $mm . "-" . $dd . "-" . $yy;
			if(strlen($dd) == 1){$dd = "0" . $dd;}
			if(strlen($mm) == 1){$mm = "0" . $mm;}
			
			$s_date	= $dd . "-" . $mm . "-" . $yy;
			
			$this->nsession->set_userdata('SEARCH_ORDER_START_DATE',$s_date);
			$this->nsession->set_userdata('SEARCH_ORDER_TMP_START_DATE',$tmp_s_date);
		
		}else{
			$this->nsession->set_userdata('SEARCH_ORDER_START_DATE','');
			$this->nsession->set_userdata('SEARCH_ORDER_TMP_START_DATE','');
		}
		//pr($_POST,0);
		if($this->input->post('end_date')!=''){
			
			$end_date_array		= explode("-", $this->input->post('end_date'));
			$dd			= $end_date_array[1];
			$mm			= $end_date_array[0];
			$yy			= $end_date_array[2];
			$tmp_e_date	= $mm . "-" . $dd . "-" . $yy;
			if(strlen($dd) == 1){$dd = "0" . $dd;}
			if(strlen($mm) == 1){$mm = "0" . $mm;}
			
			$e_date	= $dd . "-" . $mm . "-" . $yy;
			$this->nsession->set_userdata('SEARCH_ORDER_END_DATE',$e_date);
			$this->nsession->set_userdata('SEARCH_ORDER_TMP_END_DATE',$tmp_e_date);
		
		}else{
			$this->nsession->set_userdata('SEARCH_ORDER_END_DATE','');
			$this->nsession->set_userdata('SEARCH_ORDER_TMP_END_DATE','');
		}
		//pr($this->nsession->all_userdata());
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$wholesaler_name	= $this->nsession->userdata('SEARCH_ORDER_WHOLESALER_ID');
		$start_date		= $this->nsession->userdata('SEARCH_ORDER_START_DATE');
		$end_date		= $this->nsession->userdata('SEARCH_ORDER_END_DATE');
		$payment_status		= $this->nsession->userdata('SEARCH_ORDER_PAYMENT_STATUS');
		$shipment_status	= $this->nsession->userdata('SEARCH_ORDER_SHIPMENT_STATUS');
		//pr($this->nsession->all_userdata());
		$order_listing_info = $this->get_pagi_list($wholesaler_name, $start_date, $end_date, $payment_status, $shipment_status);
		
		echo json_encode($order_listing_info);
		exit;
	}
	
	function get_pagi_list($wholesaler_name, $start_date, $end_date, $payment_status, $shipment_status)
	{
		//$order_listing_info	= $this->model_product->get_all_order();

		$config['base_url']	= ADMIN_URL.'#order/listing/';
		$config['per_page']	= RECORD_PER_PAGE;
		$config['use_page_numbers'] = true;
		
		$start = 0;
		
		$data = $this->model_product->getList($config, $start, $wholesaler_name, $start_date, $end_date, $payment_status, $shipment_status);
		
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		$result['data'] = $data;
		
		$total_orders	= $this->model_product->getOrderTotal($config, $start, $wholesaler_name, $start_date, $end_date, $payment_status, $shipment_status);
		$total_item_count	= $this->model_product->getOrderItemTotal($config, $start, $wholesaler_name, $start_date, $end_date, $payment_status, $shipment_status);
		
		$result['total_orders']	= $total_orders[0]['total_price'];
		$result['total_item_count']	= $total_item_count[0]['total_item_count'];
		
		return $result;
	}
	
	public function view()
	{
		$this->data = array();
		$this->load->view('order/view');
	}
	
	public function get_details()
	{
		$order_id		= $this->uri->segment(3,0);
		$data_info['code']	= 0;
		$data_info['data']	= array(); 
		$total_qty = 0;
		$order_info		= $this->model_product->getOrderMaster($order_id);
		$order_detais_info	= $this->model_product->getOrderDetails($order_id);
		$order_data = array();
		if(is_array($order_detais_info) and count($order_detais_info)>0){
			foreach($order_detais_info as $info){
				$info['product_price'] = number_format($info['product_price'],2);
				$info['total_price'] 	= number_format($info['total_price'],2);
				$order_data[] = $info;
				$total_qty  +=$info['product_quantity'];
			}	
		}
		
		
		$shipping_cost_info	= $this->model_product->getOrdShippingCost($order_id);
		$shipping_method	= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, '', '', "");
		
		if(is_array($order_info) && count($order_info) > 0)
		{
			$data_info['code']		= 1;
			$data_info['data']		= $order_info[0];
			$data_info['order_details']	= $order_data;
			$data_info['data']['shipping_cost']	= $order_info[0]['shipping_cost'];
			$sub_total 		= $this->model_basic->getFromWhereSelect(ORDER_DETAILS, 'SUM(total_price) as sub_total', 'order_master_id="'.$order_id.'"');
			$data_info['data']['sub_total']	= $sub_total[0]['sub_total'];
			$data_info['total_qty']		= $total_qty;
		}
		
		echo json_encode($data_info);
		exit();
		
	}
	
	public function delete()
	{
		$wholesaler_id	= $this->input->post('wsId');
	}
	
	public function update_shipment_status()
	{
		$return_value 		= 0;
		$order_id		= $this->input->post(trim(addslashes('order_id')));
		$shipping_status	= $this->input->post(trim(addslashes('shipping_status')));
		
		$idArr			= array(
						'id'	=> $order_id
						);
		
		$updateArr		= array(
						'shipping_status'	=> $shipping_status
						);
		
		$return_value		= $this->model_basic->updateIntoTable(ORDER_MASTER, $idArr, $updateArr);
		
		echo $return_value;
		exit();
	}
	
	public function update_pay_status()
	{
		$return_value 		= 0;
		$order_id		= $this->input->post(trim(addslashes('order_id')));
		$pay_status	= $this->input->post(trim(addslashes('pay_status')));
		
		$idArr			= array(
						'id'	=> $order_id
						);
		
		$updateArr		= array(
						'payment_status'	=> $pay_status
						);
		
		$return_value		= $this->model_basic->updateIntoTable(ORDER_MASTER, $idArr, $updateArr);
		
		echo $return_value;
		exit();
	}
	
	public function add()
	{
		$this->data = '';
		$this->load->view('order/add', $this->data);
	}
	public function get_add_details()
	{
		$wholesaler_info	= $this->model_basic->getValues_conditions(WHOLESALER, array("wholesaler_id", "wholesaler_name"), "", "wholesaler_status = 'Active'", "wholesaler_name");
		$product_info		= $this->model_basic->getValues_conditions(PRODUCTS, array("product_id", "product_name", "product_sku", "price"), "", "product_status = 'Active'", "product_name");
		
		$shipping_info		= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, array("id", "method_name"), "", "method_status = 'Active'", "method_name");
		
		//$user_shipping_info	= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, array("id", "method_name"), "", "method_status = 'Active'", "method_name");
		//
		//pr($this->model_product->getUserShippingMethod());
		
		//$shipping_cost_info	= $this->model_basic->getFromWhereSelect(SHIPPING_PRICE,'price',"shipping_method_id='".$shipping_method."' AND ('" . $total_qty . "' BETWEEN lower_qty AND higher_qty)" );
		$data_info[0]	= $wholesaler_info;
		$data_info[1]	= $product_info;
		$data_info[2]	= $shipping_info;
		//$data['shipping_cost']	= $shipping_cost_info;
		
		echo json_encode($data_info);
		exit();
	}
	
	public function do_add_order()
	{
		$wholesaler_id 		= $this->input->post(trim(addslashes('wholesaler_name')));
		$shipping_method 	= $this->input->post(trim(addslashes('shipping_method')));
		$payment_status  	= $this->input->post(trim(addslashes('payment_status')));
		$arr_product_id	 	= $_POST['product']['name'];
		$arr_product_qty 	= $_POST['product']['quantity'];
		$arr_product_rate	= array();
		$total_price		= 0;
		$total_qty		= 0;
		
		//pr($_POST);
		
		/* insert into order master */
		$insertArr = array(
					'wholesaler_id' 	=> $wholesaler_id,
					'order_slug'		=> rand(0,999999999),
					'payment_status'	=> $payment_status,
					'shipping_status'	=> 'New',
					'added_on'		=> date('Y-m-d H:i:s')
				);
		
		$order_master_id = $this->model_basic->insertIntoTable(ORDER_MASTER,$insertArr);
		
		if(is_array($arr_product_id) && count($arr_product_id) > 0)
		{
			$i=0;
			foreach($arr_product_id as $index=>$pid)
			{
				$sub_total		= 0;
				$product_price		= $this->model_product->getProductPriceById($pid);
				$arr_product_rate[$pid]	= $product_price[0]['price'];
				$sub_total		= ($arr_product_rate[$pid]*$arr_product_qty[$pid]);
				$total_price		= $total_price + $sub_total;
				$total_qty		= $total_qty + $arr_product_qty[$pid];
				
				$product_details = $this->model_basic->getFromWhereSelect(PRODUCTS,'*',"product_id='".$pid."'" );
				$product_details = $product_details[0];
				$update_arr = array(
							'inventory_qty' => $product_details['inventory_qty'] - $arr_product_qty[$pid]
						   );
				$idArr = array(
							'product_id' => $pid
					       );
				$this->model_basic->updateIntoTable(PRODUCTS, $idArr, $update_arr);
				$insert_details = array(
							'order_master_id'	=> $order_master_id,
							'product_id'		=> $pid,
							'product_price'		=> $arr_product_rate[$pid],
							'product_quantity'	=> $arr_product_qty[$pid],
							'total_price'		=> $sub_total
							);
				$this->model_basic->insertIntoTable(ORDER_DETAILS,$insert_details);
				//pr($product_details,0);
				
			}
			
		}
		
		$shipping_method_info	= $this->model_basic->getFromWhereSelect(SHIPPING_METHOD_MASTER,'*',"id='".$shipping_method."'" );
		$shipping_method_name	= $shipping_method_info[0]['method_name'];
		
		$shipping_cost_info	= $this->model_basic->getFromWhereSelect(SHIPPING_PRICE,'price',"shipping_method_id='".$shipping_method."' AND ('" . $total_qty . "' BETWEEN lower_qty AND higher_qty)" );
		$shipping_cost		= $shipping_cost_info[0]['price'];
		
		
		
		$data['shipping_price'] = 0;
		if($shipping_method != '')
		{
			$shipping = $this->model_product->getShippingPriceByQty($total_qty, $shipping_method);
			if(is_array($shipping) && count($shipping) > 0)
			{
				$data['shipping_price'] = $shipping[0]['price'];
			}
		}
		
		$total_order_price	= ($total_price + $data['shipping_price']);
		
		
		/* update into order master */
		
		$updateArr 	= array(
					'shipping_method' => $shipping_method_name,
					'shipping_cost'	=> $shipping_cost,
					'total_price'	=> $total_order_price
					);
		
		$idArr		= array(
					'id'	=> $order_master_id
					);
		
		$this->model_basic->updateIntoTable(ORDER_MASTER, $idArr, $updateArr);
				
		if($payment_status != 'Paypal')
		{
			$response['code'] 		= 1;
			$response['order_master_id']	= $order_master_id;
			
			/* mail sent to wholeasaler start */
			
			$arr_wholesaler_info	= $this->model_basic->getValues_conditions(WHOLESALER, '', '', " wholesaler_id = '".$wholesaler_id."'");
			
			$order_info		= $this->model_product->getOrderMaster($order_master_id);
			$order_detais_info	= $this->model_product->getOrderDetails($order_master_id);
			$order_data = array();
			if(is_array($order_detais_info) and count($order_detais_info)>0){
				foreach($order_detais_info as $info){
					$info['product_price'] = number_format($info['product_price'],2);
					$info['total_price'] 	= number_format($info['total_price'],2);
					$order_data[] = $info;
				}	
			}
		
			$shipping_cost_info	= $this->model_product->getOrdShippingCost($order_master_id);
			$shipping_method	= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, '', '', "");
					
			if(is_array($order_info) && count($order_info) > 0)
			{
				$data['data']		= $order_info[0];
				
				$data['order_details']	= $order_data;
				$data['shipping_cost']	= $shipping_cost_info;
			}
			
			$data['wholesaler_info']	= $arr_wholesaler_info[0];
			
			$mail_config['to'] 		= $arr_wholesaler_info[0]['wholesaler_email'];
			$mail_config['from'] 		= EMAIL_FROM;
			$mail_config['from_name'] 	= EMAIL_FROM_NAME;
			$mail_config['subject'] 	= 'Your order has been added';
			$mail_config['message'] 	= $this->load->view('order/email_wholesaler', $data, true);
			
			$rec = send_html_email($mail_config);
			
			/* mail sent to wholeasaler end */
			
			echo json_encode($response);
			exit();
		}
		else
		{
			$this->nsession->set_userdata('ORDER_ID', $order_master_id);
			
			$response['code'] 		= 2;
			$response['item_name']		= 'Maxpins Products';
			$response['quantity']		= $total_qty;
			$response['amount']		= $total_price;
			
			$data['items'] 		   = array();$count=1;
			foreach($this->cart->contents() as $index=>$i)
			{
				$data['items'][$count]['item_name'] 	= $i['name'];
				$data['items'][$count]['item_price'] 	= $i['price'];
				$data['items'][$count]['item_qty'] 	= $i['qty'];
				$count++;
			}
			
			$data['shipping_price']		= $data['shipping_price'];
			
			$data['return_url']		= BACKEND_URL.'payment/paypal_payment_notification';
			$data['cancel_url']		= BACKEND_URL.'#/paypal_payment_cancel';
			$data['notification_url']	= BACKEND_URL.'payment/paypal_payment_notification';
			
			$this->load->view("order/paymentprocess",$data);
			exit();
			
		}
		
	}
	
	public function paymentprocess()
	{
		//pr($_POST);
		$data = array();
		
		$wholesaler_id 		= $this->input->post(trim(addslashes('wholesaler_name')));
		$shipping_method 	= $this->input->post(trim(addslashes('shipping_method')));
		$payment_status  	= $this->input->post(trim(addslashes('payment_status')));
		$arr_product_id	 	= $_POST['product']['name'];
		$arr_product_qty 	= $_POST['product']['quantity'];
		$arr_product_rate	= array();
		$arr_product_price	= array();
		$arr_product_price	= array();
		$total_price		= 0;
		$total_qty		= 0;
		
		/* insert into order master */
		$insertArr = array(
					'wholesaler_id' 	=> $wholesaler_id,
					'order_slug'		=> rand(0,999999999),
					'payment_status'	=> $payment_status,
					'shipping_status'	=> 'New',
					'added_on'		=> date('Y-m-d H:i:s')
				);
		
		$order_master_id = $this->model_basic->insertIntoTable(TEMP_ORDER_MASTER,$insertArr);
		
		$data['temp_order_master_id'] = $order_master_id;
		
		if(is_array($arr_product_id) && count($arr_product_id) > 0)
		{
			$i=0;
			foreach($arr_product_id as $pid)
			{
				$sub_total		= 0;
				$product_price		= $this->model_product->getProductPriceById($pid);
				$arr_product_rate[$i]	= $product_price[0]['price'];
				$arr_product_price[$i]	= ($arr_product_rate[$i]*$arr_product_qty[$i]);
				
				$arr_product[$i]	= $this->model_product->getProductNameById($pid);
				$sub_total		= ($arr_product_rate[$i]*$arr_product_qty[$i]);
				$total_price		= $total_price + $sub_total;
				$total_qty		= $total_qty + $arr_product_qty[$i];
				
				/* insert into order details */
				
				$insert_details = array(
							'order_master_id'	=> $order_master_id,
							'product_id'		=> $arr_product_id[$i],
							'product_price'		=> $arr_product_rate[$i],
							'product_quantity'	=> $arr_product_qty[$i],
							'total_price'		=> $sub_total
							);
				$this->model_basic->insertIntoTable(TEMP_ORDER_DETAILS,$insert_details);
								
				$i++;
			}
			
		}
		
		$shipping_method_info	= $this->model_basic->getFromWhereSelect(SHIPPING_METHOD_MASTER,'*',"id='".$shipping_method."'" );
		$shipping_method_name	= $shipping_method_info[0]['method_name'];
		
		$shipping_cost_info	= $this->model_basic->getFromWhereSelect(SHIPPING_PRICE,'price',"shipping_method_id='".$shipping_method."' AND ('" . $total_qty . "' BETWEEN lower_qty AND higher_qty)" );
		$shipping_cost		= $shipping_cost_info[0]['price'];
		
		$data['shipping_price'] = 0;
		if($shipping_method != '')
		{
			$shipping = $this->model_product->getShippingPriceByQty($total_qty, $shipping_method);
			$data['shipping_price'] = $shipping[0]['price'];
			
		}
		
		$total_order_price	= ($total_price + $data['shipping_price']);
		
		/* update into order master */
		
		$updateArr 	= array(
					'shipping_method' => $shipping_method_name,
					'shipping_cost'	=> $shipping_cost,
					'total_price'	=> $total_order_price
					);
		
		$idArr		= array(
					'id'	=> $order_master_id
					);
		
		$this->model_basic->updateIntoTable(TEMP_ORDER_MASTER, $idArr, $updateArr);
		
		$data['arr_product_id']		= $arr_product_id;
		$data['arr_product']		= $arr_product;
		$data['arr_product_rate']	= $arr_product_rate;
		$data['arr_product_price']	= $arr_product_price;
		$data['arr_product_qty']	= $arr_product_qty;
		
		$setting_data 	= $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'','sitesettings_id IN(20,21)');
		if($setting_data[1]['sitesettings_value'] == 'sandbox'){
			$data['url']	= $this->sandbox_url;
		}
		else if($setting_data[1]['sitesettings_value'] == 'live'){
			$data['url']	= $this->live_url;
		}
		
		$data['business_email_id'] = $setting_data[0]['sitesettings_value'];
		
		$data['return_url']		= BACKEND_URL.'order/paypal_payment_notification';
		$data['cancel_url']		= BACKEND_URL.'#/order/paypal_payment_cancel';
		$data['notification_url']	= BACKEND_URL.'order/paypal_payment_notification';
		
				
		return $this->load->view("order/paymentprocess",$data);
		exit();
	}
	
	public function paypal_payment_notification()
	{
		
		$order_id  		= $this->nsession->userdata('ORDER_ID');
		
		$tmp_order_master_id	= $_POST['custom'];
		$tran_id		= $_POST['txn_id'];
		$verify_sign		= $_POST['verify_sign'];
		$auth			= $_POST['auth'];
		$paypal_payment_type	= $_POST['payment_type'];
		
		$updateArr = array(
					'transaction_id'	=> $tran_id,
					'verify_sign'		=> $verify_sign,
					'auth'			=> $auth,
					'paypal_payment_type' 	=> $paypal_payment_type,
					'payment_status'	=> 'Success'
				  );
		
		$idArr	= array(
					'id' => $tmp_order_master_id
					);
		
		$this->model_basic->updateIntoTable(TEMP_ORDER_MASTER, $idArr, $updateArr);
		
		/* insert into order master table from temp table */
		$arr_temp_order_info = $this->model_basic->getValues_conditions(TEMP_ORDER_MASTER, '', '', "id = '".$tmp_order_master_id."'");
		
		$insertArr = array(
					'wholesaler_id' 	=> $arr_temp_order_info[0]['wholesaler_id'],
					'order_slug'		=> $arr_temp_order_info[0]['order_slug'],
					'total_price'		=> $arr_temp_order_info[0]['total_price'],
					'transaction_id'	=> $arr_temp_order_info[0]['transaction_id'],
					'verify_sign'		=> $arr_temp_order_info[0]['verify_sign'],
					'auth'			=> $arr_temp_order_info[0]['auth'],
					'paypal_payment_type'	=> $arr_temp_order_info[0]['paypal_payment_type'],
					'payment_status'	=> $arr_temp_order_info[0]['payment_status'],
					'shipping_status'	=> $arr_temp_order_info[0]['shipping_status'],
					'shipping_method' 	=> $arr_temp_order_info[0]['shipping_method'],
					'shipping_cost'		=> $arr_temp_order_info[0]['shipping_cost'],
					'added_on'		=> $arr_temp_order_info[0]['added_on']
				);
		
		$order_master_id = $this->model_basic->insertIntoTable(ORDER_MASTER,$insertArr);
		
		/* insert into order details */
		$arr_temp_order_details_info = $this->model_basic->getValues_conditions(TEMP_ORDER_DETAILS, '', '', "order_master_id = '".$tmp_order_master_id."'");
		
		foreach($arr_temp_order_details_info as $tmp_od)
		{
			$insert_details = array(
						'order_master_id'	=> $order_master_id,
						'product_id'		=> $tmp_od['product_id'],
						'product_price'		=> $tmp_od['product_price'],
						'product_quantity'	=> $tmp_od['product_quantity'],
						'total_price'		=> $tmp_od['total_price']
						);
			$this->model_basic->insertIntoTable(ORDER_DETAILS,$insert_details);
		}
		 
		
		/* destroy temp table data */
		$this->model_basic->truncateTable(TEMP_ORDER_MASTER);
		$this->model_basic->truncateTable(TEMP_ORDER_DETAILS);
		
		/* mail sent to wholeasaler start */
			
		$arr_wholesaler_info	= $this->model_basic->getValues_conditions(WHOLESALER, '', '', " wholesaler_id = '".$arr_temp_order_info[0]['wholesaler_id']."'");
		
		$order_info		= $this->model_product->getOrderMaster($order_master_id);
		$order_detais_info	= $this->model_product->getOrderDetails($order_master_id);
		$order_data = array();
		if(is_array($order_detais_info) and count($order_detais_info)>0){
			foreach($order_detais_info as $info){
				$info['product_price'] = number_format($info['product_price'],2);
				$info['total_price'] 	= number_format($info['total_price'],2);
				$order_data[] = $info;
			}	
		}
	
		$shipping_cost_info	= $this->model_product->getOrdShippingCost($order_master_id);
		$shipping_method	= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, '', '', "");
				
		if(is_array($order_info) && count($order_info) > 0)
		{
			$data['data']		= $order_info[0];
			
			$data['order_details']	= $order_data;
			$data['shipping_cost']	= $shipping_cost_info;
		}
		
		$data['wholesaler_info']	= $arr_wholesaler_info[0];
		
		$mail_config['to'] 		= $arr_wholesaler_info[0]['wholesaler_email'];
		$mail_config['from'] 		= EMAIL_FROM;
		$mail_config['from_name'] 	= EMAIL_FROM_NAME;
		$mail_config['subject'] 	= 'Your order has been added';
		$mail_config['message'] 	= $this->load->view('order/email_wholesaler', $data, true);
		
		$rec = send_html_email($mail_config);
		
		/* mail sent to wholeasaler end */
		
		redirect(BACKEND_URL.'#/order/view/'.$order_master_id);
		exit();
	}
	
	
	
	public function paypal_payment_cancel()	{
		redirect(BACKEND_URL.'#/order');
	}
	
	public function get_user_shipping_method()
	{
		$wholesaler_id 		= $this->input->post(trim(addslashes('wholesaler_id')));
		$arr_shipping_method	= $this->model_product->getShippingMethodByWholesalerId($wholesaler_id);
		
		$response['shipping_method_id'] = $arr_shipping_method[0]['id'];
		$response['method_name']	= $arr_shipping_method[0]['method_name'];
		echo json_encode($response);
		exit();
	}
	
	public function print_invoice()
	{
		ob_start();
		//$order_id		= $this->input->post('order_id');
		$order_id		= $this->uri->segment(3,0);
		
		$data['data']	= array(); 
		
		$order_info		= $this->model_product->getOrderMaster($order_id);
		$order_detais_info	= $this->model_product->getOrderDetails($order_id);
		
		
		$order_data = array();
		if(is_array($order_detais_info) and count($order_detais_info)>0){
			foreach($order_detais_info as $info){
				$info['product_price'] = number_format($info['product_price'],2);
				$info['total_price'] 	= number_format($info['total_price'],2);
				$order_data[] = $info;
			}	
		}
		
		
		$shipping_cost_info	= $this->model_product->getOrdShippingCost($order_id);
		$shipping_method	= $this->model_basic->getValues_conditions(SHIPPING_METHOD_MASTER, '', '', "");		
		$setting_value		= $this->model_basic->getValues_conditions(SITESETTINGS, '', '', "sitesettings_id = 14");		
		$data['setting']	= $setting_value[0];
				
		if(is_array($order_info) && count($order_info) > 0)
		{
			
			$data['data']		= $order_info[0];
			
			$data['order_details']	= $order_data;
			$data['shipping_cost']	= $shipping_cost_info;
		}
		
		
		
		$pdf_page 		= $this->load->view('order/pdf_view', $data,TRUE);
                
		$file_name		= 'invoice.pdf';
		$file_path 		= $file_name;
		$page_title		= 'Invoice: # MX';
		
		echo generate_pdf($pdf_page, $file_name, $file_path, 'I', 'P', 'A4', $page_title);
		exit();
	}
	
	public function print_shipping_label(){
		ob_start();
		$order_id		= $this->uri->segment(3,0);		
		$data['data']		= array();		
		$order_info		= $this->model_product->getOrderMaster($order_id);
		$setting_value		= $this->model_basic->getValues_conditions(SITESETTINGS, '', '', "sitesettings_id = 22");
		$data['data']		= $order_info[0];
		$data['setting']	= $setting_value[0];		
		
		$pdf_page 		= $this->load->view('order/pdf_shipping_view', $data,TRUE);
                
		$file_name		= 'shipping_label.pdf';
		$file_path 		= $file_name;
		$page_title		= 'Shipping Lebel: # MX';
		
		//$resolution		= array(127.2, 63.6);
		$resolution		= array(300, 280);
		
		echo generate_pdf($pdf_page, $file_name, $file_path, 'I', 'P', 'letter', $page_title);
		exit();
		
	}
	
	public function delete_order(){
		$order_id	= $this->input->post(trim(addslashes('oid')));
		$where_clause	= ' id = "' . $order_id . '"';
		$this->model_product->updateInventoryOnOrderDelete($order_id);
		$this->model_basic->deleteData(ORDER_MASTER, $where_clause);
		$where_clause	= ' order_master_id = "' . $order_id . '"';
		$this->model_basic->deleteData(ORDER_DETAILS, $where_clause);
	}
	
	public function setAdminOrder(){
	   $this->nsession->set_userdata('ADMINORDERFLUG','true');
	   
	   if($this->input->post('reorder_order_id')!=''){
		$this->nsession->set_userdata('REORDER_ORDER_ID',$this->input->post('reorder_order_id'));	
	   }
	   exit;
	}
}