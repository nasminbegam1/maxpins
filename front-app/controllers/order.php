<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic', 'model_product'));		
	}
	
	
	public function listing(){
		$this->load->view('order/listing');
	}
	
	public function details(){
		$this->load->view('order/details');	
	}
	
	public function get_orders(){		
		$order_list		= array();
		$wholesaler_id		= $this->nsession->userdata('WHOLESALER_ID');
		$list 		= $this->model_basic->getFromWhereSelect(ORDERS,'*',"wholesaler_id='".$wholesaler_id."' ORDER BY added_on DESC" );
		
		if(is_array($list) and count($list)>0){
			foreach($list as $o){
				if($o['transaction_id']==''){
					$o['transaction_id'] ='N/A';
				}
				$o['added_on'] = date('m-d-Y',strtotime($o['added_on']));
				$o['total_price'] = number_format($o['total_price'],2);
				if($o['payment_status']=='Success'){
					$o['payment_status'] = 'Paid';
				}
				$order_list[] = $o;
			}
		}
		echo json_encode($order_list);
	}
	
	public function order_details(){
		$order_slug = $this->uri->segment(3,0);
		$wholesaler_id		= $this->nsession->userdata('WHOLESALER_ID');
		$order_list 		= $this->model_basic->getOrderDetails($wholesaler_id, $order_slug);
		$respons 		= array();
		
		if(is_array($order_list)){
			$respons['code'] 	= 1;
			$respons['ord_slug']	= $order_slug;
			$respons['data']	= $order_list;
			
			$shipping_price = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP join '.WHOLESALER.' as W on W.shipping_method=SP.shipping_method_id JOIN '.SHIPPINGMETHOD.' AS SM ON W.shipping_method=SM.id', array('SP.price','SM.method_name'), '', "W.wholesaler_id='".$wholesaler_id."' and  ".$respons['data']['ord_qty']." BETWEEN SP.lower_qty AND SP.higher_qty");
			
			$respons['data']['shipping_price'] =  0;
			$respons['data']['shipping_method_name'] =  '';
			if(is_array($shipping_price)){
				$respons['data']['shipping_price'] =  $shipping_price[0]['price'];
				$respons['data']['shipping_method_name'] =  $shipping_price[0]['method_name'];
			}
			$respons['data']['ord_total'] = number_format($respons['data']['ord_total']+$respons['data']['shipping_price'],2);
		}else{
			$respons['code'] 	= 0;
			$respons['ord_slug']	= '';
			$respons['data'] 	= array();
		}
		//pr($respons);
		echo json_encode($respons);
	}
	
	public function print_invoice(){
		ob_start();
		$order_slug = $this->uri->segment(3,0);		
		
		$data['data']	= array(); 
		$order_list 		= $this->model_basic->getFromWhereSelect(ORDERS,'*',"order_slug='".$order_slug."'" );
		$order_id		= $order_list[0]['id'];
		$order_info		= $this->model_product->getOrderMaster($order_id);
		$order_detais_info	= $this->model_product->getOrderDetails($order_id);
		$setting_value		= $this->model_basic->getValues_conditions(SITESETTINGS, '', '', "sitesettings_id = 14");
		$data['setting']	= $setting_value[0];
		
		$order_data = array();
		if(is_array($order_detais_info) and count($order_detais_info)>0){
			foreach($order_detais_info as $info){
				$info['product_price'] = number_format($info['product_price'],2);
				$info['total_price'] 	= number_format($info['total_price'],2);
				$order_data[] = $info;
			}	
		}
		
		
		$shipping_cost_info	= $this->model_product->getOrdShippingCost($order_id);
		$shipping_method	= $this->model_basic->getValues_conditions(SHIPPINGMETHOD, '', '', "");
				
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
}