<style>
    li.selected {
    color: #4e2523;
}
</style>
<?php //echo "ss<pre>";print_r($productdetails);exit;?>
<!-- section start -->
<section class="section-t-space-20">
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="d-block d-sm-none product-name-mobile"><?php echo $productdetails['title'];?></h2>  
                                        <div class="chheda-product-slider">
                                            <?php if (!empty($productdetails['image'])) {?>
                                                    <div><img src="<?php echo $productdetails['image'];?>" alt="" class="img-fluid blur-up lazyload"></div>
                                                    
                                            <?php }else{?>
                                                 <img src="<?= base_url('images/logo.png') ?>" class="img-fluid bg-img blur-up lazyload" alt="">
                                            <?php } ?>
                                            
                                           <input type="hidden" id="product_id"  name="product_id" value="<?php echo $productdetails['id'];?>"/>
										   <input type="hidden" id="product_name"  name="product_name" value="<?php echo $productdetails['title'];?>"/>
										   <input type="hidden" id="product_image"  name="product_image" value="<?php echo $productdetails['image'];?>"/>
                                        </div>
										<h2 class="d-block d-sm-none price-mobile">
											<label id="rupee-mobile"></label>
											<label id="product-price-sm-detail">
												&#8377; <?php echo $productdetails['price'];?>
											</label>
										</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 rtl-text">
                                <div class="product-right">                                                                     
                                    <h2 class="d-none d-sm-block"><?php echo $productdetails['title'];?></h2>
									<h2 class="d-none d-sm-block">&#8377; <?php echo $productdetails['price'];?></h2>
                                    <h3 class="d-none d-sm-block"><label id="rupee"></label> <label id="product-price-detail">
                                        </label></h3>                                    
                                    <div class="product-description border-product">
                                    
                                    <div class="clearfix"></div>
										<?php echo $productdetails['description'];?>
                                        <h6 class="product-title">quantity</h6>
                                        <div class="qty-box">
                                            <div class="input-group">
												<span class="input-group-prepend">
													<button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
													<i class="ti-angle-left"></i></button> 
												</span>
												<input type="text" name="quantity" id="quantity" class="form-control input-number" value="1"> 
												<span class="input-group-prepend">
													<button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
													<i class="ti-angle-right"></i>
												</button>
												</span>
											</div>
                                        </div>
                                    </div>
                                    <div class="product-buttons">
                                    <a href="#"     
                                        onclick="addToCart(<?php echo $productdetails['id'];?>,'<?php echo $productdetails['price'];?>')">
                                         <button class="btn btn-solid buy" id="add">Add to cart</button>
                                    </a> 
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->
<!-- product section start -->

<!-- Quick-view modal popup start-->
<span id="Quickviewmodel"></span>
<!-- Quick-view modal popup end-->
</body>

</html>

<script>
$(document).ready(function() {
  $("#click0").click(function () {
        $('#add').show();
        $('#buy').show();
  });
});

function addToCart(product_id,product_price){
    //item_price = $('#product-price-detail').text();
    quantity = $("#quantity").val();
	product_name = $("#product_name").val();
	product_image = $("#product_image").val();
	
	//alert("details:"+ product_id + "product_price:"+ product_price + "quantity:"+ quantity + "product_name:"+ product_name + "product_image:"+ product_image );
	//return false;
	
    $.ajax({
    url:"<?php echo base_url()?>home/addToCart",
    dataType:"json",
    data:{"product_id":product_id,"product_price":product_price,"quantity":quantity,"product_name":product_name,"product_image":product_image },
    type:"POST",
    success:function(response){
        console.log(response);
        console.log(response.data);
		
        $.notify({
            icon: 'fa fa-check',
            title: 'Success!',
            message: 'Item Successfully added in cart'
        },{
            element: 'body',
            position: null,
            type: "info",
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: true,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 500,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
        setTimeout(location.reload.bind(location), 500);
      } 
    });
}


</script>