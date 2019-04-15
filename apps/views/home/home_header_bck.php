<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$('#frm_signin').validate({
		rules: {
			user_name: {
				required: true
			},
			user_pwd: {
				required: true
			}
		},
		messages: {
			user_name: {
                required: "Please enter a valid email address"
            },
            user_pwd: {
                required: "Please enter a password"
            }
		},
		submitHandler: function() {
			$.post("<?php echo base_url('signin');?>", {user_name:$('#user_name').val(), user_pwd:$('#user_pwd').val()}, function(result){
				if (result == 'ok') {
					$('#signin_modal').modal('hide');
					location.href = "<?php echo base_url('recruiter'); ?>";
					return true;
				} else if (result == 'deny') {
					$('#error_msg').text('Your account was blocked.');
				} else {
					$("#error_msg").show();
					$('#error_msg').text('The email or password you entered is incorrect.');
				}
			});
			return false;
        }
	});
//	$('.employees').click(function(e) {
//		<?php if ($this->session->userdata('CLIENT_ID')) { ?>  location.href="<?php echo base_url('/employee');?>";
//		<?php } else { ?> $("#enter_code_modal").load("<?php echo base_url('home/open_entercode');?>").modal({minHeight:180, minWidth:330}); <?php } ?>	
//    });
	$("#signup").click(function(e) {
		location.href="<?php echo base_url('home/open_signup');?>";
		//$('#enter_code_modal').load("<?php echo base_url('home/open_signup');?>").modal({minHeight:180, minWidth:330});
    });
	$('#signin_modal').modal({
		backdrop: true,
		show: false
	});
	$('#signin_modal').on('hide', function (){
		$("#user_name").val('');
		$("#user_pwd").val('');
		$(".error").addClass('hide');
		$("#error_msg").hide();
	});
	$('#signout_link').click(function(e) {
		location.href="<?php echo base_url('signout');?>";
		return;
    });
});

-->
</script>

<center>
<header>
<div class="home_header row-fluid">
	<div class="header_up row-fluid">
		<div class="header_logo"></div>
		<div class="visible-desktop">
			<div class="header_link">
				<a href="#about">About</a>
				<a href="#emp_rec">Employers & Recruiters</a>
				<a href="#staff">Prospective Staff</a>
				<a href="#contact">Contact us</a>
				<a href="#">Blog</a>
				<a href="#">Members</a>
				<?php 
				if ($this->logged_user->is_loggedin()) { 
					echo '<a href="#" id="signout_link">Sign out</a>';
				} else {
					echo '<a href="#signin_modal" data-toggle="modal" data-target="#signin_modal">Sign in</a>';
				}
				?>
				
			</div>
			<div class="header_image"></div>
		</div>
		<!--///////////////////////////////Translate///////////////////////////////////////-->		
		<div id="google_translate_element" class="span2"></div>
		<!--///////////////////////////////Translate///////////////////////////////////////-->
		<div id="login_modal"></div>
	</div>
</div>
</header>
<div class="modal fade" id="signin_modal">
	<form id="frm_signin">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4>Please enter your name and password.</h4>
	</div>
	<div class="modal-body">
	  	<div id="error_msg" class="error_msg"></div>
		<label for="user_name" class="signin_label">Username</label>
		<input type="text" name="user_name" id="user_name" value="" class="signin_input" />
		<label for="user_pwd" class="signin_label">Password</label>
		<input type="password" name="user_pwd" id="user_pwd" value="" class="signin_input" />
	</div>
	<div class="modal-footer">
		<button type="submit" id="btn_signin" class="btn btn-primary">Sign in now</button>
		<button class="btn" data-dismiss="modal">Close</button>
	</div>
	</form>
</div>
