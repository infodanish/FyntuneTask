<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Productdetail extends CI_Controller {
	
	function _remap($method_name = 'index'){
		if(!method_exists($this, $method_name)){
			$this->index();
		}else{
			$this->{$method_name}();
		}
	}

	function __construct()
	{
		parent::__construct();
		//$this->load->library('email');
		$this->load->model('productdetailmodel','',TRUE);
	}
 
	function index()
	{
		//echo "here..";
		$id = $this->uri->segment(2);
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://fakestoreapi.com/products/".$id."",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
		$getProductsDetails = json_decode($response, true);
		//echo "res: <pre>";print_r($getProductsDetails);exit;
		
		$result['productdetails'] = $getProductsDetails;
		
		$this->load->view('template/header.php');
		$this->load->view('index',$result);
		// $this->load->view('template/callout.php');
		$this->load->view('template/footer.php');
	}

 }

?>
