<?php
class Main extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
	}
	
	function index()
	{
		$this->dashboard();
	}
	
	function dashboard()
	{
		$this->load->model('users_model');
		$this->load->model('client_model');
		$this->load->model('blog_model');
		
		$this->set_data('menu', 'dashboard');
		
		$this->set_data('total_user', $this->users_model->get_counts());
		$this->set_data('online_total_user', $this->users_model->get_online_counts());
		$this->set_data('recruiter_counts', $this->users_model->get_counts(USER_RECRUITER_LEVEL));
		$this->set_data('online_recruiter_counts', $this->users_model->get_online_counts(USER_RECRUITER_LEVEL));
		
		$this->set_data('total_client', $this->client_model->get_counts());
		$this->set_data('activated_client', $this->client_model->get_activated_counts());
		
		$this->set_data('total_blogs', $this->blog_model->get_counts());
		$this->set_data('new_blogs', $this->blog_model->get_new_counts());
		
		$this->flush_all('dashboard');
	}
	
	function notice()
	{
		$this->load->model('notice_model');
		
		$this->set_data('menu', 'notice');
		
		$nt_mode = $this->uri->segment(4, 0) ? $this->uri->segment(4, 0) : 'default';
		
		switch ($nt_mode)
		{
			case 'new':
				$this->flush_all('notice_add');
				break;
			case 'add':
				$notice_data = array();
				$notice_data['category'] = $this->input->post('nt_category');
				$notice_data['subject'] = $this->input->post('nt_subject');
				$notice_data['content'] = $this->input->post('nt_content');
				$notice_data['state'] = $this->input->post('nt_state');
				
				$this->notice_model->add($notice_data);
				
				redirect('admin/main/notice');
				break;
			case 'edit':
				$nt_cate = $this->uri->segment(5, 0);
				$this->set_data('notice', $this->notice_model->get_by_category($nt_cate));
				$this->flush_all('notice_edit');
				break;
			case 'update':
				$notice_data = array();
				$notice_id = $this->input->post('nt_id');
				$notice_data['category'] = $this->input->post('nt_category');
				$notice_data['subject'] = $this->input->post('nt_subject');
				$notice_data['content'] = $this->input->post('nt_content');
				$notice_data['state'] = $this->input->post('nt_state');
				
				$this->notice_model->update($notice_id, $notice_data);
				
				$this->set_data('notice', $this->notice_model->get_by_category($notice_data['category']));
				$this->flush_all('notice_edit');
				break;
			case 'activate':
				$nt_cate = $this->uri->segment(5, 0);
				$this->notice_model->set_state($nt_cate, 'Y');
				redirect('admin/main/notice');
				break;
			case 'disable':
				$nt_cate = $this->uri->segment(5, 0);
				$this->notice_model->set_state($nt_cate, 'N');
				redirect('admin/main/notice');
				break;
			case 'delete':
				$nt_cate = $this->uri->segment(5, 0);
				$this->notice_model->delete_by_category($nt_cate);
				redirect('admin/main/notice');
				break;
			default:
				$this->set_data('notice', $this->notice_model->get_all());
				$this->flush_all('notice');
				break;
		}
	}
	
	function check_notice_category()
	{
		$this->load->model('notice_model');
		
		$old_category = $this->input->post('old_cate', true);
		$new_category = $this->input->post('new_cate', true);
		$result = $this->notice_model->exist_category($new_category, $old_category);
		if ($result)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
	}
}
?>