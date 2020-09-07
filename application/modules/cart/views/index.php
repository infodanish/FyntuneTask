<?php //echo "<pre>";print_r($cartdetail);exit;?>
<!--section start-->
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">				
			<div class="table-responsive-lg">	
                <table class="table cart-table">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">image</th>
                        <th scope="col">product name</th>
                        <th scope="col">price</th>
                        <th scope="col">quantity</th>
                        <th scope="col">action</th>
                        <th scope="col">total</th>
                    </tr>
                    </thead>
                    <?php 
                    
                    $total = 0;
                    if(!empty($cartdetail)){
                     foreach ($cartdetail as $key => $value) {
                    ?>
                        <tbody>
                        <tr>
                            <td>
                                 <?php if (!empty($value['product_image'])) {?>
									<a href="#"><img src="<?php echo $value['product_image']; ?>" alt=""></a>    
                                <?php }else{?>
                                    <a href="#"><img  src="<?= base_url('images/logo.png') ?>" ></a>
                                     
                                <?php } ?>
                                
                            </td>

                            <td>
								<a href="#" class="product-name-cart">
									<?=$value['product_name']?>
								</a>
                            </td>
                            <td>
                                <h2>&#8377; <?php echo $value['product_price']; ?></h2>
                            </td>
                            <td>
                                <?php echo $value['quantity']; ?>
                            </td>
                            <td><a href="#" class="icon"  onclick="deleteitemcart(<?php echo $value['cart_id'] ?>)"><i class="ti-close"></i></a></td>
                            <td><h2 class="td-color">&#8377; <?php echo $value['total_amount']; ?></h2></td>
                        </tr>
                        </tbody>

                    <?php 
						$total += $value['total_amount'];
					} } ?>
                </table>
                <table class="table cart-table table-responsive-md">
                    <tfoot>
                    <tr>
                        <td>Total Price :</td>
                        <td>
                            <h2>&#8377; <?=$total?></h2></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row cart-buttons">
            <div class="col-6"><a href="<?=base_url()?>" class="btn btn-solid">continue shopping</a></div>
            <?php if(!empty($cartdetail)){ ?>
            <div class="col-6"><a href="<?=base_url()?>checkout" class="btn btn-solid">check out</a></div>
            <?php } ?>
        </div>
    </div>
</section>
<!--section end-->


</body>

</html>
<script>
function deleteitemcart(cart_id){
	$.ajax({
		url: "<?php echo base_url()?>home/deleteitemcart",
		data:{"cart_id":cart_id},
		type: "POST",
		success: function(response){
			location.reload();
		}
	});
}
</script>