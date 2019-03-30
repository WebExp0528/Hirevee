<?php
class Logged_user
{
	var $id;
	var $email;
	var $name;
	var $allow;
	var $level;
	
	function __construct()
	{
		$this->initialize();
	}
	
	function set_user($user_info)
	{
		if (!$user_info)
			return;
		
		$tmp = get_object_vars($user_info);
		
		$this->id = $tmp['id'];
		$this->email = $tmp['email'];
		$this->name = $tmp['name'];
		$this->allow = $tmp['allow'];
		$this->level = $tmp['level'];
	}
	
	function initialize()
	{
		$this->id = 0;
		$this->email = '';
		$this->name = '';
		$this->allow = 'N';
		$this->level = 0;
	}
	
	function is_loggedin()
	{
		if (!$this->id || $this->allow == 'N')
			return false;
		
		return true;
	}
	
	function get_object()
	{
		return $this;
	}
	
	function get_item($type)
	{
		if (isset($this->$type))
		{
			return $this->$type;
		}
		else
		{
			return '';
		}
	}
	
	function is_admin()
	{
		if ($this->level == USER_ADMIN_LEVEL)
			return true;
		
		return false;
	}
	
	function validate_user($user_info = false)
	{
		$this->set_user($user_info);
		
		$CI = & get_instance();
		
		if (!$this->id || !$this->name)
		{
			$this->initialize();
			return false;
		}
		
		$query = $CI->db->get_where('users', array('id' => $this->id, 'name' => $this->name));
		if ($query->num_rows() == 0)
		{
			$this->initialize();
			return false;
		}
		$row = $query->result();
		
		$this->email = $row[0]->email;
		$this->allow = $row[0]->allow;
		$this->level = $row[0]->level;
		
		$CI->db->update('users', array('last_date' => date('Y-m-d H:i:s')), array('id' => $this->id));
		
		return true;
	}
}
?>