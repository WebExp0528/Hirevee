<?php
class Home extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('data_lan');
	}
	
	public function index()
	{
		$this->load->model('notice_model');
		
		if (BROWSER_TYPE == 'M')
		{
			
			$this->load_mobile_view();
			return;
		}
		$data = array();
		$data['title'] = 'Hire Vee';
		$data['head_css'] = array(config_item('css_url') . 'jquery.ui.dialog.css');
		$data['notice'] = $this->notice_model->get_all();
		
		$this->load->model ( 'blog_model' );
		$data ['lastblog'] = $this->blog_model->getlastpost();		
		
		$this->refresh_data('home_main', $data);
	}
	
	public function open_entercode()
	{
		$data = array();
		$data['head_css'] = array(config_item('css_url') . 'home.css');
		$this->load->view('layout/header', $data);
		$this->load->view('home/enter_code');
		$this->load->view('layout/footer');
	}
	
	public function open_signup($v = 'signin')
	{
		if (BROWSER_TYPE == 'M')
		{
			$data['title'] = 'recuriter signin';
			$header = $this->load->view('home/home_header_m', '', true);
			$data['header_content'] = $header;
			$this->load->view('layout/header', $data);
			if ($v == 'signup')
				$this->load->view('home/signup_m');
			else
				$this->load->view('home/signin_m');
			$this->load->view('layout/footer');
			return;
		}
		else
		{
			if ($this->logged_user->is_loggedin())
			{
				redirect('/recruiter/index');
			}
			$data['title'] = 'Signup free';
			$this->load->view('layout/header', $data);
			$this->load->view('home/signup');
			//footer
			$footer = $this->load->view('home/home_footer', $data, true);
			$foot['footer_content'] = $footer;
			$this->load->view('layout/footer', $foot);
		}
	}
	
	public function open_contactus()
	{
		if (BROWSER_TYPE == 'M')
		{
			$data['title'] = 'Contact us';
			$header = $this->load->view('home/home_header_m', '', true);
			$data['header_content'] = $header;
			$this->load->view('layout/header', $data);
			
			$this->load->view('home/contactus_m');
			$this->load->view('layout/footer');
			return;
		}
	}

	public function open_aboutus()
	{
		if (BROWSER_TYPE == 'M')
		{
			$data['title'] = 'About us';
			$header = $this->load->view('home/home_header_m', '', true);
			$data['header_content'] = $header;
			$this->load->view('layout/header', $data);
			
			$this->load->view('home/aboutus_m');
			$this->load->view('layout/footer');
			return;
		}
	}
	
	
	
	public function signin()
	{
		$this->load->model('users_model');
		
		$user_name = $this->input->post('username', true);
		$user_passwd = $this->input->post('userpaasword', true);
		
		if (!$user_name || !$user_passwd)
		{
			echo "empty";
			return;
		}
		$result = $this->users_model->check_validate($user_name, sha1($user_passwd));
		if (!$result)
		{
			echo "fail";
			return;
		}
		if ($result->allow == 'N')
		{
			echo "deny";
			return;
		}
		$this->logged_user->set_user($result);
		
		$this->session->set_userdata('SESS_USER_INFO', $this->logged_user->get_object());
		
		echo 'ok';
	}
	
	public function signout()
	{
		$this->session->unset_userdata('SESS_USER_INFO');
		redirect('/');
	}
	
	public function verify_code()
	{
		$this->load->model('client_model');
		
		$email = $this->input->post('enter_email', true);
		$code = $this->input->post('enter_code', true);
		
		if (!$email || !$code)
		{
			echo 'fail';
			//redirect('/');
			return;
		}
		
		$client = $this->client_model->check_enter_code($email, $code);
		if (!$client)
		{
			echo 'fail';
			//redirect('/');
			return;
		}
		
		$this->session->set_userdata('CLIENT_ID', $client->id);
		$this->session->set_userdata('CLIENT_JOB_ID', $client->id_job);
		echo 'ok';
	}
	
	function refresh_data($view_name, $data = array())
	{
		//$data['language'] = get_language_data();
		$header = $this->load->view('home/home_header', $data, true);
		if (!$data['head_css'])
		{
			$data['head_css'] = array();
		}
		if (!is_array($data['head_css']))
		{
			$data['head_css'] = array($data['head_css']);
		}
		$data['head_css'][] = config_item('css_url') . 'home.css';
		$data['header_content'] = $header;

		$this->load->view('layout/header', $data);
		$this->load->view('home/' . $view_name, $data);
		
		$data['footer_content'] = $this->load->view('home/home_footer', $data, true);
		$this->load->view('layout/footer', $data);
	}
	
	function howtowork($id = 0)
	{
		$this->load->model('introduction_model');
		$data['title'] = 'How it works';
		$data['subtitle'] = 'how it works';
		$header = $this->load->view('home/howtowork_header', $data, true);
		$views['header_content'] = $header;
		$this->load->view('layout/header', $views);
		
		$body['id'] = $id;
		$body['category'] = $this->introduction_model->get_introduction();
		$this->load->view('home/howtowork_body', $body);
		
		$footer = $this->load->view('home/home_footer', '', true);
		$data['footer_content'] = $footer;
		$this->load->view('layout/footer', $data);
	}
	
	public function sign_register()
	{
		
		$this->load->model('users_model');
		$user['name'] = $this->input->post('name', true);
		$user['company'] = $this->input->post('company', true);
		$user['email'] = $this->input->post('email', true);
		$user['passwd'] = sha1($this->input->post('password', true));
		if($this->users_model->check_validate($user['name'],$user['passwd'])){
			echo 'no';
			return false;
		}
			
		$this->users_model->add_user($user);
		
		if (BROWSER_TYPE == 'M')
		{
			$this->open_signup('signin');
		}
		echo 'ok';
	}
	public function check_username()
	{
		$this->load->model('users_model');
		
		$name_add = $this->input->post('name', true);
		$result = $this->users_model->exist_name($name_add);
		if ($result)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
	///////////////////////////////////////mobile/////////////////////////////////////////////////////////////////
	function load_mobile_view()
	{
		$data = array();
		$data['title'] = 'Mobile Hire Vee';
		$header = $this->load->view('home/home_header_m', '', true);
		$data['header_content'] = $header;
		$this->load->view('layout/header', $data);
		//body
		$this->load->view('home/home_main_m');
		//footer
		$this->load->view('layout/footer');
	
	}
	
	function m_howtowork()
	{
		$data = array();
		$data['title'] = 'How to work';
		$header = $this->load->view('home/home_header_m', '', true);
		$data['header_content'] = $header;
		$this->load->view('layout/header', $data);
		$this->load->view('home/howtowork_body_m');
		$this->load->view('layout/footer');
	
	}
	
	function open_entercode_view()
	{
		$data = array();
		$data['title'] = 'How to work';
		$header = $this->load->view('home/home_header_m', '', true);
		$data['header_content'] = $header;
		$this->load->view('layout/header', $data);
		$this->load->view('home/enter_code_m');
		$this->load->view('layout/footer');
	}
	function open_takephoto_view()
	{
		$data = array();
		$data['title'] = 'Take Photo';
		//$data ['client_id'] = $this->session->userdata('CLIENT_ID');
		$header = $this->load->view('home/takephoto_header_m', '', true);
		$data['header_content'] = $header;
		$this->load->view('layout/header', $data);
		//$this->load->view('home/enter_code_m' ); add video sector;		
		$this->load->view('layout/footer');
	}

}
?>