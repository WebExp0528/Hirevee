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

	$("#contactus_form").submit(function(){
			if($('#name').val()==''){
				$('#name').css('border', '1px solid #ff0000');
					$('#name').focus();
					return false;
				}
			if($('#email').val()==''){
				$('#email').css('border', '1px solid #ff0000');
					$('#email').focus();
					return false;
				}
			if($('#subject').val()==''){
				$('#subject').css('border', '1px solid #ff0000');
					$('#subject').focus();
					return false;
				}
			if($('#message').val()==''){
				$('#message').css('border', '1px solid #ff0000');
					$('#message').focus();
					return false;
				}
			
			return true;
});
        
        
           
            	$('#name').keypress(function () {
            		$('#name').css('border', '1px solid #bcbfc1');		
            	});

            	$('#subject').keypress(function () {
            		$('#subject').css('border', '1px solid #bcbfc1');		
            	});
            	$('#email').keypress(function () {
            		$('#email').css('border', '1px solid #bcbfc1');		
            	});
            	$('#message').keypress(function () {
            		$('#message').css('border', '1px solid #bcbfc1');		
            	});
            	
  });
</script>

<div align="center" >
<form id="contactus_form" autocomplete="off"  method="post" class="signup_form" action="<?php echo base_url('sendmail/send_mail') ;?>">

	<div><input  name="yourname" id="name"  type="text" placeholder="input your name"></div>
	<div><input  name="youremail" id="email" type="text" placeholder="input your email"></div>
	<div><input  name="yoursubject" id="subject" type="text" placeholder="input subject*."></div>
	<textarea name="message" id="message" class="yourmessage" rows="3" cols="40" placeholder="input Message." ></textarea>
	
<div>
	<button style="width: 70%" type="submit" name="signup_btn" class="btn btn-primary signup_btn"><b>Send Mail</b></button>
</div>
<hr>
</form>
</div>