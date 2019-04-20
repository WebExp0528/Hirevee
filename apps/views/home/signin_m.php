<div align="center" class="navbar sign_menu_bar">
		<div class="navbar-inner ">
			<ul class="nav row-fluid ">
				<ul class="nav">			 	
				  <li class="sign_menu_item"><a href="<?php echo base_url('home/open_signup/signup');?>">Sign up</a></li>
				   <li class="divider-vertical"></li>
				  <li class="sign_menu_item"><a href="<?php echo base_url('home/open_aboutus');?>">Find us</a></li>
				   <li class="divider-vertical"></li>
				   <li class="sign_menu_item"><a href="<?php echo base_url('home/open_contactus');?>">Contact us</a></li>
				</ul>
			</ul>
		</div>
	</div>

  <div align="center" class="content_body">		
		      <input style="width: 80%" type="text" name="username" class="signup_username" maxlength="26" id="username" placeholder="type your name">
		      <input style="width: 80%" type="password" id="password" name="password" class="password" placeholder="Password">
		      <button style="width: 84%;height: 33px;margin-top: 15px;line-height: 5px" class="btn btn-large btn-primary" id="sign_in_btn" type="button">Submit</button>		      		  	
 </div>
  
<script type="text/javascript">  
  $(document).ready(function(){
		$('#password').keypress(function () {
			$('#password').css('border', '1px solid #35a5f6');		
		});
		$('#username').keypress(function () {
			$('#username').css('border', '1px solid #35a5f6');		
		});
				
		$('#sign_in_btn').click(function(){
			var flag=false;
				if($('#username').val()==''){
					$('#username').css('border', '1px solid #ff0000');
					flag=false;
				}
				else{
					flag=true;
				}
				if($('#password').val()==''){
					$('#password').css('border', '1px solid #ff0000');
					flag=false;
				}
				else{
					flag=true;
				}
				if(flag){
					$.post("<?php echo base_url('home/signin');?>", {username:$('#username').val(), userpaasword:$('#password').val()}, function(result){
						if (result == 'ok') {
							location.href = "<?php echo base_url('recruiter/index'); ?>";
						} else if (result == 'deny') {
							alert('Your account was blocked.');							
						} else {
							alert('The email or password you entered is incorrect.');						
						
						}
					});
			}
		});
	});



</script>