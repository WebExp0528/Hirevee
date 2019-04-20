<style>
<!--
//css
.file_input_textbox
{
float: left
}
 
.file_input_div
{
position: relative;
width: 200px;
height: 35px;
overflow: hidden;
}
 
.file_input_button
{
width: 130px;
height: 30px;
}
 
.file_input_hidden
{
font-size: 45px;
position: absolute;
right: 0px;
top: 0px;
opacity: 0;
 
filter: alpha(opacity=0);
-ms-filter: "alpha(opacity=0)";
-khtml-opacity: 0;
-moz-opacity: 0;
}
-->
</style>
<div class="takephoto_bar_mobile" align="center">
	<div class="take_photo">Take Photo</div>		
</div>

<div align="center" style="height:80%">

<div style="width: 70%;height: 30%;font-size: 18px;color: #a20e30;font-weight: bold">
<p>
	Please select your Photo.
	In order to enter test, you must select your photo.
	Good luck for your interview.
</p>
</div>

<?php echo form_open_multipart('employee/mobileImageUpload', array('method' => 'post', 'id' => 'uploade_image', 'name' => 'upload_image'));?>

<input type="text" id="fileName" class="file_input_textbox" readonly="readonly" placeholder="selected image name">
<div class="file_input_div">
	<input type="button" value="select photo" class="file_input_button" style="width: 100%;"/>
	<input type="file" class="file_input_hidden" id="take_photo_btn" name="take_photo_btn" style="width: 100%;" onchange="javascript: document.getElementById('fileName').value = this.value" />
</div>





<input style="margin-top: 15px;width: 200px;" type="submit"" id="add_photo_btn" name="add_photo_btn" class="add_photo_btn" value="SendPhoto">
</from>
</div>
<script type="text/javascript">
<!--
$(document).ready(function() {
	$('#add_photo_btn').click(function(){
		if($('#take_photo_btn').val()==''){
			alert('please select your photo!');
			return false;
		}
		return true;
		
	});


	
});
-->
</script>
<!--<a href="<?php echo site_url();?>employee/recording">-->