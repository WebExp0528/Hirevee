<script type="text/javascript">
$(document).ready(function(e) {
	$('#frm_enter_code').validate({
		rules: {
			enter_email: {
				required: true,
				email:true
			},
			enter_code: {
				required: true
			}
		},
		messages: {
			enter_email: {
                required: "Please enter a valid email address"
            },
            enter_code: {
                required: "Please enter a code"
            }
		},
		submitHandler: function() {
			$.post("<?php echo site_url('verifing');?>", {enter_email:$('#enter_email').val(), enter_code:$('#enter_code').val()}, function(result){
				if (result == 'ok') {
					$('#entercode_modal').modal('hide');
					location.replace('<?php echo base_url('employee');?>');
					return true;
				} else {
					$("#code_error_msg").show();
					$('#code_error_msg').text('The email or code you entered is incorrect.');
				}
			});
			return false;
        }
	});
	$('#entercode_modal').modal({
		backdrop: true,
		show: false
	});
	$('#entercode_modal').on('hide', function (){
		$("#enter_email").val('');
		$("#enter_code").val('');
		$(".error").addClass('hide');
		$("#code_error_msg").hide();
	});
	<?php if ($this->session->userdata('CLIENT_ID')) { ?>
	$('#entercode_modal').on('show', function (){
		location.href="<?php echo base_url('/employee');?>";
	});
	<?php }?>
	
	$(window).load(function(){
		$(".header_mark").css('left', (parseInt($(window).width()) - parseInt($(".header_mark").width())) + "px");
	}).resize(function(){
		$(".header_mark").css('left', (parseInt($(window).width()) - parseInt($(".header_mark").width())) + "px");
	});
});
</script>
<header>

<div class="modal hide fade" id="entercode_modal">
	<form id="frm_enter_code">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4 class="orange">Please enter your email and code.</h4>
	</div>
	<div class="modal-body">
		<input class="inputSmall" type="text" name="enter_email" id="enter_email" placeholder="Enter email"/>
		<input class="inputSmall" type="text" name="enter_code" id="enter_code" placeholder="Enter code"/>
	  	<div id="code_error_msg" class="error_msg"></div>
	</div>
	<div class="modal-footer">
		<button type="submit" id="btn_enter" class="btn btn-success">Verify Code</button>
		<button class="btn" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>


<div class="empstart_header row-fluid">
	<div class="span2 google_trans span2"><div id="google_translate_element"></div></div>
	<div class="header_logo span2"></div>
	<div class="header_link span4">
	<?php 
	$header_link = config_item('header_link');
	if ($header_link && is_array($header_link))
	{
		$first = true;
		foreach ($header_link as $val)
		{
			if ($first)
				$first = false;
			else 
				echo ' | ';
			echo $val;
		}
	}
	?>
	</div>
	<div class="header_link span2">
	<?php 
	$header_sign_link = config_item('header_sign_link');
	if ($header_sign_link && is_array($header_sign_link))
	{
		$first = true;
		foreach ($header_sign_link as $key => $val)
		{
		    if (!$this->logged_user->is_loggedin() && $key == 'logout')
		        continue;
	        if ($this->logged_user->is_loggedin() && $key != 'logout')
	            continue;
		    
		    if ($first)
				$first = false;
			else 
				echo ' | ';
			echo $val;
		}
	}
	?>
	</div>
	<div class="span2"></div>
	<div class="header_mark"></div>
</div>
</header>


<div class="signup_content row-fluid">
	<div class="signup_box" >
			<div><label class="sign_up_title"  >Sign Up For FREE</label></div>
			<div><label class="sign_up_subtitle"  >Get free access right here. right now!</label></div>
			<hr>
			<form id="signup_form" method="post" class="signup_form" action="<?php echo base_url('home/sign_register');?>">
				<div class="div-horizontal submit_form_infos">
					<div><label class="sign_label"  >Name</label></div>
					<div><input name="name" id="name" class="sign_info" type="text"></div>
					
					<div><label class="sign_label"  >Company name</label></div>
					<div><input name="company" id="company" class="sign_info" type="text"></div>
					
					<div><label class="sign_label"  >E-mail address</label></div>
					<div><input name="email" id="email" class="sign_info" type="text"></div>
					
					<div><label class="sign_label"  >Password</label></div>
					<div><input name="password" id="password" class="sign_info" type="password"></div>
					<div>
						<button type="submit" name="signup_btn" class="btn btn-primary signup_btn" style="margin-bottom: 30px;"><b>Signup for free</b></button>
					</div>	
					<div><label class="signup_notify" style="font-size: 24px;margin-top: 70px;color: blue; display: none" >Welcome! you are signed.</label></div>
					<div><label class="signup_not_notify" style="font-size: 24px;margin-top: 70px;color: red;display: none " >Your name or password are used!</label></div>
								
				</div>
			</form>
	</div>
	<div>
		<span class="middle_button btn " disabled="disabled" style="padding-top:12px; " >OR</span>
	</div>
	<div class="signin_box">
			<div><label class="sign_up_title"  >Log into your account</label></div>
			<div><label class="sign_up_subtitle"  >Log in right here. right now!</label></div>
			<hr>
			<form id="signin_form" method="post" class="signup_form" action="<?php echo base_url('home/signin');?>">
				<div class="div-horizontal submit_form_infos">
					<div><label class="sign_label"  >Username</label></div>
					<div><input name="username" id="username" class="sign_info" type="text"></div>
					
					<div><label class="sign_label"  >Password</label></div>
					<div><input name="userpaasword" id="userpaasword" class="sign_info" type="password"></div>
					<div>
						<button type="submit" id="login_btn" name="login_btn" class="btn btn-primary signup_btn"><b>Login</b></button>
					</div>				
				</div>
			</form>
	</div>
</div>
<script language="javascript">
$(document).ready(function() {
    // validate signup form on keyup and submit
    var validator = $("#signup_form").validate({
        rules: {
            name: "required",
            company: "required",
            password: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true               
            }
        },
        messages: {
            name: "Enter your name",
            company: "Enter your companyname",
            password: {
                required: "Provide a password",
                rangelength: jQuery.format("Enter at least {0} characters" )
            },
            email: {
                required: "Please enter a valid email address"
            }
        },
        submitHandler: function() {
            $.post("<?php echo base_url('home/sign_register');?>", {name:$('#name').val(), company:$('#company').val(), email:$('#email').val(), password:$('#password').val()}, function(result){
                if (result == 'ok') {
                	$('.signup_notify').css('display','inline');
                	$('.signup_not_notify').css('display','none');
   					$('#name').val('');
   					$('#password').val('');
   					$('#company').val('');
   					$('#email').val('');   					
   					return true;
      				} else{
      					$('.signup_notify').css('display','none');
                    	$('.signup_not_notify').css('display','inline');
      				}
               	return false;
      			});
  		    }       
    });

     var validator = $("#signin_form").validate({
        rules: {
        	username: "required",
        	userpaasword: {
                required: true,
                minlength: 5
            }
        },
        messages: {
        	username: "Enter your name",
            userpaasword: {
                required: "Provide a password"                
            }
        },
        submitHandler: function() {
            $.post("<?php echo base_url('signin');?>", {username:$('#username').val(), userpaasword:$('#userpaasword').val()}, function(result){
              	 if (result == 'ok') {
   					location.href = "<?php echo base_url('recruiter'); ?>";
   					return true;
      				} else{
      					$('#username').css('border','1px solid #f00');
      					$('#userpaasword').css('border','1px solid #f00');
      				}
               	return false;
      			});
  		    } 
    });

     $('#userpaasword').keyup( function(){
    	$('#userpaasword').css('border','1px solid #bebdbd');
     });
     $('#username').keyup( function(){
      	$('#username').css('border','1px solid #bebdbd');  		
       });
});


</script>