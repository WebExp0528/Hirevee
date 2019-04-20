<div align="center" style="margin: 10px">
		
			<input type="text" id="email" name="email" class="email" placeholder="enter email." style="width: 73%;">	
		    <input type="password" name="entercode" class="entercode" id="entercode" placeholder="Enter code." style="width: 73%;">		     
		     <button style="width: 75%" id="entercode_btn" class="btn btn-primary" type="button">Submit</button>
				
</div>

<script type="text/javascript">

$(document).ready(function(){


	$('#entercode').keypress(function () {
		$('#entercode').css('border', '1px solid #35a5f6');		
	});
	$('#email').keypress(function () {
		$('#email').css('border', '1px solid #35a5f6');		
	});

	
	$('#entercode_btn').click(function(){

		<?php if ($this->session->userdata('CLIENT_ID')) { ?>
		
		window.location.href="<?php echo base_url('home/open_takephoto_view');?>";
		return;
		
		<?php }?>
		
		var flag=false;
			if($('#email').val()==''){
				$('#email').css('border', '1px solid #ff0000');
				flag=false;
			}
			else{
				flag=true;
			}
			if($('#entercode').val()==''){
				$('#entercode').css('border', '1px solid #ff0000');
				flag=false;
			}
			else{
				flag=true;
			}
			if(flag){
				$.post("<?php echo base_url('verifing');?>", {enter_email:$('#email').val(), enter_code:$('#entercode').val()},
				function(result){
					if (result == 'ok') {
						window.location.href="<?php echo base_url('home/open_takephoto_view');?>";		
						return true;
					} else {
						alert('incorrect your email or entercode!');
					}
				});	

			}
	});
});
</script>