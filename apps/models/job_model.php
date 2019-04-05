<?php
class Job_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_by_id($job_id)
	{
		$sql = 'SELECT job.*, industry.industry_name FROM job INNER JOIN industry ON industry.id = job.id_industry WHERE job.id=\''.$job_id.'\'';
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)
		{
			return false;
		}
		$row = $query->result();
		return $row[0];
	}
	
	function get_job_list($user_id)
	{
		$sql = 'SELECT job.*, industry.industry_name FROM job INNER JOIN industry ON industry.id = job.id_industry WHERE job.id_user=\''.$user_id.'\'';
		$query = $this->db->query($sql);
		if ($query->num_rows() == 0)
		{
			return false;
		}
		$result = $query->result();
		return $result;
	}
	
	function  get_db_jobs()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('job', 'job.id_user = users.id', 'left');
		
		$query = $this->db->get();
		
		return $query;
	}

	function  get_db_job(){
		$query = $this->db->get('job');
		return $query;
	}
	
	function insert($data){
		$result = $this->db->insert('job', $data);
		return $this->db->insert_id();
	}
	
	function get_job_by_industry($industry_id)
	{
		$query = $this->db->order_by('id', 'ASC')->get_where('job', array('id_industry' => $industry_id));
		
		return $query->result();
	}

}