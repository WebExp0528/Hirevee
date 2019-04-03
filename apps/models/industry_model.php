<?php

class industry_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_industry()
	{
		$query = $this->db->get('industry');
		if ($query->num_rows() == 0)
		{
			return false;
		}
		$result = $query->result();
		return $result;
	}
	
	function get_by_user($user_id)
	{
		$query = $this->db->order_by('id', 'ASC')->get_where('industry', array('id_user' => $user_id));
		return $query->result();
	}
	
	function get_by_industry_name($job_industry)
	{
		$query = $this->db->select('id')->get_where('industry', array('industry_name' => $job_industry));
		if ($query->num_rows() == 0)
		{
			return false;
		}
		$row = $query->result();
		return $row[0];
	}

}

?>