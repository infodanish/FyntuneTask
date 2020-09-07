<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// session_start(); //we need to call PHP's session object to access it through CI
class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('loginmodel','',TRUE);
	}
 
	function index()
	{
	 
		$this->load->view('template/header.php');
		$this->load->view('login');
		$this->load->view('template/footer.php');
	}
	
	function generateRandomString($length = 10) 
	{
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
 
	function loginvalidate()
	{
		$result = $this->loginmodel->login($_POST['login_email'],md5($_POST['login_password']));
		//echo "<pre>";print_r($result);exit;
		if(!empty($result))
		{
			$_SESSION["chheda_front"] = $result;
			if(!empty($_SESSION['cart_id']) && isset($_SESSION['cart_id'])){
				$_SESSION['chheda_front'][0]->cart_id = $_SESSION['cart_id'];
			}
			if(!empty($_SESSION['cart_id'])){
				$cartupdate =$this->loginmodel->getData("tbl_cart","*","cart_session = '".$_SESSION['chheda_front'][0]->cart_id."' ");
				if($cartupdate){
					$data['user_id'] = $_SESSION['chheda_front'][0]->user_id;
					$this->session->set_userdata('is_logged_in', 'true');
					$data['cart_session'] = $_SESSION['chheda_front'][0]->cart_id;
					$resultupdate = $this->loginmodel->updateRecord("tbl_cart", $data,"cart_session ='".$_SESSION['chheda_front'][0]->cart_id."' ");
				}

				$cart_sessionupdate =$this->loginmodel->getData("tbl_cart","*","user_id = '".$_SESSION['chheda_front'][0]->user_id."' ");
				if($cart_sessionupdate){
					$data['cart_session'] = $_SESSION['chheda_front'][0]->cart_id;
					$resultupdate = $this->loginmodel->updateRecord("tbl_cart", $data,"user_id ='".$_SESSION['chheda_front'][0]->user_id."' ");
				}

			}else{
				$this->session->set_userdata('cart_id','chheda-temp-cart'.$this->generateRandomString());
				$this->session->set_userdata('is_logged_in', 'true');	
				$_SESSION['chheda_front'][0]->cart_id = $_SESSION['cart_id'];
				$cart_sessionupdate =$this->loginmodel->getData("tbl_cart","*","user_id = '".$_SESSION['chheda_front'][0]->user_id."' ");
				if($cart_sessionupdate){
					$data['cart_session'] = $_SESSION['chheda_front'][0]->cart_id;
					$resultupdate = $this->loginmodel->updateRecord("tbl_cart", $data,"user_id ='".$_SESSION['chheda_front'][0]->user_id."' "); 
				}
			}	
			// $this->privilegeduser->getByUsername($_SESSION["chheda_webadmin"][0]->user_id);	
			// echo "<pre>";print_r($_SESSION);exit();
				
			echo json_encode(array("success"=>true, "msg"=>'You are successfully logged in.'));
			exit;		
		}
		else
		{
			echo json_encode(array("success"=>false, "msg"=>'Username or Password incorrect.'));
			exit;
		}
	}
	
	
	function guestdetailsvalidate()
	{
		$checkUser = $this->loginmodel->getData("tbl_users","*","email_id = '".$_POST['guest_email']."' ");
		if(!empty($checkUser)){
			echo json_encode(array("success"=>false, "msg"=>'You are a registered user please login!!!'));
			exit;
		}
		//echo "<pre>";print_r($checkUser);exit;
		
		$userdata = array();
		$userdata['full_name'] = $_POST['guest_name'];
		$userdata['email_id'] = $_POST['guest_email'];
		$userdata['password'] = md5(123456);
		$userdata['status'] = 'Active';
		$userdata['created_on'] = date("Y-m-d H:i;s");;
		
		$insertUser = $this->loginmodel->insertData('tbl_users', $userdata, '1');
		//echo "<pre>";print_r($result);exit;
		if(!empty($insertUser)){
			$result = $this->loginmodel->login($_POST['guest_email'],md5(123456));
			if(!empty($result))
			{
				$_SESSION["chheda_front"] = $result;
				if(!empty($_SESSION['cart_id']) && isset($_SESSION['cart_id'])){
					$_SESSION['chheda_front'][0]->cart_id = $_SESSION['cart_id'];
				}
				if(!empty($_SESSION['cart_id'])){
					$cartupdate =$this->loginmodel->getData("tbl_cart","*","cart_session = '".$_SESSION['chheda_front'][0]->cart_id."' ");
					if($cartupdate){
						$data['user_id'] = $_SESSION['chheda_front'][0]->user_id;
						$this->session->set_userdata('is_logged_in', 'true');
						$data['cart_session'] = $_SESSION['chheda_front'][0]->cart_id;
						$resultupdate = $this->loginmodel->updateRecord("tbl_cart", $data,"cart_session ='".$_SESSION['chheda_front'][0]->cart_id."' ");
					}

					$cart_sessionupdate =$this->loginmodel->getData("tbl_cart","*","user_id = '".$_SESSION['chheda_front'][0]->user_id."' ");
					if($cart_sessionupdate){
						$data['cart_session'] = $_SESSION['chheda_front'][0]->cart_id;
						$resultupdate = $this->loginmodel->updateRecord("tbl_cart", $data,"user_id ='".$_SESSION['chheda_front'][0]->user_id."' ");
					}

				}else{
					$this->session->set_userdata('cart_id','chheda-temp-cart'.$this->generateRandomString());
					$this->session->set_userdata('is_logged_in', 'true');	
					$_SESSION['chheda_front'][0]->cart_id = $_SESSION['cart_id'];
					$cart_sessionupdate =$this->loginmodel->getData("tbl_cart","*","user_id = '".$_SESSION['chheda_front'][0]->user_id."' ");
					if($cart_sessionupdate){
						$data['cart_session'] = $_SESSION['chheda_front'][0]->cart_id;
						$resultupdate = $this->loginmodel->updateRecord("tbl_cart", $data,"user_id ='".$_SESSION['chheda_front'][0]->user_id."' "); 
					}
				}	
				// $this->privilegeduser->getByUsername($_SESSION["chheda_webadmin"][0]->user_id);	
				// echo "<pre>";print_r($_SESSION);exit();
					
				echo json_encode(array("success"=>true, "msg"=>'You are successfully logged in.'));
				exit;		
			}
			else
			{
				echo json_encode(array("success"=>false, "msg"=>'Username or Password incorrect.'));
				exit;
			}
		}else{
			echo json_encode(array("success"=>false, "msg"=>'Problem!!!'));
			exit;
		}
	}

	
}

?>