<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Controller {
 
	public function __construct(){
		parent::__construct();
		$this->load->model(array('model_basic', 'model_product'));

	}

	
	public function index(){
		$this->data = array();
		$this->load->view('products/index');
	}
	public function setOrder(){
		$order_field		= trim($this->input->post('order_field'));
		$order_type		= trim($this->input->post('order_type'));
		$this->nsession->set_userdata('PRODUCT_ORDER_FIELD',$order_field);
		$this->nsession->set_userdata('PRODUCT_ORDER_TYPE',$order_type);
	}
	public function clearSearch(){
		$this->nsession->set_userdata('SEARCH_PRODUCT_SKU','');
		$this->nsession->set_userdata('SEARCH_PRODUCT_TYPE','');
	}
	
	public function setSearchData(){
		
		$this->nsession->set_userdata('SEARCH_PRODUCT_SKU',$this->input->post('product_name_sku'));
		$this->nsession->set_userdata('SEARCH_PRODUCT_TYPE',$this->input->post('product_type'));
		$this->nsession->set_userdata('SEARCH_PRODUCT_CATEGORY',$this->input->post('search_product_category'));
	}
	
	public function product_type_list(){
		$data['selectedtype'] ='';
		if($this->nsession->userdata('SEARCH_PRODUCT_TYPE')!=''){
			$data['selectedtype'] = $this->nsession->userdata('SEARCH_PRODUCT_TYPE');
		}
		if($this->nsession->userdata('SEARCH_PRODUCT_CATEGORY')!=''){
			$data['selectedcategory'] = $this->nsession->userdata('SEARCH_PRODUCT_CATEGORY');
		}
		$data['productType'] = $this->model_basic->getValues_conditions(PRODUCT_TYPE,array('type_name','id'),'','status="Active"');
		$data['productCategory'] = $this->model_basic->getValues_conditions(CATEGORY,array('category_name','category_id'),'','category_status="Active"','category_name','ASC');
		if(!is_array($data['productType'])){
			$data['productType']  = array();
		}
		if(!is_array($data['productCategory'])){
			$data['productCategory']  = array();
		}
		echo json_encode($data);exit;
	}
	
	public function listing()
	{
		$start = 0;
		if($this->uri->segment(3)!=''){
			$start = $this->uri->segment(3);
		}
		$product_name_sku =''; $product_type ='';$product_category ='';
		
		if($this->nsession->userdata('SEARCH_PRODUCT_SKU')!=''){
				$product_name_sku 	= addslashes(trim($this->nsession->userdata('SEARCH_PRODUCT_SKU')));
		}
		
		
		if($this->nsession->userdata('SEARCH_PRODUCT_TYPE')!=''){
				$product_type 	= addslashes(trim($this->nsession->userdata('SEARCH_PRODUCT_TYPE')));
			
		}
		if($this->nsession->userdata('SEARCH_PRODUCT_CATEGORY')!=''){
				$product_category 	= addslashes(trim($this->nsession->userdata('SEARCH_PRODUCT_CATEGORY')));
			
		}
		
		
		$order_field		= $this->nsession->userdata('PRODUCT_ORDER_FIELD');
		$order_type		= $this->nsession->userdata('PRODUCT_ORDER_TYPE');
		if($order_type=='true'){
			$order_type ="ASC";
		}elseif($order_type=='false'){
			$order_type ="DESC";
		}
		$product_info = $this->get_pagi_list($start, $product_name_sku,$product_type,$product_category,$order_field,$order_type);
		
		echo json_encode($product_info);
		exit;
	}
	
	public function get_pagi_list($start, $product_name_sku='',$product_type='',$product_category='',$order_field='',$order_type=''){

		$condition = ' 1=1 ';
		if($product_name_sku)
		{
			$condition .= " AND P.product_sku LIKE '%".$product_name_sku."%' OR P.product_name LIKE '%".$product_name_sku."%'";
			$this->nsession->set_userdata('SEARCH_PRODUCT_SKU',$product_name_sku);
		}
		if($product_type)
		{
			$condition .= " AND P.product_type = '".$product_type."'";
			$this->nsession->set_userdata('SEARCH_PRODUCT_TYPE',$product_type);
		}
		if($product_category!='' && $product_category!='undefined')
		{
			$condition .= " AND find_in_set(".$product_category." , P.category_id)";
			$this->nsession->set_userdata('SEARCH_PRODUCT_CATEGORY',$product_category);
		}
		if($order_field!='' && $order_type!=''){
			$condition .=' Order By P.'.$order_field.' '.$order_type.' ';
		}
		//echo $condition;die;
		$product_info	= $this->model_basic->getValue_condition(PRODUCTS." AS P", 'COUNT(P.product_id)','product_count',  $condition);
		
		
		//pr($cms_info);

			
		$config['base_url']	= ADMIN_URL.'#products/listing/';
		$config['per_page']	= RECORD_PER_PAGE;
		//$config['per_page']	= 2;
		$config['use_page_numbers'] = true;
		$config['total_rows'] = $product_info;
		
		if($start!=0 and $start!='' ){
			$start = ($start-1)*$config['per_page'];
		}else{
			$start = 0;
		}
		
		$data = $this->model_basic->getFromWhereSelect(PRODUCTS .' AS P JOIN '.PRODUCT_TYPE.' AS PT ON PT.id= P.product_type', 'P.product_id, REPLACE(P.product_name,"\\\","") AS product_name, P.product_sku,P.price,P.product_status, P.inventory_qty,P.category_id, P.manufactured_qty,PT.type_name AS product_type', $condition.' LIMIT '.$start.', '.$config['per_page']);
		
		$this->pagination->setFrontendPaginationStyle($config);
		$this->pagination->initialize($config);
		$result['pagination_links'] = $this->pagination->create_links();
		if(is_array($data) and count($data)>0){
			foreach($data as $index=>$d){
				
				$categories =  $this->model_basic->getValues_conditions(CATEGORY,'REPLACE(category_name,"\\\","")','category_name','category_id IN('.$d['category_id'].')');
				$d['category_name'] = '';
				//pr($categories);
				if(is_array($categories) and count($categories)>0){
					foreach($categories as $cat){
						$d['category_name'] .=$cat['category_name'].', ';
					}
					$d['category_name']  = rtrim($d['category_name'],', ');
				}
				
				
				$img_data = $this->model_basic->getValues_conditions(PRODUCT_IMAGES,array('image_name','image_id',),'','image_status="Active" and product_id="'.$d['product_id'].'" ','', '', 1 );
				$d['image_name'] ='';
				if(is_array($img_data)){
					$d['image_name'] = ORIGINAL_SITE_URL.'upload/product/thumb/'. $img_data[0]['image_name'];
				}else{
					$d['image_name'] = ORIGINAL_SITE_URL.'images/no-img-list.jpg';
				}
				$result['data'][] = $d;
			}
		}
		//$result['data'] = $data;
		
		return $result;
	}
	
	public function edit(){
		$this->data = array();
		$this->load->view('products/edit');
	}
	
	public function get_details()
	{
		$product_id		= $this->uri->segment(3,0);
		$data_info		= array();
		$data_info['code']	= 0;
		$data_info['data']	= array(); 
		$products_details	= $this->model_basic->getValues_conditions(PRODUCTS, '', '', "product_id = $product_id");
		$wholesaler_product	= $this->model_basic->getValues_conditions(WHOLESALER_PRODUCT, array('wholesaler_id'), '', "product_id = $product_id");
		
		if(is_array($products_details))
		{
			$data_info['code'] = 1;
			$products_details[0]['product_description'] = stripslashes($products_details[0]['product_description']);
			$products_details[0]['product_name'] = stripslashes($products_details[0]['product_name']);
			$data_info['data'] = $products_details[0];
			$data_info['data']['category_id'] = explode(',',$products_details[0]['category_id']);
			
			$data_info['data']['retailer_id'] = array();
			$i	= 0;
			if(is_array($wholesaler_product)){
				foreach($wholesaler_product as $wsp)
				{
					$data_info['data']['retailer_id'][$i] = $wsp['wholesaler_id'];
					$i++;
				}
			}
			
		}
		
		$data_info['data']['category'] = $this->model_basic->getValues_conditions(CATEGORY, array('category_name','category_id'), '','category_status = "Active"');
		
		$data_info['data']['wholesalers'] = $this->model_basic->getValues_conditions(WHOLESALER, array('wholesaler_id',"REPLACE(wholesaler_name, '\\\', '') as wholesaler_name"), '','','wholesaler_name', 'ASC');
		
		$data_info['data']['product_type_list'] = $this->model_basic->getValues_conditions(PRODUCT_TYPE, array('id',"REPLACE(type_name, '\\\', '') as type_name"), '','','type_name', 'ASC');
		
		echo json_encode($data_info);
		exit();
		
	}
	
	
	
	public function edit_product_action()
	{
		
		
		$respons= array();
		$product_id 		= $this->input->post('product_id');
		$product_sku 		= $this->input->post('product_sku');
		$product_type 		= $this->input->post('product_type');
		$product_name 		= addslashes(trim($this->input->post('product_name')));
		$product_description 	= addslashes(trim($this->input->post('product_description')));
		$product_item_count 	= trim($this->input->post('product_item_count'));
		$product_status 	= trim($this->input->post('product_status'));
		$product_manufactured_qty = trim($this->input->post('product_manufactured_qty'));
		$product_inventory_qty 	= trim($this->input->post('product_inventory_qty'));
		$product_reorder_status = trim($this->input->post('product_reorder_status'));
		$product_reorder_qty 	= trim($this->input->post('product_reorder_qty'));
		$product_price 		= trim($this->input->post('product_price'));
		$is_featured 		= trim($this->input->post('is_featured'));
		$any_retailer 		= trim($this->input->post('any_retailer'));
		$retailer 		= array();
		if($any_retailer=='No' and array_key_exists('product',$_POST) and array_key_exists('retailer',$_POST['product'])){
			
			$retailer = $_POST['product']['retailer'];
		}
		if($any_retailer=='No' and count($retailer)==0){
			$respons['code']	 = 0;
			$respons['msg'] 	 = 'Please select any retailer';
			echo json_encode($respons);
			exit;
		}
		
		$categories = array();
		if(array_key_exists('product',$_POST) and array_key_exists('categories',$_POST['product'])){
			$categories = $_POST['product']['categories'];
		}
		if(count($categories)==0){
			$respons['code']	 = 0;
			$respons['msg'] 	 = 'Please select any category';
			echo json_encode($respons);
			exit;
		}
		
		$update_arr 	= array(
					'product_name'		=> $product_name,
					'product_type'		=> $product_type,
					'product_description'	=> $product_description,
					'item_count'		=> $product_item_count,
					'category_id'		=> implode(',',$categories),
					'manufactured_qty'	=> $product_manufactured_qty,
					'inventory_qty'		=> $product_inventory_qty,
					'auto_reorder'		=> $product_reorder_status,
					'auto_reorder_qty'	=> $product_reorder_qty,
					'price'			=> $product_price,
					'is_featured'		=> $is_featured,
					'any_retailer'		=> strtolower($any_retailer),
					'product_status'	=> $product_status
					);
		
		$idArr = array('product_id'=>$product_id);
		$this->model_basic->updateIntoTable(PRODUCTS,$idArr,$update_arr);
		
		/*** Delete and Insert Wholesaler Product ***/
		$this->model_basic->deleteData(WHOLESALER_PRODUCT, " product_id = '".$product_id."'");
		foreach($retailer as $ws)
		{
			$insertArr = array(
					   'wholesaler_id'	=> $ws,
					   'product_id'		=> $product_id
					   );
			//pr($insertArr,0);
			$this->model_basic->insertIntoTable(WHOLESALER_PRODUCT, $insertArr);
		}
		
		$respons['code']	 = 1;
		$respons['msg'] 	 = 'Product is updated successfully';
		echo json_encode($respons);
		exit;
	}
	
	
	
	public function get_new_product_data(){
		$new_sku_no = $this->model_basic->getValue_condition(PRODUCTS, 'MAX(product_sku)', 'max_product_id','');
		if($new_sku_no==false){
			$new_sku_no = 100001;
		}else{
			$new_sku_no = ($new_sku_no+1);
		}
		$data['category'] = $this->model_basic->getValues_conditions(CATEGORY, array('category_name','category_id'), '','category_status = "Active"');
		$data['new_sku_code'] = $new_sku_no;
		
		$data['wholesalers'] = $this->model_basic->getValues_conditions(WHOLESALER, array('wholesaler_id',"REPLACE(wholesaler_name, '\\\', '') as wholesaler_name"), '','','wholesaler_name', 'ASC');
		
		$data['product_type_list'] = $this->model_basic->getValues_conditions(PRODUCT_TYPE, array('id',"REPLACE(type_name, '\\\', '') as type_name"), '','','type_name', 'ASC');
		echo json_encode($data);
	}
	
	public function add_product(){
		$this->data = array();
		
		$this->load->view('products/add');
	}
	
	public function add_product_action(){
		$respons= array();
		$product_sku 		= $this->input->post('product_sku');
		$product_type 		= addslashes(trim($this->input->post('product_type')));
		$product_name 		= addslashes(trim($this->input->post('product_name')));
		$product_description 	= addslashes(trim($this->input->post('product_description')));
		$product_item_count 	= trim($this->input->post('product_item_count'));
		$product_status 	= trim($this->input->post('product_status'));
		$product_manufactured_qty = trim($this->input->post('product_manufactured_qty'));
		$product_inventory_qty 	= trim($this->input->post('product_inventory_qty'));
		$product_reorder_status = trim($this->input->post('product_reorder_status'));
		$product_reorder_qty 	= trim($this->input->post('product_reorder_qty'));
		$product_price 		= trim($this->input->post('product_price'));
		$any_retailer 		= trim($this->input->post('any_retailer'));
		$retailer 		= array();
		if($any_retailer=='No' and array_key_exists('product',$_POST) and array_key_exists('retailer',$_POST['product'])){
			
			$retailer = $_POST['product']['retailer'];
		}
		if($any_retailer=='No' and count($retailer)==0){
			$respons['code']	 = 0;
			$respons['msg'] 	 = 'Please select any retailer';
			echo json_encode($respons);
			exit;
		}
		$categories = array();
		if(array_key_exists('product',$_POST) and array_key_exists('categories',$_POST['product'])){
			$categories = $_POST['product']['categories'];
		}
		if(count($categories)==0){
			$respons['code']	 = 0;
			$respons['msg'] 	 = 'Please select any category';
			echo json_encode($respons);
			exit;
		}
		
		$insert_arr 	= array(
					'product_sku'		=> $product_sku,
					'product_type'		=> $product_type,
					'product_name'		=> $product_name,
					'product_slug'		=> $this->model_basic->create_unique_slug($product_name,PRODUCTS,'product_slug'),
					'product_description'	=> $product_description,
					'item_count'		=> $product_item_count,
					'category_id'		=> implode(',',$categories),
					'manufactured_qty'	=> $product_manufactured_qty,
					'inventory_qty'		=> $product_inventory_qty,
					'auto_reorder'		=> $product_reorder_status,
					'auto_reorder_qty'	=> $product_reorder_qty,
					'price'			=> $product_price,
					'any_retailer'		=> strtolower($any_retailer),
					'product_status'	=> $product_status,
					'added_on'		=> date('Y-m-d H:i:s')
					);
		$insert_id = $this->model_basic->insertIntoTable(PRODUCTS,$insert_arr);
		
		foreach($retailer as $ws)
		{
			$insertArr = array(
					   'wholesaler_id'	=> $ws,
					   'product_id'		=> $insert_id
					   );
			
			$this->model_basic->insertIntoTable(WHOLESALER_PRODUCT, $insertArr);
		}
		
		$respons['code']	 = 1;
		$respons['msg'] 	 = 'Product is added successfully';
		echo json_encode($respons);
		exit;
	}
	
	
	public function delete(){
		$product_id	= $this->input->post('pId');
		$this->model_basic->deleteData(PRODUCT_IMAGES, 'product_id = "'.$product_id.'"');
		$this->model_basic->deleteData(PRODUCTS, 'product_id = "'.$product_id.'"');
		echo 1;
		exit;
	}
	
	public function images(){
		$this->data = array();
		$this->load->view('products/images');
	}
	
	public function get_product_images(){
	   $product_id = $this->input->post('pId');	
	   $images = $this->model_basic->getValues_conditions(PRODUCT_IMAGES, array('image_id','image_name'), '','product_id = "'.$product_id.'"');
	   $data =array();
	   //pr($images);
	   if(is_array($images)){
		foreach($images as $i){
			$file_size =  filesize(FILE_UPLOAD_ABSOLUTE_PATH.'product/'.$i['image_name']);
			$data[]=array(
				    'image_name'	=>$i['image_name'],
				    'image_url'		=>ORIGINAL_SITE_URL.'upload/product/'.$i['image_name'],
				    'image_id'		=>$i['image_id'],
				    'image_size'	=> $file_size
				    );
		}
	   }
	   echo json_encode($data);
	   exit;
	}
	
	
	
	public function remove_product_images(){
		$imgId	= $this->input->post('imgId');
		$pId	= $this->input->post('pId');
		$image_data = $this->model_basic->getValues_conditions(PRODUCT_IMAGES, array('image_id','image_name'), '','image_id = "'.$imgId.'"');
		
		@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'product/'.$image_data[0]['image_name']);
		@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'product/thumb/'.$image_data[0]['image_name']);
		@unlink(FILE_UPLOAD_ABSOLUTE_PATH.'product/thumb2/'.$image_data[0]['image_name']);
		
		$res 	= $this->model_basic->deleteData(PRODUCT_IMAGES, 'product_id = "'.$pId.'" and image_id = "'.$imgId.'"');
		$images = $this->model_basic->getValues_conditions(PRODUCT_IMAGES, array('image_id','image_name'), '','product_id = "'.$pId.'"');
		$data =array();
		if(is_array($images)){
		     foreach($images as $i){
			     $file_size =  filesize(FILE_UPLOAD_ABSOLUTE_PATH.'product/'.$i['image_name']);
			     $data[]=array(
					 'image_name'	=>$i['image_name'],
					 'image_url'	=>ORIGINAL_SITE_URL.'upload/product/'.$i['image_name'],
					 'image_id'	=>$i['image_id'],
					 'image_size'	=> $file_size
					 );
		     }
		}
		echo json_encode($data);
	        exit;
	}
	
	public function uploadImage(){
		if ( !empty( $_FILES ) ) {
			$product_id  = $this->uri->segment(3,0);
			$productDetails = $this->model_basic->getValues_conditions(PRODUCTS, '',  '', 'product_id='.$product_id);
			$maxImg = $this->model_basic->getValues_conditions(PRODUCT_IMAGES, array('MAX(image_id) as max_img_id'),  '', 'product_id='.$product_id);
			//pr($maxImg,0);
			$path_info = pathinfo($_FILES[ 'file' ][ 'name' ]);
			
			if(!is_array($maxImg)){
				$count =1;
			}else{
				$count = $maxImg[0]['max_img_id']+1;
			}
			$productsku = $productDetails[0]['product_sku'];
			$tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
			$image_name = $productsku.'-'.$count.'.'.$path_info['extension'];
			$uploadPath = FILE_UPLOAD_ABSOLUTE_PATH .'product/'. $image_name;
		    
			move_uploaded_file( $tempPath, $uploadPath );
			
			
//                                $upload_config['field_name']				= 'file';
//				$upload_config['file_upload_path'] 			= FILE_UPLOAD_ABSOLUTE_PATH.'product/';
//				$upload_config['max_size']				= '';
//				$upload_config['max_width']				= '';
//				$upload_config['max_height']				= '';
//				$upload_config['allowed_types']				= '*';
//                                
//                                $thumb_config['thumb_create']                           = true;
//                                $thumb_config['thumb_file_upload_path']                 = 'thumb/';
//                                $thumb_config['thumb_width']                            = '150';
//                                $thumb_config['thumb_height']                           = '150';
//				
//                                
//                                $image_name = image_upload($upload_config,$thumb_config);
			
			$source_image_path = FILE_UPLOAD_ABSOLUTE_PATH.'product/'.$image_name;
			
			$thumb_path = FILE_UPLOAD_ABSOLUTE_PATH.'product/thumb/'.$image_name;
			$this->generate_image_thumbnail($source_image_path,$thumb_path,'150','150');
			
			$thumb_path = FILE_UPLOAD_ABSOLUTE_PATH.'product/thumb2/'.$image_name;
			$this->generate_image_thumbnail($source_image_path,$thumb_path,'82','82');
		    
			$answer = array( 'answer' => 'File transfer completed' );
			$json = json_encode( $answer );
		    
		       
			$insert_arr = array(
					    'product_id' => $product_id,
					    'image_name' => $image_name,
					    'image_status'=> 'Active'
					    );
			$this->model_basic->insertIntoTable(PRODUCT_IMAGES,$insert_arr);
			echo $json;
		    
		    } else {
		    
			echo 'No files';
		    
		    }
	}
	
	
	function generate_image_thumbnail($source_image_path, $thumbnail_image_path,$max_width=100,$max_height=100)
	{
		//define('$max_width', 82);
		//define('$max_height', 82);

	    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
	    switch ($source_image_type) {
		case IMAGETYPE_GIF:
		    $source_gd_image = imagecreatefromgif($source_image_path);
		    break;
		case IMAGETYPE_JPEG:
		    $source_gd_image = imagecreatefromjpeg($source_image_path);
		    break;
		case IMAGETYPE_PNG:
		    $source_gd_image = imagecreatefrompng($source_image_path);
		    break;
	    }
	    if ($source_gd_image === false) {
		return false;
	    }
	    $source_aspect_ratio = $source_image_width / $source_image_height;
	    $thumbnail_aspect_ratio = $max_width / $max_height;
	    if ($source_image_width <= $max_width && $source_image_height <= $max_height) {
		$thumbnail_image_width = $source_image_width;
		$thumbnail_image_height = $source_image_height;
	    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
		$thumbnail_image_width = (int) ($max_height * $source_aspect_ratio);
		$thumbnail_image_height = $max_height;
	    } else {
		$thumbnail_image_width = $max_width;
		$thumbnail_image_height = (int) ($max_width / $source_aspect_ratio);
	    }
	    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
	    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
	
	    $img_disp = imagecreatetruecolor($max_width,$max_width);
	    $backcolor = imagecolorallocate($img_disp,0,0,0);
	    imagefill($img_disp,0,0,$backcolor);
	
		imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));
	
	    imagejpeg($img_disp, $thumbnail_image_path, 90);
	    imagedestroy($source_gd_image);
	    imagedestroy($thumbnail_gd_image);
	    imagedestroy($img_disp);
	    return true;
	}
	
	public function addProductQty(){
		
		$product_id  	= $this->input->post('pId');
		$qty 		= $this->input->post('qty');
		$productDetails = $this->model_basic->getValues_conditions(PRODUCTS, '',  '', 'product_id='.$product_id);
		$update_arr 	= array(
					'manufactured_qty'	=> $productDetails[0]['manufactured_qty']+$qty,
					'inventory_qty'		=> $productDetails[0]['inventory_qty']+$qty
					);
		$idArr 		= array('product_id'=>$product_id);
		$this->model_basic->updateIntoTable(PRODUCTS,$idArr,$update_arr);
		echo json_encode($update_arr);
	}
	
	
	
}