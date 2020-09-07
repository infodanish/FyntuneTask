<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {


	function __construct() {
		parent::__construct();
		$this->load->model('homemodel', '', TRUE);
	}
	
	public function index() {
		$this->load->view('template/header');
		$this->load->view('index',$result);
		$this->load->view('template/footer');

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


	public function addtocart(){
	     
	   //  print_r($_POST);
	   //  exit;
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			{   
				if(!isset($_SESSION['cart_id'])){
					$this->session->set_userdata('cart_id','chheda-temp-cart'.$this->generateRandomString());
					$this->session->set_userdata('is_logged_in', 'false');	
				}
				
				$product_id = $_POST['product_id'];
				$product_price =$_POST['product_price'];
				$product_name =$_POST['product_name'];
				$product_image =$_POST['product_image'];
				
				
				$qty = 1;
			    if(!empty($_POST['quantity'])){
			        $qty = $_POST['quantity'];
			    }
			  
				$checkcart = $this->homemodel->checkToCart($product_id);
				// echo "<pre>";
				// print_r($checkcart);
				// exit();
				
				$html = "";
				
				if(!empty($checkcart))
				{
					$updatedqty = $qty + $checkcart[0]->quantity;
					$updatedprice = $product_price * $updatedqty;
					
					$updatecart = $this->homemodel->updateCart($product_id,$updatedqty,$updatedprice, $product_name, $product_image);
					
					echo json_encode(array('success' => true,'data'=>$html, 'msg'=>"Quantity updated successfully"));
					exit;

				}else{
						
					$inserttocart = $this->homemodel->addTocart($product_id,$qty,$product_price, $product_name, $product_image);
					
					$html='';
  					
					echo json_encode(array('success' => true,'data'=>$html, 'msg'=>"Quantity updated successfully"));
					exit;

				}
			}
	}
	
	function deleteitemcart(){
		$resultdel= $this->homemodel->delRecord('tbl_cart','cart_id',$_POST['cart_id']);
		// print_r($resultdel);
		// exit();
		if($resultdel){
			$html ='';
			echo json_encode(array('success' => true,'data'=>$html, 'msg'=>"Quantity deleted successfully"));
			exit;
		}
	}
	
	function logout()
	{

	       // unset($_SESSION['cart_id']);
		if(!empty($_SESSION['chheda_front'])){
	        unset($_SESSION['chheda_front']);   
			$this->session->unset_userdata('chheda_front');
			unset($_SESSION);
	    }
		
	    session_destroy();
	    redirect("productlisting");
		// session_destroy();
		
		// echo "<pre>";
		// print_r($_SESSION);
		// print_r($this->session->all_userdata());
		// exit;
		
		// redirect('login', 'refresh');
	}

}