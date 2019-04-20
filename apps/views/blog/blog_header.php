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

<div class="header row-fluid">
	<div class="header_up row-fluid">
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
		<div class=" span2" ></div>
		<div class="header_mark"></div>
	</div>
	<div class="header_down row-fluid">
		<div class="span2 offset2">
			<br><p class="top_title_big "><b><?php echo $title; ?></b></p><br>
			<p class="top_title_small pull-left"  style="color: #fff;"><a href="<?php echo site_url();?>"  style="color: #fff;">HireVee &nbsp;</a>/
			<?php if(isset($subtitle)):?>
			<a href="<?php echo base_url('blog');?>"  style="color: #fff;"> <?php echo $subtitle; ?></a>
			<?php endif;?>
			
			<?php if(isset($aticletitle)):?>
				/ <a href="#"  style="color: #fff;"> <?php echo $aticletitle; ?></a>
			<?php endif;?>
			</p>
			<div class="home_header_bt row-fluid">
		<div class="home_header_bt_mark row-fluid"></div>
	</div>
		</div>
		<div class="header_search">
			<form id="search_form" action="<?php echo base_url('/blog/search_blog' );?>" class="navbar-search pull-right" method="post">
				    
					    <div class="input-append">
					    	<?php 
					    	if(empty($search_value))
					    		$search_value=' ';
					    	?>
						    <input type="text" 	 id="search_key" name="search_key" class="search" placeholder="Search on blog" style="border-right: hidden;" value="<?php echo $search_value;?>">
						    <span class="add-on"><i class="icon-search"></i></span>
					    </div>
    				
				
			</form>
		</div>
	</div>
</div>

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


<script type="text/javascript">
<!--
	$('#search_form').submit(function() {		
	    if($('#search_key').val()== '') {
	         return false;
	    } else {
		    return true;
	    }
	});

//-->
</script>
