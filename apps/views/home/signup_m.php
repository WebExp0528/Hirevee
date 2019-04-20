<style type="text/css">
* 

label {
	widivh: 10em;
	float: left;
}

p {
	clear: both;
}
label.error {
	display: inline;
	margin-left:10px;
	color: red;
	vertical-align: top;
}

.submit {
	margin-left: 12em;
}

em {
	font-weight: bold;
	padiving-right: 1em;
	vertical-align: top;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    // validate signup form on keyup and submit

	$("#signup_form").submit(function(){
			if($('#name').val()==''){
				$('#name').css('border', '1px solid #ff0000');
					$('#first_name').focus();
					return false;
				}
			if($('#company').val()==''){
				$('#company').css('border', '1px solid #ff0000');
					$('#company').focus();
					return false;
				}
			if($('#email').val()==''){
				$('#email').css('border', '1px solid #ff0000');
					$('#email').focus();
					return false;
				}
			if($('#password_confirm').val()==''){
				$('#password_confirm').css('border', '1px solid #ff0000');
					$('#password_confirm').focus();
					return false;
				}
			if($('#password').val()==''){
				$('#password').css('border', '1px solid #ff0000');
					$('#password').focus();
					return false;
				}
			
			return true;
});
        
        
           
            	$('#name').keypress(function () {
            		$('#name').css('border', '1px solid #bcbfc1');		
            	});

            	$('#company').keypress(function () {
            		$('#company').css('border', '1px solid #bcbfc1');		
            	});
            	$('#email').keypress(function () {
            		$('#email').css('border', '1px solid #bcbfc1');		
            	});
            	$('#password').keypress(function () {
            		$('#password').css('border', '1px solid #bcbfc1');		
            	});
            	$('#password_confirm').keypress(function () {
            		$('#password_confirm').css('border', '1px solid #bcbfc1');		
            	});
            	
  });
</script>

<div align="center" >
<form id="signup_form" autocomplete="off"  method="post" class="signup_form" action="<?php echo base_url('home/sign_register') ;?>">

	<div><input  name="name" id="name"  type="text" placeholder="input your name"></div>
	<div><input  name="company" id="company" type="text" placeholder="input your company name"></div>
	<div><input  name="password" id="password" type="password" placeholder="password"></div>
	<div><input  name="password_confirm" id="password_confirm" type="password" placeholder="confirm your password"></div>
	<div><input  name="email" id="email" type="text" placeholder="input your email"></div>
<div>
	<button style="width: 70%" type="submit" name="signup_btn" class="btn btn-primary signup_btn"><b>signup</b></button>
</div>
<hr>
</form>
</div>