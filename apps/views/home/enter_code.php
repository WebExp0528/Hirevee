<script type="text/javascript" src="<?php echo config_item('js_url').'jquery.validate.js';?>" ></script>
<script type="text/javascript" src="<?php echo config_item('js_url').'jquery.simplemodal.js';?>" ></script>
<script type="text/javascript" src="<?php echo config_item('js_url').'jquery.placeholder.js';?>" ></script>
<script type="text/javascript">
<!--
$(document).ready(function(e) {
	$('#id_verify_code').click(function(e) {
		var email = $('#enter_email').val();
		var code = $('#enter_code').val();
		
		if(!email){
			$('.message').html('Please enter your E-mail.');
			var cheight = $('.basic-modal-code').height() + 20;
			$('#simplemodal-container').height(cheight);
			return;
		}
		if(!code){
			$('.message').html('Please enter your code.');
			var cheight = $('.basic-modal-code').height() + 20;
			$('#simplemodal-container').height(cheight);
			return;
		}
		enter_code(email,code);
	});
});

function enter_code(email,code){
	$.post( "<?php echo base_url('verifing');?>",
		{
			enter_email: email,
			enter_code: code
		}, 
		function(result){
//alert(result);
			if(result == "ok"){
				$.modal.close();
				location.replace('<?php echo base_url('employee');?>');
			} else {
				$('.message').html('Your email or code is incorrected!');
				var cheight = $('.basic-modal-code').height() + 20;
				$('#simplemodal-container').height(cheight);
			}
	});
}

-->
</script>
<div class="basic-modal-code">
	<div class="signin">
		<div class="alert_inner_window">
			<div class="titleContainer">
				<span class="title" >Enter code!</span>
			</div>
			<div class="lightboxContent_login">
				<div class="enter_code_box">
					<form id="enter_code_form" method="post">
						<div class="enter_code_fields">
							<div class="enter_code_field">
								<input class="inputSmall" type="text" name="enter_email" id="enter_email" placeholder="E-mail"/>
							</div>
							<div class="enter_code_field">
								<input class="inputSmall" type="text" name="enter_code" id="enter_code" placeholder="Code"/>
							</div>
							<div class="clear-both"></div>
						</div>
						<p class="message"></p>
						<div>
						<div class="submit">
							<input class="verify_code" id="id_verify_code" type="button" value="Verify Code">
						</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>	
