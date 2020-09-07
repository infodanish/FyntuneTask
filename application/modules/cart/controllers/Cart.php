<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('home/homemodel', '', TRUE);
		// $this->checkfrontlogin();
		// ini_set('upload_max_filesize', '20M');  
		// ini_set('post_max_size', '25M');  
	}
    function index(){
    	$this->load->model('home/homemodel', '', TRUE);
        $result['cartdetail']=$this->homemodel->getdetailsofcart();
        //echo "<pre>";print_r($result);exit;
		
        $this->load->view('template/header');
        $this->load->view('index',$result);
        $this->load->view('template/footer');
    }
     
    
}

?>