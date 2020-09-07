<?php
$this->load->model('home/homemodel', '', TRUE);
// echo "<pre>";
// print_r($menus);
// exit;

function arrayFormation($array,$label){
    $rerurn_array = array();
    $temp_variable = "";
    foreach($array as $key=>$val){
        if($temp_variable == $val[$label]){
            $return_array[$val[$label]][] = $val;
        }else{
            $temp_variable = $val[$label];
            $return_array[$val[$label]][] = $val;
        }
    }
    return $return_array;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Chheda Dry Fruits">
    <meta name="keywords" content="Chheda Dry Fruits">
    <meta name="author" content="Chheda Dry Fruits">
    <link rel="icon" href="<?=base_url()?>assets/images/favicon/1.png" type="image/x-icon">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <title>FynTune Task</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/fontawesome.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/slick-theme.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/nice-select.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/chheda.css" media="screen" id="color">
	<script src="<?=base_url()?>assets/js/script.js"></script>
   <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
      
   
   
     <!-- latest jquery-->
     <script src="<?=base_url()?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
     <script src='<?php echo base_url()?>assets/js/jquery.form.js'></script>
    <script src='<?php echo base_url()?>assets/js/jquery.validate.js'></script> 
     <script src='<?php echo base_url()?>assets/js/form-validation.js'></script>    
    <!-- Local jQuery -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 

</head>

<header>
    <div class="mobile-fix-option"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">    
                    <a href="<?=base_url()?>cart" class="cart-mobile d-block d-sm-none"><i class="ti-shopping-cart"></i></a>                    
                        <div class="brand-logo">
                            <a href="<?=base_url()?>"> <img src="<?=base_url()?>images/logo.png" class="img-fluid blur-up lazyload" alt=""></a>
                        </div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            
                        </div>
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div">
                                        <?php if(!empty($_SESSION['chheda_front'])) { ?>
                                            <a href="<?=base_url()?>profile" title="My Account">
                                            <img src="<?=base_url()?>assets/images/icon/user.png" class="img-fluid blur-up lazyload"  alt="login">
                                            </a>
                                            <!--<a href="<?php echo base_url("home/logout");?>"><i data-feather="log-out"></i>Logout</a>-->
                                        <?php }else{?>
                                            <a href="<?=base_url()?>login" title="Login">
                                            <img src="<?=base_url()?>assets/images/icon/user.png" class="img-fluid blur-up lazyload"  alt="login">
                                            </a>
                                        <?php } ?>										
										<?php if(!empty($_SESSION['chheda_front'])) { ?>										
											<div class="show-div setting">                                                                                       
											<ul>																								
												<!--<li><a href="<?=base_url()?>profile">My Profile</a></li>                                                     
												<li><a href="#">My Orders</a></li>  												-->
												<li><a href="<?php echo base_url("home/logout");?>">Logout</a></li>											
											</ul>                                                                                    
											</div>										
										<?php } ?>
                                        
                                    </li>
                                    <!--<li>
                                        <a href="#" title="My Wishlist">
                                            <img src="<?=base_url()?>assets/images/icon/like.png" class="img-fluid blur-up lazyload" alt="My Wishlist"></i>
                                        </a>
                                    </li>  -->                                  
                                 
                                    <?php 
										$cartdetail=$this->homemodel->getdetailsofcart();
										// echo $this->db->last_query();
										// print_r($cartdetail);
										
										if(empty($cartdetail)){
											$size = 0;
										}else{
											$size = sizeof($cartdetail);
										}
                                    ?> 
                                    <li  class="onhover-div mobile-cart"> <span id="cart-count"><?php print_r($size); ?></span>
                                        <div>
                                            <a href="<?=base_url()?>cart"><img src="<?=base_url()?>assets/images/icon/cart.png" class="img-fluid blur-up lazyload" alt=""></a>
                                            <i class="ti-shopping-cart"></i></div>
                                        
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Spacer div start -->
<div class="spacer">