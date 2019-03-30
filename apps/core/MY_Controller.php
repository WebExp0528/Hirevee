<?php
class MY_Controller extends CI_Controller
{
	var $data = array();
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('logged_user');
		$this->check_loggedin();
	}
	
	function check_loggedin()
	{
		$session_user = $this->session->userdata('SESS_USER_INFO');
		$this->logged_user->validate_user($session_user);
	}
	
	function set_data($key, $value)
	{
		if (!$key)
			return;
		
		$this->data[$key] = $value;
	}
	
	function get_data($key)
	{
		if (!$key || !isset($this->data[$key]))
			return null;
		return $this->data[$key];
	}
}

class Admin_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function flush_all($view = '')
	{
		$this->load->view('admin/header', $this->data);
		$this->load->view('admin/sidebar', $this->data);

		if ($view != '')
		{
			$this->load->view('admin/' . $view, $this->data);
		}
		$this->load->view('admin/footer', $this->data);
	}
	
	function check_loggedin()
	{
		$session_user = $this->session->userdata('SESS_ADMIN_INFO');
		$this->logged_user->validate_user($session_user);
	}
	
}
?>