<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_product extends CI_Model
{
	
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_all_order()
	{
		$sql	= "SELECT OM.*, W.wholesaler_customer_id FROM ".ORDERS." AS OM
			   LEFT JOIN ".WHOLESALER." AS W ON OM.wholesaler_id = W.wholesaler_id"  ;
		
		$query  = $this->db->query($sql);
		$rec 	= FALSE;
		$rs 	= $this->db->query($sql);
		if($rs->num_rows())
		{
				$rec = $rs->result_array();
		}
		else
		{
		    $rec = FALSE;
		}
		return $rec;
	}
	
	public function getList(&$config,&$start, $wholesaler_name, $start_date, $end_date, $payment_status, $shipment_status)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('ORDER_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if(!empty($wholesaler_name)){
			$where	.= ' AND OM.wholesaler_id = "' . $wholesaler_name . '"';
		}

		if(!empty($payment_status)){
			$where	.= ' AND OM.payment_status = "' . $payment_status . '"';
		}
		
		if(!empty($shipment_status)){
			$where	.= ' AND OM.shipping_status = "' . $shipment_status . '"';
		}
		
		if(!empty($start_date)){			
			$start_date_array	= explode("-", $start_date);
			$dd			= $start_date_array[0];
			$mm			= $start_date_array[1];
			$yy			= $start_date_array[2];
			
			if(strlen($mm) == 1){
				$mm = "0" . $mm;
			}
			
			$start_date	= $yy . "-" . $mm . "-" . $dd;
			$where	.= ' AND OM.added_on >= "' . $start_date . '"';
		}
		
		if(!empty($end_date)){			
			$end_date_array		= explode("-", $end_date);
			$dd			= $end_date_array[0];
			$mm			= $end_date_array[1];
			$yy			= $end_date_array[2];
			
			if(strlen($mm) == 1){
				$mm = "0" . $mm;
			}
			
			$end_date	= $yy . "-" . $mm . "-" . $dd . " 23:59:59";
			$where	.= ' AND OM.added_on <= "' . $end_date . '"';
		}		
		
		
		
		$sql	= "SELECT COUNT(*) AS TotalrecordCount FROM ".ORDERS." AS OM
			   LEFT JOIN ".WHOLESALER." AS W ON OM.wholesaler_id = W.wholesaler_id" . $where;
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = ($page-1)*RECORD_PER_PAGE;
		
		$config['start'] = $start;
		$sql	= "SELECT OM.*, DATE_FORMAT(OM.added_on, '%m-%d-%Y') AS added_date, W.wholesaler_customer_id, W.wholesaler_name FROM ".ORDERS." AS OM
			   LEFT JOIN ".WHOLESALER." AS W ON OM.wholesaler_id = W.wholesaler_id" . $where . "
			   ORDER BY OM.added_on DESC LIMIT ".$start.",".$config['per_page'];
			   
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function getOrderTotal(&$config, &$start, $wholesaler_name, $start_date, $end_date, $payment_status, $shipment_status)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('ORDER_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if(!empty($wholesaler_name)){
			$where	.= ' AND OM.wholesaler_id = "' . $wholesaler_name . '"';
		}

		if(!empty($payment_status)){
			$where	.= ' AND OM.payment_status = "' . $payment_status . '"';
		}
		
		if(!empty($shipment_status)){
			$where	.= ' AND OM.shipping_status = "' . $shipment_status . '"';
		}
		
		if(!empty($start_date)){			
			$start_date_array	= explode("-", $start_date);
			$dd			= $start_date_array[0];
			$mm			= $start_date_array[1];
			$yy			= $start_date_array[2];
			
			if(strlen($mm) == 1){
				$mm = "0" . $mm;
			}
			
			$start_date	= $yy . "-" . $mm . "-" . $dd;
			$where	.= ' AND OM.added_on >= "' . $start_date . '"';
		}
		
		if(!empty($end_date)){			
			$end_date_array		= explode("-", $end_date);
			$dd			= $end_date_array[0];
			$mm			= $end_date_array[1];
			$yy			= $end_date_array[2];
			
			if(strlen($mm) == 1){
				$mm = "0" . $mm;
			}
			
			$end_date	= $yy . "-" . $mm . "-" . $dd . " 23:59:59";
			$where	.= ' AND OM.added_on <= "' . $end_date . '"';
		}
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = ($page-1)*RECORD_PER_PAGE;;
		
		$config['start'] = $start;
		$sql	= "SELECT FORMAT(SUM(OM.total_price),2) AS total_price
			   FROM ".ORDERS." AS OM " . $where . "
			   LIMIT ".$start.",".$config['per_page'];
			   
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
	public function getOrderMaster($order_id){
		$rec	= false;
		$sql	= "SELECT OM.*, replace(WM.wholesaler_name,'\\\','') as wholesaler_name , WM.wholesaler_customer_id, WM.wholesaler_billing_address,
			   WM.wholesaler_billing_city, WM.wholesaler_billing_state, WM.wholesaler_billing_zip,
			   SM.method_name, WM.wholesaler_shipping_address, WM.wholesaler_shipping_city,
			   WM.wholesaler_shipping_state, WM.wholesaler_shipping_zip, WM.wholesaler_email, WM.wholesaler_contact,
			   WM.wholesaler_phone, CB.country_name AS billing_country_name, CS.country_name AS shipping_country_name
			   FROM ".ORDERS." AS OM
			   LEFT JOIN ".WHOLESALER." AS WM ON OM.wholesaler_id = WM.wholesaler_id
			   LEFT JOIN ".COUNTRY." AS CB ON WM.wholesaler_billing_country = CB.id
			   LEFT JOIN ".COUNTRY." AS CS ON WM.wholesaler_shipping_country = CS.id
			   LEFT JOIN ".SHIPPINGMETHOD." AS SM ON WM.shipping_method = SM.id
			   WHERE OM.id = '".$order_id."'";
			   
		$query	= $this->db->query($sql);
		
			$rec	= $query->result_array();
		
		return $rec;
	}
	
	public function getOrderDetails($order_id)
	{
		$rec	= false;
		$sql	= "SELECT OD.*, P.product_name, P.product_sku
			   FROM ".ORDER_DETAILS." AS OD
			   LEFT JOIN ".PRODUCTS." AS P ON OD.product_id = P.product_id
			   WHERE OD.order_master_id = '".$order_id."'";
			   
		$query	= $this->db->query($sql);
		
			$rec	= $query->result_array();
		
		return $rec;
	}

	public function getOrdShippingCost($order_id){
		$shipping_cost		= 0;
		$total_qty		= 0;
		$shipping_method	= 0;
		$rec			= false;
		
		$sql		= "SELECT SUM(OD.product_quantity) AS qty
					FROM ".ORDER_DETAILS." AS OD
					WHERE OD.order_master_id = '".$order_id."'";
			   
		$query		= $this->db->query($sql);
		if($query->num_rows() > 0){
			$rec		= $query->row_array();
			$total_qty	= $rec['qty'];
		}
		
		$sql			= "SELECT WS.shipping_method AS shipping_method FROM " . WHOLESALER . " AS WS INNER JOIN " . ORDERS . " AS OM ON WS.wholesaler_id = OM.wholesaler_id WHERE OM.id = '" . $order_id . "'";
		$query			= $this->db->query($sql);
		if($query->num_rows() > 0){
			$rec			= $query->row_array();
			$shipping_method 	= $rec['shipping_method'];
		}
		
		if($total_qty > 0 && $shipping_method > 0){
			$sql	= "SELECT price FROM " . SHIPPINGPRICE . " WHERE " . $total_qty . " BETWEEN lower_qty AND higher_qty";
			$query	= $this->db->query($sql);
			if($query->num_rows() > 0){
				$rec			= $query->row_array();
				$shipping_cost 	= $rec['price'];
			}
		}
		return $shipping_cost;
	}
	
	public function getProductPriceById($pid)
	{
		$rec	= false;
		$sql	= "SELECT price
			   FROM ".PRODUCTS."
			   WHERE product_id = '".$pid."'";
			   
		$query	= $this->db->query($sql);
		
		$rec	= $query->result_array();
		
		return $rec;
	}
	
	public function getShippingPriceByQty($qty,$shipping_method_id)
	{
		$rec	= false;
		$sql	= "SELECT SP.price
			   FROM ".SHIPPING_PRICE." AS SP
			   LEFT JOIN ".SHIPPING_METHOD_MASTER." AS SMM ON SP.shipping_method_id = SMM.id
			   WHERE '".$qty."' BETWEEN SP.lower_qty AND SP.higher_qty
			   AND SP.shipping_method_id = '".$shipping_method_id."'";
			   
		$query	= $this->db->query($sql);
		
		$rec	= $query->result_array();
		
		return $rec;
	}
	
	public function getShippingMethodByWholesalerId($wholesaler_id)
	{
		$rec	= false;
		$sql	= "SELECT SMM.id, SMM.method_name
			   FROM ".SHIPPING_METHOD_MASTER." AS SMM
			   LEFT JOIN ".WHOLESALER." AS W ON SMM.id = W.shipping_method
			   WHERE wholesaler_id = '".$wholesaler_id."'";
			   
		$query	= $this->db->query($sql);
		
		$rec	= $query->result_array();
		
		return $rec;
	}
	
	public function getProductNameById($product_id)
	{
		$rec	= false;
		$sql	= "SELECT product_name
			   FROM ".PRODUCTS." 
			   WHERE product_id = '".$product_id."'";
			   
		$query	= $this->db->query($sql);
		
		$rec	= $query->result_array();
		
		return $rec[0];
	}
}