<?php
class Blog extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'blog_model' );
		$this->load->library ( "pagination" );
		$this->load->helper ( 'data_lan' );
	}
	
	public function index() {
		
//				$this->load->view('home/takephoto_header_m');
//				return ;
				
		

		$parameter = ($this->uri->segment ( 3 )) ? $this->uri->segment ( 3 ) : 0;
		
		$temp = explode ( '_', $parameter );
		
		if (count ( $temp ) == 2) {
			$page = $temp [0];
			$cur_category = $temp [1];
		} else {
			$page = $parameter;
			$cur_category = 0;
		}
		$data ['title'] = 'Blog';
		$data ['subtitle'] = 'Blog';
		$data['head_css'] = array(config_item('css_url') . 'jquery.lightbox-0.5.css');
		$header = $this->load->view ( 'blog/blog_header', $data, true );
		$views ['header_content'] = $header;
		$this->load->view ( 'layout/header', $views );
		
		$data ['lastblog'] = $this->blog_model->getlastpost ();
		$config = array ();
		$config ["base_url"] = base_url () . "blog/index";
		$config ["total_rows"] = $this->blog_model->record_count ( $cur_category );
		$config ['per_page'] = 7;
		$config ["uri_segment"] = 3;
		
		$choice = $config ["total_rows"] / $config ["per_page"];
		$config ["num_links"] = round ( $choice );
		
		$this->pagination->initialize ( $config );
		
		//$id_category = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data ['per_page'] = $config ["per_page"];
		$data ["blog"] = $this->blog_model->getblog ( $config ['per_page'], $page, $cur_category );
		$data ["blog_category"] = $this->blog_model->get_category ();
		$data ["links"] = $this->pagination->create_links ();
		$data ['category'] = $cur_category;
		
		$this->load->view ( 'blog/blog_content', $data );
		
		$footer = $this->load->view ( 'home/home_footer', $data, true );
		$views ['footer_content'] = $footer;
		$this->load->view ( 'layout/footer', $views );
	}
	
	public function innerblog($id) {
		$data ['title'] = 'Blog';
		$data ['subtitle'] = 'Blog';
		$data ['aticletitle'] = 'Aticle';
		
		$data['head_css'] = array(config_item('css_url') . 'jquery.lightbox-0.5.css');
		$header = $this->load->view ( 'blog/blog_header', $data, true );
		$views ['header_content'] = $header;
		$this->load->view ( 'layout/header', $views );
		
		$view_data ['innerblog'] = $this->blog_model->get_article ( $id );
		$view_data ['blog_comment'] = $this->blog_model->get_comment ( $id );
		$view_data ["blog_category"] = $this->blog_model->get_category ();
		
		$this->load->view ( 'blog/innnerblog', $view_data );
		
		$footer = $this->load->view ( 'home/home_footer', $data, true );
		$views ['footer_content'] = $footer;
		$this->load->view ( 'layout/footer', $views );
	}
	
	public function reply() {
		$data ['name'] = $this->input->post ( 'user_name', true );
		$data ['email'] = $this->input->post ( 'email', true );
		$data ['subject'] = $this->input->post ( 'subject', true );
		$data ['comment'] = $this->input->post ( 'comment', true );
		$data ['user_id'] = $this->input->post ( 'blog_id', true );
		$this->blog_model->insert_article ( $data );
		redirect ( '/blog/innerblog/' . $data ['user_id'] );
	
	}
	
	function search_blog() {
		$page = ($this->uri->segment ( 3 )) ? $this->uri->segment ( 3 ) : 0;
		$temp = explode ( '_', $page );
		if (count ( $temp ) == 2) {
			$page = $temp [0];
			$search_key = $temp [1];
		} else {
			
			$search_key = $this->input->post ( 'search_key', true );
		}
		
		$search_key = trim ( $search_key );
		
		$data ['search_value'] = $search_key;
		$data ['title'] = 'Blog';
		$data ['subtitle'] = 'search result of Blog';
		$header = $this->load->view ( 'blog/blog_header', $data, true );
		$views ['header_content'] = $header;
		
		$this->load->view ( 'layout/header', $views );
		
		$config = array ();
		$config ["base_url"] = base_url () . "blog/search_blog";
		$config ["total_rows"] = $this->blog_model->search_count ( $search_key );
		$config ["per_page"] = 9;
		$config ["uri_segment"] = 3;
		
		$choice = $config ["total_rows"] / $config ["per_page"];
		$config ["num_links"] = round ( $choice );
		
		$this->pagination->initialize ( $config );
		
		$data ["search_key"] = $search_key;
		$data ['total_number'] = $config ['total_rows'];
		$data ["search_blog"] = $this->blog_model->getsearch_blog ( $config ['per_page'], $page, $search_key );
		$data ["blog_category"] = $this->blog_model->get_category ();
		$data ["links"] = $this->pagination->create_links ();
		
		$this->load->view ( 'blog/blog_search', $data );
		
		//$data['footer_lang'] = get_footer_language();
		$footer = $this->load->view ( 'home/home_footer', $data, true );
		$views ['footer_content'] = $footer;
		$this->load->view ( 'layout/footer', $views );
	}
	
	function blog_editor($message) {
		if (! $this->logged_user->is_loggedin()) {
			redirect('/');
		} 
		if($message=='ok'){
		$data ['title'] = 'Blog';
		$data ['subtitle'] = 'Blog';
		$data ['aticletitle'] = ' add Blog ';
		$data['head_css'] = array(base_url('/template/fckeditor/').'/sample.css');
		$header = $this->load->view ( 'blog/blog_header', $data, true );
		$views ['header_content'] = $header;
		$this->load->view ( 'layout/header', $views );
			
			$data ['message'] = $message;
			$data ['category'] = $this->blog_model->get_category ();
			$this->load->view ( 'blog/blog_editor', $data );
			$footer = $this->load->view ( 'home/home_footer', $data, true );
			$views ['footer_content'] = $footer;
			$this->load->view ( 'layout/footer', $views );
		}else{
			
		$data ['title'] = 'Blog';
		$data ['subtitle'] = 'Blog';
		$data ['aticletitle'] = ' Edit ';
		$data['head_css'] = array(base_url('/template/fckeditor/').'/sample.css');
		$header = $this->load->view ( 'blog/blog_header', $data, true );
		$views ['header_content'] = $header;
		$this->load->view ( 'layout/header', $views );
		
			$data ['blog_id'] =  $message ;
			$data ['blog_data'] = $this->blog_model->get_article ( $message );
			$data ['category'] = $this->blog_model->get_category ();
			$this->load->view ( 'blog/blog_editor', $data );
			$footer = $this->load->view ( 'home/home_footer', $data, true );
			$views ['footer_content'] = $footer;
			$this->load->view ( 'layout/footer', $views );
			
		}				
		
	}
	
	function update_blog(){
	
		
		if (! $this->logged_user->is_loggedin()) {
			redirect('/');
		} 
		$data ['category'] = $this->input->post ( 'category', true );
		$data ['content'] = $this->input->post ( 'update', FALSE );		
		$data ['subject'] = $this->input->post ( 'subject', true );
		$data ['id'] = $this->input->post ( 'blog_id', true );
		$data['allow']=$this->logged_user->get_item('allow');
//		if ($data ['content'] == '' || $data ['subject'] == '') {
//			
//			$view ['message'] = "There are no subject or cotent!";
//			redirect ( '/blog/blog_editor/no' );
//		}
		$view ['message'] = 'ok';
		
		$attr ['upload_path'] = UPLOAD_BLOG_PATH;
		$attr ['allowed_types'] = 'gif|jpg|png';
		$attr ['max_size'] = '1000';
		$attr ['max_width'] = '1024';
		$attr ['max_height'] = '968';
		$this->load->library ( 'upload', $attr );
		
		if ($this->upload->do_upload ( 'file_uploaded' )) {
			
			$data ['process_flag'] = 1;
			$data ['file_name'] = $this->upload->file_name;
			$this->blog_model->update_blog( $data);
		
		} else {
			$data ['process_flag'] = 2;
			$data ['file_name'] = '';
			$this->blog_model->update_blog($data);
		
		}
		redirect ( '/blog/index/' );
	}
	function add_blog() {
		
		if (! $this->logged_user->is_loggedin()) {
			redirect('/');
		} 
		$data ['category'] = $this->input->post ( 'category', true );
		$data ['content'] = $this->input->post ( 'blog_content', FALSE );
		$data ['subject'] = $this->input->post ( 'subject', true );
		$data ['id'] = $this->logged_user->get_item('id');
		$data['allow']=$this->logged_user->get_item('allow');
		if ($data ['content'] == '' || $data ['subject'] == '') {
			
			$view ['message'] = "There are no subject or cotent!";
			redirect ( '/blog/blog_editor/no' );
		}
		$view ['message'] = 'ok';
		
		$attr ['upload_path'] = UPLOAD_BLOG_PATH;
		$attr ['allowed_types'] = 'gif|jpg|png|css|txt|zip|rar';
		$attr ['max_size'] = '1000';
		$attr ['max_width'] = '4024';
		$attr ['max_height'] = '968';
		$this->load->library ( 'upload', $attr );
		
		if ($this->upload->do_upload ( 'file_uploaded' )) {
			
			$data ['process_flag'] = 1;
			$data ['file_name'] = $this->upload->file_name;
			$this->blog_model->addblog ( $data );
			redirect ( '/blog/index/' );
		} else {
			$data ['process_flag'] = 2;
			$data ['file_name'] = '';
			$this->blog_model->addblog ( $data );
			redirect ( '/blog/index/' );
		}
	
	}
	function download_file($file_name) {
		$this->load->helper ( 'download' );
		try {
			$data = file_get_contents ( UPLOAD_PATH . $file_name ); // Read the file's contents	
		} catch ( Exception $e ) {
			echo $e;
			exit ( 1 );
		}
		
		force_download ( $file_name, $data );
	}

}

?>
