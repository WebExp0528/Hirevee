<?php 
	echo '<script language="javascript">
	var base_url = "'.base_url().'";
	var site_url = "'.site_url().'";
	var user_id = "'.$client_id.'";
	var question_id = "'.$question->id.'";
	var time_limit = '.($sess_think_time - time()).';
	</script>';
	
	echo $this->javascript->external('http://code.jquery.com/jquery-latest.js');
	echo $this->javascript->external(config_item('js_url').'rec_android.js');
	//echo 'current state : '.$state;
	//echo $sess_think_time - time();
?>
	<script type="text/javascript">
		

	</script>
	<div class="explain_text">
		<p><?php
				echo $question->question;
			?>
		</p><hr>
	</div>
	<form name="upload">
        <input type="file" name="upload" id="upload" style="display: none;">
    </form> 
	
	<div class="video_rec row-fluid" style="background-color: #fff;" <?php if ($state != 'start') { echo 'style="display: none;"';}?>>
			<iframe 
			<?php if ($state != 'start') { echo 'style="display: none;"';}?>
			 id="checkframe" name="checkframe" src="check.html" width="1" height="1" frameborder="0"></iframe>
	</div>
	
	
	
	
	<form style="margin: 0;padding: 0" id="rec_state" name="rec_state" action="<?php echo site_url('employee/recording');?>" method="post">
<!--	<div align="center" class="time_box">-->
		<div class="rec_control row-fluid" align="center">
	
		<!--	display steps	-->
			<div><?php echo $step.'   of   '.$quest_count;?></div>
			
		<!--	timer image		-->
			<div class="time_pic span2 offset4">
			<img src="<?php echo config_item('image_url')?>m_timer.png" ></div>
			
		<!--	display time	-->
			<div class="display_time span1" id="time_ticker" >00:00</div>
			
		<!--	2 Buttons for control	-->
			<!--	<button class="explain_start_btn btn  btn-primary" type="button">Start</button>-->
			<a href="#rec_waiting_modal" role="button" class="btn_rec_start btn btn-primary" 
			 type="button" id="start_btn" data-toggle="modal"
			 <?php if ($state == 'start') { echo 'style="display: none;"';}?>>Start</a>
			 
			 <button class="btn_rec_stop btn btn-primary"
			 type="button" id="stop_btn"
			  <?php if ($state != 'start') { echo 'style="display: none;"';}?>>Stop</button>
			 
			<input type="hidden" id="state" name="state" value="<?php echo $state?>"></input>
			<input type="hidden" id="step" name="step" value="<?php echo $step?>"></input>
		</div>
	</form>
	
<!-- /////////////////////////		RECORDING WAITING MODAL		//////////////////////////// --> 
<div id="rec_waiting_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
<!--			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>-->
		<h3 id="myModalLabel">Recording Now ...</h3>
	</div>
	<div class="modal-body" style="text-align: center;">
		Please wait...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<img src="<?php echo config_item('image_url')?>ajax-loader-7.gif">
	</div>
	<div class="modal-footer">
		<span class="message_question"></span>
	</div>
</div>