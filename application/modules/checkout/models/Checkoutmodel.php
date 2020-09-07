<?PHP
 class Checkoutmodel  extends CI_Model {
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
	
	function getRecords($get) 
	{
		//echo "here...<br/>";
		//print_r($get);
		$table               = "tbl_products";
		$table_id            = 'i.product_id';
		$default_sort_column = 'i.product_id';
		$default_sort_order  = 'desc';
		$condition = "1=1";
		
		$colArray  = array('c.category_name','i.product_name','i.product_code','i.stock_status','i.status');
			
		$page  = $get['iDisplayStart']; // iDisplayStart starting offset of limit funciton
		$rows  = $get['iDisplayLength']; // iDisplayLength no of records from the offset
		
		//sort order by column
		$sort  = isset($get['iSortCol_0']) ? strval($colArray[$get['iSortCol_0']]) : $default_sort_column;
		$order = isset($get['sSortDir_0']) ? strval($get['sSortDir_0']) : $default_sort_order;
    
		for ($i = 0; $i < 3; $i++) 
		{
			if (isset($get['sSearch_' . $i]) && $get['sSearch_' . $i] != '') 
			{   
				$condition .= " AND $colArray[$i] like '%" . $_GET['sSearch_' . $i] . "%'";
			}
		}
	
		//echo "condition ".$condition;exit;
		// $this->db->select('i.*,c.category_name,s.subcategory_name');
		$this->db->select('i.*,c.category_name');
		$this->db->from('tbl_products as i');
		$this->db->join('tbl_categories as c', 'i.category_id  = c.category_id', 'left');
		// $this->db->join('tbl_subcategories as s', 'i.subcategory_id  = s.subcategory_id', 'left');
    
		$this->db->where("($condition)");
		$this->db->order_by($sort, $order);
		$this->db->limit($rows, $page);
		$query = $this->db->get();
		$this->db->select('i.*,c.category_name');
		$this->db->from('tbl_products as i');
		$this->db->join('tbl_categories as c', 'i.category_id  = c.category_id', 'left');
		// $this->db->join('tbl_subcategories as s', 'i.subcategory_id  = s.subcategory_id', 'left');
  
		$this->db->where("($condition)");
		$this->db->order_by($sort, $order);
		$query1 = $this->db->get();
		
		if ($query->num_rows() >= 1) 
		{
			$totcount = $query1->num_rows();
			return array("query_result" => $query->result(),"totalRecords" => $totcount);
		} 
		else 
		{
			return array("totalRecords" => 0);
		}
	}
	function getExportRecords($get)
	{
		// echo "<pre>";
		// print_r($get);
		// echo $get['sSearch_0'];
		// exit;
		$table = "tbl_products";
		$table_id = 'i.product_id';
		$default_sort_column = 'i.product_id';
		$default_sort_order = 'desc';
		$condition = "1=1";
		
		$colArray = array('c.category_name','s.subcategory_name','i.product_name','i.product_code');
		$searchArray = array('c.category_name','s.subcategory_name','i.product_name','i.product_code');
		
		// sort order by column
		$sort = $default_sort_column;  
		$order = $default_sort_order;
		
		for($i=0;$i<4;$i++)
		{
			if(isset($get['sSearch_'.$i]) && $get['sSearch_'.$i]!='')
			{
				$condition .= " AND $colArray[$i] like '%".$get['sSearch_'.$i]."%'";
			}
		}
		
		// echo "condition ".$condition;exit;
		
		// $this -> db -> select('i.*,c.category_name,s.subcategory_name,v.full_name,d.designer_name,ss.subsubcategory_name');
		$this -> db -> select('i.*,c.category_name,s.subcategory_name');
		$this -> db -> from('tbl_products as i');
		$this -> db -> join('tbl_categories as c', 'i.category_id  = c.category_id', 'left');
		$this -> db -> join('tbl_subcategories as s', 'i.subcategory_id  = s.subcategory_id', 'left');
		$this->db->where("($condition)");
		$this->db->order_by($sort, $order);	
		$query = $this -> db -> get();
		// print_r($this->db->last_query());
		// exit;
		if($query -> num_rows() >= 1)
		{
			$totcount = $query -> num_rows();
			return array("query_result" => $query->result(), "totalRecords" => $totcount);
		}
		else
		{
			return array("totalRecords" => 0);
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
	
	// function getFormdata($ID) 
	// {
	// 	$condition = "1=1 AND i.product_id='" . $ID . "' ";
	// 	$this->db->select('i.*, c.category_name, s.subcategory_name');
	// 	$this->db->from('tbl_products as i');
	// 	$this->db->join('tbl_categories as c', 'i.category_id  = c.category_id', 'left');
	// 	$this->db->join('tbl_subcategories as s', 'i.subcategory_id  = s.subcategory_id', 'left');
     
	// 	$this->db->where("($condition)");
	// 	$query = $this->db->get();
	// 	//print_r($this->db->last_query());
	// 	//exit;
	// 	if ($query->num_rows() >= 1) 
	// 	{
	// 		return $query->result();
	// 	} 
	// 	else 
	// 	{
	// 		return false;
	// 	}
 //    }
    function getFormdata($ID){
		// $this -> db -> select('s.*, p.product_code, p.link, p.product_name, p.short_description, p.product_base_price, p.product_tax_amount, p.tax_percentage, p.product_final_price, p.stock_status, i.product_thumbnail_image as imagename, c.color_name');
		$this -> db -> select('s.*');
		$this -> db -> from('tbl_order_details as s');
		$this -> db -> where('order_id',$ID);
		// $this -> db -> order_by('i.default', "DESC");
		$query = $this -> db -> get();
		
		 // echo $this->db->last_query();
		 // exit;
		
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

    function getshippingprice($condition){

        $this->db->select('pm.*,p.*');
		$this->db->from('tbl_pincode as p');
		$this->db->join('tbl_shipping_amount_map as pm', 'p.pincode_id  = pm.pincode_id', 'left');
		// $this->db->join('tbl_subcategories as s', 'i.subcategory_id  = s.subcategory_id', 'left');
     
		$this->db->where("($condition)");
		$query = $this->db->get();
		//print_r($this->db->last_query());
		//exit;
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
	
		function getData_std($table, $condition = '1=1', $select = "*") 
	{
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where("($condition)");
		$query = $this->db->get();
		// echo $this->db->last_query();
		// exit;
		if($query->num_rows() >= 1) 
		{
			return $query->result();
		} 
		else 
		{
			
			return false;
		}
	}
	
	
	/* used while export product */
	function getProductColors($product_id)
	{
		$condition = "1=1 AND i.product_id='".$product_id."' ";
		$this -> db -> select('c.color_name, i.product_quantity');
		$this -> db -> from('tbl_product_colors as i');
		$this -> db -> join('tbl_colors as c', 'c.color_id = i.color_id', 'left');
		
		$this->db->where("($condition)");
		$query = $this -> db -> get();
	   
		//print_r($this->db->last_query());
		//exit;
	   
		if($query -> num_rows() >= 1)
		{
			return $query->result();
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
	function checkToCart($item_id){
		
		$this->db->select('*');
		$this->db->from('tbl_cart');
		$this->db->where('customer_cart_session',$_SESSION['cart_id']);
		$this->db->where('item_id',$item_id);
	
		// $this->db->where('cart_type',1);
		$query = $this->db->get();
		// print_r($query)
		if($query->num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
		
	}
	function updateCart($item_id,$qty,$total_price,$updatedweight,$category_id){
		$cgst =(($total_price*2.5)/100);
		$sgst = (($total_price*2.5)/100);
		$data = array( 
		    'item_qty'      => $qty , 
		    'item_total' => $total_price,
		    'cgst'=>$cgst,
		    'sgst'=>$sgst,
		    'weight'=>$updatedweight,
		    'grand_total'=>$total_price+$cgst+$sgst
		);
		$this->db->where('item_id', $item_id);
		$this->db->where('customer_cart_session',$_SESSION['cart_id']);
		
		 if($this->db->update('tbl_cart', $data))
	      {
	        return true;
	      }
	      else
	      {
	        return false;
	      }

	}
	function addTocart($item_id,$qty,$item_price,$default_weight,$category_id){
		$total_price =  $qty * $item_price;
		$cgst =(($total_price*2.5)/100);
		$sgst = (($total_price*2.5)/100);
		$data = array(
        'customer_cart_session' => $_SESSION['cart_id'],
        'item_id' => $item_id,
        'category_id'=>$category_id,
        'weight'=>$default_weight,
        'item_qty' => $qty,
		'item_unit_price'=>$item_price,
		'item_total' => $total_price,
		'cgst'=>$cgst,
		'sgst'=>$sgst,
		'grand_total'=>$total_price+$cgst+$sgst,
		'user_id' => (!empty($_SESSION['chheda_front'][0]->user_id)? $_SESSION['chheda_front'][0]->user_id:0),
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
    	$this->db->select("ca.*,p.*");
    	$this->db->from("tbl_cart as ca");
    	$this->db->join("tbl_products as p","p.product_id = ca.item_id","left");
    	
    	if(!empty($_SESSION["cart_id"])){
			$this->db->where('customer_cart_session',$_SESSION['cart_id']);
			// $this->db->where('user_id',$_SESSION["chheda_front"][0]->user_id);	
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
