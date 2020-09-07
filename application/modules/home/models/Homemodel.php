<?PHP
 class Homemodel  extends CI_Model {
	function insertData($tbl_name, $data_array, $sendid = NULL) 
	{
		$this->db->insert($tbl_name, $data_array);
		//print_r($this->db->last_query());
		//exit;
		$result_id = $this->db->insert_id();
		if ($sendid == 1) 
		{
			return $result_id;
		}
	}
	
    function updateRecord($tableName, $data, $condition = "") 
	{
		if(!empty($condition))
		{
			$this->db->where("($condition)");
		}
		
		//print_r($this->db->last_query());
		//exit;
		if($this->db->update($tableName, $data)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	
	   
	function getDropdown($tbl_name, $tble_flieds, $condition = "", $sort_by = "", $sort_order = "") 
	{
		$this->db->select($tble_flieds);
		$this->db->from($tbl_name);
		if(!empty($condition))
		{
			$this->db->where($condition);
		}
		if(!empty($sort_by) && !empty($sort_order))
		{
			$this->db->order_by($sort_by, $sort_order);
		}
		$query = $this->db->get();
		if ($query->num_rows() >= 1) 
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}
	}

	function getDropdownSelval($tbl_name, $tble_flieds, $tbl_id, $rec_id = NULL, $join_tbl = "", $join_on = "", $join = "left") 
	{
		$this->db->select($tble_flieds);
		$this->db->from($tbl_name);
		
		if(!empty($join) &&!empty($join_tbl) && !empty($join_on))
		{
			$this->db->join($join_tbl, $join_on, $join);
		}
		
		if(!empty($tbl_id) && !empty($rec_id))
		{
			$this->db->where($tbl_id, $rec_id);
		}
		$query = $this->db->get();
		
		// print_r($this->db->last_query());
		// exit;
		
		if ($query->num_rows() >= 1) 
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}	
	}
   
	function getdata($table, $condition = '1=1', $select = "*") 
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where("($condition)");
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit;
		if($query->num_rows() >= 1) 
		{
			return $query->result_array();
		} 
		else 
		{
			
			return false;
		}
	}
	
	function delrecord($tbl_name, $tbl_id, $record_id) 
	{
		$this->db->where($tbl_id, $record_id);
		if($this->db->delete($tbl_name)) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	/*
		 * Fetch records from multiple tables [Join Queries] with multiple condition, Sorting, Limit, Group By
	*/
	function JoinFetch($main_table = array(), $join_tables = array(), $condition = null, $sort_by = null, $group_by = null, $limit = null) {
		$columns = isset($main_table[1]) ? $main_table[1] : array();
		$main_table = $main_table[0];

		$join_str = "";
		foreach ($join_tables as $join_table) {
			$join_str .= $join_table[0] . " JOIN " . $join_table[1] . " ON (" . $join_table[2] . ") ";
			if (isset($join_table[3])) {
				$columns = array_merge($columns, $join_table[3]);
			}
		}
												
		$columns = (sizeof($columns) > 0) ? implode(", ", $columns) : "*";

		if (is_null($condition) || $condition == "") {
			$condition = "1=1";
		}
										
		$sort_order = "";
		if (is_array($sort_by) && $sort_by != null) {
			foreach ($sort_by as $key => $val) {
				$sort_order .= ($sort_order == "") ? "ORDER BY $key $val" : ", $key $val";
			}
		}
														
		if ($group_by != null) {
			$group_by = " GROUP BY " . $group_by;
		}
								
		if ($limit != null) {
			$limit = " LIMIT " . $limit;
		}
				
		//$this->db->query($this->set_timezone_query);
		$sql = trim("SELECT $columns FROM $main_table $join_str WHERE $condition $group_by $sort_order $limit");
		
		// echo $sql.'<br/><br/><br/>';
		// exit;
		$query = $this->db->query($sql);
		return $query;
	}

	/*
		 * Fetch as per the request like [Array,Object,Asscociative Array]
	*/
	function MySqlFetchRow($result, $type = 'assoc') {

		$row = false;
		if ($result != false) {

			switch ($type) {
			case 'array':
				$row = @$result->result_array();
				break;
			case 'object':
				$row = @$result->result();
				break;
			default:
			case 'assoc':
				$row = @$result->row_array();
				break;
			}
		}
		return $row;
	}
	function checkToCart($product_id){
		
		$this->db->select('*');
		$this->db->from('tbl_cart');
		$this->db->where('cart_session',$_SESSION['cart_id']);
		$this->db->where('product_id',$product_id);
		
		$query = $this->db->get();
		// print_r($query)
		if($query->num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
		
	}
	function updateCart($product_id,$qty,$total_price, $product_name, $product_image){
		$data = array( 
		    'quantity'=> $qty , 
		    'total_amount' => $total_price,
			'product_name' => $product_name,
			'product_image' => $product_image
		);
		$this->db->where('product_id', $product_id);
		$this->db->where('cart_session',$_SESSION['cart_id']);
		
		
		 if($this->db->update('tbl_cart', $data))
	      {
	        return true;
	      }
	      else
	      {
	        return false;
	      }

	}
	
	function addTocart($product_id,$qty,$item_price, $product_name, $product_image){
		$total_price =  $qty * $item_price;
		
		$data = array(
			'cart_session' => $_SESSION['cart_id'],
			'product_id' => $product_id,
			'product_name' => $product_name,
			'product_image' => $product_image,
			'product_price'=>$item_price,
			'quantity' => $qty,
			'total_amount' => $total_price,
			'created_on'=>date("Y-m-d H:i:s")
		);
		
		$query = $this->db->insert('tbl_cart', $data);
		
		if(!empty($query) && $query >= 1 ){
			return $this->db->insert_id();
		}else{
			return false;
		}
		
		
	}
	 function getdetailsofcart()
    {
    	// print_r($get);
    	// exit();
    	$this->db->select("ca.*");
    	$this->db->from("tbl_cart as ca");
    	
    	
    	if(!empty($_SESSION["cart_id"])){
			$this->db->where('ca.cart_session',$_SESSION['cart_id']);	
    	}
    	$query=$this->db->get();
    	// echo $this->db->last_query();
    	// exit();
    	if($query->num_rows()>0)
    	{
    		return $query->result_array();
    	}else
    	{
    		return false;
    	}
    }
    
 }
?>
