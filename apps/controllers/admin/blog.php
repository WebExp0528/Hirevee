<?php
class Blog extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->load->model('blog_model');
	}
	
	function index()
	{
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->load->library('pagination');
		
		$this->set_data('menu', 'blog');
		
		$curr_page = $this->uri->segment(4, 0);
		
		$page_nav = array();
		$page_nav['base_url'] = site_url('admin/blog/index/');
		$page_nav['total_rows'] = $this->blog_model->get_counts();
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
		
		$blog_data = $this->blog_model->get_blog_list(NAV_PER_PAGE_NUM, $curr_page);
		
		$this->set_data('total_num', $page_nav['total_rows']);
		$this->set_data('start_no', $curr_page);
		$this->pagination->initialize($page_nav);
		$pagination = $this->pagination->create_links();
		$this->set_data('pagination', $pagination);
		
		$this->set_data('contents', $blog_data);
		$this->flush_all('blog_list');
	}
	
	function view()
	{
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->set_data('menu', 'blog');
		
		$blog_id = $this->uri->segment(4, 0);
		
		if (!$blog_id)
			redirect('admin/blog/index');
		
		$blog_data = $this->blog_model->get_by_id($blog_id);
		if (!$blog_data)
			redirect('admin/blog/index');
		
		$this->set_data('contents', $blog_data);
		$this->set_data('comments', $this->blog_model->get_comment($blog_id));
		
		$this->flush_all('blog_view');
	}
	
	function edit()
	{
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->set_data('menu', 'blog');
		
		$blog_id = $this->uri->segment(4, 0);
		
		if (!$blog_id)
			redirect('admin/blog/index');
		
		if ($this->input->post('mode', true) == 'update')
		{
			$blog_data = array();
			$blog_data['id_category'] = $this->input->post('b_category');
			$user_data['subject'] = $this->input->post('b_subject');
			$user_data['content'] = $this->input->post('b_content');
			$attach = $this->input->post('b_del_attach');
			if ($attach == 'yes')
				$user_data['attach_file'] = '';
			$this->blog_model->update($blog_id, $user_data);
		}
		$blog_data = $this->blog_model->get_by_id($blog_id);
		
		if (!$blog_data)
			redirect('admin/blog/index');
		
		$this->set_data('contents', $blog_data);
		
		$this->flush_all('blog_edit');
	}
	
	function set_state()
	{
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->set_data('menu', 'blog');
		
		$state = $this->uri->segment(4, 0);
		$blog_id = $this->uri->segment(5, 0);
		
		$state = ($state == 'allow') ? 'Y' : 'N';
		
		$result = $this->blog_model->set_state($blog_id, $state);
		
		redirect('admin/blog/view/' . $blog_id);
	}
	
	function delete()
	{
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->set_data('menu', 'blog');
		
		$blog_id = $this->uri->segment(4, 0);
		
		$result = $this->blog_model->delete($blog_id);
		
		if ($result)
		{
			redirect('admin/blog/index');
		}
		else
		{
			redirect('admin/blog/view/' . $blog_id);
		}
	}
	
	function comment_set_state()
	{
		if (!$this->logged_user->is_loggedin())
		{
			echo 'You must login.';
			return;
		}
		$id = $this->input->post('cmtid', true);
		$state = $this->input->post('curr_state', true);
		$state = ($state == 'active') ? 'Y' : 'N';
		
		$result = $this->blog_model->comment_set_state($id, $state);
		
		if ($result)
			echo 'ok';
		else
			echo 'Change faild.';
	}
	
	function comment_delete()
	{
		if (!$this->logged_user->is_loggedin())
		{
			echo 'You must login.';
			return;
		}
		$id = $this->input->post('cmtid', true);
		
		$result = $this->blog_model->comment_delete($id);
		
		if ($result)
			echo 'ok';
		else
			echo 'Can not delete comment.';
	}
	
	function category()
	{
		if (!$this->logged_user->is_loggedin())
			redirect('admin/user/login');
		
		$this->set_data('menu', 'blog_category');
		
		$blog_category = $this->blog_model->get_category();
		if (!$blog_category)
			redirect('admin/blog/index');
		
		$this->set_data('contents', $blog_category);
		
		$this->flush_all('blog_category');
	}
	
	function category_add()
	{
		if (!$this->logged_user->is_loggedin())
		{
			echo 'You must login.';
			return;
		}
		$category_data['category'] = $this->input->post('name', true);
		$category_data['description'] = $this->input->post('desc', true);
		$result = $this->blog_model->category_add($category_data);
		
		if ($result)
			echo 'ok';
		else
			echo 'Can not add new category.';
	}
	
	function category_edit()
	{
		if (!$this->logged_user->is_loggedin())
		{
			echo 'You must login.';
			return;
		}
		$id = $this->input->post('cid', true);
		$category_data['category'] = $this->input->post('name', true);
		$category_data['description'] = $this->input->post('desc', true);
		
		$result = $this->blog_model->category_update($id, $category_data);
		
		if ($result)
			echo 'ok';
		else
			echo 'Can not update category.';
	}
	
	function category_delete()
	{
		if (!$this->logged_user->is_loggedin())
		{
			echo 'You must login.';
			return;
		}
		
		$id = $this->input->post('cid', true);
		
		$result = $this->blog_model->category_delete($id);
		
		if ($result)
			echo 'ok';
		else
			echo 'Can not delete category.';
	}
}
?>