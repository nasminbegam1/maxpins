<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_basic extends CI_Model
{
	
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getValue_condition($TableName, $FieldName, $AliasFieldName='', $Condition=''){	
		if($Condition == "") {
			$Condition = "";
		} else {
			$Condition = " WHERE ".$Condition;
		}
		
		if($AliasFieldName == ''){
			$getField = $FieldName;
		}
		else{
			$getField = $AliasFieldName;
			$FieldName = $FieldName ." AS ".$AliasFieldName;
		}
				
		$sql = "SELECT ".$FieldName." FROM ".$TableName.$Condition;
		
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec = $rs->row();
			
			if(is_numeric($rec->$getField))
			{
				if($rec->$getField > 0)
					return $rec->$getField;
				else
					return "0";
			}
			else{
				return $rec->$getField;
			}
		}else{
			return false;
		}
	}
	
	
	public function isRecordExist($tableName = '', $condition = '', $idField = '', $idValue = ''){
		if($condition == '') $condition = 1;
		
		$sql = "SELECT COUNT(*) as CNT FROM ".$tableName." WHERE ".$condition."";
		
		if($idValue > 0 && $idValue <> '')
		{
			$sql .=" AND ".$idField." <> '".$idValue."'";
		}
		
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$rec = $rs->row();
		$cnt = $rec->CNT;

		return $cnt;
	}
	
	
	public function populateDropdown($idField, $nameField, $tableName, $condition='', $orderField, $orderBy)
	{
		$conditionWhere = '';
		if($condition != '') {
			$conditionWhere = " AND ".$condition;
		}
		$sql = "SELECT ".$idField.", ".$nameField." FROM ".$tableName." WHERE 1 ".$conditionWhere." ORDER BY ".$orderField." ".$orderBy."";
		$rs = $this->db->query($sql);

		if($rs->num_rows())
		{
			$rec = $rs->result_array();
			return $rec;			
		}
			
		return false;
	}
	
	
	public function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL) {
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;

		if($key)$params["$key !="] = $value;
		while ($t->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			$params [$field] = $slug;
		}
		return $slug;
	}
	
	
	public function getValues_conditions($TableName, $FieldNames='', $AliasFieldName = '', $Condition='', $OrderBy='', $OrderType='', $Limit=0)
	{
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    if($FieldNames && is_array($FieldNames))
		$select = implode(",", $FieldNames);
	    
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
    
	    if($OrderBy != '')
	    {
		$sql .= " ORDER BY ".$OrderBy." ".$OrderType;
	    }
	    if($Limit > 0 )
	    {
		$sql .= " LIMIT 0, $Limit";
	    }
	    //echo $sql;
	    $rec = FALSE;
	    $rs = $this->db->query($sql);
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

    
    	
	public function get_settings( $id = '' ){
		$sql = "SELECT sitesettings_id, sitesettings_name, sitesettings_value FROM lp_sitesettings WHERE sitesettings_id in (".$id.") ";
		//echo $sql; exit;
		$query = $this->db->query($sql);
		$rec = false;
		if ($query->num_rows() > 0){
		    foreach ($query->result_array() as $row){
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];
		    }
		    //pr($rec);
		    return $rec;
		}
		return false;
 	}
	
	
	public function deleteData($table, $where) {
		$sql	= "DELETE FROM ".$table." WHERE ".$where;
		$rec 	= $this->db->query($sql);
		return $rec;
	}


	public function insertIntoTable($tableName,$insertArr){
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if( $insertArr && is_array($insertArr) ){
			$this->db->insert($tableName, $insertArr);
			//echo $this->db->last_query(); die;
			$ret = $this->db->insert_id(); 
		}
		
		return $ret;
	}
	
	public function updateIntoTable($tableName, $idArr, $updateArr)
	{
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		if( $updateArr && is_array($updateArr) )
		{
			$this->db->update($tableName, $updateArr, $idArr);
			$ret = $this->db->affected_rows();
		}
		//echo $this->db->last_query();
		return $ret;
	}	


	public function checkRowExists($tableName, $whereArr){ // WhereArr = array('fieldname1'=>'fieldvalue1','fieldname2'=>'fieldvalue2');		
		$this->db->where($whereArr);
		$query = $this->db->get($tableName);
		//echo $query->num_rows();
		//echo $this->db->last_query();exit();
		//if ($query->num_rows() > 0){
		//    return 0;
		//}else{
		//    return 1;
		//}
		
		return $query->num_rows();
	}

	public function changeStatus($tableName, $pagearray, $setfieldName, $fieldStatus, $updateFieldName){ 
		$error		= false;		
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($pagearray)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){			
			$sql = "UPDATE ".$tableName."
				SET ".$setfieldName." = '".$fieldStatus."'
				WHERE FIND_IN_SET(".$updateFieldName.", '".implode(",", $pagearray)."')";
			$this->db->query($sql);
		}
		if($fieldStatus == 'active') {
			return 'deactive';	
		} else {
			return 'active';	
		}
	}
	


	public function getFromWhereSelect($TableName, $FieldNames='', $Condition='')
	{
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    if($FieldNames && $FieldNames!= '')
		$select = $FieldNames;
	    
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition; 
	   // echo $sql;
	    $rec = FALSE;
	    $rs = $this->db->query($sql);
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
	
	public function getOrderDetails($wid, $order_slug){
		$rec		= false;
		$result		= false;
		
		$sql	= "SELECT ODD.* FROM " . ORDER_DETAILS . " AS ODD INNER JOIN " . ORDERS . " AS OD ON ODD.order_master_id = OD.id WHERE OD.wholesaler_id = '" . $wid . "' AND OD.order_slug = '" . $order_slug . "'";
		$query	= $this->db->query($sql);
		if($query->num_rows() > 0){
			$rec	= $query->result_array();
			if(is_array($rec) && count($rec) > 0){
				for($i=0; $i<count($rec); $i++){
					$sql	= "SELECT product_name, product_slug FROM " . PRODUCTS . " WHERE product_id = '" . $rec[$i]['product_id']. "'";
					$query	= $this->db->query($sql);
					if($query->num_rows() > 0){
						$rec2	= $query->row_array();
						$rec[$i]['product_name'] = $rec2['product_name'];
						$rec[$i]['product_slug'] = $rec2['product_slug'];
					}else{
						$rec[$i]['product_name'] = '';
						$rec[$i]['product_slug'] = '';
					}
					
					$rec[$i]['product_price'] = number_format($rec[$i]['product_price'],2);
					$rec[$i]['total_price'] = number_format($rec[$i]['total_price'],2);
				}
				$result['data']	= $rec;
			}
		}
		
		$sql	= "SELECT COALESCE(SUM(ODD.total_price),0) AS grand_total, COALESCE(SUM(ODD.product_quantity),0) AS grand_qty, SUM(ODD.product_price) AS tot_product_price FROM " . ORDER_DETAILS . " AS ODD INNER JOIN " . ORDERS . " AS OD ON ODD.order_master_id = OD.id WHERE OD.wholesaler_id = '" . $wid . "'  AND OD.order_slug = '" . $order_slug . "'";
		$query	= $this->db->query($sql);
		if($query->num_rows() > 0){
			$rec	= $query->row_array();
			if(is_array($rec) && count($rec) > 0){
				$result['ord_qty']	= $rec['grand_qty'];
				$result['ord_total']	= $rec['grand_total'];
				$result['price_total']	= $rec['tot_product_price'];
			}else{
				$result['ord_qty']	= 0;
				$result['ord_total']	= 0;
				$result['price_total']	= 0;
			}
			$result['ord_total'] = number_format($result['ord_total'],2);
			$result['price_total'] = number_format($result['price_total'],2);
			
		}
		
		return $result;
	}

}