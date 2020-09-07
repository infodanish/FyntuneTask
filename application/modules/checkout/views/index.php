
<!-- section start -->
<section class="section-b-space section-t-space-20">
    <div class="container">
        <div class="checkout-page">
            <div class="checkout-form">
               
                <!-- <form id="add-address" method="post" enctype="multipart/form-data"> -->
                <form class="form-horizontal" id="add-address" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-8 col-sm-12 col-xs-12">
                            <div class="checkout-title">
                                <h3>Billing Details</h3></div>
                            <div class="row check-out">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Name<sup>*</sup></div>
                                    <input type="text" name="full_name" id="full_name" value="<?= (!empty($user_details[0]['full_name']) ? $user_details[0]['full_name'] : "")?>" placeholder="">
                                </div>
                               
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Phone<sup>*</sup></div>
                                    <input type="text" name="phone" id ="phone" minlength="10" maxlength="10" value="<?php if(!empty($user_details[0]['phone_no'])){print_r($user_details[0]['phone_no']);} ?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Email Address<sup>*</sup></div>
                                    <input type="email" name="email" id="email" value="<?= (!empty($user_details[0]['email_id']) ? $user_details[0]['email_id']:"")?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Address*</div>
                                    <input type="text" name="address"  id="Address" value="" placeholder="Street address" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Town/City*</div>
                                    <input type="text" name="city" id="city" value="" placeholder="" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <div class="field-label">State*</div>
                                    <input type="text" name="state" id="state" value="" placeholder="" required>
                                </div>
                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <div class="field-label">Postal Code*</div>
                                    <input type="number" name="postal_code" id="postal_code" value="" placeholder="" required>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 col-xs-12">
                           
                            <div class="checkout-details">
                                <div class="order-box">
                                    <div class="title-box">
                                        <div>Product <span>Total</span></div>
                                    </div>
                                    <ul class="qty">

                                        <?php 
										$grand_total=0;$container_weight = 0;
                                        if(!empty($cartdetail)){
                                         foreach ($cartdetail as $key => $value) {
                                             $grand_total += $value['total_amount'];
                                              ?>
                                            <li>
												<?php echo substr($value['product_name'],0, 50);?> <strong>X</strong> <?=$value['quantity']?> 
											<span>&#8377; <?= $value['total_amount'];?></span></li>
                                        <?php }} ?>
                                        <!-- <li>Anjeer × 1 <span>&#8377; 555.00</span></li> -->
                                    </ul>
                                    <ul class="sub-total">
                                        <li>Subtotal *&#8377; <span class="count" id="sub_total"><?= $grand_total;?></span></li>
                                    </ul>
                                    <ul class="total">
                                        <li>Total &#8377;  <span class="count" id="final_amt" name="final_amt"><?= $grand_total?> </span></li>
										<input type="hidden" id="grand_total" name="grand_total" value="<?php echo $grand_total; ?>"/>
                                    </ul>
                                </div>
                                <div class="payment-box">
                                    <div class="upper-box">
                                        <div class="payment-options">
                                            <ul>
                                                <li>
                                                    <div class="radio-option">
                                                        <input type="radio" name="payment-group"  id="payment-1" checked="checked" value="online">
                                                        <label for="payment-1">COD</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-solid btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</section>
<script>


$( document ).ready(function() {
     
   
});


//for add new address 
var vRules = {
    full_name:{required:true},
    phone:{required:true},
    email:{required:true},
    address:{required:true},
    city:{required:true},
    state:{required:true},
    postal_code:{required:true, 
                digits: true,
                minlength: 6}
    
    };  
var vMessages = {
    
    full_name:{required:"Enter Name here "},
    phone:{required:"Enter phone number here "},
    email_id:{required:"Please enter email id",email:"Please enter correct email id",remote:"Email Id Already Exist."},
    address:{required:"Enter address here"},
    city:{required:"Enter Town/city here"},
    state:{required:"Enter state here"},
    postal_code:{required:"Please 6 digit Pincode",
                digit:"provide proper  6 digit pincode for early shipment ",
                minlength: "Your pincode number seems a bit short, doesn't it?",
                remote:""}
};



$("#add-address").validate({
    rules: vRules,
    messages: vMessages,
    submitHandler: function(form) 
    {
        var act = "<?php echo base_url();?>checkout/checkoutDetails";
        // alert("helo");
        $("#add-address").ajaxSubmit({
            url: act, 
            type: 'post',
            cache: false,
            clearForm: false,
            dataType: 'json',   
            success: function (response) {
                if(response.success){
                    setTimeout(function(){
						window.location = "<?php echo base_url();?>checkout/success";
					},2000);
                }
            }
        });
    }
});
</script>

</body>

</html>