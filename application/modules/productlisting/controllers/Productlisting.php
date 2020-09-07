<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Productlisting extends CI_Controller {
	
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
		$this->load->model('productlistingmodel','',TRUE);
		$this->load->model('productdetail/productdetailmodel','',TRUE);

	}
 
	function index()
	{
		$this->load->view('template/header.php');
		$this->load->view('index');
		$this->load->view('template/footer.php');
	}
	
	function getRecords(){
		$html = '';
		//echo "here..";exit;
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://fakestoreapi.com/products",
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
		
		//echo $response;
		$getProducts = json_decode($response, true);
		//echo "res: ";print_r($getProducts);exit;
		if(!empty($getProducts)){
			
			for($i=0; $i < sizeof($getProducts); $i++){
				//echo $getProducts[$i]['image'];exit;
				
				$html .='<div class="col-xl-2 col-md-6 col-6 ">
						<div class="product-box">
							<div class="img-wrapper">
								<div class="front">';
									$html .='<a href="'.base_url().'productdetail/'.$getProducts[$i]['id'].'">
									<img src="'.$getProducts[$i]['image'].'" style="width:160px;height:229px;" class="img-fluid blur-up lazyload bg-img" alt=""></a>';
									
								$html .='</div>
								<div class="cart-info cart-wrap"></div>
							</div>
							<div class="product-detail">
								<div>
									<a href="'.base_url().'productdetail/'.$getProducts[$i]['id'].'">
										<h6>'.$getProducts[$i]['title'].'</h6>
									</a>
									<p>'.$getProducts[$i]['description'].'</p>
									<h4>&#8377; '.$getProducts[$i]['price'].'</h4>									
								</div>
							</div>
						</div>
					</div>';
				
			}
			
			//echo $html;exit;
			
			echo json_encode(array('msg'=>'success','htmldata'=>$html));
			exit;
		}else{
			echo json_encode(array('msg'=>'error','htmldata'=>'No Products Found'));
			exit;
		}		
	}
}

?>
