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
<script src="<?php echo config_item('js_url')?>jwplayer.js"></script>
<script>jwplayer.key="pPuyHFSKh7L1Uq45cjghdG4L9wpXFeWqelnR4w=="</script>



<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/c/video.js"></script>


<center>
<!-- <header class="struct structHeader">	 -->
 
<header class="header_bar">
<div style="height: 150px; width: 700px;"></div>
<div style="height: 5px; width: 700px; background-color: #990033"></div>

</header>
<!-- 	Contianer	 -->
<div class="main_container row-fluid" style="height: 450px; width: 700px; background-color: #f8f8f8;">
	
		
			<div class="video_rec row-fluid" style="background-color: #dbdbdb;">
				<?php if (isset($recruiter->video) || empty($recruiter->video)) { echo config_item('profile_video_url').'sample.mp4';?>
<!--					<video controls="true" poster="<?php echo config_item('image_url')?>video.gif"-->
<!--					 width="100%" height="100%" >-->
<!--					<source type="video/mp4" src="video/sample.mp4"></source>-->
<!--					</video>			-->

			<video id="opening_video_player" class="video-js vjs-default-skin" autoplay controls
			 width="700" height="450" poster="<?php //echo config_item('image_url')?>video.gif"
			  preload="auto" data-setup="{}">
			  <source type="video/mp4" src="<?php echo config_item('profile_video_url').'sample.mp4'?>">
			</video>

				<?php } else {  ?>
				<div id="player">Loading the player...</div>
					<script type="text/javascript">
					var filename = "<?php echo $recruiter->video?>";
					
					    jwplayer("player").setup({
					    	'width': '700',
					    	'height': '450',
					    	'autostart': true,
					    sources: [{
					            file: "rtmp://198.154.106.194:1935/vod/mp4:"+filename
					        },{
					            file: "http://198.154.106.194:1935/vod/"+filename+"/playlist.m3u8"
					        },{
					            file: "rtsp://198.154.106.194:1935/vod/mp4:"+filename
					        }]
					    });
					</script>
<!--				<video controls="true" poster="<?php //echo config_item('image_url')?>video.gif" width="100%" height="100%" >-->
<!--					<source src=""></source>			-->
<!--				</video>-->
				<?php }?>
			</div>
			
			<form id="take_photo" name="take_photo" action="" method="post">
			<div class="rec_control row-fluid" style="width: 100%; height: 100%; background-color: #dbdbdb;">
				
					<div class="" style="padding: 10px;">
						<button class="btn_rec_stop btn btn-primary" type="button"
						 id="take_photo_btn" style="height: 50px; width: 120px;" onclick="go_recording()">
						<b>Next</b></button>
					</div>
			</div>
			</form>
	
</div>
<!--///////////////////////////////Translate///////////////////////////////////////-->		
<!--		<div id="google_translate_element" class="span2"></div>-->
<!--///////////////////////////////Translate///////////////////////////////////////-->

<!-- <footer class="struct structFooter">

</footer>
-->


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script language="javascript">

	function go_recording() {
		location.href ="<?php echo site_url()?>employee/take_photo";
	}
</script>