<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		
	}

	
	
	
	public function getCategory(){
		$search_category = $this->nsession->userdata('SEARCH_CATEGORY');
		$search_category_arr = explode(",",$search_category) ;
		$data = $this->model_basic->getValues_conditions(CATEGORY,array('category_id','category_name'),'','category_status="Active"' );
		$result = array();
		if(is_array($data)){
			foreach($data as $d){
			  if(in_array($d['category_id'],$search_category_arr)){
				$d['checked']= 'true';
			  }else{
				$d['checked']= 'false';
			  }
			  $result[] = $d;
			}
			//pr($result);
		}
		echo json_encode($result);
		exit;
	}
	
	public function getCmsContent(){
		$cms_slug =$this->uri->segment(3,0);
		$data = $this->model_basic->getValues_conditions(CMS,array('cms_content','cms_title','cms_meta_title','cms_meta_key','cms_meta_desc','cms_slug'),'','cms_slug="'.$cms_slug.'"' );
		if(is_array($data)){
			$data = $data[0];
			$respons['code'] = 1;
			$respons['data'] = $data;
		}else{
			$respons['code'] = 0;
			$respons['data'] = array();
		}
		echo json_encode($respons);
	}
	

	
	
	public function listing(){
		$this->load->view('product/list');
	}

	public function getCustomProducts(){
		$wholesaler_id = $this->nsession->userdata('WHOLESALER_ID');
		$data = $this->model_basic->getValues_conditions(PRODUCTS,array('product_name','price','product_id','product_slug','any_retailer','inventory_qty'),'','product_status="Active" ','product_id','DESC' );
		$result =array();
		foreach($data as $index=>$d){
			
				$list_status ='false';
				if($this->nsession->userdata('WHOLESALER_ID')!='' and $d['any_retailer']=='No'){
					
					$w_p_data = $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT,array('wholesaler_product_id'),'','wholesaler_id="'.$this->nsession->userdata('WHOLESALER_ID').'" and product_id ="'.$d['product_id'].'"');
					
					if(is_array($w_p_data)){
						$w_p_data = $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT,array('wholesaler_product_id'),'',' product_id ="'.$d['product_id'].'"');
						if(is_array($w_p_data) and count($w_p_data)==1){
							$list_status ='true';	
						}
					
						
						
					}
					//pr($w_p_data,0);
				}
				
				
				if($list_status=='true'){
					$d['product_name'] = stripslashes($d['product_name']);
					if(strlen($d['product_name'])>40){
						$d['product_name'] =  substr($d['product_name'],0,40).'...';	
					}
					$img_data = $this->model_basic->getValues_conditions(PRODUCT_IMAGES,array('image_name','image_id',),'','image_status="Active" and product_id="'.$d['product_id'].'" ','', '', 1 );
					$d['image_name'] ='';
					if(is_array($img_data)){
						$d['image_name'] = ORIGINAL_SITE_URL.'upload/product/thumb/'. $img_data[0]['image_name'];
					}else{
						$d['image_name'] = ORIGINAL_SITE_URL.'images/no-img-list.jpg';
					}
					
					$result[] = $d;
			}
		}
		echo json_encode($result);exit;

	}
	public function getProducts(){
		$cat ='';$where = '';
		$data = array();$result=array();
		if($this->input->post('category_id')!='' || $this->nsession->userdata('SEARCH_CATEGORY')!=''){
			if($this->input->post('category_id')!=''){
				$cat = $this->input->post('category_id');
			}elseif($this->nsession->userdata('SEARCH_CATEGORY')!=''){
				$cat = $this->nsession->userdata('SEARCH_CATEGORY');
			}
			$cat_arr = array();
			if($cat!=''){
				$cat_arr = explode(',',$cat);
			}
			
			if(is_array($cat_arr) && count($cat_arr)>0){
				$where .=" and (";
				foreach($cat_arr AS $cc){
					$where .= ' FIND_IN_SET("'.$cc.'", category_id) AND ';
				}
				$where = substr($where, 0, strlen($where)-4);
				$where .=" )";
			}
			//$where = " and category_id IN(".$cat.")";
		}
		
		if($this->input->post('product_type')!='' || $this->nsession->userdata('SEARCH_PRODUCTTYPE')!=''){
			if($this->input->post('product_type')!=''){
				$cat = $this->input->post('product_type');
			}elseif($this->nsession->userdata('SEARCH_PRODUCTTYPE')!=''){
				$cat = $this->nsession->userdata('SEARCH_PRODUCTTYPE');
			}
			
				$where .=" and (";
				$where .=" product_type='".$cat."'";
				$where .=" )";
			
			//$where = " and category_id IN(".$cat.")";
		}
		
		if($this->nsession->userdata('WHOLESALER_ID') || $this->nsession->userdata('ADMIN_ID')){
			$data = $this->model_basic->getValues_conditions(PRODUCTS,array('product_name','price','product_id','product_slug','any_retailer','inventory_qty'),'','product_status="Active" '.$where,'product_id','DESC' );	
		}else{
			$data = $this->model_basic->getValues_conditions(PRODUCTS,array('product_name','price','product_id','product_slug','any_retailer','inventory_qty'),'',' 1=1 '.$where,'product_id','DESC' );
		}
		
		//pr($where);
		if(!is_array($data)){
			$data =array();
		}else{
			
			foreach($data as $index=>$d){
				
				$list_status ='true';
				
				if($this->nsession->userdata('WHOLESALER_ID')!='' and $d['any_retailer']=='No'){
					
					$w_p_data = $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT,array('wholesaler_product_id','wholesaler_id'),'',' product_id ="'.$d['product_id'].'"');
					
					if(is_array($w_p_data) and count($w_p_data)==1 and $w_p_data[0]['wholesaler_id']==$this->nsession->userdata('WHOLESALER_ID')){
						$list_status ='true';
						
					}else{
						$list_status ='false';
					}
					
					//pr($w_p_data,0);
				}
				
				
				if($list_status=='true'){
					$d['product_name'] = str_replace("\\",'',$d['product_name']);
					if(strlen($d['product_name'])>40){
						$d['product_name'] =  substr($d['product_name'],0,40).'...';	
					}
					
					//$result[$index] = $d;
					$img_data = $this->model_basic->getValues_conditions(PRODUCT_IMAGES,array('image_name','image_id',),'','image_status="Active" and product_id="'.$d['product_id'].'" ','', '', 1 );
					$d['image_name'] ='';
					if(is_array($img_data)){
						$d['image_name'] = ORIGINAL_SITE_URL.'upload/product/thumb/'. $img_data[0]['image_name'];
					}else{
						$d['image_name'] = ORIGINAL_SITE_URL.'images/no-img-list.jpg';
					}
					
					$result[] = $d;
				}
			}
		}
		echo json_encode($result);
		exit;
	}
	
	public function details(){
		$this->load->view('product/details');	
	}
	
	public function product_details(){
		$product_slug = $this->uri->segment(3,0);
		$data = $this->model_basic->getValues_conditions(PRODUCTS.' AS P JOIN '.PRODUCT_TYPE.' AS PT ON P.product_type = PT.id ','P.*,PT.type_name','','product_slug = "'.$product_slug.'"' );
		$respons = array();
		if(is_array($data)){
			$respons['code'] = 1;
			$respons['data'] = $data[0];
			$rec = $data[0];
			$respons['data']['product_description'] = stripslashes($respons['data']['product_description']);
			$respons['data']['product_name'] = stripslashes($respons['data']['product_name']);
			$respons['data']['inv_status'] = 'true';
			
			$custom_pins_status	= false;
			$custom_pins	= '';
			
			if(($this->nsession->userdata('ADMINORDERFLUG')== true || $this->nsession->userdata('WHOLESALER_ID')!='') and $rec['any_retailer']=='No'){
					
				$w_p_data = $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT,array('wholesaler_id','wholesaler_product_id'),'',' product_id ="'.$rec['product_id'].'"');
				//pr($w_p_data);
	//wholesaler_id="'.$this->nsession->userdata('WHOLESALER_ID').'" and			
				if(is_array($w_p_data)){
					//$w_p_data = $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT,array('wholesaler_product_id'),'',' product_id ="'.$rec['product_id'].'"');
					if($this->nsession->userdata('ADMINORDERFLUG')== true){
						if(is_array($w_p_data) and count($w_p_data)==1 ){
							$custom_pins =100;
							$custom_pins_status	= true;
						}
					}
					elseif($this->nsession->userdata('WHOLESALER_ID')!=''){
						if(is_array($w_p_data) and count($w_p_data)==1 && $w_p_data[0]['wholesaler_id']==$this->nsession->userdata('WHOLESALER_ID') ){
							$custom_pins =100;
							$custom_pins_status	= true;
						}
					}
					
				}
				//pr($w_p_data,0);
			}
			$respons['data']['custom_pins']	= $custom_pins;
			$respons['data']['custom_pins_status']	= $custom_pins_status;
			
			if($rec['inventory_qty']==0 and ($this->nsession->userdata('WHOLESALER_ID')!='' || $this->nsession->userdata('ADMIN_ID')!='')){
				
				$respons['data']['inv_status'] = 'false';
			}
			else if($rec['inventory_qty']==0 and ($this->nsession->userdata('WHOLESALER_ID')=='' && $this->nsession->userdata('ADMIN_ID')=='')){
				
				$respons['data']['inventory_qty'] = 'On Backorder';
			}
			
			elseif($rec['inventory_qty']>25 and ($this->nsession->userdata('WHOLESALER_ID')!='' || $this->nsession->userdata('ADMIN_ID')!='')){
				
				$respons['data']['inventory_qty'] = " >25 ";
			}
			elseif($this->nsession->userdata('WHOLESALER_ID')=='' || $this->nsession->userdata('ADMIN_ID')==''){
				
				$respons['data']['inv_status'] = 'false';
			}
			
			$img_data = $this->model_basic->getValues_conditions(PRODUCT_IMAGES,array('image_name','image_id'),'','image_status="Active" and product_id = "'.$data[0]['product_id'].'"' );
			$respons['data']['images'] = array();
			if(is_array($img_data)){
				foreach($img_data as $img){
					$img_name  =$img['image_name'];
					
					$img['image_name'] = ORIGINAL_SITE_URL.'upload/product/'.$img_name;
					$img['image_thumb_name'] = ORIGINAL_SITE_URL.'upload/product/thumb2/'.$img_name;
					$respons['data']['images'][] = $img;	
				}
				
			}else{
				$respons['data']['images'][] = array(
								     'image_id'=>0,
								     'image_name' => ORIGINAL_SITE_URL.'images/no_img.jpg'
								     );	
			}
		}else{
			$respons['code'] = 0;
			$respons['data'] = array();
		}
		
		echo json_encode($respons);
		
	}
	public function addSearchCategory(){
		$keyword = $this->input->post('keyword');
		$this->nsession->set_userdata('SEARCH_CATEGORY',$keyword);
		$this->nsession->set_userdata('SEARCH_KEYWORD','');
	}
	public function addSearchProductType(){
		$keyword = $this->input->post('keyword');
		$this->nsession->set_userdata('SEARCH_PRODUCTTYPE',$keyword);
		$this->nsession->set_userdata('SEARCH_KEYWORD','');
		
	}
	
	public function addSearchkeyWord(){
		$keyword = $this->input->post('keyword');
		$this->nsession->set_userdata('SEARCH_KEYWORD',$keyword);
		$this->nsession->set_userdata('SEARCH_CATEGORY','');
		$this->nsession->set_userdata('SEARCH_PRODUCTTYPE','');
	}
	
	public function getSearchkeyWord(){
		echo $this->nsession->userdata('SEARCH_KEYWORD');
		exit;
	}
	public function getSearchCategory(){
		echo $this->nsession->userdata('SEARCH_CATEGORY');
		exit;
	}
	public function getSearchProductType(){
		echo $this->nsession->userdata('SEARCH_PRODUCTTYPE');
		exit;
	}
	

	public function search(){
		$keyword='';
		if($_POST['keyword']!=''){
			$keyword = strip_tags(addslashes(trim( $_POST['keyword'])));	
		}else if($this->nsession->userdata('SEARCH_KEYWORD')!=''){
			
			$keyword = strip_tags(addslashes(trim( $this->nsession->userdata('SEARCH_KEYWORD') )));	
		}
		$result= array();
		if($keyword==''){
			$data = $this->model_basic->getValues_conditions(PRODUCTS,'','',' 1=1 ' );
		}else{
			$data = $this->model_basic->getValues_conditions(PRODUCTS,'','',' product_name LIKE "%'.$keyword.'%"  ' );	
		}
		
		if(!is_array($data)){
			$data =array();
		}else{
			foreach($data as $index=>$d){
				//echo $d['any_retailer'].'>>>';
				$list_status ='true';
				if($this->nsession->userdata('WHOLESALER_ID')!='' and $d['any_retailer']=='No'){
					$w_p_data = $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT,array('wholesaler_product_id'),'','wholesaler_id="'.$this->nsession->userdata('WHOLESALER_ID').'" and product_id ="'.$d['product_id'].'"');
					
					if(is_array($w_p_data)){
						$list_status ='true';
						
					}else{
						$list_status ='false';
					}
				}
				//echo $d['any_retailer'].'===>>'.$list_status.'<><><>';
				
				if($list_status=='true'){
					//$result[$index] = $d;
					$d['product_name'] = str_replace("\\",'',$d['product_name']);
					$img_data = $this->model_basic->getValues_conditions(PRODUCT_IMAGES,array('image_name','image_id',),'','image_status="Active" and product_id="'.$d['product_id'].'" ','', '', 1 );
					$d['image_name'] ='';
					if(is_array($img_data)){
						$d['image_name'] = ORIGINAL_SITE_URL.'upload/product/thumb/'. $img_data[0]['image_name'];
					}else{
						$d['image_name'] = ORIGINAL_SITE_URL.'images/no-img-list.jpg';
					}
					
					$result[] = $d;
				}
			}
			
		}
		
		echo json_encode($result);
		
	}
	
	public function addToCart(){
		$respons =array(); $respons['code'] = 0; $respons['msg'] = '';$respons['itemCount'] = 0;
		extract($_POST);
		$total_cart_item = $this->cart->total_items();
		$data = $this->model_basic->getValues_conditions(PRODUCTS,'','',' product_id = "'.$proId.'"' );
		if(!is_array($data)){
			$data =array();
			$respons['code'] = 0;
		}else{
			$data = $data[0];
			
			$custom_pins	= false;
			if(($this->nsession->userdata('ADMINORDERFLUG')== true || $this->nsession->userdata('WHOLESALER_ID')!='') and $data['any_retailer']=='No'){
					
				$w_p_data = $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT,array('wholesaler_product_id'),'','product_id ="'.$data['product_id'].'"');
				
				if(is_array($w_p_data)){
					if($this->nsession->userdata('ADMINORDERFLUG')== true){
						if(is_array($w_p_data) and count($w_p_data)==1 ){
							$custom_pins =true;	
						}
					}
					elseif($this->nsession->userdata('WHOLESALER_ID')!=''){
						
						if(is_array($w_p_data) and count($w_p_data)==1 and $w_p_data[0]['wholesaler_id']==$this->nsession->userdata('WHOLESALER_ID')){
							$custom_pins =true;	
						}
					}
				}
				//pr($w_p_data,0);
			}
			if($custom_pins){
				$insert_arr = array(
						'id'      => $data['product_id'],
						'qty'     => $cartQty,
						'price'   => $data['price'],
						'name'    => ($total_cart_item+1).'-product',
						//'options' => array('Size' => 'L', 'Color' => 'Red')
					     );
				 
				$this->cart->insert($insert_arr);

				$respons['code'] = 1;
				$respons['itemCount'] = $this->cart->total_items();
				
				
			}else{
				if($cartQty > $data['inventory_qty']  ){
					$respons['code'] = 2;
					
				}
				else{
					$insert_arr = array(
							'id'      => $data['product_id'],
							'qty'     => $cartQty,
							'price'   => $data['price'],
							'name'    => ($total_cart_item+1).'-product',
							//'options' => array('Size' => 'L', 'Color' => 'Red')
						     );
					 
					$this->cart->insert($insert_arr);
	
					$respons['code'] = 1;
					$respons['itemCount'] = $this->cart->total_items();
				}
			}
			//$total_qty =  $this->cart->total_items();$count=0;
			//	foreach($this->cart->contents() as $index=>$c){
			//		$update_data = array(
			//			'rowid' => $index,
			//			'name'   => ($total_qty-$count).'-product'
			//		);
			//
			//		$this->cart->update($update_data);
			//		$count++;
			//	}
		}
		
		echo json_encode($respons);
		
	}
	
	public function removeCart(){
		extract($_POST);
		
		$data = array(
			'rowid' => $rowId,
			'qty'   => 0
		);

		$this->cart->update($data);
		$this->getCartData();
		exit;
	}
	
	
	public function cartDetails(){
		$this->load->view('user/cart_details');
	}
	
	public function cartItemCount(){
		$respons = $this->cart->total_items();
		echo $respons;exit;
	}
	
	public function getCartData(){
		$data = $this->cart->contents();
		$respons['data'] = array();
		$respons['total'] = 0; $respons['itemCount'] = 0;$respons['not_added_product']='';
		$not_add_data = $this->nsession->userdata('NOT_ADDED_PRODUCT');
		if(is_array($not_add_data) and count($not_add_data)>0){
			$respons['not_added_product'] = implode(', ',$not_add_data);
		}
		if(!is_array($data) or count($data)==0){
			$data  = array();
		}else{
			
		  foreach($data as $index=>$d){
			
			$product_data = $this->model_basic->getValues_conditions(PRODUCTS,'','',' product_id = "'.$d['id'].'"' );
			if(is_array($product_data)){
				$product_data = $product_data[0];
				$d['cart_item_name'] = $d['name'];
				$d['name'] = $product_data['product_name'];
				$img_data = $this->model_basic->getValues_conditions(PRODUCT_IMAGES,array('image_name','image_id',),'','image_status="Active" and product_id="'.$d['id'].'" ','', '', 1 );
				$d['image_name'] ='';
				if(is_array($img_data)){
					$d['image_name'] = ORIGINAL_SITE_URL.'upload/product/thumb2/'. $img_data[0]['image_name'];
				}else{
					$d['image_name'] = ORIGINAL_SITE_URL.'images/no-img-thum.jpg';
				}
				$d['subtotal'] = number_format($d['subtotal'],2);
				$d['inv_qty'] = $product_data['inventory_qty']; 
				$respons['data'][] = $d;
			}
		  }
		  $respons['total'] = number_format($this->cart->total(),2);
		  $respons['itemCount'] = $this->cart->total_items();
		}
		
		echo json_encode($respons);
	}

	public function updateCart(){
		extract($_POST);
		$rowId 	= explode(',',$rowId);
		$qty 	= explode(',',$qty);
		foreach($rowId as $index=>$row){
			$update_data = array(
				'rowid' => $row,
				'qty'   => $qty[$index]
			);

			$this->cart->update($update_data);
			
		}
		
		$this->getCartData();
	        exit;
	}
	
	
	public function checkout(){
		$this->load->view('user/checkout');
	}
	
	public function getShipping(){
		$wholesaler_id = $this->input->post('wholesaler');
		$this->nsession->set_userdata('WHOLESALER_ID',$wholesaler_id);
		$respons['order_total']	= $this->cart->total();
		$respons['order_total_item']	= $this->cart->total_items();
		
		$shipping_price = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP join '.WHOLESALER.' as W on W.shipping_method=SP.shipping_method_id JOIN '.SHIPPINGMETHOD.' AS SM ON W.shipping_method=SM.id', array('SP.price','SM.method_name'), '', "W.wholesaler_id='".$wholesaler_id."' and  ".$respons['order_total_item']." BETWEEN SP.lower_qty AND SP.higher_qty");
		if(is_array($shipping_price)){
			$price = $shipping_price[0]['price'];
			$method = $shipping_price[0]['method_name'];
		}else{
			$price = 0;
			$method='';
		}
		$respons['shipping_method'] = $method;
		$respons['shipping_price'] = $price;
		$respons['shipping_price'] = number_format($respons['shipping_price'],2);
		$respons['order_total']	+= $price;
		
		echo json_encode($respons);exit;
		
		
	}
	public function getShippingAmt(){
		$shipping_method = $this->input->post('shipping_method');
		$this->nsession->set_userdata('SELECT_SHIPPING_METHOD',$shipping_method);
		$respons['order_total']	= $this->cart->total();
		$respons['order_total_item']	= $this->cart->total_items();
		
		$shipping_price = $this->model_basic->getValues_conditions(SHIPPINGPRICE, array('price'), '', "shipping_method_id='".$shipping_method."' and  ".$respons['order_total_item']." BETWEEN lower_qty AND higher_qty");
		
		if(is_array($shipping_price)){
			$price = $shipping_price[0]['price'];
			
		}else{
			$price = 0;
			
		}
		
		$respons['shipping_price'] = $price;
		$respons['shipping_price'] = number_format($respons['shipping_price'],2);
		$respons['order_total']	+= $price;
		
		echo json_encode($respons);exit;
		
		
	}
	
	public function checkoutData(){
		$wholesaler_id = '';
		if($this->nsession->userdata('WHOLESALER_ID')=='' &&  $this->nsession->userdata('ADMINORDERFLUG')=='true'){
			if($this->nsession->userdata('REORDER_ORDER_ID')!=''){
				$order_id  = $this->nsession->userdata('REORDER_ORDER_ID');
				$order_master = $this->model_basic->getValues_conditions(ORDERS,'','','id="'.$order_id.'"');
				$wholesaler_id = $order_master[0]['wholesaler_id'];
			}
			
			
			
		}elseif($this->nsession->userdata('WHOLESALER_ID')!=''){
			$wholesaler_id = $this->nsession->userdata('WHOLESALER_ID');	
		}
		$userdata='';
		if($wholesaler_id!=''){
			$userdata  = $this->model_basic->getValues_conditions(WHOLESALER, '', '', "wholesaler_id='".$wholesaler_id."'");
		}
		
		$respons = array();$respons['user_data']=array();$respons['cart_data']=array();$respons['order_total'] = 0;
		if(is_array($userdata)){
			$respons['user_data'] 	= $userdata[0];
			
			$respons['user_data']['wholesaler_billing_country'] = $this->model_basic->getValue_condition(COUNTRY, 'country_name', 'wholesaler_billing_country', 'id="'.$userdata[0]['wholesaler_billing_country'].'"');
			
			$respons['user_data']['wholesaler_shipping_country'] = $this->model_basic->getValue_condition(COUNTRY, 'country_name', 'wholesaler_shipping_country', 'id="'.$userdata[0]['wholesaler_shipping_country'].'"');
			
		
		}
		if($this->nsession->userdata('ADMINORDERFLUG')=='true'){
			//$respons['wholesaler_list'] = $this->model_basic->getValues_conditions(WHOLESALER,array('*', "REPLACE(wholesaler_name, '\\\', '')"),'','wholesaler_status="Active"', 'wholesaler_name', 'ASC');
			$respons['wholesaler_list'] = $this->model_basic->getFromWhereSelect(WHOLESALER, "*, REPLACE(wholesaler_name, '\\\', '') AS wholesaler_name", 'wholesaler_status="Active" ORDER BY wholesaler_name ASC');
			
		}
		$respons['shippingMethod'] = $this->model_basic->getValues_conditions(SHIPPINGMETHOD,'','','method_status="Active"');
			
		$respons['cart_data'] = array();
			
		$cart_data 	= $this->cart->contents();
		
		foreach($cart_data as $index=>$c){
			$product_data = $this->model_basic->getValues_conditions(PRODUCTS,'','',' product_id = "'.$c['id'].'"' );
			$c['cart_item_name'] = $c['name'];
			$c['name'] = $product_data[0]['product_name'];
			$c['price'] = number_format($c['price'],2);
			$c['subtotal'] = number_format($c['subtotal'],2);
			$respons['cart_data'][] = $c;
		}
		$respons['order_total']	= $this->cart->total();
		$respons['order_total_item']	= $this->cart->total_items();
		
		$shipping_price = $this->model_basic->getValues_conditions(SHIPPINGPRICE.' as SP join '.WHOLESALER.' as W on W.shipping_method=SP.shipping_method_id JOIN '.SHIPPINGMETHOD.' AS SM ON W.shipping_method=SM.id', array('SP.price','SM.method_name'), '', "W.wholesaler_id='".$wholesaler_id."' and  ".$respons['order_total_item']." BETWEEN SP.lower_qty AND SP.higher_qty");
		if(is_array($shipping_price)){
			$price = $shipping_price[0]['price'];
			$method = $shipping_price[0]['method_name'];
		}else{
			$price = 0;
			$method='';
		}
		$respons['shipping_method'] = $method;
		$respons['shipping_price'] = $price;
		$respons['shipping_price'] = number_format($respons['shipping_price'],2);
		$respons['order_total']	+= $price;
		
		
		echo json_encode($respons);
	}
	
	
	public function setreorder(){
		$order_id  =  $this->nsession->userdata('REORDER_ORDER_ID');
		$this->cart->destroy();$this->nsession->set_userdata('NOT_ADDED_PRODUCT','');
		$order_details = $this->model_basic->getValues_conditions(ORDER_DETAILS,'','','order_master_id="'.$order_id.'"');
		if(is_array($order_details) and count($order_details)>0){
			$not_add_product = array();
			foreach($order_details as $index=>$order){
				
				$product_details = $this->model_basic->getValues_conditions(PRODUCTS,'','','product_id="'.$order['product_id'].'"');
				if(is_array($product_details) && count($product_details)>0){
					$product_details = $product_details[0];
					if($product_details['inventory_qty']<=0){
						$cartQty=0;
						$not_add_product[$product_details['product_id']]=$product_details['product_name'];
					}else{
						if($product_details['inventory_qty'] < $order['product_quantity']){
							$cartQty = $product_details['inventory_qty'];
							
						}else{
							$cartQty = $order['product_quantity'];
							
						}
						
					}
					
					
					//$price = $cartQty*$product_details['price'];
					$insert_arr = array(
						'id'      => $order['product_id'],
						'qty'     => $cartQty,
						'price'   => $product_details['price'],
						'name'    => ($index+1).'-product',
						'options' => array('inv_qty'=>$product_details['inventory_qty'])
					     );
				 
					$this->cart->insert($insert_arr);	
				}
				
			}
			if(count($not_add_product)>0){
				$this->nsession->set_userdata('NOT_ADDED_PRODUCT',$not_add_product);
			}
			$this->load->view('user/cart_details');
			//redirect(FRONTEND_URL.'#/mycart');
			
		}else{
			redirect(FRONTEND_URL.'#/page-not-found');
		}
	}
	
	
	public function setreorderdata(){
	 if($this->input->post('orderId')!=''){
		$this->nsession->set_userdata('REORDER_ORDER_ID',$this->input->post('orderId'));	
	   }
	   exit;
	}
}