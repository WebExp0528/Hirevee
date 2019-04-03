<?php
class Profile extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->load->model('users_model');
		$this->set_data('menu', 'profile');
	}
	
	function index()
	{
		$profile = $this->users_model->get_user_by_id($this->logged_user->get_item('id'));
		
		if (!$profile)
			redirect('admin');
			
		$this->set_data('contents', $profile);
		$this->flush_all('profile');
	}
	
	function update()
	{
		$profile['name'] = $this->input->post('u_name', true);
		$profile['email'] = $this->input->post('u_email', true);
		$profile['company'] = $this->input->post('u_company', true);
		$passwd = $this->input->post('u_new_passwd', true);
		if (!empty($passwd) && strlen(trim($passwd)) > 0)
			$profile['passwd'] = sha1($passwd);
			
		$this->users_model->update($this->logged_user->get_item('id'), $profile);
		
		redirect('admin/profile');
	}
}
?>