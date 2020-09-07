<body>


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Login</h3>
                    <div class="theme-card">
                        <form class="theme-form" id="frm_login">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="login_email" name="login_email" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <label for="review">Password</label>
                                <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Enter your password">
                            </div><button type="submit"class="btn btn-solid">Login</button> 
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>Guest User</h3>
                    <div class="theme-card authentication-right">
                        <form class="theme-form" id="frm_guser">
                            <div class="form-group">
                                <label for="email">Name</label>
                                <input type="text" class="form-control" id="guest_name" name="guest_name" placeholder="Enter your name">
                            </div>
							<div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="guest_email" name="guest_email" placeholder="Enter your Email">
                            </div>
                            <button type="submit"class="btn btn-solid">Submit</button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
	<script>
    
    var vRules = {
			login_email:{required:true, email:true},
			login_password:{required:true}
		};

		var vMessages = {
			login_email:{required:"Please enter email.",email:"Please enter valid email."},
			login_password:{required:"Please enter password."}    
		};

		$("#frm_login").validate({
		rules: vRules,
		messages: vMessages,
		submitHandler: function(form) 
		{
			var act = "<?php echo base_url();?>login/loginvalidate";
			$("#frm_login").ajaxSubmit({
				url: act, 
				type: 'post',
				dataType: 'json',
				cache: false,
				clearForm: false, 
				beforeSubmit : function(arr, $form, options){
					//return false;
				},
				success: function (response) 
				{
					alert(response.msg);
					$('#myModal ').find(".modal-body").html("");
					$('#myModal ').find(".modal-body").html(response.msg);
					$('#myModal').modal('toggle');
					if(response.success)
					{
						setTimeout(function(){
							window.location = "<?php echo base_url();?><?=(!empty($_SESSION['last_state'])?$_SESSION['last_state']:"home")?>";
						},2000);
					}
				}
			});
		}
	});
	
	
	var vgRules = {
		
			guest_email:{required:true, email:true},
			guest_name:{required:true}
		};

		var vgMessages = {
			guest_email:{required:"Please enter email.",email:"Please enter valid email."},
			guest_name:{required:"Please enter name."}    
		};

		$("#frm_guser").validate({
		rules: vgRules,
		messages: vgMessages,
		submitHandler: function(form) 
		{
			var act = "<?php echo base_url();?>login/guestdetailsvalidate";
			$("#frm_guser").ajaxSubmit({
				url: act, 
				type: 'post',
				dataType: 'json',
				cache: false,
				clearForm: false, 
				beforeSubmit : function(arr, $form, options){
					//return false;
				},
				success: function (response) 
				{
					alert(response.msg);
					$('#myModal ').find(".modal-body").html("");
					$('#myModal ').find(".modal-body").html(response.msg);
					$('#myModal').modal('toggle');
					if(response.success)
					{
						setTimeout(function(){
							window.location = "<?php echo base_url();?><?=(!empty($_SESSION['last_state'])?$_SESSION['last_state']:"home")?>";
						},2000);
					}
				}
			});
		}
	});
	
  </script>