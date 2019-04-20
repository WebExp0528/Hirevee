<style type="text/css">
#background {
    width: 100%; 
    height: 100%; 
    position: fixed; 
    left: 0px; 
    top: 0px; 
    z-index: -1; /* Ensure div tag stays behind content; -999 might work, too. */
}

.stretch {
    width:100%;
    height:100%;
}
</style>
<div id="background">
    <img src="<?php echo $banner_image;?>" class="stretch" alt="" />
</div>
<center>
<!-- <header class="struct structHeader">	 -->
<script type="text/javascript" src="<?php echo config_item('js_url');?>webcam.js"></script>

<!-- Configure a few settings -->
	<script language="JavaScript">
		webcam.set_api_url( '<?php echo base_url('employee/upload_photo');?>' );
		webcam.set_swf_url( '<?php echo config_item('js_url');?>webcam.swf' );
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true, '<?php echo config_item('js_url');?>shutter.mp3' ); // play shutter click sound
	</script>
	
<header class="header_bar">
<div style="height: 150px; width: 700px;"></div>
<div style="height: 5px; width: 700px; background-color: #990033"></div>

</header>
<!-- 	Contianer	 -->
<div class="main_container row-fluid" style="height: 450px; width: 700px; background-color: #f8f8f8;">
	
		
			<div class="video_rec row-fluid" style="background-color: #dbdbdb;">
				<script language="JavaScript">
					document.write( webcam.get_html(700, 450, 230, 150) );
				</script>
			</div>
			
			<form id="take_photo" name="take_photo" action="" method="post">
			<div class="rec_control row-fluid" style="width: 100%; height: 100%; background-color: #dbdbdb;">
				
					<div class="" style="padding: 10px;">
					<a href="javascript:void(webcam.snap())">
						<button class="btn_rec_stop btn btn-primary" type="button" id="take_photo_btn"
						 style="height: 50px; width: 150px;" onclick="">
						<b>Take photo</b></button></a>
					</div>
			</div>
			</form>
	
</div>

<!-- Le javascript================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		function my_completion_handler(msg) {
			// extract URL out of PHP output
			if (msg.match(/(http\:\/\/\S+)/)) {
				location.href ="<?php echo site_url()?>employee/recording";
				//webcam.reset();
			}
			else alert("PHP Error: " + msg);
		}
	</script>