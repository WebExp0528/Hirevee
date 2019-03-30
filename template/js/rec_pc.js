
function time_ticker() {
	if (time_limit < 0) {
		finish_timing();
		return;
	}

	min = parseInt(time_limit / 60);
	sec = time_limit % 60;

	min = (min < 10) ? "0" + min : min;
	sec = (sec < 10) ? "0" + sec : sec;

	$("#time_ticker").text(min + ":" + sec);
	time_limit--;
	
	window.setTimeout('time_ticker(' + time_limit + ')', 1000);
}

function finish_timing() {
	//alert("start???");
	//alert($('#state').val());
	if ($('#state').val() == 'ready') {
		start_recording();
	} else {
		stop_recording();
	}
}

function start_recording() {
	$.post(site_url + "employee/recording_start", 
		function(result) {
			if (result) {
				//alert(result);
				time_limit = result;
				time_ticker();
				//check_stop();
				$('#state').val('start');
				// video start				
			}
	});
}
function start_time_save() {
	//time_limit = -1;
	//alert(time_limit);
	$.post(site_url + "employee/start_time_save", 
		{
			user_id : user_id,
			question_id : question_id
		},	
		function(result) {
			//alert(result+"start");
			if (result == "ok") {
				alert("Recording Started.");
			}
			else {
				alert("Save start_time failed.");
			}
		
	});
}

function stop_recording(result) {
	
	time_limit = -1;
	//alert(time_limit);
	$('#state').val('stop');
	
//	$('#stop_btn').click(function(e) {
//		$('#upload').val(result);
//		
//	});
//	$('#upload').val(result);
	//alert($('#upload').val());
	result_upload();
	//$('#rec_state').submit();
}

function result_upload() {
	
	$.post(site_url + "employee/result_upload_pc",
		{
			user_id : user_id,
			question_id : question_id
		},	
		function(result) {
			//alert(result);
			if (result == "ok") {
				alert("Uploaded Successed.");
				$('#rec_state').submit();
			}
			else {
				alert("Upload Failed.");
			}
		
	});
}

$(document).ready(function(e) {
	//alert(time_limit);
	// $(this).load();
	// $('.empstart_button').click(function() {
	// location.href =site_url+"employee/recording";
	// });

	$('#start_btn').click(function(e) {
		//$('#form_result_name').submit();
		//alert("Recording now...");
		if ($('#state').val() == 'ready') {
			time_limit = -1;
			//start_recording();
		}
		//if ($('#state').val('start')) time_limit=180;
		//alert(time_limit);
		$('.btn_rec_start').attr("disabled", "disabled");
		//$('.btn_rec_start').hide();
		//$('.explain_text').hide();
		$('video').hide();
		
		$('.btn_rec_stop').removeAttr("disabled");
		//$('.btn_rec_stop').show();
		$('#recording_iframe').show();
		// start recode
		start_time_save();
		
		
		$.post(site_url + "template/recorder/settings.php", 
				{
					time_limit : 100
				}
		);
		
		
	});
	
	
	$('#stop_btn').click(function(e) {
		stop_recording();
	});

	time_ticker();
	
});