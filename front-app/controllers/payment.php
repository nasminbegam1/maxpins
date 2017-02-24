<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller {
 
	var $payment_mode 	= 'sandbox';
	//var $business_email_id  = 'kingshuk.biswas-facilitator@webskitters.com';
	var $business_email_id  = 'deykalyan777@gmail.com';
	var $sandbox_url	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	var $live_url		= 'https://www.paypal.com/cgi-bin/webscr';
	
	public function __construct(){
		parent::__construct();
	}
	public function setDiscount(){
		$this->nsession->set_userdata('DISCOUNT',$this->input->post('discount'));
	}
	public function paymentprocess(){
		
		$wholesaler_id  = $this->uri->segment(3,0);
		$discount  = $this->nsession->userdata('DISCOUNT');
		$order_qty 	= $this->cart->total_items();
		$setting_data 	= $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_value'),'','sitesettings_id IN(20,21)');
		
		if($setting_data[1]['sitesettings_value'] == 'sandbox'){
			$data['url']	= $this->sandbox_url;
		}
		else if($setting_data[1]['sitesettings_value'] == 'live'){
			$data['url']	= $this->live_url;
		}
		$data['business_email_id'] = $setting_data[0]['sitesettings_value'];
		$data['items'] 		   = array();$count=1;
		foreach($this->cart->contents() as $index=>$i){
			$product_data = $this->model_basic->getValues_conditions(PRODUCTS,'','',' product_id = "'.$i['id'].'"' );
			
			$data['items'][$count]['item_name'] 	= $product_data[0]['product_name'];
			$data['items'][$count]['item_price'] 	= $i['price'];
			$data['items'][$count]['item_qty'] 	= $i['qty'];
			$count++;
		}
		if($this->nsession->userdata('ADMINORDERFLUG')!='' && $this->nsession->userdata('SELECT_SHIPPING_METHOD')!=''){
				$method = $this->nsession->userdata('SELECT_SHIPPING_METHOD');
				
				$shipping = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP  JOIN  '.SHIPPINGMETHOD.' AS SM ON SP.shipping_method_id=SM.id', array('SP.price','SM.method_name'), '', "SP.shipping_method_id='".$method."' and  ".$order_qty." BETWEEN SP.lower_qty AND SP.higher_qty");
				
				if(is_array($shipping)){
					$shipping_price =  $shipping[0]['price'];
					$shipping_method = $shipping[0]['method_name'];	
					
				}else{
					 $shipping = $this->model_basic->getValues_conditions(SHIPPINGMETHOD.' AS SM ', array('SM.method_name'), '', "SM.id='".$method."'");
					 $shipping_method = $shipping[0]['method_name'];
					 $shipping_price =0;
				}
				
				
		
		}else{
				$shipping = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP join '.WHOLESALER.' as W on W.shipping_method=SP.shipping_method_id JOIN '.SHIPPINGMETHOD.' AS SM ON W.shipping_method=SM.id', array('SP.price','SM.method_name'), '', "W.wholesaler_id='".$wholesaler_id."' and  ".$order_qty." BETWEEN SP.lower_qty AND SP.higher_qty");
				$shipping_price =$shipping[0]['price'];
		}
		
		
		$data['shipping_price'] 	= $shipping_price;
		$data['discount']		= $discount;
		$data['wholesaler_id']		= $wholesaler_id;
		$data['return_url']		= ORIGINAL_SITE_URL.'payment/payment_notification';
		$data['cancel_url']		= ORIGINAL_SITE_URL.'#/paymentcancel';
		$data['notification_url']	= ORIGINAL_SITE_URL.'payment/payment_notification';
		
		$this->load->view("user/paymentprocess",$data);
	}
	
	public function success(){
		
		$data['order_slug'] = $this->uri->segment(3,0);
		$this->load->view('payment_success',$data);
	}
	
	public function payment_cancel(){
		
	}
	
	public function payment_notification(){
		
		$wholesaler_id  = $this->nsession->userdata('WHOLESALER_ID');
		$order_qty 	= $this->cart->total_items();
		$shipping_price =  0;$shipping_method='';
		if($this->nsession->userdata('ADMINORDERFLUG')!='' && $this->nsession->userdata('SELECT_SHIPPING_METHOD')!=''){
				$method = $this->nsession->userdata('SELECT_SHIPPING_METHOD');
				
				$shipping = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP  JOIN  '.SHIPPINGMETHOD.' AS SM ON SP.shipping_method_id=SM.id', array('SP.price','SM.method_name'), '', "SP.shipping_method_id='".$method."' and  ".$order_qty." BETWEEN SP.lower_qty AND SP.higher_qty");
				
				if(is_array($shipping)){
					$shipping_price =  $shipping[0]['price'];
					$shipping_method = $shipping[0]['method_name'];	
					
				}else{
					 $shipping = $this->model_basic->getValues_conditions(SHIPPINGMETHOD.' AS SM ', array('SM.method_name'), '', "SM.id='".$method."'");
					 $shipping_method = $shipping[0]['method_name'];
					 $shipping_price =0;
				}
				
				
		
		}else{
				$shipping = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP join '.WHOLESALER.' as W on W.shipping_method=SP.shipping_method_id JOIN '.SHIPPINGMETHOD.' AS SM ON W.shipping_method=SM.id', array('SP.price','SM.method_name'), '', "W.wholesaler_id='".$wholesaler_id."' and  ".$order_qty." BETWEEN SP.lower_qty AND SP.higher_qty");
				
				if(is_array($shipping)){
					$shipping_price  =  $shipping[0]['price'];
					
					if($shipping_method!='NULL'){
						$shipping_method = $shipping[0]['method_name'];	
					}
				}
				
		}
		
		$discount = 0;
		if($this->nsession->userdata('DISCOUNT')!='0.00' && $this->nsession->userdata('DISCOUNT')!=''){
			$discount =$this->nsession->userdata('DISCOUNT');
		}
		
		$order_total 	= ($shipping_price + $this->cart->total())-$discount;
		$tran_id	= $_POST['txn_id'];
		$insert_arr = array(
				'wholesaler_id' 	=> $wholesaler_id,
				'order_slug'		=> rand(0,999999999),
				'total_price'		=> $order_total,
				'transaction_id'	=> $tran_id,
				'verify_sign'		=> $_POST['verify_sign'],
				'auth'			=> $_POST['auth'],
				'paypal_payment_type' 	=> $_POST['payment_type'],
				'shipping_cost'		=> $shipping_price,
				'shipping_method'	=> $shipping_method,
				'payment_status'	=> 'Success',
				'shipping_status'	=> 'New',
				'discount'		=> $discount,
				'added_on'		=> date('Y-m-d H:i:s')
				);
		$order_master_id = $this->model_basic->insertIntoTable(ORDERS,$insert_arr);
		    
		foreach($this->cart->contents() as $index=>$item){
		    $insert_details = array(
					    'order_master_id'	=> $order_master_id,
					    'product_id'	=> $item['id'],
					    'product_price'	=> $item['price'],
					    'product_quantity'	=> $item['qty'],
					    'total_price'	=> $item['subtotal']
					    );
		    $this->model_basic->insertIntoTable(ORDER_DETAILS,$insert_details);
		    
		    $product_details = $this->model_basic->getFromWhereSelect(PRODUCTS,'*',"product_id='".$item['id']."'" );
		    $update_arr = array(
					'inventory_qty' => $product_details[0]['inventory_qty'] - $item['qty']
					);
		    $idArr = array(
			    'product_id'=>$item['id']
				   );
		    $this->model_basic->updateIntoTable(PRODUCTS, $idArr, $update_arr);
		    
		}
		$this->cart->destroy();
		$respons['code'] = 1;
		$respons['msg'] = $insert_arr['order_slug'];
		$this->nsession->set_userdata('DISCOUNT');
		$this->send_order_mail($order_master_id); // SEND MAIL TO WHOLESALER
		if($this->nsession->userdata('ADMINORDERFLUG')!=''){
			$this->nsession->set_userdata('ADMINORDERFLUG','');
			$this->nsession->set_userdata('WHOLESALER_ID','');
			$this->nsession->set_userdata('SELECT_SHIPPING_METHOD','');
			redirect(BACKEND_URL.'#/order/view/'.$order_master_id);
		}else{
			redirect(FRONTEND_URL.'#/paymentsuccess/'.$insert_arr['order_slug']);
		}
	}
	
	public function payNotPaypal(){
		$total_items 	= $this->cart->total_items();
		if($total_items > 0){
			$payment_type 	= $this->input->post('payment_type');
			$wholesaler_id  = $this->input->post('wholesaler_id');
			$discount 	= $this->input->post('discount');
			//$wholesaler_id  = $this->nsession->userdata('WHOLESALER_ID');
			
			$order_qty 	= $this->cart->total_items();$shipping_price =  0;$shipping_method='';
			if($this->nsession->userdata('ADMINORDERFLUG')!='' && $this->nsession->userdata('SELECT_SHIPPING_METHOD')!=''){
					$method = $this->nsession->userdata('SELECT_SHIPPING_METHOD');
					
					$shipping = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP  JOIN  '.SHIPPINGMETHOD.' AS SM ON SP.shipping_method_id=SM.id', array('SP.price','SM.method_name'), '', "SP.shipping_method_id='".$method."' and  ".$order_qty." BETWEEN SP.lower_qty AND SP.higher_qty");
					
					if(is_array($shipping)){
						$shipping_price =  $shipping[0]['price'];
						if($shipping_method!='NULL'){
							$shipping_method = $shipping[0]['method_name'];	
						}
					}else{
						 $shipping = $this->model_basic->getValues_conditions(SHIPPINGMETHOD.' AS SM ', array('SM.method_name'), '', "SM.id='".$method."'");
						 $shipping_method = $shipping[0]['method_name'];
						 $shipping_price = 0;
					}
					
					
			
			}else{
					
					$shipping = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP join '.WHOLESALER.' as W on W.shipping_method=SP.shipping_method_id JOIN '.SHIPPINGMETHOD.' AS SM ON W.shipping_method=SM.id', array('SP.price','SM.method_name'), '', "W.wholesaler_id='".$wholesaler_id."' and  ".$order_qty." BETWEEN SP.lower_qty AND SP.higher_qty");
					if(is_array($shipping)){
						$shipping_price =  $shipping[0]['price'];
						if($shipping_method!='NULL'){
							$shipping_method = $shipping[0]['method_name'];	
						}
					}
					
			}
			
			
			
			$order_total 	= ($shipping_price + $this->cart->total())-$discount;
			$insert_arr = array(
					'wholesaler_id' 	=> $wholesaler_id,
					'order_slug'		=> rand(0,999999999),
					'total_price'		=> $order_total,
					'shipping_cost'		=> $shipping_price,
					'shipping_method'	=> $shipping_method,
					'shipping_status'	=> 'New',
					'discount'		=> $discount,
					'added_on'		=> date('Y-m-d H:i:s')
					);
			
			if($payment_type == 'net_30'){
				$insert_arr['payment_status'] = 'Net 30';
			}
			else if($payment_type == 'success'){
				$insert_arr['payment_status'] = 'Success';
			}
			$order_master_id = $this->model_basic->insertIntoTable(ORDERS,$insert_arr);
			    
			foreach($this->cart->contents() as $index=>$item){
			    $insert_details = array(
						    'order_master_id'	=> $order_master_id,
						    'product_id'	=> $item['id'],
						    'product_price'	=> $item['price'],
						    'product_quantity'	=> $item['qty'],
						    'total_price'	=> $item['subtotal']
						    );
			    $this->model_basic->insertIntoTable(ORDER_DETAILS,$insert_details);
			    
			    $product_details = $this->model_basic->getFromWhereSelect(PRODUCTS,'*',"product_id='".$item['id']."'" );
			    $update_arr = array(
						'inventory_qty' => $product_details[0]['inventory_qty'] - $item['qty']
						);
			    $idArr = array(
				    'product_id'=>$item['id']
					   );
			    $this->model_basic->updateIntoTable(PRODUCTS, $idArr, $update_arr);
			    
			}
			$this->cart->destroy();
			$respons['code'] 		= 1;
			$respons['order_code'] 		= $insert_arr['order_slug'];
			$respons['order_id'] 		= $order_master_id;
			if($this->nsession->userdata('ADMINORDERFLUG')!=''){
				$this->nsession->set_userdata('ADMINORDERFLUG','');
				$this->nsession->set_userdata('SELECT_SHIPPING_METHOD','');
			}
			$this->send_order_mail($order_master_id);
		}else{
			$respons['code'] 		= 2;
			
		}
		echo json_encode($respons);exit;
	}
	
	
	function index()
	{
		// Load the ARB lib
		$wholesaler_id = $this->nsession->userdata('WHOLESALER_ID');
		$wholesaler_data 		= $this->model_basic->getValues_conditions(WHOLESALER,'','','wholesaler_id="'.$wholesaler_id.'"');
		
		$post_values = array(
			"x_login"           => AUTHNET_LOGIN,
			"x_tran_key"        => AUTHNET_TRANSKEY,
			"x_version"         => "3.1",
			"x_delim_data"      => "TRUE",
			"x_delim_char"      => "|",
			"x_relay_response"  => "FALSE",
			//"x_market_type"       => "2",
			"x_device_type"     => "1",
			"x_type"            => "AUTH_CAPTURE",
			"x_method"          => "CC",
			"x_card_num"        => $_POST['card_no'],
			//"x_exp_date"      => "0115",
			"x_exp_date"        => sprintf("%02d", $_POST['exp_month']).substr($_POST['exp_year'],2,2),
			"x_amount"          => $_POST['orderTotal'],
			//"x_description"       => "Sample Transaction",
			"x_first_name"      => $wholesaler_data[0]['wholesaler_name'],
			"x_last_name"       => '',
			"x_address"         => $wholesaler_data[0]['wholesaler_billing_address'],
			"x_state"           => $wholesaler_data[0]['wholesaler_billing_state'],
			"x_response_format" => "1",
			"x_zip"             => $wholesaler_data[0]['wholesaler_billing_zip']
			// Additional fields can be added here as outlined in the AIM integration
			// guide at: http://developer.authorize.net
		);
		
		$post_string = "";
		foreach( $post_values as $key => $value )$post_string .= "$key=" . urlencode( $value ) . "&";
		$post_string = rtrim($post_string,"& ");
		
		//for test mode use the followin url
		if(AUTHNET_MODE =='sandbox'){
			$post_url = "https://test.authorize.net/gateway/transact.dll";
		}else{
			$post_url = "https://secure.authorize.net/gateway/transact.dll";
		}
		//for live use this url
		//$post_url = "https://secure.authorize.net/gateway/transact.dll";
		
		$request = curl_init($post_url); // initiate curl object
		curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
		curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
		curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
		$post_response = curl_exec($request); // execute curl post and store results in $post_response
		// additional options may be required depending upon your server configuration
		// you can find documentation on curl options at http://www.php.net/curl_setopt
		curl_close ($request); // close curl object

		// This line takes the response and breaks it into an array using the specified delimiting character
		$response_array = explode($post_values["x_delim_char"],$post_response);
 
		$respons['code'] = 0;
		if($response_array[0]==2||$response_array[0]==3)
		{
		    
		    $respons['code'] = 0;
		    $respons['msg'] = $response_array[3];
		}
		else
		{
			//pr($response_array);
		    $ptid = $response_array[6]; // The transaction key when success
		    $ptidmd5 = $response_array[7]; // The md5 of the above transaction key
		    
		    $insert_arr = array(
					'wholesaler_id' => $this->nsession->userdata('WHOLESALER_ID'),
					'order_slug'	=> rand(0,999999999),
					'total_price'	=> $_POST['orderTotal'],
					'transaction_id'=> $ptid,
					'payment_status'=>'Success',
					'shipping_status'=>'New',
					'added_on'	=> date('Y-m-d H:i:s')
					);
		    $order_master_id = $this->model_basic->insertIntoTable(ORDERS,$insert_arr);
		    
		    foreach($this->cart->contents() as $index=>$item){
			$insert_details = array(
						'order_master_id'=>$order_master_id,
						'product_id'=> $item['id'],
						'product_price'	=>$item['price'],
						'product_quantity'=> $item['qty'],
						'total_price'	=> $item['subtotal']
						);
			$this->model_basic->insertIntoTable(ORDER_DETAILS,$insert_details);
			
			$product_details = $this->model_basic->getFromWhereSelect(PRODUCTS,'*',"product_id='".$item['id']."'" );
			$update_arr = array(
					    'inventory_qty' => $product_details[0]['inventory_qty'] - $item['qty']
					    );
			$idArr = array(
				'product_id'=>$item['id']
				       );
			$this->model_basic->updateIntoTable(PRODUCTS, $idArr, $update_arr);
			
		    }
		    $this->cart->destroy();
		    $respons['code'] = 1;
		    $respons['msg'] = $insert_arr['order_slug'];
		    
		}
		
		echo json_encode($respons);exit;
	}
	
	
	public function send_order_mail($order_master_id){
			$order_master_details =  $this->model_basic->getValues_conditions(ORDERS, '', '', " id = '".$order_master_id."'");
			$order_detais_info	= $this->model_basic->getValues_conditions(ORDER_DETAILS.' AS OD JOIN '.PRODUCTS.' AS P ON OD.product_id=P.product_id', array('OD.*','P.product_name','P.product_sku'), '', " order_master_id = '".$order_master_id."'");
	
			
			$wholesaler_id = $order_master_details[0]['wholesaler_id'];
			/* mail sent to wholeasaler start */
			
			$arr_wholesaler_info	= $this->model_basic->getValues_conditions(WHOLESALER, '', '', " wholesaler_id = '".$wholesaler_id."'");
			$arr_wholesaler_billing_country	= $this->model_basic->getValues_conditions(COUNTRY, '', '', " id ='".$arr_wholesaler_info[0]['wholesaler_billing_country']."'");
			$arr_wholesaler_shipping_country	= $this->model_basic->getValues_conditions(COUNTRY, '', '', " id ='".$arr_wholesaler_info[0]['wholesaler_shipping_country']."'");
			
			$arr_wholesaler_info[0]['billing_country_name'] = $arr_wholesaler_billing_country[0]['country_name'];
			$arr_wholesaler_info[0]['shipping_country_name'] = $arr_wholesaler_shipping_country[0]['country_name'];
			
			
			$siteSetting = $this->model_basic->getValues_conditions(SITESETTINGS,array('sitesettings_id','sitesettings_value'),'','sitesettings_id IN(6,1) ','sitesettings_id','ASC');
			
			$order_data = array();
			if(is_array($order_detais_info) and count($order_detais_info)>0){
				foreach($order_detais_info as $info){
					$info['product_price'] = number_format($info['product_price'],2);
					$info['total_price'] 	= number_format($info['total_price'],2);
					$order_data[] = $info;
				}	
			}
		
			$shipping_cost		= $order_master_details[0]['shipping_cost'];
			$shipping_method	= $order_master_details[0]['shipping_method'];
					
			if(is_array($order_master_details) && count($order_master_details) > 0)
			{
				$data['data']		= $order_master_details[0];
				
				$data['order_details']	= $order_data;
				$data['shipping_cost']	= $shipping_cost;
			}
			
			$setting_value		= $this->model_basic->getValues_conditions(SITESETTINGS, '', '', "sitesettings_id = 14");		
			$data['setting']	= $setting_value[0];
			$data['wholesaler_info']	= $arr_wholesaler_info[0];
			//pr($data['order_details']);
			$mail_config['to'] 		= $arr_wholesaler_info[0]['wholesaler_email'];
			$mail_config['from'] 		= $siteSetting[0]['sitesettings_value'];
			$mail_config['from_name'] 	= $siteSetting[1]['sitesettings_value'];
			$mail_config['subject'] 	= 'Your order has been added';
			$mail_config['message'] 	= $this->load->view('order/email_wholesaler', $data, true);
			$cc 				= 'norm@maxpins.com';
			
			//pr($mail_config);
			$rec = send_html_email($mail_config,$cc);
	}
	
	
	
}