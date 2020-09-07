<?php
class Checkout extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->checkfrontlogin();
        $this->load->model('home/homemodel', '', TRUE);
        $this->load->model('checkoutmodel', '', TRUE);
        
    }
      function checkfrontlogin()
    {
        // echo "<pre>";
        // print_r($_SESSION);exit;
        if(empty($_SESSION["chheda_front"]) && !isset($_SESSION['chhedda_front']))
        {
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            {
                echo json_encode(array('success'=>false,'msg'=>'redirect'));
                exit();
            }
            else
            {
                $_SESSION["last_state"] = "checkout";
                redirect('login', 'refresh');
                exit();
            }
        }
    }
    
    function index(){

        //echo "<pre>";print_r($_SESSION);exit;
        $result['cartdetail']=$this->homemodel->getdetailsofcart();
        $result['user_details']=$this->homemodel->getdata('tbl_users',"user_id = ".$_SESSION['chheda_front'][0]->user_id);
        
        // echo $this->db->last_query();
        // echo "<pre>";
        // print_r($result);
        // exit;
        $this->load->view('template/header');
        $this->load->view('index',$result);
        $this->load->view('template/footer');
    }

    function  success(){
        $this->load->view('template/header');
        $this->load->view('success');
        $this->load->view('template/footer');
    }

    function checkoutDetails(){
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_SESSION);
        // exit;
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){   
			$data = array();
			$data['user_id'] = $_SESSION['chheda_front'][0]->user_id;
			$data['name'] = $_POST['full_name'];
			$data['email_id'] = $_POST['email'];
			$data['mobile'] = $_POST['phone'];
			$data['address'] = $_POST['address'];
			$data['pincode'] = $_POST['postal_code'];
			$data['city'] = $_POST['city'];
			$data['state'] = $_POST['state'];
			$data['netpayment'] = $_POST['grand_total'];
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['status'] = 'Success';
			
			//get cart details
			//$cartDetails = $this->homemodel->getdetailsofcart();
			//echo "<pre>";print_r($cartDetails);exit;
			
			$insertOrder = $this->checkoutmodel->insertData('tbl_orders', $data, '1');
			if(!empty($insertOrder)){
				$invoice = array();
				$invoice['invoice'] = "Order".$insertOrder;
				$updateresult = $this->checkoutmodel->updateRecord('tbl_orders',$invoice,"order_id = ".$insertOrder);
				
				$cart = array();
				$cart['order_id'] = $insertOrder;
				$condition = "cart_session='".$_SESSION['chheda_front'][0]->cart_id."' ";
				$updateresult1 = $this->checkoutmodel->updateRecord('tbl_cart',$cart,$condition);
				
				unset($_SESSION['chheda_front'][0]->cart_id);
				unset($_SESSION['cart_id']);
				
				echo json_encode(array('success'=>true, 'msg'=>'Order placed successfully!!!.'));
				exit;
			}else{
				echo json_encode(array('success'=>false, 'msg'=>'Problem in order creation!!!.'));
				exit;
			}            
            
        }
   
    }
    
}

?>