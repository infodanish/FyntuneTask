
     <script src="<?=base_url()?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
     <script src='<?php echo base_url()?>assets/js/jquery.form.js'></script>
    <script src='<?php echo base_url()?>assets/js/jquery.validate.js'></script> 
     <script src='<?php echo base_url()?>assets/js/form-validation.js'></script>    
    
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> 
<html>
  <head>
    <title> RazorPay Integration</title>
    <meta name="viewport" content="width=device-width">
    <style>
      .razorpay-payment-button {
        color: #ffffff !important;
        background-color: #7266ba;
        border-color: #7266ba;
        font-size: 14px;
        padding: 10px;
      }
    </style>
  </head>
  <body>
<!-- 
    <input type="text" name="user_id" id="user_id" value="<?= $user_id ?>">
    <input type="text" name="email_id" id="email_id" value="<?= $email_id ?>">
    <input type="text" name="phone_no" id="phone_no" value="<?= $phone_no ?>">
    <input type="text" name="user_name" id="user_name" value="<?= $user_name ?>">

    <input type="text" name="amount_pay" id="amount_pay" value="<?php echo $amount; ?>"/>  
     -->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var payment_id;
var options = {
    "key": "<?php echo $apikey; ?>",
    "amount": "<?php echo $amount; ?>", // 2000 paise = INR 20
    "name": "<?= $user_name?>",
    "modal": {
        "ondismiss": function(){
          alert("Transaction has been declined ");
        window.location = "<?php echo base_url('checkout')?>";
        }
    },
    "handler": function (response){
        // $('#payment_id').val(response.razorpay_payment_id);
        alert("payment has been successfully ");
        payment_id=response.razorpay_payment_id;
        setreseponse(response.razorpay_payment_id)
    },
    "prefill": {
        "name": "",
        "contact":"<?= $phone_no ?>",
        "email": "<?= $email_id ?>"
    },
    "notes": {
        "address": ""
    },
    "theme": {
        "color": "green"
    }
};
var rzp1 = new Razorpay(options);

function razorpay_manual(){
  // alert("inside razorpay/");
  rzp1.open();
  
}
razorpay_manual();

function setreseponse(payment_id)
{
  document.cookie = "payment_id ="+payment_id;
  var  amount ="<?= $amount; ?>";
  var  address = "<?= $address; ?>";
  var  city = "<?=  $city; ?>";
  var  state = "<?=  $state; ?>";
  var  phone = "<?=  $phone_no; ?>";
  var  postal_code = "<?=  $postal_code; ?>";
  // var payment_id = payment_id;
  var user_id = <?php print_r($_SESSION['chheda_front'][0]->user_id) ?>;
  <?php  $_SESSION['address']=$address?>;
  <?php  $_SESSION['city']=$city?>;
  <?php  $_SESSION['user_name']=$user_name?>;
  <?php  $_SESSION['state']=$state?>;
  <?php  $_SESSION['postal_code']=$postal_code?>;
  <?php $_SESSION['order_date']=date("Y/m/d") ?>;


// alert(amount);
// alert(payment_id);
// alert(status);
//   alert($('#note_pay').val());
//   alert($('#total_pay').val());
//   alert($('#couponcode_pay').val());
//   return;
   $.ajax({
        url: "<?php echo base_url('checkout/storeresponse')?>", 
        type: 'post',
        cache: false,
        data:{ "amount":amount/100,"payment_id":payment_id,"user_id":user_id,"address":address,"city":city,"state":state,"postal_code":postal_code,"phone":phone},
        clearForm: false,
        dataType:"json",
        success: function (response) {
        // alert(response);

        if(response.success=='1')
        {
          // alert(response.msg);
          setTimeout(function(){
                window.location = "<?php echo base_url('checkout/successpage');?>";
              },100);
        }else{
          alert(response.msg);
          setTimeout(function(){
                window.location = "<?php echo base_url('home');?>";
              },100);
        }

        }
      });
  
}
</script>

  </body>
</html>
