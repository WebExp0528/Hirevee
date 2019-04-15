<script type="text/javascript">
<!--$(document).ready(function(e) {
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
});
</script>
<!-----------------********************************** Interview Staff ******************---------------------------->
<section>
<div class="home_staff row-fluid">
	<div class="header_down row-fluid">
		<div class="span1"></div>
		<div class='span3'>
			<div class="name_caption">Employees</div>
			<div class="employees"></div>
			<div class="entercode" data-toggle="modal" data-target="#entercode_modal">Enter Code</div>
		</div>
		<div class="interview_title span4">
			<?php echo $notice['staff']->subject;?>
			<hr>
			<?php echo $notice['staff']->content;?>
		</div>
		<div class="span3">
			<div class='name_caption'>Recruiters</div>
			<div class="recruiter"></div>
			<div class="entercode" id="signup">Sign up</div>
		</div>
		<div class="span1"></div>
	</div>
	<div class="enter_code_modal" id="enter_code_modal"></div>
</div>
<div class="modal hide fade" id="entercode_modal">
	<form id="frm_enter_code">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4>Please enter your email and code.</h4>
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
</section>
<!-----------------********************************** About our Company ******************---------------------------->
<section>
<div class="hirevee_contents row-fluid">

	<!-- <div class="empstart_left_space span2"></div> -->
	<div class="hirevee_contents span8 offset2">	
		<section>
			<div class="row-fluid">
				<a name="about" class="none_link"><?php echo $notice['about']->subject;?></a>
			</div>
			<div class="banner"><?php echo img(config_item('image_url').'banner.png');?></div>
		</section>
		
		<section>
			<div class="description span3" style="width: 970px;margin-bottom: 30px;"><?php echo $notice['about']->content;?></div>
		</section>
		
		<section>
			<div class="banner" style="margin-bottom: 60px;"><?php echo img(config_item('image_url').'meda.png');?></div>
		</section>	
	</div>
	<!-- <div class="empstart_right_space span2"></div> -->
</div>
</section>
<!-----------------********************************** Employers & Recruiters ******************---------------------------->
<section style="background-color: #EEEEEE">
<div class="empl_and_recr row-fluid">

	<!-- <div class="empstart_left_space span2"></div> -->
	<div class="hirevee_contents span8 offset2">	
		<section>
		<div class="row-fluid"  style="margin-top: 90px;">
				<a name="emp_rec" class="none_link"><?php echo $notice['job']->subject;?></a>
			</div>
			
		</section>
		
		<section>
			<div class="span12"><a><?php echo img(config_item('image_url').'employees&recruiters.png');?></a></div>
		</section>
	
	</div>
	<!-- <div class="empstart_right_space span2"></div> -->
</div>
</section>
<!-----------------********************************** Prospective Staff ***************************---------------------------->
<section>
<div class="prospective_staff row-fluid">

	<!-- <div class="empstart_left_space span2"></div> -->
	<div class="hirevee_contents span8 offset2">
		<section style="margin-top: 30px">
			<div class="row-fluid">
				<a name="staff" class="none_link"><?php echo $notice['prospective']->subject;?></a>
			</div>
			<div class="banner"><?php echo img(config_item('image_url').'banner.png');?></div>
		</section>
	
		<section style="margin: 50px;">
				<div class="span1"></div>		
			<div class="span3"  style="margin-right: 0px;;margin-bottom: 10px;padding-top:30px;padding-bottom:30px; text-align: left"><?php echo $notice['prospective']->content;?></div>
			<div class="span8 pull-right" style="margin-bottom: 60px"><a><?php echo img(config_item('image_url').'prospective_staff.png');?></a></div>
		</section>
		
		
	</div>
	<!-- <div class="empstart_right_space span2"></div> -->
</div>
</section>
<!-----------------********************************** From the blog *****************************---------------------------->
<section style="background-color: #EEEEEE">
<div class="from_blog row-fluid">

		<div class="span3"></div>
		<div class="fromblog span6">
			<span style="font-size: 30px;line-height: 1.2em; color:#ad1036;margin-bottom:60px; "><strong>From the Blog</strong></span><br>
			<div class="fromposts row-fluid">
						<div class="post_pic span3"><?php echo img(config_item('image_url').'post_pic.gif');?></div>
						<div class="span7">
									<div class="from_blog_title" style="text-align: left font-size: 15px; color: #006bdf;">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh</div>
									<div class="row-fluid pull-left margin:0;padding:0" style="float:left ;text-align: left ;font-size:11px" >
										<div class=" span3 Date"  style="margin:0px; padding:0px">2012/12/25&nbsp;|</div>
										<div class=" span3 Author" style="margin:0px; padding:0px">Author: Admin &nbsp;|</div>
										<div class=" span3 category" style="margin:0px; padding:0px">category: Business&nbsp;|</div>
										<div class=" span3 comments" style="margin:0px; padding:0px">24comments</div>
									</div>
									<div class="contents"  style="letter-height:1em">
									<p >Donec ullamcorper nulla non metus auctor fringilla.Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis.Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p></div>

						</div>
			</div>
			<div class="fromposts row-fluid">
						<div class="post_pic span3"><?php echo img(config_item('image_url').'post_pic.gif');?></div>
						<div class="span7">
									<div class="from_blog_title" style="text-align: left font-size: 15px; color: #006bdf;">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh</div>
									<div class="row-fluid pull-left margin:0;padding:0" style="float:left ;text-align: left ;font-size:11px" >
										<div class=" span3 Date"  style="margin:0px; padding:0px">2012/12/25&nbsp;|</div>
										<div class=" span3 Author" style="margin:0px; padding:0px">Author: Admin &nbsp;|</div>
										<div class=" span3 category" style="margin:0px; padding:0px">category: Business&nbsp;|</div>
										<div class=" span3 comments" style="margin:0px; padding:0px">24comments</div>
									</div>
									<div class="contents"  style="letter-height:1em">
									<p >Donec ullamcorper nulla non metus auctor fringilla.Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis.Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p></div>

						</div>
			</div>
			<div class="fromposts row-fluid">
						<div class="post_pic span3"><?php echo img(config_item('image_url').'post_pic.gif');?></div>
						<div class="span7">
									<div class="from_blog_title" style="text-align: left font-size: 15px; color: #006bdf;">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh</div>
									<div class="row-fluid pull-left margin:0;padding:0" style="float:left ;text-align: left ;font-size:11px" >
										<div class=" span3 Date"  style="margin:0px; padding:0px">2012/12/25&nbsp;|</div>
										<div class=" span3 Author" style="margin:0px; padding:0px">Author: Admin &nbsp;|</div>
										<div class=" span3 category" style="margin:0px; padding:0px">category: Business&nbsp;|</div>
										<div class=" span3 comments" style="margin:0px; padding:0px">24comments</div>
									</div>
									<div class="contents"  style="letter-height:1em">
									<p >Donec ullamcorper nulla non metus auctor fringilla.Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis.Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p></div>

						</div>
			</div>
		</div>
		<div class="form_twitter span2">
						<div class="twiterfeed_box">
				<h2 class="twiterfeed_title">Twitter feed</h2><!-- Twitter feed ---------------------------->
							 <hr>
								  <p>
									Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
									commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.
									<small>Someone famous <cite title="Source ">Source Title</cite></small>
									</p>
							  <hr>
									 <p>
									Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
									<small>Someone famous <cite title="Source ">Source Title</cite></small>
								</p>
							  <hr>
							  </div>
							 
		</div>
		<div class="span1"></div>
			
		
		
	</div>
	<!-- <div class="empstart_right_space span2"></div> -->
</div>
</section>
