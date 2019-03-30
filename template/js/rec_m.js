
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
		$('#stop_btn').click();
	}
}

function start_recording() {
	//time_limit = -1;
	$.post(site_url + "employee/recording_start", 
		{
			user_id : user_id,
			question_id : question_id
		},	
		function(result) {
			//alert(result);
			if (result == "ok") {
				time_limit = 180;
				time_ticker ();
				$('#state').val('start');
				// video start				
			}
			else {
				alert("Save start_time failed.");
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
		//alert("Recording now...");
		if ($('#state').val() == 'ready') {
			start_recording();
		}
		//$('.btn_rec_start').attr("disabled", "disabled");
		$('.btn_rec_start').hide();
		$('.explain_text').hide();
		
		//$('.btn_rec_stop').removeAttr("disabled");
		$('.btn_rec_stop').show();
		$('video').show();
		// start recode
	});
	$('#stop_btn').click(function(e) {
		
		time_limit = -1;
		//alert(time_limit);
		$('#state').val('stop');
		$('#rec_state').submit();
	});

	time_ticker();
	

});