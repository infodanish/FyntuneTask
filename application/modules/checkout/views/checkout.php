<div class="container full-height">
<div class="row">
	<div class="col-sm-12">
		<h2>Checkout</h2>		
	</div>
	<head>
	<style type="text/css">
      /*this for showing autofill data into  text field for modal/fancybox */
      .pac-container { z-index: 100000; }
	</style>
</head>
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="checkout-section">
			<h3 class="select-delivery-collapse"><a class="link-shobha-med">Select Delivery Address</a></h3>
			<div class="checkout-content">
				<form action="/action_page.php">
				<div class="row" id="alladdress">
					<!-- <?php foreach ($useraddress as $key => $value) {?>
						<div class="col-sm-6 col-md-6">	
						<div class="account-address">
							<input type="hidden" name="address_id" name="address_id" value="<?php echo $value->address_id; ?>">
							<p class="tag-address"><strong><?php echo $value->addresstype; ?></strong></p>
							<p class="tag-address"><strong><?php echo $value->first_name;?></strong></p>				
							<p class="full-address"><?php echo $value->room_no .','.$value->address.'<br/>'.$value->pincode ?></p>
							<label for="add1"><input type="radio" id="add1" name="addselect" value="add1" /> Deliver Here	</label>					
						</div>
					</div>
					<?php } ?> -->
				<!-- 	<div class="col-sm-6 col-md-6">	
						<div class="account-address">
							<p class="tag-address"><strong>Work</strong></p>				
							<p class="full-address">303, Jasmine Apartment, Dada Saheb Phalke Marg,<br/>
							Gautam Nagar, Dadar, Mumbai, Maharashtra 400014,<br/>
							India</p>
							<label for="add1"><input type="radio" id="add1" name="addselect" value="add1" /> Deliver Here	</label>					
						</div>
					</div> -->
					<!-- <div class="col-sm-6 col-md-6">
						<div class="account-address">
							<p class="tag-address"><strong>Home</strong></p>				
							<p class="full-address">303, Jasmine Apartment, Dada Saheb Phalke Marg,<br/>
							Gautam Nagar, Dadar, Mumbai, Maharashtra 400014,<br/>
							India</p>
							<label for="add2"><input type="radio" id="add2" name="addselect" value="add2" /> Deliver Here	</label>								
						</div>
					</div> -->
				</div>
					<div class="col-sm-12">
						<a href="#" class="link-shobha-med" data-fancybox="" data-src="#add-address" style="margin-left:0;">Add New Address</a>
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
		<!--<div class="checkout-section">	
			 <div class="checkout-section">
				<h3>Payment Options</h3>
				<div class="checkout-content" align="center">
					<img src="<?php echo base_url()?>img/payment-options.png" class="img-responsive " alt="Payment Options" style="margin:20px auto;"/>
					<a href="#" class="shobha-btn-medium">Pay Now</a>
				</div>
				<div class="clearfix"></div>
			</div> 
			<div class="clearfix"></div>
		</div>-->	
	</div>	
	<div class="clearfix-mobile"></div>
	<!-- Cart -->	
	<div class="col-sm-6 checkout-cart">	
		<div id="cartview" style="display: none;">
			<div class="my-check-right">	
			</div>						
		</div>
	</div>
	<!-- Cart -->	
</div>


	<!-- Add Address -->
	<div style="display:none" id="add-address">
		<div class="add-address-wrapper">
			<h4>Add New Address</h4>
			<div class="add-address-content">
				
				<form id="add-address-form" method="post" enctype="multipart/form-data">
					 <div class="form-group">
			            <label for="addresstag">Find location  &nbsp<i class="fa fa-map-marker"style="font-size:20px;color:red"></i></label>
			         
			              <input id="pac-input" type="text" placeholder="Enter a location"  class="form-control">
			      </div>
					<div class="form-group">
						<label for="addresstag">Tag Address*</label>
						<input type="text" class="form-control" name="addresstag" id="addresstag" placeholder="Home, Work etc...">
					</div>
					<div class="form-group">
						<label for="addressblock">Door/ Flat No.*</label>
						<input type="text" class="form-control" name="flatno" id="flatno" placeholder="Enter Door/ Flat no.">
					</div>
					
					<div class="form-group">
						<label for="address1">Building/chawl*</label>
						<input type="text" class="form-control" name="building" id="building" placeholder="Enter Building name/ chawl name">
					</div>	
					<div class="form-group">
						<label for="pincode">Pin Code*</label>
						<input type="text" class="form-control" name="pincode" id="pincode" placeholder="Enter Pincode">
					</div>
					<div class="form-group">
						<label for="building">Address*</label>
						<input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
					</div>	

						<input type="hidden" name="latitude"  id="latitude" value="">
						<input type="hidden" name="langitude"  id="longitude" value="">

					<button type="submit" class="btn btn-shobhaa-med"> Save </button>	

			</form>
			</div>

			
		</div>
	</div>
	<!-- Add Address -->

</div>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8JxcSJ9rEE57tkC2Gc0n88VjEAtJkPY8&libraries=places&callback=initMap" async defer=""></script> 
<script>

	

// $("#add-address").fancybox({
//  afterClose: function(){
//      $.fancybox.close();
//   		parent.location.reload(true);
      
//     }
// })

// jQuery(document).ready(function ($) {
//     $("#add-address").fancybox({
//         afterClose: function () {
//             document.getElementById("add-address-form").reset();
//         }
//     });
// });
 // $('#add-address').fancybox({
 //   'afterClose': function() {
 //                               alert('test') 
 //                             }
 //  });

function initMap() {
var area1='';
var city = '';
var state = '';
var country = '';
        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        // console.log(place);
		 var shop_lat = 18.9842 ;
	 	 var shop_lng = 72.8356;
	     var distance =getDistanceFromLatLonInKm(shop_lat,shop_lng,place.geometry.location.lat(),place.geometry.location.lng());
	        var shopdistance = <?php echo $distance[0]['delivery_range']; ?>;
          if(distance >= shopdistance){
          	alert("This address is to far from our restaurant range for delivery. so pickup your  order by youseld only and get 5% instead Discount from restaurant ends over there ");
          		$.each(place.address_components, function(index, component){
				var types = component.types;
				$.each(types, function(index, type){
						if(type == 'locality') {
							// alert(component.long_name);
							 city = component.long_name;
						}
					if(type == 'administrative_area_level_1' ) {
						  state = component.long_name;
					}
				  
					if(type == 'country') {
					 	 country = component.long_name;
					}

					if(type == 'natural_feature' || type == 'route' ||  type =='sublocality_level_2')
					{
						  area = component.long_name;
						  area1  = area1.concat(area+',');
					}
					if(type == 'premise')
					{
						 building = component.long_name;
					}else{
						building = place.name;
					}
					if(type == 'postal_code'){
						  pincode =component.long_name;
					}
				});
	
			});	
          	$('#building').val(building);
          	$('#pincode').val(pincode);
          	$('#address').val(area1+''+city+','+state+','+country)
          }else{

          	    $.each(place.address_components, function(index, component){
				var types = component.types;
				$.each(types, function(index, type){
						if(type == 'locality') {
							// alert(component.long_name);
							 city = component.long_name;
						}
					if(type == 'administrative_area_level_1' ) {
						  state = component.long_name;
					}
				  
					if(type == 'country') {
					 	 country = component.long_name;
					}

					if(type == 'natural_feature' || type == 'route' ||  type =='sublocality_level_2')
					{
						  area = component.long_name;
						  area1  = area1.concat(area+',');
					}
					if(type == 'premise')
					{
						 building = component.long_name;
					}else{
						building = place.name;
					}
					if(type == 'postal_code'){
						  pincode =component.long_name;
					}
				});
	
			});	
          	$('#building').val(building);
          	$('#pincode').val(pincode);
          	$('#address').val(area1+''+city+','+state+','+country)

          }
          
      
        });
      }



// getting geolocation from browser.
// $(document).ready(function() {
//   if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(showPosition);
//   } else { 
//     x.innerHTML = "Geolocation is not supported by this browser.";
//   }
//    // alert("opdasd");

// }); 	



//get feolocation on click og maker button 

// function getLocation(){

//   if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(showPosition);
//   } else { 
//     x.innerHTML = "Geolocation is not supported by this browser.";
//   }	
// }

// function showPosition(position) {	
// 	  $('#latitude').val(position.coords.latitude);
//       $('#longitude').val(position.coords.longitude);
//       // alert(position.coords.longitude);
//       getLocationDetails(position.coords.latitude,position.coords.longitude)
// }



// function getLocationDetails(latitude,longitude){
// 	$.getJSON('https://maps.googleapis.com/maps/api/geocode/json?latlng='+ latitude + "," + longitude +"&key=AIzaSyBnV_uN1-T1Z2oWhg46ymjR68EMdHWqOls").success(function(response){
// 		// http://maps.googleapis.com/maps/api/geocode/json?latlng="+ lat + "," + lon + &sensor=true"

// 		if(response.status=='OK'){
// 			// console.log(response);
// 			// return;
//           var address_lat = response.results[0].geometry.location.lat;
//           var address_lng = response.results[0].geometry.location.lng;
//           // alert(address_lat);
//           $('#latitude').val(address_lat);
//           $('#langitude').val(address_lng);
//           // alert(address_lng);
//           var shop_lat = 18.9842 ;
//           var shop_lng = 72.8356;
//           var distance =getDistanceFromLatLonInKm(shop_lat,shop_lng,address_lat,address_lng).toFixed(2);
//           var shopdistance = 2;
//           if(distance >= shopdistance){
//           	alert("your are not allow to book food from this restaurant.our range for delivery is  only " + shopdistance);
//           	$('#pincode').val('');
//           }else{


//           }
// 		}else{
// 				alert("This is seem to be invalid pincode!");
// 					$('#pincode').val('');
// 				// $('#orgpostal_code').val('');
// 				// $('#orgcity').val('');
//     //         	$('#orgstate').val('');
//     //         	$('#orgcountry').val('');	
// 		}
// 	});
// }

$(window).load(function(){
getuseraddressindividual();
getcartdetail();
})

// alert(getDistanceFromLatLonInKm(59.3293371,13.4877472,59.3225525,13.4619422).toFixed(2));

function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}



//add to cart 
function addToCartStepper(item_id,category_id,item_price){

	var qty = 1;
	if(qty !='' && qty!='undefined' && qty!=null && qty > 0)
	{
		$.ajax({
		url:"<?php echo base_url()?>productlisting/addToCart",
		// dataType:"json",
		data:{"item_id":item_id,"item_price":item_price,"qty":qty,"category_id":category_id},
		type:"POST",
		success:function(response){
			$('#cartview').css('display','block');
			$('#cartview').html(response);
			$('#mobile_cart_wrapper').html(response);

		  }	
		});
	}else{
		alert("Please Enter Quantity..!!!");
	}
}



// remove from cart 
function removeFromCart(item_id,category_id,item_price){

	var qty = 1;
	var cqty = $('#citem_qty'+item_id).val();
	// alert(cqty);
	// return
	if(cqty > 1){
		if(qty !='' && qty!='undefined' && qty!=null && qty > 0)
		{
			$.ajax({
			url:"<?php echo base_url()?>productlisting/removeFromCart",
			// dataType:"json",
			data:{"item_id":item_id,"item_price":item_price,"qty":qty,"category_id":category_id},
			type:"POST",
			success:function(response){
				// $('#cartview').css('display','block');
				$('#cartview').html(response);
				$('#mobile_cart_wrapper').html(response);

			  }	
			});
		}else{
			alert("Please Enter Quantity..!!!");
		}
	}else{
		$('#bitem_id'+item_id).attr('disabled','disabled');
	}
	
}


// $("#pincode").focusout(function(){
//  var zip = document.getElementById("pincode").value
// $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+zip+"&key=AIzaSyBnV_uN1-T1Z2oWhg46ymjR68EMdHWqOls").success(function(response){
// 		if(response.status=='OK'){
//           var address_lat = response.results[0].geometry.location.lat;
//           var address_lng = response.results[0].geometry.location.lng;
//           // alert(address_lat);
//           $('#latitude').val(address_lat);
//           $('#langitude').val(address_lng);
//           // alert(address_lng);
//           var shop_lat = 18.9842 ;
//           var shop_lng = 72.8356;
//           var distance =getDistanceFromLatLonInKm(shop_lat,shop_lng,address_lat,address_lng).toFixed(2);
//           var shopdistance = 2;
//           if(distance >= shopdistance){
//           	alert("your are not allow to book food from this restaurant.our range for delivery is  only " + shopdistance);
//           	$('#pincode').val('');
//           }
// 		}else{
// 				alert("This is seem to be invalid pincode!")
// 				$('#orgpostal_code').val('');
// 				$('#orgcity').val('');
//             	$('#orgstate').val('');
//             	$('#orgcountry').val('');	
// 		}
// 	});
// });


//for delete item from cart 

function deleteitemcart(cart_id){
$.ajax({
url: "<?php echo base_url()?>productlisting/deleteitemcart",
data:{"cart_id":cart_id},
// dataType:"json",
type: "POST",
// dataType : "json",
success: function(response){
	$('#cartview').css('display','block');
	// console.log(response);
	// $('#cartview').html('');	
	$('#cartview').html(response);	
}
});
}

//get all cart details added item if any
function getcartdetail(){
var checkout='checkout';
$.ajax({
url: "<?php echo base_url()?>productlisting/getcartdetail",
data:{"checkout":checkout},
// dataType:"json",
type: "POST",
// dataType : "json",
success: function(response){
	$('#cartview').css('display','block');
	// console.log(response);
	// $('#cartview').html('');	
	$('#cartview').html(response);	
}
});
}



//get all address of user if any 
function getuseraddressindividual(){
$.ajax({
url: "<?php echo base_url()?>checkout/getuseraddress",
// dataType:"json",
type: "POST",
// dataType : "json",
success: function(response){
	// $('#cartview').css('display','block');
	// console.log(response);
	// $('#cartview').html('');	
	$('#alladdress').html(response);	
}
});

}




//for add new address 
var vRules = {
	addresstag:{required:true},
	flatno:{required:true},
	pincode:{required:true},
	building:{required:true},
	address:{required:true,}
};
var vMessages = {
	
	addresstag:{required:"Please enter type of address"},
	flatno:{required:"Please Enter flat number/Door "},
	pincode:{required:"Please enter pincode"},
	building:{required:"Please enter buildig name or chawl name"},
	address:{required:"Please enter proper Address"}
};

$("#add-address-form").validate({
	rules: vRules,
	messages: vMessages,
	submitHandler: function(form) 
	{
		var act = "<?php echo base_url();?>checkout/addnewaddress";
		// alert("helo");
		$("#add-address-form").ajaxSubmit({
			url: act, 
			type: 'post',
			cache: false,
			clearForm: false,
			// dataType: 'json',	
			success: function (response) {
				$.fancybox.close();
					$('#alladdress').html(response);
			}
		});
	}
});


function paymentOffline(){
if($('input:radio:checked').length > 0){
var address_id = $("input[name='add']:checked").val();
var note =$('#note').val();
var subtotal = $('#subtotal').text() ;
var total = $('#total').text(); 
var cgst = $('#cgst').text();
var sgst = $('#cgst').text();
var couponcode = $('#couponCode').val();
// alert(subtotal);
// alert(cgst);

// return
	$.ajax({
	url:"<?php echo base_url()?>checkout/paymentOffline",
	data:{"address_id":address_id,"note":note,"subtotal":subtotal,"total":total,"cgst":cgst,"sgst":sgst,"couponcode":couponcode},
	type:"POST",
	dataType:'json',
	success:function(response){
		console.log(response);
		if(response.success){
		   // alert(response.msg);
		   // alert(response.msg);
			 setTimeout(function(){
				window.location = "<?php echo base_url('profile/successpage');?>";
			},100);
		}else{
			// alert(response.msg);
			return false;
		}
		// alert(response.room_no);
	}
});
 }else{
alert("Please select the Address first !!")
 }
}

function pay_razorpay(){
	if($('input:radio:checked').length > 0){

		var form = document.createElement("form");
		var element1 = document.createElement("input"); 
		var element2 = document.createElement("input"); 
		var element3 = document.createElement("input"); 
		var element4 = document.createElement("input"); 
		var element5 = document.createElement("input"); 
		var element6 = document.createElement("input"); 
		var element7 = document.createElement("input"); 


		form.method = "POST";
		form.action = "<?php echo base_url()?>checkout/razorpay";   

		element1.value=$("input[name='add']:checked").val();
		element1.name="address_id_pay";
		form.appendChild(element1);  

		element2.value=$('#note').val();
		element2.name="note_pay";
		form.appendChild(element2);

		element3.value=$('#subtotal').text() ;
		element3.name="subtotal";
		form.appendChild(element3);

		element4.value=$('#total').text() ;
		element4.name="total";
		form.appendChild(element4);

		element5.value=$('#cgst').text() ;
		element5.name="cgst";
		form.appendChild(element5);

		element6.value=$('#sgst').text() ;
		element6.name="sgst";
		form.appendChild(element6);

		element7.value =$('#couponCode').val();
		element7.name ="couponcode";
		form.appendChild(element7);

		document.body.appendChild(form);

		form.submit();
		// var address_id = $("input[name='add']:checked").val();
		// var note =$('#note').val();
		// setTimeout(function(){window.location = "<?php echo base_url()?>checkout/razorpay";}, 0);
	// var address_id = $("input[name='add']:checked").val();
	// var note =$('#note').val();

	// alert(note);
	// return
	// 	$.ajax({
	// 	url:"<?php //echo base_url()?>checkout/razorpay",
	// 	// data:{"address_id":address_id,"note":note},
	// 	type:"POST",
	// 	// dataType: 'json',
	// 	// success:function(response){
	// 	// 	// console.log(response);
	// 	// 	if(response.success){
	// 	// 	// alert(response.msg);
	// 	// 	// alert(response.msg);
	// 	// 		setTimeout(function(){
	// 	// 			window.location = "<?php echo base_url();?>";
	// 	// 		},1000);
	// 	// 	}else{
	// 	// 		alert(response.msg);
	// 	// 		return false;
	// 	// 	}
	// 	// 	// alert(response.room_no);
	// 	// }
	// });
	}else{
	alert("Please select the Address first !!")
 }
}


function validateCoupon(){
	var couponcode = $('#couponCode').val();
	if(couponcode!='' && couponcode!='undefined' && couponcode!='null'){

		var totalprice = $('#subtotal').text();
	var coup = $('#couponCode').val();
	// alert(coup);
	// alert(totalprice);
	// return
	$.ajax({
			url: "<?php echo base_url(); ?>checkout/checkvalidatecoupon",
			method:"POST",
			data:{coupon:coup,totalprice:totalprice
			},
            success: function(data){
				console.log(data);
				if(data.trim() == 'false'){
					
					$('#couponMessage').show();
					$('#couponMessage').html('').append('<span style="color:red">You seem to have entered a wrong Coupon Code or the Coupon Code that you entered has expired</span>');
					$('#couponCode').val('');
					
				}else{

					if(data.trim() == '2'){
						alert("You are not able to apply this Coupon because Coupon Worth is more than Cart value..")
						window.location = '<?php echo base_url('checkout')?>';

						}else{
						var res = '<p><span class="leftsummary bold">Coupon Discount</span><span class="rightsummary">- <i class="fa fa-inr"></i>'+data+'</span></p>';
						$('#couponDisc').html('').append(res);
						var total = parseInt($('#subtotal').html()) - parseInt(data.trim());
							if(total >0){
								// alert(total);
								$('#subtotal').html('').append(total);
								// $('#subtotal').html('').append(total);
								var sgst = ((total*2.5)/100);
								var cgst = ((total*2.5)/100);
								var grandtotal = Math.round(total+sgst+cgst);
								$('#cgst').html('').append(cgst);
								$('#sgst').html('').append(sgst);
								$('#total').html('').append(grandtotal);

							}else{
								total=0;
								$('#subtotal').html('').append(total);
								$('#cgst').html('').append(total);
								$('#sgst').html('').append(total);
								$('#total').html('').append(total);
							}
						// $('#orderTotal').html('').append(total);
						$('#removecoupon').css("display",'block');
						$('#applycoupon').css('display','none');
						$('#couponMessage').show();
						$('#couponMessage').html('').append('<span style="color:green">Coupon code applied successfully !</span>');
					}

					
				}
				
			}
			
		});

	}else{
		alert("Please enter the code");
	}
	
}
if($(window).width() < 767){		
	$('h3.select-delivery-collapse').click(function(){		
		$('#alladdress').toggle();
	});
}
</script>
	

 