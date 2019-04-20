<?php
class Recruiter extends MY_Controller
{
    function __construct ()
    {
        parent::__construct();
        if (!$this->logged_user->is_loggedin())
        {
            redirect('/index.php');
        }
        $this->load->helper('data_lan');
    }
    public function index ()
    {
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('users_model');
        $this->load->model('client_model');
        $this->load->model('transaction_model');
        $this->load->model('job_model');
        $this->set_data('userinf', $this->users_model->get_user_by_id($user_id));
        $this->set_data('clients', 
        $this->client_model->get_last_ten_entries($user_id));
        //$this->set_data('transaction', $this->transaction_model->get_transaction_byid($user_id));
        // Job list
        $jobs = $this->job_model->get_job_list($user_id);
        $job_list = array(0 => 'All Jobs');
        if ($jobs)
        {
            foreach ($jobs as $job)
            {
                $job_list[$job->id] = $job->job_name;
            }
        }
        $this->set_data('job_list', $job_list);
        // Transaction types
        $trans_types = array('all' => 'All Transactions', 
        'fix' => 'Fixed');
        $this->set_data('trans_type_list', $trans_types);
        $this->set_data('caption', 'Home');
        $this->set_data('category', 'home');
        $curr_transaction = $this->input->post('transaction');
        if (!$curr_transaction)
            $curr_transaction = 'all';
        $this->set_data('transaction', $curr_transaction);
        // Get transaction filter params
        $filter_from_date = $this->input->post('from_date');
        $filter_to_date = $this->input->post('to_date');
        $filter_trans = $this->input->post('filter_trans');
        $filter_job = $this->input->post('filter_job');
        if (!$filter_from_date)
            $filter_from_date = date('M d, Y');
        if (!$filter_to_date)
            $filter_to_date = date('M d, Y');
        if (!$filter_trans)
            $filter_trans = 'all';
        if (!$filter_job)
            $filter_job = 0;
        $this->set_data('filters', 
        array('from_date' => $filter_from_date, 'to_date' => $filter_to_date, 
        'trans' => $filter_trans, 'job' => $filter_job));
        if (BROWSER_TYPE == 'M')
        {
            $this->flush_data('recruiter_enter_m');
        }
        else
        {
            $this->flush_data('home');
        }
    }
    function flush_data ($viewer = '')
    {
        if (BROWSER_TYPE == 'M')
        {
            if ($viewer == 'video_jobs_m')
            {
                $header = $this->load->view('recruiter/video_jobs_header_m', 
                $this->data, true);
            }
            else
            {
                $header = $this->load->view('home/home_header_m', '', true);
            }
            $this->load->library('javascript'); //javascript load
            $this->set_data('head_css', 
            array((config_item('css_url') . 'mobile_recruiter.css'), 
            (config_item('admin_css_url') . 'jquery-ui-1.8.21.custom.css'), 
            (config_item('css_url') . 'jquery.rating.css')));
            $this->set_data('header_content', $header);
            //$data['header_content'] = $header;
            $this->load->view('layout/header', $this->data);
            $this->load->view('recruiter/' . $viewer, $this->data);
            $this->load->view('layout/footer');
            return;
        }
        else
        {
            $this->load->library('javascript'); //javascript load
            $this->set_data('head_css', 
            array((config_item('css_url') . 'recruiter.css'), 
            (config_item('admin_css_url') . 'jquery-ui-1.8.21.custom.css'), 
            (config_item('css_url') . 'jquery.rating.css')));
            $this->set_data('header_content', 
            $this->load->view('recruiter/recruiter_header', $this->data, true));
            $this->set_data('footer_content', 
            $this->load->view('recruiter/recruiter_footer', $this->data, true));
            $this->load->view('layout/header', $this->data);
            $this->load->view('recruiter/' . $viewer, $this->data);
            $this->load->view('layout/footer');
        }
    }
    function jobs () //m
    {
        $user_id = $this->logged_user->get_item('id');
        $client_id = $this->uri->segment(3);
        $flag_q = $this->uri->segment(4);
        $search_txt = ($this->input->post('search_txt')) ? $this->input->post(
        'search_txt') : '';
        $this->load->model('client_model');
        $this->load->model('job_model');
        $this->load->model('result_model');
        $this->set_data('caption', 'Jobs');
        $this->set_data('category', 'job');
        //$this->set_data('client_list', $this->client_model->get_inherit($user_id));
        $this->set_data('search_txt', $search_txt);
        if ($client_id)
        {
            $this->set_data('clientinf', 
            $this->client_model->get_by_id($client_id));
            $this->set_data('result_all', 
            $this->result_model->get_by_client($client_id));
        }
        //echo $quesion_result_id;
        //		if ($quesion_result_id)
        //		{
        //			//$result_cur = $this->result_model->get_result_by_id($quesion_result_id);
        //			//$data['result_curr'] = $result_cur;
        //			$this->set_data('result_curr', $this->result_model->get_result_by_id($quesion_result_id));
        //			
        //			//$comments = $this->result_model->get_comments($quesion_result_id);
        //			//$data['comments'] = $comments;
        //			$this->set_data('comments', $this->result_model->get_comments($quesion_result_id));
        //		}
        //$data['user_id'] = $user_id;
        //$data['client_id'] = $client_id; //----------------------------id of one client save
        //$data['quesion_result_id'] = $quesion_result_id;
        //$this->set_data('user_id', $user_id);
        //$this->set_data('client_id', $client_id);
        //$this->set_data('quesion_result_id', $quesion_result_id);
        if (BROWSER_TYPE ==
         'M')
        {
            if ($client_id)
            {
                if (isset($flag_q) && $flag_q == 'question')
                {
                    $this->flush_data('ques_jobs_m.php');
                    return;
                }
                if (isset($flag_q) && $flag_q == 'note')
                {
                    $this->flush_data('notes_jobs_m.php');
                    return;
                }
                $this->flush_data('video_jobs_m');
                return;
            }
            $this->flush_data('list_jobs_m');
        }
        else
        {
            $this->flush_data('job_list');
        }
    }
    function add_job () //m
    {
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('users_model');
        $this->load->model('question_model');
        $this->load->model('industry_model');
        $this->set_data('caption', 'Add Job');
        $this->set_data('category', 'job');
        $this->set_data('userinfo', 
        $this->users_model->get_user_by_id($user_id));
        $this->set_data('questions', 
        $this->question_model->get_question_by_user($user_id));
        $this->set_data('industry', 
        $this->industry_model->get_by_user($user_id));
        $this->flush_data('job_add');
    }
    function add_job_submit ()
    {
        $this->load->model('users_model');
        $this->load->model('job_model');
        $this->load->model('client_model');
        $this->load->model('transaction_model');
        $this->load->model('result_model');
        $user_id = $this->logged_user->get_item('id');
        $staff_num = $this->input->post('staff_num');
        $quest_num = $this->input->post('quest_num');
        //$available = $this->transaction($quesnum);
        $job_data = array();
        $job_data['id_user'] = $user_id;
        $job_data['job_name'] = $this->input->post('job_name');
        $job_data['description'] = $this->input->post('job_desc');
        $job_data['id_industry'] = $this->input->post('job_industry');
        $job_data['close_date'] = $this->input->post('job_closedate');
        $client_list = array();
        for ($i = 1; $i <= $staff_num; $i++)
        {
            $first_name = $this->input->post('first_name_' . $i);
            $surname = $this->input->post('surname_' . $i);
            $email = $this->input->post('email_' . $i);
            if (!$first_name || !$surname || !$email)
                continue;
            $client_list[] = array('first_name' => $first_name, 
            'surname' => $surname, 'email' => $email, 
            'verify_code' => rand_string(20));
        }
        $quest_list = array();
        for ($i = 1; $i <= $quest_num; $i++)
        {
            $quest_id = $this->input->post('question_' . $i);
            if ($quest_id > 0)
            {
                $quest_list[] = $quest_id;
            }
        }
        $job_id = $this->job_model->insert($job_data);
        if (!$job_id)
        {
            redirect('/recruiter/add_job');
            return;
        }
        $this->add_client_module($job_id, $client_list, $quest_list);
        redirect('/recruiter/jobs');
    }
    private function add_client_module ($job_id, $client_list, $quest_list)
    {
        //$this->users_model->update_balance($this->logged_user->get_item('id'), (DEFAULT_STAFF_MONEY * -1));
        //transaction
        $user_id = $this->logged_user->get_item('id');
        $user_info = $this->users_model->get_user_by_id($user_id);
        if ($user_info->balance < count($client_list) * DEFAULT_STAFF_MONEY)
        {
            $this->set_data('error_msg', 'A lack of funding.');
            return;
        }
        //$this->users_model->update_balance($this->logged_user->get_item('id'), (DEFAULT_STAFF_MONEY * -1 * count($client_list)));
        $trans_data = array();
        $trans_data['reg_date'] = date('Y-m-d H:i:s');
        $trans_data['id_user'] = $user_id;
        $trans_data['id_job'] = $job_id;
        $trans_data['type'] = 1;
        $trans_data['amount'] = count($client_list) * DEFAULT_STAFF_MONEY;
        $trans_data['balance'] = $user_info->balance;
        $trans_data['description'] = 'Add new';
        $trans_data['allow'] = 0;
        $this->transaction_model->add($trans_data);
        foreach ($client_list as $client)
        {
            $client['reg_date'] = date('Y-m-d H:i:s');
            $client['id_job'] = $job_id;
            $client_id = $this->client_model->insert($client);
            if (!$client_id)
                continue;
            foreach ($quest_list as $quest)
            {
                if ($this->result_model->check_exist(
                array('id_question' => $quest, 'id_client' => $client_id)))
                    continue;
                $this->result_model->insert(
                array('id_question' => $quest, 'id_client' => $client_id));
            }
            @$this->send_email($client);
        }
    }
    function account ()
    {
        $user_id = $this->logged_user->get_item('id');
        $this->flush_data('account_m.php');
    }
    function clients () //m
    {
        $user_id = $this->logged_user->get_item('id');
        $client_id = $this->uri->segment(3);
        $result_id = $this->uri->segment(4);
        $search_txt = ($this->input->post('search_txt')) ? $this->input->post(
        'search_txt') : '';
        $this->load->model('client_model');
        $this->load->model('job_model');
        $this->load->model('result_model');
        //$this->set_data('language', get_language_data());
        $this->set_data('caption', 'Clients');
        $this->set_data('category', 'client');
        $this->set_data('curr_result', $result_id);
        $this->set_data('client_list', 
        $this->client_model->get_inherit($user_id, $search_txt));
        $this->set_data('search_txt', $search_txt);
        if ($client_id)
        {
            $this->set_data('clientinf', 
            $this->client_model->get_by_id($client_id));
            $inter_result = $this->result_model->get_by_client($client_id);
            $this->set_data('result_all', $inter_result);
        }
        //dumpr($inter_result->num_rows());
        //if ($client_id && isset($inter_result) && $inter_result->num_rows() > 0)
        //{
        //	$row = $inter_result->result();
        //$quesion_result_id = $row[0]->id;
        //	$this->set_data('first_result', $row[0]);
        //}
        //$this->fresh_view('clients', $data);
        $this->flush_data(
        'client_list');
    }
    function add_client () //m
    {
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('users_model');
        $this->load->model('question_model');
        $this->load->model('job_model');
        $this->set_data('caption', 'Add Client');
        $this->set_data('category', 'client');
        $this->set_data('userinfo', 
        $this->users_model->get_user_by_id($user_id));
        $this->set_data('questions', 
        $this->question_model->get_question_by_user($user_id));
        //$this->set_data('industry', $this->industry_model->get_by_user($user_id));
        $this->set_data('jobs', 
        $this->job_model->get_job_list($user_id));
        if (BROWSER_TYPE == 'M')
        {
            $this->flush_data('client_add_m');
        }
        else
        {
            $this->flush_data('client_add');
        }
    }
    function get_job_detail ()
    {
        $this->load->model('job_model');
        $job_id = $this->input->post('jobid');
        $job_data = $this->job_model->get_by_id($job_id);
        if (!$job_data)
        {
            echo 'false';
            return;
        }
        $ret_data = '[{"desc":"' . $job_data->description . '", "industry":"' .
         $job_data->industry_name . '", "closingdate":"' . $job_data->close_date .
         '"}]';
        echo $ret_data;
    }
    function add_client_submit ()
    {
        $this->load->model('users_model');
        $this->load->model('job_model');
        $this->load->model('client_model');
        $this->load->model('transaction_model');
        $this->load->model('result_model');
        $user_id = $this->logged_user->get_item('id');
        $staff_num = $this->input->post('staff_num');
        $quest_num = $this->input->post('quest_num');
        $job_id = $this->input->post('job_name');
        if (!$job_id || $job_id <= 0)
        {
            redirect('/recruiter/add_client');
            return;
        }
        $client_list = array();
        for ($i = 1; $i <= $staff_num; $i++)
        {
            $first_name = $this->input->post('first_name_' . $i);
            $surname = $this->input->post('surname_' . $i);
            $email = $this->input->post('email_' . $i);
            if (!$first_name || !$surname || !$email)
                continue;
            $client_list[] = array('first_name' => $first_name, 
            'surname' => $surname, 'email' => $email, 
            'verify_code' => rand_string(20));
        }
        if (count($client_list) == 0)
        {
            redirect('/recruiter/add_client');
            return;
        }
        $quest_list = array();
        for ($i = 1; $i <= $quest_num; $i++)
        {
            $quest_id = $this->input->post('question_' . $i);
            if ($quest_id > 0)
            {
                $quest_list[] = $quest_id;
            }
        }
        $this->add_client_module($job_id, $client_list, $quest_list);
        redirect('/recruiter/clients');
    }
    function profile () //m			//////////////////////////jon scale////////////////////////////////
    {
        //$data['language'] = get_language_data();
        //$data['caption'] = 'Profile';
        //$data['category'] = 'Profiles';
        //$this->set_data('language', get_language_data());
        $this->set_data('caption', 'Profile');
        $this->set_data('category', 'profile');
        $this->load->model('recruiter_model');
        $this->load->model('question_model');
        $this->load->model('industry_model');
        $this->load->model('job_model');
        //$recruiter_id = $this->session->userdata('RECRUITER_ID');		
        $recruiter_id = $this->logged_user->get_item('id');
        //$recruiter_id = 3;
        //dumpr($recruiter_id);
        //$data['recruiter_id'] = $recruiter_id;
        $this->set_data('recruiter_id', $recruiter_id);
        if (!$recruiter_id)
        {
            redirect('/');
        }
        $recruiter = $this->recruiter_model->get_user_data($recruiter_id);
        //$data['recruiter'] = $recruiter;
        $this->set_data('recruiter', $recruiter);
        //dumpr($recruiter);
        //$recruiter_meta = $this->recruiter_model->get_users_meta_data($recruiter_id);
        //$data['recruiter_meta'] = $recruiter_meta;
        //dumpr($recruiter_meta);
        $recruiter_job = $this->job_model->get_job_list($recruiter_id);
        $this->set_data('recruiter_job', $recruiter_job);
        //dumpr($recruiter_job);
        //$data['recruiter_job'] = $recruiter_job;
        //dumpr($industry);
        //$data['industry'] = $industry;
        $industry = $this->industry_model->get_by_user($recruiter_id);
        $this->set_data('industry', $industry);
        //$data['recruiter_quests'] = $recruiter_quests;
        $recruiter_quests = $this->question_model->get_quests_byuser($recruiter_id);
        $this->set_data('recruiter_quests', $recruiter_quests);
        //$data['online'] = "Online Now";
        $this->set_data('online', 'Online Now');
        //$this->fresh_view('profile', $data);
        $this->flush_data('profile');
    }
    ////////////////////////////////////////////////////////////////jon scale//////////////////////////////
    function add_comment ()
    {
        $this->load->model('result_model');
        $result_id = $this->input->post('resid');
        $comment = $this->input->post('comment');
        $time_now = time();
        $post_date = date('Y-m-d H:i:s', $time_now);
        $update_data = array('id_result' => $result_id, 'comment' => $comment, 
        'post_date' => $post_date);
        $result = $this->result_model->insert_comment($update_data);
        if (!$result)
        {
            echo 'false';
            return;
        }
        $pass_time = time() - $time_now;
        $ret_data = '[{"note":"' . $comment . '", "time":"' . $pass_time .
         ' seconds ago"}]';
        echo $ret_data;
    }
    function get_comments ()
    {
        $this->load->model('result_model');
        $result_id = $this->input->post('resid');
        $ret_data = '[';
        $comments = $this->result_model->get_comments($result_id);
        foreach ($comments->result() as $comment)
        {
            $ret_data .= '{"note":"' . $comment->comment . '", "time":"' .
             get_pass_time($comment->post_date) . '"},';
        }
        if (strlen($ret_data) > 2)
            $ret_data = substr($ret_data, 0, -1);
        echo $ret_data . ']';
    }
    function set_rating ()
    {
        $this->load->model('result_model');
        $result_id = $this->input->post('resid');
        $rating = $this->input->post('rating');
        $result = $this->result_model->update_rating($result_id, $rating);
        if ($result)
            echo 'success';
        else
            echo 'fail';
    }
    function add_questions_modal ()
    {
        $question = $this->input->post('question', true);
        $user_id = $this->input->post('user_id', true);
        $sql = "insert into question(id_user, question) values('$user_id', '$question')";
        $query = $this->db->query($sql);
        //$result = $query->result();
        if ($query)
            echo "ok";
        else
            echo "false";
    }
    function add_industry_modal ()
    {
        $industry = $this->input->post('industry', true);
        $user_id = $this->input->post('user_id', true);
        $sql = "insert into industry(industry_name, id_user) values('$industry', '$user_id')";
        $query = $this->db->query($sql);
        //$result = $query->result();
        if ($query)
            echo "ok";
        else
            echo "false";
    }
    function add_job_modal ()
    {
        $this->load->model('industry_model');
        $user_id = $this->input->post('user_id', true);
        $job_name = $this->input->post('job_name', true);
        $job_description = $this->input->post('job_description', true);
        $job_industry = $this->input->post('job_industry', true);
        $job_closedate = $this->input->post('job_closedate', true);
        $industry = $this->industry_model->get_by_industry_name($job_industry);
        $sql = "insert into job(id_user, job_name, description, id_industry, close_date)
		 values('$user_id', '$job_name', '$job_description', '$industry->id', '$job_closedate')";
        //echo $sql;
        $query = $this->db->query($sql);
        if ($query)
            echo "ok";
        else
            echo "false";
    }
    function banner_color_modal ()
    {
        $user_id = $this->input->post('user_id', true);
        $banner_color = $this->input->post('banner_color', true);
        $sql = "update users set banner_color = '$banner_color' where id = '$user_id'";
        $query = $this->db->query($sql);
        if ($query)
            echo "ok";
        else
            echo "false";
    }
    function add_logo_modal ()
    {
        $user_id = $this->input->post('user_id', true);
        //		$config['upload_path'] = $this->input->post ( 'logo_upload_url', true );
        //		$config['upload_path'] = config_item('logo_recruiter_url');
        $config['upload_path'] = UPLOAD_USER_IMAGE_PATH;
        $config['file_name'] = 'logo_recruiter_' . $user_id;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png|bmp|tiff';
        $config['max_size'] = '20000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = TRUE;
        //dumpr($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('recruiter/profile', $error);
            //dumpr($error['error']);
            echo $error['error'];
            //echo "false";
            redirect(base_url('recruiter/profile'));
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success', $data);
            //dumpr($data);
            //dumpr($data['upload_data']['file_name']);
            $logo_path = $data['upload_data']['file_name'];
            $sql = "update users set logo_path = '$logo_path' where id = '$user_id'";
            //dumpr($sql);
            $query = $this->db->query($sql);
            if ($query)
            {
                //echo "ok";
                redirect(base_url('recruiter/profile'));
            }
            else
            {
                redirect(base_url('recruiter/profile'));
                 //echo "false";
            }
        }
    }
    function change_banner_image_modal ()
    {
        $user_id = $this->input->post('user_id', true);
        $config['upload_path'] = UPLOAD_USER_BANNER_IMAGE_PATH;
        $config['file_name'] = 'banner_recruiter_' . $user_id;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'gif|jpg|png|bmp|tiff';
        $config['max_size'] = '20000';
        $config['max_width'] = '2000';
        $config['max_height'] = '1600';
        //$config ['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('recruiter/profile', $error);
            //dumpr($error['error']);
            echo $error['error'];
            //echo "false";
            redirect(base_url('recruiter/profile'));
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success', $data);
            //dumpr($data);
            //dumpr($data['upload_data']['file_name']);
            $banner_path = $data['upload_data']['file_name'];
            $sql = "update users set banner_img = '$banner_path' where id = '$user_id'";
            //dumpr($sql);
            $query = $this->db->query($sql);
            if ($query)
            {
                //echo "ok";
                redirect(base_url('recruiter/profile'));
            }
            else
            {
                redirect(base_url('recruiter/profile'));
                 //echo "false";
            }
        }
    }
    function add_profile_video_modal ()
    {
        $user_id = $this->input->post('user_id', true);
        $config['upload_path'] = UPLOAD_USER_OPENING_VIDEO;
        $config['allowed_types'] = '*';
        $config['file_name'] = 'opening_video_' . $user_id;
        $config['overwrite'] = TRUE;
        $config['max_size'] = '50000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        //$config ['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('recruiter/profile', $error);
            //dumpr($error['error']);
            echo $error['error'];
            //echo "false";
            redirect(base_url('recruiter/profile'));
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success', $data);
            //dumpr($data);
            //dumpr($data['upload_data']['file_name']);
            $video_path = $data['upload_data']['file_name'];
            $sql = "update users set video = '$video_path' where id = '$user_id'";
            //dumpr($sql);
            $query = $this->db->query($sql);
            if ($query)
            {
                //echo "ok";
                redirect(base_url('recruiter/profile'));
            }
            else
            {
                redirect(base_url('recruiter/profile'));
                 //echo "false";
            }
        }
    }
    function funds () //m
    {
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('users_model');
        $this->set_data('userinf', $this->users_model->get_user_by_id($user_id));
        $this->set_data('caption', 'Home');
        $this->set_data('category', 'home');
        if (BROWSER_TYPE == 'M')
        {
            //$this->fresh_view('recruiter_enter_m', $data);
            $this->flush_data('recruiter_enter_m');
        }
        else
        {
            //$this->fresh_view('fund', $data);
            $this->flush_data('home_funds');
        }
    }
    function add_funds ()
    {
        if (isset($_POST['rdAnswer']))
        {
            $this->load->library('paypal');
            $p = new Paypal();
            //$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            $p->add_field('business', 'wangjengjeng@hotmail.com');
            //$p->add_field('return', 'http://'.$_SERVER['HTTP_HOST'].'/success.php');
            $success_path = base_url('recruiter/add_funds_success');
            $cancel_path = base_url('recruiter/add_funds_cancel');
            $p->add_field('return', $success_path);
            $p->add_field('cancel_return', $cancel_path);
            //$p->add_field ( 'notify_url', 'http://' . $_SERVER ['HTTP_HOST'] . '/ipn.php' );
            //$p->add_field ( 'item_name', $rsddtl ['pro_name'] );
            //$p->add_field ( 'item_number', $insertdid );
            $p->add_field('amount', 
            $_POST['rdAnswer']);
            $p->submit_paypal_post();
        }
        else
        {
            $this->funds();
        }
    }
    function add_funds_success ()
    {
        if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
            ob_start("ob_gzhandler");
        else
            ob_start();
        header("cache-control: must-revalidate");
        $offset = 60 * 60 * 60;
        $expire = "expires: " . gmdate("D, d M Y H:i:s", time() + $offset) .
         " GMT";
        header($expire);
        session_start();
        $stack = array();
        foreach ($_REQUEST as $key => $value)
        {
            $stack[$key] = $value;
        }
        $p = new Paypal(); // initiate an instance of the class
        $nowtimedt = date('Y-m-d H:i:s');
        $sdfsdfsdfsdnum = rand(111113454, 8890980980);
        $insertpaypal = "insert into data_paypal set `mc_gross`='" .
         $stack['mc_gross'] . "' ,`protection_eligibility`='" .
         $stack['protection_eligibility'] . "',`address_status`='" .
         $stack['address_status'] . "', `payer_id`='" . $stack['payer_id'] .
         "',`tax`='" . $stack['tax'] . "',`address_street`='" .
         $stack['address_street'] . "',`payment_date`='" . $stack['payment_date'] .
         "',`payment_status`='" . $stack['payment_status'] . "',`charset`='" .
         $stack['charset'] . "', `address_zip`='" . $stack['address_zip'] .
         "',`first_name`='" . $stack['first_name'] . "',`mc_fee`='" .
         $stack['mc_fee'] . "',`address_country_code`='" .
         $stack['address_country_code'] . "',`address_name`='" .
         $stack['address_name'] . "',`notify_version`='" .
         $stack['notify_version'] . "',`custom`='" . $stack['custom'] .
         "',`payer_status` ='" . $stack['payer_status'] . "',`business`='" .
         $stack['business'] . "',`address_country`='" . $stack['address_country'] .
         "',`address_city`='" . $stack['address_city'] . "',`quantity`='" .
         $stack['quantity'] . "',`verify_sign`='" . $stack['verify_sign'] .
         "',`payer_email`='" . $stack['payer_email'] . "',`txn_id`='" .
         $stack['txn_id'] . "',`payment_type`='" . $stack['payment_type'] .
         "',`last_name`='" . $stack['last_name'] . "',`address_state`='" .
         $stack['address_state'] . "',`receiver_email`='" .
         $stack['receiver_email'] . "',`payment_fee`='" . $stack['payment_fee'] .
         "',`receiver_id`='" . $stack['receiver_id'] . "',`txn_type`='" .
         $stack['txn_type'] . "',`item_name`='" . $stack['item_name'] .
         "',`mc_currency`='" . $stack['mc_currency'] . "',`item_number`='" .
         $stack['item_number'] . "', `residence_country`='" .
         $stack['residence_country'] . "',`test_ipn`='" . $stack['test_ipn'] .
         "',`handling_amount`='" . $stack['handling_amount'] .
         "',`transaction_subject`='" . $stack['transaction_subject'] .
         "',`payment_gross`='" . $stack['payment_gross'] . "',`shipping`='" .
         $stack['shipping'] . "'";
        mysql_query($insertpaypal);
        echo "Payment Completed successfully";
    }
    function add_funds_cancel ()
    {
        echo "paypal pay cancel!";
    }
    function addfun ()
    {
        $user_id = $this->logged_user->get_item('id');
        $this->flush_data('home_fund_m.php');
    }
    function questions ()
    {
        //		if (!$this->logged_user->is_loggedin())		//set user_id ???
        //			redirect('/');
        //			
        //		//$recruiter_id = $this->session->userdata('RECRUITER_ID');
        //		$user_id = $this->session->userdata('SESS_USER_ID');
        $user_id = 1;
        //------------------------------
        $client_id = $this->uri->segment(3);
        $quesion_result_id = $this->uri->segment(4);
        $this->load->model('client_model');
        $this->load->model('job_model');
        $this->load->model('result_model');
        //$data['language'] = get_language_data();
        $data['caption'] = $data['language']['jobs'];
        $data['title'] = 'Jobs';
        $clients = $this->client_model->get_inherit($user_id);
        $data['clients'] = $clients; //-----------------------------list of clients
        //$job_info = $this->job_model->
        $data['user_id'] = $user_id;
        $data['client_id'] = $client_id; //----------------------------id of one client save
        $data['quesion_result_id'] = $quesion_result_id;
        if ($client_id)
        {
            $user_data = $this->client_model->get_by_id($client_id);
            $data['clientinf'] = $user_data; //------------------------------- client's 
        }
        if ($client_id)
        {
            $inter_result = $this->result_model->get_results($client_id);
            $data['result_all'] = $inter_result; //-------------------------------
        }
        if (BROWSER_TYPE == 'M')
        {
            if ($client_id)
            {
                $this->fresh_view('ques_jobs_m', $data);
                return;
            }
        }
    }
    function notes ()
    {
        //		if (!$this->logged_user->is_loggedin())		//set user_id ???
        //			redirect('/');
        //			
        //		//$recruiter_id = $this->session->userdata('RECRUITER_ID');
        //		$user_id = $this->session->userdata('SESS_USER_ID');
        $user_id = 1;
        //------------------------------
        $client_id = $this->uri->segment(3);
        $quesion_result_id = $this->uri->segment(4);
        $this->load->model('client_model');
        $this->load->model('job_model');
        $this->load->model('result_model');
        //$data['language'] = get_language_data();
        $data['caption'] = $data['language']['jobs'];
        $data['title'] = 'Jobs';
        $clients = $this->client_model->get_inherit($user_id);
        $data['clients'] = $clients; //-----------------------------list of clients
        //$job_info = $this->job_model->
        $data['user_id'] = $user_id;
        $data['client_id'] = $client_id; //----------------------------id of one client save
        $data['quesion_result_id'] = $quesion_result_id;
        if ($client_id)
        {
            $user_data = $this->client_model->get_by_id($client_id);
            $data['clientinf'] = $user_data; //------------------------------- client's 
        }
        if ($client_id)
        {
            $inter_result = $this->result_model->get_results($client_id);
            $data['result_all'] = $inter_result; //-------------------------------
        }
        //dumpr($inter_result->num_rows());
        if (!$quesion_result_id && isset($inter_result) &&
         $inter_result->num_rows() > 0)
        {
            $row = $inter_result->result();
            $quesion_result_id = $row[0]->id;
        }
        if ($quesion_result_id)
        {
            $result_cur = $this->result_model->get_result_by_id(
            $quesion_result_id);
            $data['result_curr'] = $result_cur;
            $comments = $this->result_model->get_comments($quesion_result_id);
            $data['comments'] = $comments;
        }
        $data['client_id'] = $client_id; //----------------------------id of one client save
        $data['quesion_result_id'] = $quesion_result_id;
        if (BROWSER_TYPE == 'M')
        {
            $this->fresh_view('notes_jobs_m', $data);
        }
    }
    function fresh_view ($view_name, $data = array())
    {
        if (BROWSER_TYPE == 'M')
        {
            $data['head_css'] = array(
            (config_item('css_url') . 'basestyle.css'), 
            (config_item('css_url') . 'jquery.ui.all.css')); //set css
            if ($view_name == 'video_jobs_m')
            {
                $header = $this->load->view('recruiter/video_jobs_header_m', 
                $data, true);
            }
            else
            {
                $header = $this->load->view('home/home_header_m', '', true);
            }
            $data['header_content'] = $header;
            $this->load->view('layout/header', $data);
            $this->load->view('recruiter/' . $view_name, $data);
            $this->load->view('layout/footer');
            return;
        }
        else
        {
            $this->load->library('javascript'); //javascript load
            $data['head_css'] = array(
            (config_item('css_url') . 'recruiter.css')); //set css
            $header = $this->load->view(
            'recruiter/recruiter_header', $data, true); //get 
            $footer = $this->load->view(
            'recruiter/recruiter_footer', $data, true); //get 
            $data['header_content'] = $header;
            $data['footer_content'] = $footer;
            $this->load->view('layout/header', $data);
            //$this->load->view('recruiter/' . $view_name, $data);
            if ($view_name == 'jobs' || $view_name == 'clients')
            {
                //$this->load->view('recruiter/inter_result', $data);
            }
            $this->load->view('layout/footer');
        }
    }
    function __add_client_submit__ ()
    {
        if (!$this->logged_user->is_loggedin()) //set user_id ???
            redirect('/');
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('job_model'); //model(database loading)
        $this->load->model('client_model');
        $this->load->model('question_model');
        $this->load->model('transaction_model');
        $quesnum = $this->input->post('questnum');
        $available = $this->transaction($quesnum);
        if ($available == false)
        {
            ?>
<script type="text/javascript"> 
    		alert("There is no balance. please add funds."); 
   			history.back(); 
  			</script>
<?php
            exit();
        }
        //job entry		
        $datajob = array('id_user' => $user_id, 
        'job_name' => $this->input->post('jobname'), 
        'description' => $this->input->post('jobdescription'), 
        'close_date' => $this->input->post('closedate'), 
        'id_industry' => $this->input->post('job_industry'));
        if ($datajob['job_name'] == '' || $datajob['description'] == '')
        {
            ?>
<script type="text/javascript"> 
    		alert("please enter all info for job."); 
   			 history.back(); 
  			</script>
<?php
            exit();
        }
        //client entry
        $dataclient = array(
        'first_name' => $this->input->post('firstname'), 
        'surname' => $this->input->post('lastname'), 
        'email' => $this->input->post('usermail'), 
        'reg_date' => $this->input->post('closedate'), 
        'verify_code' => $this->get_client_pass());
        if ($dataclient['first_name'] == '' || $dataclient['surname'] == '' ||
         $dataclient['email'] == '')
        {
            ?>
<script type="text/javascript"> 
			alert("<?php
            echo $dataclient['email']?>");
    		alert("please enter all info for staff."); 
   			 history.back(); 
  			</script>
<?php
            exit();
        }
        $this->job_model->insert_db_job($datajob); //job database 
        $dataclient['id_job'] = $this->db->insert_id(); //get job id
        $this->client_model->insert_db_client($dataclient); //client database
        $id = $this->db->insert_id(); //get client id
        for ($i = 0; $i < $this->input->post('questnum'); $i++)
        {
            $questions = "question" . ($i + 1);
            $dataquestion = array(
            'id_question' => $this->input->post($questions), 'id_client' => $id, 
            'video_path' => 1, 'rating' => 2);
            $this->db->insert('result', $dataquestion);
             //-----------calc balance
        }
        ;
        $datatransaction = array('id_user' => $user_id, 'id_client' => $id, 
        'transaction' => $quesnum * 20, 'date' => $dataclient['reg_date']);
        $this->transaction_model->insert_db_transaction($datatransaction);
        // Send
        $this->send_email($dataclient);
        //mail ( 'goldenstar121@hotmail.com', 'My Subject', 'My Message' );
        $this->add_client();
    }
    function set_comment ()
    {
        $this->load->model('result_model');
        $inter_res_id = $this->input->post('id', true);
        $comment = $this->input->post('comment', true);
        if (!$inter_res_id || !$comment)
        {
            echo "fail";
            return;
        }
        $result = $this->result_model->set_comment($inter_res_id, $comment);
        echo "ok";
    }
    function set_star_rating ()
    {
        $this->load->model('result_model');
        $inter_rating = $this->input->post('total', true);
        $inter_id = $this->input->post('number', true);
        if ($inter_id == '')
        {
            echo "fail";
        }
        $this->result_model->update_rating($inter_id, $inter_rating);
        echo "ok";
        exit();
    }
    function transaction ($quesnum)
    {
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('users_model');
        $res = $this->users_model->decrease_one_by_id($user_id, $quesnum);
        return $res;
    }
    function send_email ($receiver)
    {
        $this->load->library('email');
        // set email class parameters
        $this->email->from($this->logged_user->get_item('email'), 
        $this->logged_user->get_item('name'));
        $this->email->to($receiver['email']);
        $this->email->subject(
        'Hi ' . $receiver['first_name'] . ' ' . $receiver['surname'] .
         '! You add to seeking worker.');
        $this->email->message('Your verify code is ' . $receiver['verify_code']);
        if ($this->email->send())
        {
            //show_error ('Email sent.');
        }
        else
        {
            //show_error($this->email->print_debugger());
        }
    }
    function get_client_pass ()
    {
        $this->load->model('client_model');
        // Create a random client id		mt_rand(1200,999999999)
        $random_pass = rand_string(20);
        // Make sure the random user_id isn't already in use
        $query = $this->client_model->is_verify_id($random_pass);
        if ($query->num_rows() > 0)
        {
            $query->free_result();
            // If the random user_id is already in use, get a new number
            $this->get_client_pass();
        }
        return $random_pass;
    }
    function set_share ()
    {
        $inter_rating = $this->input->post('total', true);
        //share data
        $sharedata = array('id_user' => $this->input->post('id_user'), 
        'id_client' => $this->input->post('id_client'), 
        'video_path' => $this->input->post('video_path'), 
        'video_verify' => $this->get_share_pass());
        $email = $this->input->post('email');
        if ($sharedata['id_user'] == '' || $sharedata['id_client'] == '' ||
         $sharedata['video_path'] == '')
        {
            ?>
<script type="text/javascript"> 
	    		alert("please enter all info for staff."); 
	   			 history.back(); 
	  			</script>
<?php
            echo "fail";
            exit();
        }
        //-----------		
        $this->load->model('share_model');
        $this->share_model->insert_db_share($sharedata); //client database
        //mail ( 'goldenstar121@hotmail.com', 'My Subject', 'My Message' );
        //-----------------------
        $user_id = $sharedata['id_user'];
        $this->load->model('users_model');
        $userdata = $this->users_model->get_user_by_id($user_id);
        //	$dataclient = array ('first_name', 'surname', 'email', 'verify_code');
        $this->load->library('email');
        // set email class parameters
        $this->email->from($userdata[0]->email, 
        $userdata[0]->first_name . $userdata[0]->last_name);
        $this->email->to('$email');
        $this->email->subject('Testing email class');
        $this->email->message(
        ' 
				<tr>
					<td>
						<p style="font-family:Arial;font-size:20px;margin-bottom:0.5em">Hi goldenstar121,</p>
						<p style="margin-bottom:0px">
						<b>Projects:</b>
						</p>
						<p style="margin-bottom:14px">
						<a target="_blank" href="https://http://192.168.1.100/interview/#contact" style="color:#0093d0;text-decoration:none">Upload Script & Configure</a>
						<br>
						Employer: koj
						<br>
						Budget: $250-$750 USD
						<br>
						Skills: MySQL, Script Install
						</p>
					</td>
				</tr>
		' .
         'How are you?, your verify code is ' . $sharedata['video_verify'] . '');
        if ($this->email->send())
        {
            echo 'Email sent.';
        }
        else
        {
            show_error($this->email->print_debugger());
        }
        //---------------
        echo "ok";
        exit();
    }
    function get_share_pass ()
    {
        $this->load->model('share_model');
        // Create a random client id		mt_rand(1200,999999999)
        $random_pass = rand_string(20);
        // Make sure the random user_id isn't already in use
        $query = $this->share_model->is_verify_id($random_pass);
        if ($query->num_rows() > 0)
        {
            $query->free_result();
            // If the random user_id is already in use, get a new number
            $this->get_share_pass();
        }
        return $random_pass;
    }
    function down_csv ()
    {
        if (!$this->logged_user->is_loggedin()) //set user_id ???
            redirect('/');
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('transaction_model');
        $filter = array('fromdate' => $this->input->post('fromdate'), 
        'todate' => $this->input->post('todate'));
        $sql_csv = $this->transaction_model->get_transaction_byfilter($user_id, 
        $filter);
        $this->CSVExport($sql_csv); //$query
        $this->index();
    }
    //Get the result of the query as a CSV stream.
    //http://www.bin-co.com/php/scripts/csv_import_export/
    function CSVExport ($sql_csv)
    {
        header("Content-type:text/octect-stream");
        header("Content-Disposition:attachment;filename=data.csv");
        while ($row = mysql_fetch_row($sql_csv))
        {
            print '"' . stripslashes(implode('","', $row)) . "\"\n";
        }
        exit();
    }
    // Action
    function __add_job_submit__ ()
    {
        if (!$this->logged_user->is_loggedin()) //set user_id ???
            redirect('/');
        $user_id = $this->logged_user->get_item('id');
        $this->load->model('job_model'); //model(database loading)
        $this->load->model('client_model');
        $this->load->model('question_model');
        $this->load->model('transaction_model');
        $quesnum = $this->input->post('questnum');
        $available = $this->transaction($quesnum);
        if ($available == false)
        {
            ?>
<script type="text/javascript"> 
	    		alert("There is no balance. please add funds."); 
	   			 history.back(); 
	   			 
  			</script>
<?php
            exit();
        }
        //job entry	
        $datajob = array('id_user' => $user_id, 
        'job_name' => $this->input->post('jobname'), 
        'description' => $this->input->post('jobdescription'), 
        'close_date' => $this->input->post('closedate'), 'id_industry' => 1);
        if ($datajob['job_name'] == '' || $datajob['description'] == '')
        {
            ?>
<script type="text/javascript"> 
    		alert("please enter all info for job."); 
   			 history.back(); 
  			</script>
<?php
            exit();
        }
        //client entry
        $dataclient = array(
        'first_name' => $this->input->post('firstname'), 
        'surname' => $this->input->post('surename'), 
        'email' => $this->input->post('usermail'), 
        'reg_date' => $this->input->post('closedate'), 
        'verify_code' => $this->get_client_pass());
        if ($dataclient['first_name'] == '' || $dataclient['surname'] == '' ||
         $dataclient['email'] == '')
        {
            ?>
<script type="text/javascript"> 
    		alert("please enter all info for staff."); 
   			 history.back(); 
  			</script>
<?php
            exit();
        }
        $this->job_model->insert_db_job($datajob); //job database 
        $dataclient['id_job'] = $this->db->insert_id(); //get job id
        $this->client_model->insert_db_client($dataclient); //client database
        $id = $this->db->insert_id(); //client job id
        for ($i = 0; $i < $quesnum; $i++)
        {
            $questions = "question" . ($i + 1);
            $dataquestion = array(
            'id_question' => $this->input->post($questions), 'id_client' => $id, 
            'video_path' => 1, 'rating' => 2);
            $this->db->insert('result', $dataquestion);
        }
        ;
        $datatransaction = array('id_user' => $user_id, 'id_client' => $id, 
        'transaction' => $quesnum * 20);
        $this->transaction_model->insert_db_transaction($datatransaction);
        // Send
        $this->send_email($dataclient);
        //mail ( 'goldenstar121@hotmail.com', 'My Subject', 'My Message' );
        $this->add_job();
    }
}
?>