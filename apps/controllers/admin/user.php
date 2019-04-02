<?php
class User extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('users_model');
		$this->set_data('menu', 'user');
	}
	
	function index()
	{
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->load->library('pagination');
		
		$curr_page = $this->uri->segment(4, 0);
		
		$page_nav = array();
		$page_nav['base_url'] = site_url('admin/user/index/');
		$page_nav['total_rows'] = $this->users_model->get_counts();
		$page_nav['uri_segment'] = 4;
		$page_nav['per_page'] = NAV_PER_PAGE_NUM;
		$page_nav['num_links'] = 3;
		$page_nav['page_query_string'] = false;
		$page_nav['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
		$page_nav['full_tag_close'] = '</ul></div>';
		$page_nav['first_link'] = '&lt;&lt; First';
		$page_nav['first_tag_open'] = '<li>';
		$page_nav['first_tag_close'] = '</li>';
		$page_nav['last_link'] = 'Last &gt;&gt;';
		$page_nav['last_tag_open'] = '<li>';
		$page_nav['last_tag_close'] = '</li>';
		$page_nav['prev_link'] = '&lt; Prev';
		$page_nav['prev_tag_open'] = '<li>';
		$page_nav['prev_tag_close'] = '</li>';
		$page_nav['next_link'] = 'Next &gt;';
		$page_nav['next_tag_open'] = '<li>';
		$page_nav['next_tag_close'] = '</li>';
		$page_nav['cur_tag_open'] = '<li class="active"><a>';
		$page_nav['cur_tag_close'] = '</a></li>';
		$page_nav['num_tag_open'] = '<li>';
		$page_nav['num_tag_close'] = '</li>';
		
		$user_data = $this->users_model->get_user_list(NAV_PER_PAGE_NUM, $curr_page);
		
		$this->set_data('total_num', $page_nav['total_rows']);
		$this->set_data('start_no', $curr_page);
		$this->pagination->initialize($page_nav);
		$pagination = $this->pagination->create_links();
		$this->set_data('pagination', $pagination);
		
		$this->set_data('contents', $user_data);
		$this->flush_all('user_list');
	}
	
	function login()
	{
		if ($this->logged_user->is_loggedin())
			redirect('admin');
		
		$is_submit = $this->input->post('action', true);
		if ($is_submit == 'login')
		{
			$user_name = $this->input->post('username', true);
			$user_passwd = $this->input->post('userpasswd', true);
			
			if ($user_name && $user_passwd)
			{
				$result = $this->users_model->check_validate($user_name, sha1($user_passwd));
				if ($result && $result->level == USER_ADMIN_LEVEL)
				{
					if ($result->allow == 'Y')
					{
						$this->logged_user->set_user($result);
						$this->session->set_userdata('SESS_ADMIN_INFO', $this->logged_user->get_object());
						redirect('admin');
					}
					else
						$this->session->set_flashdata('LOGIN_STATUS', 'block');
				}
				else
					$this->session->set_flashdata('LOGIN_STATUS', 'faild');
			}
		}
		$this->set_data('no_visible_elements', true);
		$this->flush_all('login');
	}
	
	function logout()
	{
		$this->session->unset_userdata('SESS_ADMIN_INFO');
		redirect('admin');
	}
	
	function delete()
	{
		if (!$this->logged_user->is_loggedin())
		{
			echo 'You must login.';
			return;
		}
		$user_id = $this->input->post('userid', true);
		
		if ($this->logged_user->get_item('id') == $user_id)
		{
			echo 'Can not delete administrator.';
			return;
		}
		
		$result = $this->users_model->delete_by_id($user_id);
		
		if ($result)
			echo 'ok';
		else
			echo 'Can not delete user because of user details are still exist.';
	}
	
	function edit()
	{
	    $this->load->model('job_model');
	    $this->load->model('industry_model');
	    $this->load->model('question_model');
	    
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$user_id = $this->uri->segment(4, 0);
		if (!$user_id)
			redirect('admin/user/index');
		
		if ($this->input->post('mode', true) == 'update')
		{
			$user_data = array();
			$user_data['name'] = $this->input->post('u_name', true);
			$user_data['email'] = $this->input->post('u_email', true);
			$user_data['email'] = $this->input->post('u_email', true);
			$user_data['company'] = $this->input->post('u_company', true);
			$user_data['balance'] = $this->input->post('u_balance', true);
			$user_data['allow'] = $this->input->post('u_allow', true);
			$this->users_model->update($user_id, $user_data);
		}
		
		$user_data = $this->users_model->get_user_by_id($user_id);
		if (!$user_data)
			redirect('admin/user/index');
			
		$jobs = $this->job_model->get_job_list($user_id);
		$industries = $this->industry_model->get_by_user($user_id);
		$quests = $this->question_model->get_quests_byuser($user_id);
		
		$this->set_data('userinfo', $user_data);
		$this->set_data('jobs', $jobs);
		$this->set_data('industries', $industries);
		$this->set_data('questions', $quests);
		$this->set_data('userid', $user_id);
		
		$this->flush_all('user_edit');
	}
	
}