<?php
	$css_url =  $this->config->item('css_url');
	$js_url =  $this->config->item('js_url');
	$image_url = $this->config->item('image_url');
	//translate("Welcome to Hire Vee!",$lang);
		
	echo '<script language="javascript">
	var base_url = "'.base_url().'";
	var site_url = "'.site_url().'";
	var user_id = "'.$client_id.'";
	var question_id = "'.$question->id.'";
	var time_limit = '.($sess_think_time - time()).';
	</script>';
	
	echo $this->javascript->external('http://code.jquery.com/jquery-latest.js');
	echo $this->javascript->external($js_url.'rec_pc.js');
	//echo 'current state : '.$state;
	//echo $sess_think_time - time();
?>
<center>
<!-- <header class="struct structHeader">	 -->
 
<header class="header_bar">
<div style="height: 70px; width: 990px;"></div>
<!--<div style="height: 5px; width: 990px; background-color: #990033"></div>-->
<div style="background: url('<?php echo $image_url?>rec_header_bar.png'); height: 100px; width: 990px;">
	<div class="row-fluid">
		<div class="span2" style="font-size: 45px; color: #990033; padding: 40px; font-weight: bold;">Interview</div>
		<div class="span4 offset1" style="font-size: 15px; color: #0066bb; padding-top: 45px;">
			<a href="" target="">Recruiters Details</a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="" target="">Job Details</a></div>
			
		<!--///////////////////////////////Translate///////////////////////////////////////-->		
		<div id="google_translate_element" class="span2" style="padding-top: 50px;"></div>
		<!--///////////////////////////////Translate///////////////////////////////////////-->
		<div class="span3">
			<a href="<?php echo site_url('/');?>" title="home"><div class="header_logo" style="padding: 10px 10px 0 0; float: right;"></div></a>
		</div>
	</div>
</div>

</header>
<!-- 	Contianer	 -->
<div class="main_container row-fluid" style="height: 550px; width: 990px; background-color: #f8f8f8;">
	
		<div class="left_container span4 row-fluid">
			<div class="howitworks" style="float: left;">
				<div style="font-size: 23px; color: #990033; font-weight: bold; padding-top: 20px; text-align: left; padding-left: 30px">
				<br>
				How it works
				</div>
				<div style="padding-left: 30px"><hr></div>
				<div>
				      <img alt="" src="<?php echo $image_url?>how_it_work1.png" style="padding-left: 50px;">
				      <img alt="" src="<?php echo $image_url?>how_it_work2.png">
				</div>			
			</div>
			<div class="question" style="float: left;">
			
				<div style="font-size: 23px; color: #990033; font-weight: bold; padding-top: 20px; text-align: left; padding-left: 30px">
				<br>
				Question to Answer
				</div>
				<div style="padding-left: 30px"><hr></div>
				<div style="padding: 0 30px; text-align: left; color: #000000; font-weight: lighter;">
				<?php
				echo $question->question;
				?>
				</div>
				<div style="padding-left: 30px"><hr></div>
			</div>
			<div class="processbar">
<!--			<meter class="" value="2" min="0" low="3" high="7" max="10" optimum="10" contenteditable="true">step 2</meter> -->
				<progress value="<?php echo $step - 1;?>" max="<?php echo $quest_count;?>" style="width: 230px; height: 20px;"></progress>
				<div style="padding: 0 30px; color: #000000; font-weight: bold; width: 50%;">
				<?php
				//echo $question->question;
				echo $step.'   of   '.$quest_count;
				?>
				</div>
			</div>
			
		</div>
	
		<div class="right_container span8 row-fluid" style="background-color: #FFFFFF; height: 550px; padding: 10px 50px;">		
			<div class="job_title row-fluid">
				<div class="span6" style="text-align: left; font-size: 33px; font-weight: bold; color: #990033; padding-top: 15px; line-height: 30px;">
					<?php echo $job_name;?>
				</div>
				<div class="span4 offset2" style="text-align: right; font-size: 33px; font-weight: bold; color: #009999;">
<!--					<span style="background-image: url('<?php echo $logo_image;?>');">-->
					<img title="logo" src="<?php echo $logo_image;?>" width="70%" height="70%">
<!--					SIEMENS</span>-->
				</div>
			</div>
			<div class="video_rec row-fluid" style="background-color: #dbdbdb; margin-top: 10px;">
				<iframe id="recording_iframe" width="100%" height="300" frameborder="0" name="recording_iframe"
				 src="<?php echo site_url('template/recorder/')?>?result_id=<?php echo $result_id?>" scrolling="no" marginwidth="-20", marginheight="-20"
				  allowTransparency="true"
				  <?php if ($state != 'start') { echo 'style="display: none;"';}?>>
				</iframe>
				<video controls="true" <?php if ($state == 'start') { echo 'style="display: none;"';}?>
				 width="100%" height="300" >		
				</video>
			</div>
			
			<form id="rec_state" name="rec_state" action="<?php echo site_url('employee/recording');?>" method="post">
			<div class="rec_control row-fluid" style="width: 100%; height: 100%; background-color: #dbdbdb;">
				
					<div class="span4" style="padding: 10px;">
						<button class="btn_rec_start btn btn-success" type="button" name="" id="start_btn" <?php if ($state == 'start') { echo 'disabled="disabled"';}?> style="height: 40px; width: 120px;">
						<b>START</b></button></div>
					<div class="span2">
					<img alt="" src="<?php echo $image_url?>timer.png" width="50" height="50" style="padding-top: 5px"></div>
					<div class="display_time span2" id="time_ticker" style="font-size: 30px;padding-top: 20px;">00:00</div>			
					<div class="span4" style="padding: 10px;">
						<button class="btn_rec_stop btn btn-primary" type="button" id="stop_btn"  <?php if ($state != 'start') { echo 'disabled="disabled"';}?> style="height: 40px; width: 120px;">
						<b>STOP</b></button></div>
					<input type="hidden" id="state" name="state" value="<?php echo $state?>"></input>
					<input type="hidden" id="step" name="step" value="<?php echo $step?>"></input>
				
			</div>
			
			</form>
		</div>
	
</div>



<!-- <footer class="struct structFooter">

</footer>
-->


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script language="javascript">-->
<!--</script>-->
<!--			-->
<!--<script src="assets/js/bootstrap-typeahead.js"></script>-->
<!--</center>-->