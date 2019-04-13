<footer>
<div class ="blog_footer row-fluid" >
	<div class="footer_left_side span6 offset2 ">
	<form name="send_mail" id="send_mail" action="">
		<div class="row-fluid "><h2>Contact us</h2></div>
		
		<div class="row-fluid addres_field ">
				<input name="yourname" id="yourname" class="yourname" type="text"  placeholder="Your name*" >
				<input name="youremail" id="youremail" class="youremail " type="text"  placeholder="Your e-mail address*">
				<input name="yoursubject" id="yoursubject" class="yoursubject " type="text"  placeholder="Subject*">
		</div>
		<div class ="row-fluid">
			<textarea name="message" id="message" class="yourmessage" rows="4"></textarea>
		</div>
		<div class="sendmail_btn row-fluid">
			<button type="button" id="send_btn" name="send_btn" class="btn btn-primary">Send message</button>
		</div>
	</form>
	</div>
	<div class="footer_right_side span2 pull-left">
					<h3 style="color: #000;margin-top: 30px;">Find us here</h3>
					<hr>
				  <p>	<i class="icon-home "></i>&nbsp;&nbsp;Address: &nbsp;&nbsp;<small>Melboume, Victoria </small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small> Australia 3000</small></p>
				  	<p ><i class="icon-headphones"></i>&nbsp;&nbsp;Mobile: &nbsp;&nbsp;&nbsp;<small>+40-745.036.789<br></small>
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	 <small>+40-745.675.631<br></small>
				  </p>
				  <p ><i class="icon-envelope"></i>&nbsp;&nbsp;Email: &nbsp;&nbsp;&nbsp;<small style="color: #1141cc;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hello@hirevee.com<br></small></p><br>
				  <hr>
				  <div class ="footer_icons row-fluid">
					<p>
						<span class='st_facebook_large' 
							st_title='HireVee.com'
							st_url='<?php echo $_SERVER['SELF'];?>'
							displayText='facebook'></span>
								
							<span class='st_twitter_large'
							st_title='HireVee.com'
							st_url='<?php echo $_SERVER['SELF'];?>'	
							displayText='twitter'></span>
							
							<span class='st_linkedin_large'
							st_title='HireVee.com'
							st_url='<?php echo $_SERVER['SELF'];?>'
							displayText='linkedin'></span>
							
							<span class='st_email_large'
							st_title='HireVee.com'
							st_url='<?php echo $_SERVER['SELF'];?>'
							displayText='plusone'></span>													
						</p>
					
					</p>
					
					
				  </div>			
	</div>
	 
</div>
<div class ="footer_end row-fluid"></div>
</footer>
</center>
<script type="text/javascript">
<!--
$(document).ready(function(){

	
	$('#send_btn').click(function () {

		var flag=false;

		if($('#yourname').val()==''){
			$('#yourname').css('border', '1px solid #ff0000');
				$('#yourname').focus();
				return;
			}
		if($('#youremail').val()==''){
			$('#youremail').css('border', '1px solid #ff0000');
			$('#youremail').focus();
			return;
		}
		if($('#yoursubject').val()==''){
			$('#yoursubject').css('border', '1px solid #ff0000');
			$('#yoursubject').focus();
			return;
		}
		if($('#message').val()==''){
			$('#message').css('border', '1px solid #ff0000');
			$('#message').focus();
			return;
		}
		
		$.ajax({
		    url: '<?php echo base_url('sendmail/send_mail');?>',
		    type: 'POST',
		    dataType: 'text',
		    data: 'name='+$('#yourname').val()+'&email='+$('#youremail').val()+'&subject='+$('#yoursubject').val()+'&message='+$('#message').val(),
		    error: function(){
		        alert('error');
		    },
		    success: function(msg){
		    	alert("ok! your email have been success!");
		    	$('#yourname').val('');
		    	$('#yoursubject').val('');
		    	$('#message').val('');
		    	$('#youremail').val('');
		    	$('#yourname').css('border', '1px solid #b7b7b7');		
		    	$('#youremail').css('border', '1px solid #b7b7b7');		
		    	$('#yoursubject').css('border', '1px solid #b7b7b7');		
		    	$('#message').css('border', '1px solid #b7b7b7');	
		    }
		});

	});


	$('#yourname').keypress(function () {
		$('#yourname').css('border', '1px solid #35a5f6');		
	});
	$('#youremail').keypress(function () {
		$('#youremail').css('border', '1px solid #35a5f6');		
	});
	$('#yoursubject').keypress(function () {
		$('#yoursubject').css('border', '1px solid #35a5f6');		
	});
	$('#message').keypress(function () {
		$('#message').css('border', '1px solid #35a5f6');		
	});

	
});

//-->
</script>
</body>
</html>



