  <div class="content_body" align="center" >
	<div  class="job_seeker_txt"><p>Job<br>Seekers</p></div>
  	<div class="job_pic"></div>
    	
  	<button id="enter_code" class="enter_code btn btn-primary" type="button">Enter code</button>
  	<div class="body_text">How it works</div>
  	<div class="how_it_work_pic"></div>
  </div> 
<script type="text/javascript">
$(document).ready(function () {
	$('#enter_code').click( function(){
		window.location.href="<?php echo base_url('home/open_entercode_view');?>";		
	});	
}); 
</script>