<?php 
	echo '<script language="javascript">
	var base_url = "'.base_url().'";
	var site_url = "'.site_url().'";
	var user_id = "'.$client_id.'";
	var question_id = "'.$question->id.'";
	var time_limit = '.($sess_think_time - time()).';
	</script>';
	
	echo $this->javascript->external('http://code.jquery.com/jquery-latest.js');
	echo $this->javascript->external(config_item('js_url').'rec_m.js');
	//echo 'current state : '.$state;
	//echo $sess_think_time - time();
?>
	
	
	<div class="explain_text" <?php if ($state == 'start') { echo 'style="display: none;"';}?>>
		<p><?php
				echo $question->question;
			?>
		</p><hr>
	</div>
	
	<div class="video_rec row-fluid" style="background-color: #dbdbdb; margin-top: -30px;height: 60%" <?php if ($state != 'start') { echo 'style="display: none;"';}?>>
<!--		<video controls="true" width="100%">-->
		<video controls="true" 
		 <?php if ($state != 'start') { echo 'style="display: none;"';}?>
		 poster="<?php echo config_item('image_url')?>video.gif" width="100%">
		</video>
	</div>
	
	
	
	
	<form style="margin: 0;padding: 0" id="rec_state" name="rec_state" action="<?php echo site_url('employee/recording');?>" method="post">
<!--	<div align="center" class="time_box">-->
		<div class="rec_control row-fluid" align="center">
	
		<!--	display steps	-->
			<div><?php echo $step.'   of   '.$quest_count;?></div>
			
		<!--	timer image		-->
			<div class="time_pic"><img src="<?php echo config_item('image_url')?>m_timer.png" ></div>
			
		<!--	display time	-->
			<div class="display_time" id="time_ticker" >00:00</div>
			
		<!--	2 Buttons for control	-->
			<!--	<button class="explain_start_btn btn  btn-primary" type="button">Start</button>-->
			<button class="btn_rec_start btn btn-primary"
			 type="button" id="start_btn"
			  <?php if ($state == 'start') { echo 'style="display: none;"';}?>>Start</button>
			
			<button class="btn_rec_stop btn btn-primary"
			 type="button" id="stop_btn"
			  <?php if ($state != 'start') { echo 'style="display: none;"';}?>>Stop</button>
			
			<input type="hidden" id="state" name="state" value="<?php echo $state?>"></input>
			<input type="hidden" id="step" name="step" value="<?php echo $step?>"></input>
		</div>
	</form>
	
				
					
		
		
		
		
		
		