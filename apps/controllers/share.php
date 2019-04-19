<?php
class Share extends MY_Controller {
	
 	function __construct()
    {
        parent::__construct();
		$this->load->helper('data_lan');
		
    }
 
	public function index() {
		
		$video_verify = $this->uri->segment( 3 );
		
		//------------------------------
		$this->load->model ( 'share_model' ); //model(database loading)
		$this->load->model ( 'client_model' );
		$this->load->model ( 'job_model' );
		$this->load->model ( 'result_model' );
		
		// Make sure the random user_id isn't already in use
	    $query = $this->share_model-> is_verify_id ( $video_verify );
	    
		if ($query->num_rows() > 0)
	    {
	        $result = $query->result();
	    }
	    else {
	    	$query->free_result();
	
	        if (!$this->logged_user->is_loggedin())		//set user_id ???
			redirect('/');
	    }
	    
		$user_id = $result[0]->id_user;
		$client_id = $result[0]->id_client; //$this->uri->segment ( 3 );
		
		$clients = $this->client_model->get_inherit ( $user_id );
		$data ['clients'] = $clients; //-----------------------------list of clients
		
		if ($client_id) {
			$user_data = $this->client_model->get_by_id ( $client_id );
			$data ['clientinf'] = $user_data; //------------------------------- client's 
		}
		
		if ($client_id) {
			$inter_result = $this->result_model->get_results ( $client_id );
			$data ['result_all'] = $inter_result; //-------------------------------
		}
		
		$data ['video_path'] = $result[0]->video_path;	
		$data ['video_verify'] = $video_verify;
		
		//$data['language']=get_language_data();	
		$data ['caption'] = $data['language']['share video'];
		$data ['title'] = 'Share Video';
		
		if(BROWSER_TYPE=='M'){
			$this->fresh_view ('video_m', $data );
		}else {
			$this->load->view('video_share', $data);
		}
	}
}

?>