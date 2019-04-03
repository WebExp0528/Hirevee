<?php
class Client_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function check_enter_code($email, $code)
	{
		$query = $this->db->select(array('id', 'id_job'))->get_where('client', array('email' => $email, 'verify_code' => $code));
		if ($query->num_rows() == 0)
		{
			return false;
		}
		$row = $query->result();
		return $row[0];
	}
	
	function get_by_id($client_id)
	{
		$sql = 'SELECT c.*, j.job_name, i.id AS id_industry, i.industry_name FROM client c 
				INNER JOIN job j ON j.id=c.id_job 
				INNER JOIN industry i ON i.id=j.id_industry 
				WHERE c.id=' . $client_id;
		
		$query = $this->db->query($sql);
		
		if ($query->num_rows() == 0)
		{
			return false;
		}
		$row = $query->result();
		return $row[0];
	}
	
	function get_last_ten_entries($recruiter_id = 0)
	{
		$sql = 'SELECT c.first_name, c.surname, j.job_name, ir.* FROM client c
				INNER JOIN result ir on ir.id_client = c.id
				INNER JOIN job j on j.id = c.id_job 
				WHERE j.id_user = ' . $recruiter_id;
		$query = $this->db->query($sql);
		return $query;
	}
	
	function get_by_job($job_id)
	{
		$query = $this->db->order_by('id', 'ASC')->get_where('client', array('id_job' => $job_id));
		return $query->result();
	}
	
	function ___get_clients_inherit($user_id)
	{
		$sql = 'SELECT c.*, j.job_name, i.id AS industry_id, i.industry_name FROM client c 
				INNER JOIN job j ON j.id=c.id_job AND j.id_user=' . $user_id . ' 
				INNER JOIN industry i ON i.id=j.id_industry 
				ORDER BY industry_id, c.id_job ASC';
		
		$query = $this->db->query($sql);
		
		return $query;
	}
	
	// by mi
	function get_inherit($user_id, $search = '')
	{
		$exp_where = (!$search || empty($search)) ? '' : ' AND (c.first_name LIKE \'%'.$search.'%\' OR c.surname LIKE \'%'.$search.'%\')';
		$sql = 'SELECT c.*, j.job_name, j.close_date, i.id AS id_industry, i.industry_name  
				FROM client c
				LEFT JOIN job j ON j.id = c.id_job
				LEFT JOIN industry i ON i.id = j.id_industry AND j.id_user = i.id_user
				WHERE i.id_user = ' . $user_id. $exp_where . '
				ORDER BY c.id ASC';
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	function get_db_clients()
	{
		
		$this->db->select('first_name, surname, job_name, client.id');
		$this->db->from('client');
		$this->db->join('job', 'job.id = client.id_job', 'inner');
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_db_client()
	{
		$query = $this->db->get('client');
		return $query;
	}
	
	function insert($data)
	{
		$result = $this->db->insert('client', $data);
		return $this->db->insert_id();
	}
	
	function get_db_client_id($client_id)
	{
		$this->db->select('*, client.id');
		$this->db->from('client');
		$this->db->join('job', 'job.id = client.id_job', 'left');
		$this->db->where('client.id', $client_id);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function is_verify_id($random_pass)
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->where('verify_code', $random_pass);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_counts($option = null, $value = null)
	{
		$where = array();
		if (!is_null($option))
		{
			$where[$option] = $value;
		}
		
		$result = $this->db->select('COUNT(id) AS cnt')->get_where('client', $where);
		if ($result->num_rows == 0)
			return 0;
		
		$row = $result->result();
		return $row[0]->cnt;
	}
	
	function add_client_image($par)
	{
		$data = array('photo' => $par['file_name']);
		
		$this->db->where('id', $par['id']);
		
		$this->db->update('client', $data);
	}
	function get_activated_counts()
	{
		$sql = 'SELECT COUNT(id) AS cnt FROM client WHERE photo != \'\'';
		$result = $this->db->query($sql);
		if ($result->num_rows == 0)
			return 0;
		
		$row = $result->result();
		return $row[0]->cnt;
	}
}