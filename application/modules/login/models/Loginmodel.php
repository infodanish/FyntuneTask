<?PHP
class Loginmodel extends CI_Model
{
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
	
	function login($username,$password)
	{
		$whr = "email_id = '".$username."' AND password = '".$password."' AND status='Active' ";		
		$this->db->select('user_id, email_id, full_name, phone_no');
		$this->db->from('tbl_users');
		$this->db->where($whr);
		$this->db->limit(1);
		$query = $this->db->get();	

		//print_r($this->db->last_query());
		//exit;
		
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	function getData($table_name, $select = "*", $condition = "1=1", $orderby="", $order="")
	{
		$this -> db -> select($select);
		$this -> db -> from($table_name);
		if(!empty($condition))
		{
			$this->db->where("($condition)");
		}
		
		if(!empty($orderby) && !empty($order))
		{
			$this -> db -> order_by($orderby, $order);
		}
		$query = $this -> db -> get();
		
		//print_r($this->db->last_query());
		//exit;
		
		if($query->num_rows() >= 1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	function updateRecord($tableName, $data, $condition = '1=1') 
	{
		if(!empty($condition))
		{
			$this->db->where("($condition)");
		}
		if($this->db->update($tableName, $data)) 
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
