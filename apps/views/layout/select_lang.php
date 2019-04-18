<?php
		$css_url =  $this->config->item('css_url');
		$js_url =  $this->config->item('js_url');
		$image_url =  $this->config->item('image_url');
		//translate("Welcome to Hire Vee!",$lang);
		$tar_lang = $this->input->post('selTargetLanguage', true);
		if (!$tar_lang)
		{
			echo 'no_tar_lang'.'<br>';
			$tar_lang = 'en';
		}
		//else $tar_lang = $this->input->post('selTargetLanguage', true);
		
		$this->session->set_userdata('tar_lang', $tar_lang);
		
		$tar_lang = $this->session->userdata('tar_lang');
		$org_lang = 'en';
		
		$org_text = $test_org_text;
		//$org_text = 'I am a man.';
		$tar_text = $this->input->post('selTargetLanguage1', true);
		
		echo $org_lang.'<br>';
		echo $tar_lang.'<br>';
		echo $tar_text.'<br>';
		
?>
<?php 
		echo link_tag($css_url.'bootstrap.css');
		echo link_tag($css_url.'bootstrap-responsive.css');
		echo link_tag($css_url.'common.css');
		
		echo '<script language="javascript">
		var base_url = "'.base_url().'";
		 var site_url = "'.site_url().'";
		  var org_lang = "'.$org_lang.'";
		   var tar_lang = "'.$tar_lang.'";
		    var org_text  = "'.$org_text.'";
		 </script>';
		
		//echo $this->javascript->external('http://code.jquery.com/jquery-latest.js');
		echo $this->javascript->external($js_url.'jquery-1.8.3.js');
		echo $this->javascript->external('https://www.google.com/jsapi');
		//echo $this->javascript->external($js_url.'jquery-1.8.3.js');
		echo $this->javascript->external($js_url.'jquery.blockUI.js');
		echo $this->javascript->external($js_url.'multi_lang.js');
		//echo $this->javascript->external($js_url.'rec_pc.js');
?>
<form name="langForm_text" id="langForm_text" action="<?php echo base_url('employee/emp_start');?>" method="post"> 
	<input type="hidden" name="translated_string" id="translated_string">
	<input type="text" name="translated_string1" id="translated_string1">
	<input type="text" name="translated_string2" id="translated_string2" value="<?php echo $tar_text;?>">
	<input type="hidden" name="current" id="current" value="<?php echo substr(uri_string(),1,strlen(uri_string()));?>">
</form>
<form name="langForm" id="langForm" action="" method="post">
	<select id="selTargetLanguage" name="selTargetLanguage" ></select>
</form>