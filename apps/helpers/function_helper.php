<?php
if (!function_exists('get_blog_category_list'))
{
	function get_blog_category_list()
	{
		$CI = & get_instance();
		
		$CI->load->model('blog_model');
		
		$ret_val = array();
		$list = $CI->blog_model->get_category();
		foreach ($list as $row)
			$ret_val[$row->id] = $row->category;
		
		return $ret_val;
	}
}

if (!function_exists('get_industry_list'))
{
	function get_industry_list($user_id)
	{
		$CI = & get_instance();
		
		$CI->load->model('industry_model');
		
		$list = $CI->industry_model->get_by_user($user_id);
		return $list;
	}
}

if (!function_exists('get_job_list'))
{
	function get_job_list($industry_id)
	{
		$CI = & get_instance();
		
		$CI->load->model('job_model');
		
		$list = $CI->job_model->get_job_by_industry($industry_id);
		return $list;
	}
}

if (!function_exists('get_client_list'))
{
	function get_client_list($job_id)
	{
		$CI = & get_instance();
		
		$CI->load->model('client_model');
		
		$list = $CI->client_model->get_by_job($job_id);
		return $list;
	}
}

if (!function_exists('get_comments_list'))
{
	function get_comments_list($result_id)
	{
		$CI = & get_instance();
		
		$CI->load->model('result_model');
		
		$list = $CI->result_model->get_comments($result_id);
		return $list;
	}
}

if (!function_exists('rand_string'))
{
	function rand_string($len)
	{
		$return_str = "";
		for ($i = 0; $i < $len; $i++)
		{
			mt_srand((double)microtime() * 1000000);
			$return_str .= substr('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(0, 61), 1);
		}
		return $return_str;
	}
}

if (!function_exists('get_pass_time'))
{
	function get_pass_time($datetime)
	{
		$time = time() - strtotime($datetime);
		if ($time / 60 < 1)
		{
			return ($time % 60) . ' Seconds ago';
		}
		else if ($time / (60 * 60) < 1)
		{
			return (floor($time / 60) % 60) . ' Minutes ago';
		}
		else if ($time / (60 * 60 * 24) < 1)
		{
			return (floor($time / (60 * 60)) % 24) . ' Hours ago';
		}
		else
		{
			return floor($time / (60 * 60 * 24)) . ' Days ago';
		}
	}
}

if (!function_exists('date_to_localtime'))
{
	function date_to_localtime($date)
	{
		if (empty($date))
			return '';
			
		$tmp = explode(',', $date);
		$tmp1 = explode(' ', $tmp[0]);
		//$date = 
		$str_date = str_replace(', ', ' ', $date);
		return strtotime($str_date);
	}
}


?>