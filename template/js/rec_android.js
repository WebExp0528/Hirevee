
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
	
	setTimeout('time_ticker(' + time_limit + ')', 1000);
}

function finish_timing() {
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
				//alert("Recording Started.");
			}
			else {
				alert("Save start_time failed.");
			}
		
	});
}

function stop_recording() {
	
	time_limit = -1;
	//alert(time_limit);
	$('#state').val('stop');
	
//	$('#stop_btn').click(function(e) {
//		$('#upload').val(result);
//		
//	});
//	$('#upload').val(result);
	//alert($('#upload').val());
	//result_upload();
	$('#rec_state').submit();
}

function result_upload() {
	
	$.post(site_url + "employee/interview_result_upload_android",
		{
			user_id : user_id,
			question_id : question_id
		},	
		function(result) {
			alert(result);
			if (result == "ok") {
				alert("Uploaded Successed.");
			}
			else {
				alert("Upload Failed.");
			}
		
	});
}

function check_stop() {
	//time_limit = -1;
	$.post(site_url + "employee/check_stop", 
		{
			user_id : user_id,
			question_id : question_id
		},	
		function(result) {
			alert(result);
			if (result != "ok") {
				setTimeout("check_stop()", 1000);				
			}
			else {
				alert(result);
				//alert("Recording finished");
				stop_recording();
			}
		
	});
}

function checkApplicationInstall() {
	 var loc = "hireveeapp://android.camerarecording?url=http://192.168.1.100/interview/upload_android&time_limit="+time_limit+"&user_id="+user_id+"&question_id="+question_id;
	 //alert(loc);
	 document.checkframe.location = loc;
	 setTimeout("checkApplicationInstall_callback()", 1000);
	}
	
function checkApplicationInstall_callback() {
	 try {
	  var s = document.checkframe.document.body.innerHTML;
	 } catch (e) {
	 alert("Camera recording application is not installed.");
	 }
	}


$(document).ready(function(e) {
	//alert(time_limit);
	// $(this).load();
	// $('.empstart_button').click(function() {
	// location.href =site_url+"employee/recording";
	// });
	
	//$('.modal').modal({keyword:false, backdrop:'static'});

	$('#start_btn').click(function(e) {
		
		//alert(time_limit);
		if ($('#state').val() == 'ready'){
			time_limit = -1;
			//start_recording();
			//time_limit=180;
		}
		//if(time_limit == -1) time_limit = 180;
		//alert(time_limit);
		$('.btn_rec_start').hide();
		//$('.explain_text').hide();
		$('.btn_rec_stop').show();
		//$('iframe').show();
		
		// start record
		start_time_save();
		check_stop();
		checkApplicationInstall();
		//alert(time_limit);
	});
	
	$('#stop_btn').click(function(e) {
		stop_recording();
		
	});
	
	time_ticker();
	

});