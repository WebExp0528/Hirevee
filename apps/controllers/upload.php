<?php
class Upload extends MY_Controller {
	public function __construct() {
		parent::__construct ();
	
	}
	
	function index() {

			print_r($_FILES);
			$new_image_name = "potho.jpg";
			move_uploaded_file($_FILES["file"]["tmp_name"], UPLOAD_IMAGE_PATH.$new_image_name);

	}
	function test(){
		$this->load->view('home/test');
	}
	function camera(){
		$this->load->view('blog/camera_capture');
	}

}
?>
