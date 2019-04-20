<?php
class Sendmail extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();		
		$this->load->library('email');
	}
	
	function send_mail(){	
		
		$name=$this->input->post('name',true);
		$email=$this->input->post('email',true);
		$subject=$this->input->post('subject',true);
		$message=$this->input->post('message',true);
		
		$this->email->from($email, $name);
		$this->email->to(config_item('mail_server_address')); 
				
		$this->email->subject($subject);
		$this->email->message($message);	
		$this->email->send();
		if (BROWSER_TYPE == 'M'){
			$data['title'] = 'recuriter signin';
			$header = $this->load->view('home/home_header_m', '', true);
			$data['header_content'] = $header;
			$this->load->view('layout/header', $data);
			
				$this->load->view('home/signin_m');
			$this->load->view('layout/footer');
			return;
		}		
		echo $this->email->print_debugger();
	}
	
}
?>