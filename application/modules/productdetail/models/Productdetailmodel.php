<?PHP
class Productdetailmodel extends CI_Model
{
	function insertData($tbl_name,$data_array,$sendid = NULL)
	 {
	 	/*echo $tbl_name."<br/>";
	 	print_r($data_array);
	 	echo $sendid;
	 	exit;*/
	 	
	 	/*$this->db->where('UserId', $did);
     	$this->db->delete('test_user_roles');*/

     	/*$this->db->where('UserId', $did);
     	$this->db->delete('test_customer_warehouse_details');*/ 
	 	
	 	$this->db->insert($tbl_name,$data_array);
	 	$result_id = $this->db->insert_id();
	 	
	 	/*echo $result_id;
	 	exit;*/
	 	
	 	if($sendid == 1)
	 	{
	 		//return id
	 		return $result_id;
	 	}
	 	
	 	
	 	
	 }

	 function getfeaturedproduct()
	 {
	 	$this->db->select('p.*,pi.imagename');
		$this->db->from('tbl_products as p');
		$this->db->join('tbl_productimages as pi', 'p.product_id  = pi.product_id', 'left');
    	$this->db->where("p.is_featured=1 and p.status='Active'");
    	$this->db->group_by("p.product_id");
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
	 
	 function getdata($table,$select='',$condition ='',$order_by=null,$group_by=null){
	
		$this->db->select("$select");
    	$this->db->from("$table");
		$this->db->where($condition);
		if(!empty($order_by)){
			$this->db->order_by('product_type_size_weight_quantity_id','ASC');
		}
		if(!empty($group_by)){
			$this->db->group_by('product_sizetype');	
		}
    	$query=$this->db->get();
    
    	if($query->num_rows() > 0)
    	{
    		return $query->result_array();
    	}else
    	{
    		return false;
    	}
    }

    function getallproductjoin($table,$condition)
    {
    	$this->db->select("p.*,pi.imagename,pi.product_thumbnail_image");
    	$this->db->from("$table as p");
    	$this->db->join("tbl_productimages as pi","p.product_id= pi.product_id","left");
    	$this->db->where($condition);
    	$this->db->order_by('p.product_name','DESC');
    	$this->db->group_by('p.product_id');	
    	$query=$this->db->get();
    
    	if($query->num_rows() > 0)
    	{
    		return $query->result_array();
    	}else
    	{
    		return false;
    	}
    }

     function getsubproductjoin($get)
    {
    	// print_r($get);
    	// exit();
    	$this->db->select("p.*,pi.imagename");
    	$this->db->from("tbl_products as p");
    	$this->db->join("tbl_productimages as pi","pi.product_id= p.product_id","left");
    	$this->db->where('p.status="Active" and p.category_id="'.$get.'" ');
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
	
         function getActiveSessions(){
             $query = $this->db->query('Select count(*) as total From tbl_session where status="Active"');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
         function getTotalOrders(){
             $query = $this->db->query('Select count(*) as total From tbl_orders where order_status="Complete" AND payment_status="Success"');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
         function getTotalCourseSold(){
             $query = $this->db->query('Select count(Distinct product_id) as total From tbl_shopping_cart c where order_id IN (Select order_id From tbl_orders Where order_status="Complete" AND payment_status="Success") AND product_type = "course"');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
         function getTotalCount($table){
             $query = $this->db->query('Select * From '.$table.' where status="Active"');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
         function getTotalUser(){
             $query = $this->db->query('Select created_on From tbl_users where status="Active"');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
        
          
          function get_customer_of_unread_message($user_id){
            $sql = $this->db->query('Select *
                                     From tbl_messages
                                     Where ((from_id = '.$user_id.' And from_utype = "prof")
                                            OR (to_id = '.$user_id.' And to_utype = "prof"))
                                            And seen = "0"  
                                            
                              ');
            if($sql->num_rows() > 0){
                  return $sql->result_array();
              }else{
                  return false;
              }
          }
         
         
         function getTotalUsers(){
             $query = $this->db->query('Select count(*) as total FROM tbl_users WHERE status = "Active"');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
         function getLatestOrders(){
             $query = $this->db->query('Select * FROM tbl_orders ORDER BY  `order_id` DESC Limit 4');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
         function getUserDetails($user_ids){
             $query = $this->db->query('Select * FROM tbl_users where `user_id` IN('.$user_ids.')');
             if($query->num_rows()>0){
                 return $query->result();
             }
             else{
                 return false;
             }
         }
         
         function getCustomerdata($all_customer_ids){
             $query = $this->db->query('Select * FROM tbl_customers where `customer_id` IN('.$all_customer_ids.')');
             if($query->num_rows()>0){
                 return $query->result_array();
             }
             else{
                 return false;
             }
         }
         
         function get_refer_and_wish($customer_id){
            $query = $this->db->query('Select * FROM tbl_refer_and_wish where user_id='.$this->db->escape($customer_id).' And user_type="customer" And status="Active"');
             if($query->num_rows()>0){
                 return $query->result_array();
             }
             else{
                 return false;
             }
         }
         
	function getCustomer(){
	   
	   $this -> db -> select('*');
	   $this -> db -> from('test_users as u');
	   $this -> db -> join('test_user_roles as r', 'u.UserId = r.UserId', 'left');
	   $this -> db -> where('r.RoleId', '4');
	
	   $query = $this -> db -> get();
	   
	   //print_r($query->result());
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
	
	function getDropdown($tbl_name,$tble_flieds){
	   
	   $this -> db -> select($tble_flieds);
	   $this -> db -> from($tbl_name);
	
	   $query = $this -> db -> get();
	
	   if($query -> num_rows() >= 1)
	   {
	     return $query->result();
	   }
	   else
	   {
	     return false;
	   }
			
	}
	
	function getDropdownSelval($tbl_name,$tbl_id,$tble_flieds,$rec_id=NULL){
		//echo "in condition...";
	   /*echo $tbl_name."<br/>";
	   echo $tbl_id."<br/>";
	   echo $tble_flieds."<br/>";
	   echo $rec_id."<br/>";*/
	   
	   
	   $this -> db -> select($tble_flieds);
	   $this -> db -> from($tbl_name);
	   $this -> db -> where($tbl_id, $rec_id);
	
	   $query = $this -> db -> get();
		
	   //print_r($query->result());
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
	
	function getUsersdata($UserID){
		
	   $this -> db -> select('u.*,r.RoleId');
	   $this -> db -> from('test_users as u');
	   $this -> db -> join('test_user_roles as r', 'u.UserId = r.UserId', 'left');
	   $this -> db -> where('u.UserId', $UserID);
	
	   $query = $this -> db -> get();
	   
	   //print_r($query->result());
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
	
	
	function getUserswarehouse($UserID){
		
	   $this -> db -> select('w.*');
	   $this -> db -> from('test_customer_warehouse_details as w');
	   $this -> db -> where('w.UserId', $UserID);
	
	   $query = $this -> db -> get();
	   
	   //print_r($query->result());
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
	
	
	//Update customer by id
	 function updateProfessional($datar,$eid)
	 {
		 $this -> db -> where('professional_id', $eid);
		 $this -> db -> update('tbl_professional',$datar);
		 
		 if ($this->db->affected_rows() > 0)
			{
			  return true;
			}
		 else
			{
			  return true;
			} 
		 
	 }
   
   function updatereferwish($datar,$eid)
	 {
		 $this -> db -> where('refer_and_wish_id', $eid);
		 $this -> db -> update('tbl_refer_and_wish',$datar);
		 
		 if ($this->db->affected_rows() > 0)
			{
			  return true;
			}
		 else
			{
			  return true;
			} 
		 
	 }
	 
	 function updateUserRole($tbl_name,$role_data,$id){
	 	$this->db->where('UserId', $id);
     	$this->db->delete('test_user_roles');
     	
     	$this->insertData($tbl_name,$role_data);
     	
	 }
	 
   function updatesession($data,$id){
	 	$this->db->where('session_id', $id);
     	$this->db->update('tbl_session_data',$data);
     	
     	
     	
	 }
	 
	 function updateWarehouseDetail($datar,$eid)
	 {
		 $this -> db -> where('customer_warehouse_id', $eid);
		 $this -> db -> update('test_customer_warehouse_details',$datar);
		 
		 if ($this->db->affected_rows() > 0)
			{
			  return true;
			}
		 else
			{
			  return true;
			} 
		 
	 }
	 
	function delRecord($tbl_name,$tbl_id,$record_id)
	 {
		 $this->db->where($tbl_id, $record_id);
	     $this->db->delete($tbl_name); 
		 if($this->db->affected_rows() >= 1)
	   {
	     return true;
	   }
	   else
	   {
	     return false;
	   }
	 }
	 
	 
	function delcustomer($id)
	 {
		$this->db->where('UserId', $id);
	    $this->db->delete('test_customer_supplier'); 
	     
	    $this->db->where('UserId', $id);
	    $this->db->delete('test_customer_warehouse_details'); 
	     
	 	$this->db->where('UserId', $id);
	    $this->db->delete('test_user_roles');

	    $this->db->where('UserId', $id);
	    $this->db->delete('test_users');
		
	    if($this->db->affected_rows() >= 1)
	    {
	      return true;
	    }
	    else
	    {
	     return false;
	    }
	 }
	
	
 

}
?>
