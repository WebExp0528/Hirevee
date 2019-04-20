<?php
class Employee extends MY_Controller
{
	public function index()
	{
		$this->emp_start();
	}
	
	function languages()
	{
	   //extract($_POST);
	   $tar_lang = $this->input->post('selTargetLanguage', true);
	   $translated = $this->input->post('translated_string', true);
	   $current = $this->input->post('current', true);
	   $this->session->set_userdata('tar_lang', $tar_lang);
	   $redirect_url = base_url('employee/emp_start');
	   redirect('/');	
	
	}
	
	public function emp_start()
	{
//		if (!$this->logged_user->is_loggedin()) //set user_id ???
//			redirect('/');
		$data = array();
		$data['title'] = 'Employee Start';
		//$data['head_css'] = array(config_item('css_url') . 'jquery.ui.dialog.css');
		
		$this->load->library('javascript');
		$this->load->model('client_model');
		
		$client_id = $this->session->userdata('CLIENT_ID');
		$client_job_id = $this->session->userdata('CLIENT_JOB_ID');
		
		if (!$client_id && !$client_job_id)
		{
			//echo '<h1>failed, no client!</h1>';
			redirect('/');
		}
		$client = $this->client_model->get_by_id($client_id, $client_job_id);
		//dumpr($client);
	
		if ($client->first_name == "" || $client->surname == "")
		{
			echo '<h1>failed, Client non-exist!</h1>';
			//redirect('/');
		}
		$data['first_name'] = $client->first_name;
		$data['surname'] = $client->surname;
		
		
		// assign those session variable to one variable.
		///////////////////////////////////////////////////////////////////////////////////////////
			//$this->load->helper('t');
			//$text = 'I am a student.';
			//$toLang = 'ch'; //or any other language - http://code.google.com/apis/language/translate/v2/using_rest.html#language-params
			//echo t($text, $toLang);
		///////////////////////////////////////////////////////////////////////////////////////////
		
		//$data['lang'] = $this->session->userdata('language');
		
		$data['welcome'] = 'Welcome';
		///////////////////////////////////////////////////////////////////////////////////////////
		$this->refresh_data('employee/emp_start', $data);
		//$this->load->view('employee/emp_start', $data);
	}
	
	public function take_photo()
	{
		$this->load->library('javascript');
		$this->load->model('job_model');
		$this->load->model('question_model');
		$this->load->model('result_model');
		$this->load->model('recruiter_model');
		
		$client_id = $this->session->userdata('CLIENT_ID');
		$client_job_id = $this->session->userdata('CLIENT_JOB_ID');
		if (!$client_id && !$client_job_id)
		{
			//echo '<h1>failed, no client!</h1>';
			redirect('/');
		}
		
		$job = $this->job_model->get_by_id($client_job_id);
		$data['job_name'] = $job->job_name;
		
		$data['id_user'] = $job->id_user;		
		$recruiter = $this->recruiter_model->get_user_data($data['id_user']);
		$data['banner_color'] = $recruiter->banner_color;
		
		if ($recruiter->banner_img) $data['banner_image'] = config_item('banner_image_url').$recruiter->banner_img; 
		else $data['banner_image'] = config_item('image_url').'interview_bg.png';
		
		$data['title'] = 'Take Photo';
		$this->load->view('layout/header', $data);
		$this->load->view('employee/take_photo', $data);
		$this->load->view('layout/footer', $data);
		
		
	}
	
	public function welcome_interview()
	{
		$this->load->library('javascript');
		$this->load->model('job_model');
		$this->load->model('question_model');
		$this->load->model('result_model');
		$this->load->model('recruiter_model');
		
		$client_id = $this->session->userdata('CLIENT_ID');
		$client_job_id = $this->session->userdata('CLIENT_JOB_ID');
		if (!$client_id && !$client_job_id)
		{
			//echo '<h1>failed, no client!</h1>';
			redirect('/');
		}
		$job = $this->job_model->get_by_id($client_job_id);
		$data['job_name'] = $job->job_name;
		
		$data['id_user'] = $job->id_user;		
		$recruiter = $this->recruiter_model->get_user_data($data['id_user']);
		$data['recruiter'] = $recruiter;
		$data['banner_color'] = $recruiter->banner_color;
		
		if ($recruiter->banner_img) $data['banner_image'] = config_item('banner_image_url').$recruiter->banner_img; 
		else $data['banner_image'] = config_item('image_url').'interview_bg.png';
		
		$data['title'] = 'Welcome Interview';
		$this->load->view('layout/header', $data);
		$this->load->view('employee/welcome_interview', $data);
		$this->load->view('layout/footer', $data);
	}
	
	public function recording()
	{
		$this->load->library('javascript');
		$this->load->model('job_model');
		$this->load->model('question_model');
		$this->load->model('result_model');
		$this->load->model('recruiter_model');
	//dumpr($this->session->userdata);
		$client_id = $this->session->userdata('CLIENT_ID');
		$client_job_id = $this->session->userdata('CLIENT_JOB_ID');
		
		$data ['client_id'] = $this->session->userdata('CLIENT_ID');
	//dumpr($client_id);
	//dumpr($client_job_id);
		//echo $client_id;	
		if (!$client_job_id)
		{
			//echo '<h1>failed, no job_id!</h1>';
			redirect('/');
		}
		//$id_user = 3;
		$job = $this->job_model->get_by_id($client_job_id);
		if (!$job)
		{
			echo 'failed, no job!';
			return;
		}
		//$data['id'] = $job->id;
		$data['job_name'] = $job->job_name;
		
		$data['id_user'] = $job->id_user;		
		$recruiter = $this->recruiter_model->get_user_data($data['id_user']);
		$data['banner_color'] = $recruiter->banner_color;
		
		if ($recruiter->banner_img) $data['banner_image'] = config_item('banner_image_url').$recruiter->banner_img; 
		else $data['banner_image'] = config_item('image_url').'interview_bg.png';
		
		if ($recruiter->logo_path) $data['logo_image'] = config_item('logo_recruiter_url').$recruiter->logo_path; 
		else $data['logo_image'] = config_item('image_url').'logo_1.png';
		
		
		//$question_id = array();
		$question_id = $this->result_model->get_question_id($client_id);
	//dumpr($question_id);
		if (!$question_id)
		{
			echo 'failed, no any questions!';
			return;
		}
		
		$quest_num = count($question_id);
		for ($i=0; $i<$quest_num; $i++)
		{
			$questions[$i] = $this->question_model->get_by_id($question_id[$i]);
		}
		
		//$questions = $this->question_model->get_by_id($question_id[0]);
		//$data['questions'] = $questions[2];
		//dumpr($data['questions']);

		$think_time = time() + QUESTION_READY_TIME;
		$answer_time = time() + QUESTION_ANSWER_TIME;
		
		$state = $this->input->post('state', true);
		if (!$state)
			$state = 'ready';
		$step = $this->input->post('step', true);
		if (!$step)
			$step = 0;
	//dumpr($this->session->userdata('SESS_QUESTION'));
		//echo $current_state;
		$sess_val = array();
		$sess_quest = $this->session->userdata('SESS_QUESTION');
		$sess_val['state'] = ($sess_quest) ? $sess_quest['state'] : 'ready';
		$sess_val['step'] = ($sess_quest) ? $sess_quest['step'] : 0;
		$sess_val['timeout'] = ($sess_quest) ? $sess_quest['timeout'] : 0;
		
		//$questions = $this->question_model->get_by_job($client_job_id);
		
		$quest_num = count($question_id);
	//dumpr($quest_num);
		$data['quest_count'] = $quest_num;
		//if ($quest_num < $sess_step) {
		//	$this->session->unset_userdata('SESS_QUESTION');
		//	redirect('/');
		//}
	//dumpr($state.'-'.$step);
		if ($state == 'ready' && $sess_val['state'] != $state)
		{
			$state = 'start';
		}
		else if ($state == 'stop' && $sess_val['step'] == $step)
		{
			$state = 'ready';
		}

		if ($state == 'ready' && $sess_val['step'] == $step)
		{
			$sess_val['state'] = $state;
			
			$sess_val['timeout'] = $think_time;
	//dumpr($sess_val);
			if (($sess_val['step'] + 1 )> $quest_num)
			{
				//WHEH THE INTERVIEW FINISHED, THEN UNSET SESSION AND GOTO FIRST PAGE!!!
				$this->session->unset_userdata('SESS_QUESTION');
				//echo '<script>alert(\'Interview Finished, Congratulation!\');</script>';
		//		$this->session->unset_userdata('CLIENT_ID');
		//		$this->session->unset_userdata('CLIENT_JOB_ID');
				redirect('/');
				return;
			}
			$sess_val['step'] += 1;
			
			$this->session->set_userdata('SESS_QUESTION', $sess_val);
		}
		
		$data['state'] = $sess_val['state'];
		$data['step'] = $sess_val['step'];
		$data['question'] = $questions[$sess_val['step'] - 1];
	//dumpr($question_id);
	//dumpr($data['question']);
		$this->session->set_userdata('QUESTION_ID', $data['question']->id);
		$result = $this->result_model->get_by_client_question($client_id, $data['question']->id);
		$data ['result_id'] = $result['id'];
	//dumpr($sess_val['timeout'] - time().'-'.count($questions));
		

		$data['sess_think_time'] = $sess_val['timeout'];
		
		if(BROWSER_TYPE=='M' && BROWSER_TYPE_M=='iPhone'){
			
			$data ['title'] = 'Recording';	
			//$data ['client_id'] = $this->session->userdata('CLIENT_ID');
			$header = $this->load->view('employee/recording_header_m',$data , true );	
			$data ['header_content'] = $header;
			$this->load->view('layout/header', $data );
			$this->load->view('employee/recording_m' ); 		
			$this->load->view('layout/footer' );
		}
		
		elseif(BROWSER_TYPE=='M' && BROWSER_TYPE_M=='Android'){
			
//			if (isset($_POST['record_file']))	{
//				$data['rec_file_name'] = $_POST['record_file'];
//				//echo $rec_file_name;
//			}
			
			
			$data ['title'] = 'Recording';
			
			$header = $this->load->view('employee/recording_header_m',$data , true );	
			$data ['header_content'] = $header;
			$this->load->view('layout/header', $data );
			$this->load->view('employee/recording_android' );
			$this->load->view('layout/footer' );
		}
		
		else{
			
			$data ['title'] = 'Recording';
			
			$header = $this->load->view('employee/recording_header', $data, true);
			$data['header_content'] = $header;
			
			$this->load->view('layout/header', $data);			
			$this->load->view('employee/recording', $data);	
			$this->load->view('layout/footer', $data);
		}
		
	
	}

	function start_pc_recorder()
	{
		
		$this->load->view('recorder/index');
		//$footer = $this->load->view('home/home_footer', $data, true);
		//$data['footer_content'] = $footer;
		//$this->load->view('layout/footer', $data);
	}
	
	
	function refresh_data($view_name, $data = array())
	{
		//$data['language'] = get_language_data();
		//$header = $this->load->view('home/home_header', $data, true);
//		if (!$data['head_css'])
//		{
//			$data['head_css'] = array();
//		}
//		if (!is_array($data['head_css']))
//		{
//			$data['head_css'] = array($data['head_css']);
//		}
		//$data['head_css'][] = config_item('css_url') . 'home.css';
		//$data['head_css'] = array(config_item('css_url').'home.css');
		//$data['header_content'] = $header;
		//$this->load->model('notice_model');
		//$data['notice'] = $this->notice_model->get_notice();
		
		$this->load->view('layout/header', $data);
		$this->load->view($view_name, $data);
		
		//$footer = $this->load->view('home/home_footer', $data, true);
		//$data['footer_content'] = $footer;
		$this->load->view('layout/footer', $data);
	}
	
	function mobileImageUpload(){
		$data ['id'] = $this->session->userdata('CLIENT_ID');
		$attr ['upload_path'] = UPLOAD_IMAGE_PATH;
		$attr ['file_name'] = 'photo'.$data ['id'];		
		$attr ['allowed_types'] = 'gif|jpg|png|bmp|tiff';
		$attr ['max_size'] = '4000';
		$attr ['max_width'] = '2000';
		$attr ['max_height'] = '2000';
		$attr ['overwrite'] = TRUE;
		$attr ['remove_spaces'] = TRUE;		
		$this->load->library ( 'upload', $attr );
		
		if ($this->upload->do_upload ( 'take_photo_btn' )) {
			
			$data ['process_flag'] = 1;			
			$data ['file_name'] = $this->upload->file_name;
			$this->load->model('client_model');
			$this->client_model->add_client_image($data);
			
			
		
		$data['title'] = 'Show Photo';		

		$header = $this->load->view('home/show_photo_m',$data, true);
		$data['header_content'] = $header;
		$this->load->view('layout/header', $data);				
		$this->load->view('layout/footer');	
		} else {
			echo "no uploade! try again.<br>";
			echo $this->upload->display_errors();
		}
	
	}
	
	function upload_photo(){
		$data ['id'] = $this->session->userdata('CLIENT_ID');
		$filename ='photo'.$data ['id'].'.jpg';
		//Create image file and put to server
		$result = file_put_contents( UPLOAD_IMAGE_PATH.$filename, file_get_contents('php://input') );
		if (!$result) {
			print "ERROR: ";
			exit();
		}
			
			$data ['file_name'] = $filename;
			$this->load->model('client_model');
			$this->client_model->add_client_image($data);			
			
		//Set url to read.
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . UPLOAD_IMAGE_PATH. $filename;
		print "$url\n";
	}

	public function recording_start()
	{
		$sess_val = $this->session->userdata('SESS_QUESTION');
		$sess_val['state'] = 'start';
		$sess_val['timeout'] = time() + QUESTION_ANSWER_TIME;
		$this->session->set_userdata('SESS_QUESTION', $sess_val);
		echo QUESTION_ANSWER_TIME;
	}
	
	public function start_time_save()
	{
		$user_id = $this->input->post('user_id', true);
		$question_id = $this->input->post('question_id', true);
				
		$start_time=date("Y-m-d H:i:s",time());
		$sql = "update result set start_time = '$start_time' where id_client = '$user_id' AND id_question = '$question_id'";
		
		$query = $this->db->query($sql);
		if ($query)
			echo "ok";
		else
			echo "false";
	}
	
	
	public function recording_stop()
	{
//		$this->load->view('employee/recording_stop' );
		$video_path = $this->input->post('record_file', true);
		$client_id = $this->input->post('user_id', true);
		$question_id = $this->input->post('question_id', true);
		
		$end_time=date("Y-m-d H:i:s",time());		
		$sql = "update result set video_path = '$video_path', end_time = '$end_time' where id_client = '$client_id' AND id_question = '$question_id'";
		//echo $sql;
		$query = $this->db->query($sql);
		if ($query)
			echo "success";
		else
			echo "failed";

					
	}
	
	public function check_stop()
	{
		$client_id = $this->input->post('user_id', true);
		$question_id = $this->input->post('question_id', true);
		
		$this->load->model('result_model');		
		$result = $this->result_model->get_by_client_question($client_id, $question_id);
		if ((!$result['end_time']) || ($result['end_time'] == '0000-00-00 00:00:00') || (!$result['video_path'])){
			echo "false";
		}
		//else echo $result['video_path'];
		else echo "ok";
		
	}

	function result_upload_pc(){
		$client_id = $this->input->post('user_id', true);
		$question_id = $this->input->post('question_id', true);
		
		$end_time=date("Y-m-d H:i:s",time());
		
		$this->load->model('result_model');		
		$result = $this->result_model->get_by_client_question($client_id, $question_id);
		$data ['id'] = $result['id'];
		
		//$attr ['upload_path'] = UPLOAD_CLIENT_INTERVIEW_VIDEO;
		$attr ['file_name'] = 'interview_result_'.$data ['id'];
		$video_path = $attr ['file_name'];
//		$attr ['allowed_types'] = '*';
//		$attr ['max_size'] = '50000';
//		$attr ['max_width'] = '2000';
//		$attr ['max_height'] = '2000';
//		$attr ['overwrite'] = TRUE;
//		$attr ['remove_spaces'] = TRUE;		
//		$this->load->library ( 'upload', $attr );
//		
//		if ($this->upload->do_upload ( 'upload' )) {
//			
//			$data ['process_flag'] = 1;			
//			$data ['file_name'] = $this->upload->file_name;
//			
//			$sql = "update result set video_path = '$data ['file_name']' WHERE id_client = '$client_id' AND id_question = '$question_id'";
//			//dumpr($sql);
//			$query = $this->db->query ( $sql );
//			if ($query) {
//				echo "ok";
//				//redirect ( base_url ( 'recruiter/profile' ) );
//			}
//			else {
//				echo "false";
//				//redirect ( base_url ( 'recruiter/profile' ) );
//			}
//		}
//		else {
//			$error = array ('error' => $this->upload->display_errors());
//			echo $error ['error'];
//		}

		$sql = "update result set video_path = '$video_path', end_time = '$end_time' where id_client = '$client_id' AND id_question = '$question_id'";
		//echo $sql;
		$query = $this->db->query($sql);
		if ($query)
			echo "ok";
		else
			echo "false";
			
		$this->session->unset_userdata('QUESTION_ID');
	
	}
	
	function upload_android()
	{
		$this->load->model('result_model');
		
//		$client_id = $this->session->userdata('CLIENT_ID');
//		$question_id = $this->session->userdata('QUESTION_ID');

//		$client_id = $_COOKIE['CLIENT_ID'];
//		$question_id = $_COOKIE['QUESTION_ID'];
		
		$client_id = $_GET['CLIENT_ID'];
		$question_id = $_GET['QUESTION_ID'];
		
		$end_time=date("Y-m-d H:i:s",time());
		
		$result = $this->result_model->get_by_client_question($client_id, $question_id);		
		$data ['id'] = $result['id'];
		
		$video_path	= $_FILES['uploadedfile']['name'];
		//$video_path = 'interview_result_'.$data ['id'];
		
		$upload_path  = UPLOAD_CLIENT_INTERVIEW_VIDEO;
		
		echo $client_id.",".$question_id.",".$video_path.",".$end_time.", Result_ID=".$data ['id'];
	
	    //$upload_path = $upload_path . basename( $_FILES['uploadedfile']['name']);
	    $upload_path = $upload_path . basename($video_path);
		
	    //echo "echo:".$upload_path;
	    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $upload_path))
	    {
	        echo "The file ".basename( $_FILES['uploadedfile']['name'])." has been uploaded";
	    } 
	    else
	    {
	        echo "There was an error uploading the file, please try again!";
	    }

		$sql = "update result set video_path = '$video_path', end_time = '$end_time' where id_client = '$client_id' AND id_question = '$question_id'";
		//echo $sql;
		$query = $this->db->query($sql);
		if ($query)
			echo "success";
		else
			echo "failed";	
		
		
//		$result = $this->result_model->get_by_client_question($client_id, $question_id);
//		
//		$data ['id'] = $result['id'];
//		
//		$attr ['upload_path'] = UPLOAD_CLIENT_INTERVIEW_VIDEO;
//		$attr ['file_name'] = 'interview_result_'.$data ['id'];
//		$attr ['allowed_types'] = '*';
//		$attr ['max_size'] = 50 * 1024;
//		$attr ['max_width'] = 2000;
//		$attr ['max_height'] = 2000;
//		$attr ['overwrite'] = TRUE;
//		$attr ['remove_spaces'] = TRUE;		
//		$this->load->library ( 'upload', $attr );

		$this->session->unset_userdata('QUESTION_ID');
		
//		if ($this->upload->do_upload ( 'upload' )) {
//			
//			$data ['process_flag'] = 1;			
//			$data ['file_name'] = $this->upload->file_name;
//			
//			$sql = "update result set video_path = '$data ['file_name']', end_time = '$end_time' WHERE id_client = '$client_id' AND id_question = '$question_id'";
//			dumpr($sql);
//			$query = $this->db->query ( $sql );
//			if ($query) {
//				echo "success";
//				//redirect ( base_url ( 'recruiter/profile' ) );
//			}
//			else {
//				echo "false";
//				//redirect ( base_url ( 'recruiter/profile' ) );
//			}
//		}
//		else {
//			$error = array ('error' => $this->upload->display_errors());
//			echo $error ['error'];
//		}
	}
}

?>
